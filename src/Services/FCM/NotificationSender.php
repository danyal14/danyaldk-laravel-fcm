<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

class NotificationSender
{
    public static function send(string $device, string $token, string $title, string $body, string $deeplink)
    {
        $tokenService = new FCMTokenService();
        $fcmClient = new FCMClient($tokenService);

        if ($device === 'android') {
            $notification = (new AndroidNotification())
                ->setToken($token)
                ->setTitle($title)
                ->setBody($body)
                ->setDeeplink($deeplink)
                ->build();
        } elseif ($device === 'ios') {
            $notification = (new IOSNotification())
                ->setToken($token)
                ->setTitle($title)
                ->setBody($body)
                ->setDeeplink($deeplink)
                ->build();
        } else {
            return response()->json(['error' => 'Unsupported device'], 422);
        }

        return $fcmClient->send($notification);
    }
}