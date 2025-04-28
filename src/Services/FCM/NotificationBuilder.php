<?php

namespace DanyalDK\LaravelFCM\Services\FCM;

abstract class NotificationBuilder
{
    protected string $token;
    protected string $title;
    protected string $body;
    protected string $deeplink;

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function setDeeplink(string $deeplink): self
    {
        $this->deeplink = $deeplink;
        return $this;
    }

    abstract public function build(): array;
}