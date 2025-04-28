# Laravel FCM

A Laravel package for Firebase Cloud Messaging.

## Installation

```bash 
 composer require danyaldk/laravel-fcm
```


## Usage

    use DanyalDK\LaravelFCM\Services\FCM\NotificationSender;
    
    NotificationSender::send('android', 'your-device-token', 'Test Title', 'Test Body', 'https://example.com');