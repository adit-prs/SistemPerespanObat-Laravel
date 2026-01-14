<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ExternalAuthService
{
    protected $client;
    protected string $redisKey = 'external:token';

    public function __construct()
    {
        $this->client = Http::baseUrl(config('services.ext_api.base_url'))
            ->timeout(10)
            ->acceptJson();
    }

    public function getToken()
    {
        if (Redis::exists($this->redisKey)) {
            return Redis::get($this->redisKey);
        }

        return $this->login();
    }

    protected function login()
    {
        try {
            $response = $this->client->post('/auth', [
                'email' => config('services.ext_api.username'),
                'password' => config('services.ext_api.password'),
            ]);

            if ($response->failed()) {
                throw new \Exception("API Error: ".$response->body());
            }

            $data = $response->json();
            $token = $data['access_token'];

            $ttl = max($this->ttlUntilMidnight(), 60);

            Redis::setex($this->redisKey, $ttl, $token);

            return $token;
        } catch (\Exception $e) {
            Log::error("API Auth Error: ".$e->getMessage());

            return null;
        }
    }

    public function ttlUntilMidnight(): int
    {
        $now = Carbon::now();
        $midnight = Carbon::tomorrow()->startOfDay();

        // minimal TTL 60 detik biar gak 0
        return max($now->diffInSeconds($midnight), 60);
    }

    public function refreshToken()
    {
        return $this->login();
    }
}