<?php

namespace App\Services;

use App\Models\prescriptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\DataTables;

class MedicineService
{
    protected $client;
    protected $redisKey = 'external:medicines';
    protected $auth;

    public function __construct(
        ExternalAuthService $auth
    ) {
        $this->client = Http::baseUrl(config('services.ext_api.base_url'))
            ->timeout(10)
            ->acceptJson();
        $this->auth = $auth;
    }

    public function getList()
    {
        // cek cache dulu
        if (Redis::exists($this->redisKey)) {
            return json_decode(Redis::get($this->redisKey), true);
        }

        // kalau tidak ada cache → fetch ke API
        $token = $this->auth->getToken();

        $response = $this->client
            ->withToken($token)
            ->get('/medicines');


        // handle token invalid
        if ($response->unauthorized()) {
            $token = $this->auth->refreshToken(); // refresh token
            $response = $this->client
                ->withToken($token)
                ->get('/medicines');
        }

        $data = $response->json();

        // hitung TTL sampai jam 00:00 besok
        $ttl = $this->auth->ttlUntilMidnight();

        Redis::setex($this->redisKey, $ttl, json_encode($data));

        return $data;
    }

    public function getTodayPrice($id, ?Carbon $date = null): ?array
    {
        $detail = $this->getDetail($id);

        if (!isset($detail['prices']) || !is_array($detail['prices'])) {
            return null;
        }

        $dateString = ($date ?? now())->toDateString(); // 'Y-m-d'

        $prices = collect($detail['prices']);

        $current = $prices
            ->filter(function ($price) use ($dateString) {
                $start = $price['start_date']['value'] ?? null;
                $end = $price['end_date']['value'] ?? null;

                if (!$start) {
                    return false;
                }

                return $start <= $dateString
                    && (is_null($end) || $end >= $dateString);
            })
            // kalau ada beberapa yang cocok, ambil yang start_date-nya paling baru
            ->sortByDesc(fn($price) => $price['start_date']['value'])
            ->first();

        if (!$current) {
            return null;
        }

        return [
            'id' => $current['id'],
            'unit_price' => $current['unit_price'],
            'start_date' => $current['start_date']['value'] ?? null,
            'end_date' => $current['end_date']['value'] ?? null,
        ];
    }

    public function getDetail($id)
    {
        $cacheKey = "external:medicines:{$id}";

        if (Redis::exists($cacheKey)) {
            return json_decode(Redis::get($cacheKey), true);
        }

        $token = $this->auth->getToken();
        $response = $this->client
            ->withToken($token)
            ->get("/medicines/{$id}/prices");
        if ($response->unauthorized()) {
            $token = $this->auth->refreshToken();
            $response = $this->client
                ->withToken($token)
                ->get("/medicines/{$id}/prices");
        }

        $data = $response->json();

        Redis::setex($cacheKey, $this->auth->ttlUntilMidnight(), json_encode($data));

        return $data;
    }

    public function getAllPrescriptions($status = null)
    {
        $query = prescriptions::with('examinations');
        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    public function getAllTables($status = null)
    {
        $query = prescriptions::with('examinations');

        if ($status) {
            $query->where('status', $status);
        }

        return DataTables::of($query)
            ->editColumn('examined_at', function ($row) {
                return $row->examinations ? Carbon::parse($row->examinations->examined_at)->format('d/m/Y') : '-';
            })
            ->filterColumn('examined_at', function ($query, $keyword) {
                $query->whereHas('examinations', function ($q) use ($keyword) {
                    $q->where('examined_at', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('action', function ($row) {
                $url = route('prescriptions.show', $row['id']);

                return '<a href="'.$url.'" class="btn-detail text-blue-500 hover:underline">Detail</a>';
            }
            )
            ->rawColumns(['action']) // supaya HTML tidak di-escape
            ->make(true);
    }

    public function getPrescriptionItem($id)
    {
        $query = prescriptions::with('prescriptionitems')->where('id', $id)->first();

        return $query;
    }

    public function getPrescriptionDetail($id)
    {
        $query = prescriptions::with('examinations.patient')->where('id', $id)->first();

        return $query;
    }

    public function updatePrescriptionStatus($id, $status)
    {
        $query = prescriptions::where('id', $id)->update(['status' => $status]);

        return $query;
    }
}
