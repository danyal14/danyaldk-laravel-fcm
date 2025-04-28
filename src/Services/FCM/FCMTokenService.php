<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

use Google\Client;
use Illuminate\Support\Facades\Cache;

class FCMTokenService
{
    public function getAccessToken(): string
    {
        error_log("FCM-V1: getAccessToken");
        return Cache::remember('fcm_access_token', now()->addMinutes(30), function () {
            return $this->fetchNewAccessToken();
        });
    }

    public function refreshAccessToken(): string
    {
        error_log("FCM-V1: refreshAccessToken");
        $token = $this->fetchNewAccessToken();
        Cache::put('fcm_access_token', $token, now()->addMinutes(30));
        return $token;
    }

    protected function fetchNewAccessToken(): string
    {
        error_log("FCM-V1: fetchNewAccessToken");

        // Initialize Google Client
        $client = new Client();

        // Set credentials directly from .env values
        $client->setAuthConfig([
            'type' => 'service_account',
            'project_id' => env('FIREBASE_PROJECT_ID'),
            'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID'),
            'private_key' => env('FIREBASE_PRIVATE_KEY'),
            'client_email' => env('FIREBASE_CLIENT_EMAIL'),
            'client_id' => env('FIREBASE_CLIENT_ID'),
            'auth_uri' => env('FIREBASE_AUTH_URI'),
            'token_uri' => env('FIREBASE_TOKEN_URI'),
            'auth_provider_x509_cert_url' => env('FIREBASE_AUTH_PROVIDER_X509_CERT_URL'),
            'client_x509_cert_url' => env('FIREBASE_CLIENT_X509_CERT_URL'),
        ]);

        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // Fetch access token using assertion
        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];
    }
}