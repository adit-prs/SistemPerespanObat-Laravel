<?php

namespace App\Services;

use App\Models\ApiToken;
use Illuminate\Support\Facades\Http;

class ApiExtService
{
    protected string $serviceName = 'api-token';

    public function getMedicineList(): array
    {
        $token = $this->getValidToken();

        if (!$token) {
            throw new \Exception("Token tidak tersedia atau sudah kedaluwarsa.");
        }

        $response = Http::withToken($token)
            ->get('http://recruitment.rsdeltasurya.com/api/v1/medicines');

        if ($response->failed()) {
            throw new \Exception('Gagal mengambil data obat.' . $response->failed());
        }

        return $response->json();
    }

    protected function getValidToken(): ?string
    {
        $token = ApiToken::where('service', $this->serviceName)
            ->latest()
            ->first();

        // Kalau token tidak ada atau sudah expired
        if (!$token || now()->greaterThan($token->expires_at)) {
            // Refresh token
            $newToken = $this->refreshToken();

            // Simpan ke database
            ApiToken::create([
                'service' => $this->serviceName,
                'access_token' => $newToken['token'],
                'expires_at' => now()->addSeconds($newToken['expires_in']),
            ]);

            return $newToken['token'];
        }

        return $token->access_token;
    }

    protected function refreshToken(): array
    {
        $response = Http::asForm()->post('http://recruitment.rsdeltasurya.com/api/v1/auth', [
            'email' => config('services.api.client_id'),
            'password' => config('services.api.client_secret'),
        ]);

        if ($response->failed()) {
            throw new \Exception('Gagal refresh token dari API.');
        }

        return [
            'token' => $response['access_token'],
            'expires_in' => $response['expires_in'], // dalam detik
        ];
    }

    public function getMedicinePrice($id): array
    {
        $token = $this->getValidToken();

        if (!$token) {
            throw new \Exception("Token tidak tersedia atau sudah kedaluwarsa.");
        }

        $response = Http::withToken($token)
            ->get('http://recruitment.rsdeltasurya.com/api/v1/medicines/' . $id . '/prices');

        if ($response->failed()) {
            throw new \Exception('Gagal mengambil data harga obat.');
        }

        return $response->json();
    }
}