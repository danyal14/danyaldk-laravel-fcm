<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

class AndroidNotification extends NotificationBuilder
{
    public function build(): array
    {
        return [
            'token' => $this->token,
            'notification' => [
                'title' => $this->title,
                'body' => $this->body,
            ],
            'data' => [
                'deeplink' => $this->deeplink,
                'title' => $this->title,
                'body' => $this->body,
                'device' => 'android',
            ]
        ];
    }
}