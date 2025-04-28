<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

use Illuminate\Support\Facades\Http;

class FCMClient
{
    protected string $projectId = 'bold-app-ad48f';
    protected FCMTokenService $tokenService;

    public function __construct(FCMTokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function send(array $payload): array
    {
        error_log("FCM-V1: send");
        $accessToken = $this->tokenService->getAccessToken();
        $response = $this->makeRequest($payload, $accessToken);

        // If unauthorized (401 or 403), refresh token and retry ONCE
        if ($response->status() === 401 || $response->status() === 403) {
            error_log("FCM-V1: send (" . $response->status() . ") > refreshAccessToken");

            $accessToken = $this->tokenService->refreshAccessToken();
            $response = $this->makeRequest($payload, $accessToken);
        }
        error_log("FCM-V1: send success");
        return $response->json();
    }

    protected function makeRequest(array $payload, string $accessToken)
    {
        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";
        error_log("FCM-V1: makeRequest");
        return Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, ['message' => $payload]);
    }
}