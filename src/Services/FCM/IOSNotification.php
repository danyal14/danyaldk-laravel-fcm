<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

class IOSNotification extends NotificationBuilder
{
    public function build(): array
    {
        return [
            'message' => [
                'token' => $this->token,
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'alert' => [
                                'title' => $this->title,
                                'body' => $this->body,
                            ],
                            'sound' => 'default',
                        ],
                        'deeplink' => $this->deeplink,
                    ],
                ],
            ],
        ];
    }
}