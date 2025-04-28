# Laravel FCM

A Laravel package for Firebase Cloud Messaging (FCM) that simplifies sending push notifications to Android and iOS devices.
Installation

To install the package, run the following command:

```bash 
 composer require danyaldk/laravel-fcm
```


## Configuration
### Environment Variables
Add the following environment variables to your .env file. These variables are required for authenticating with Firebase:

### Service Provider
The package will be automatically discovered by Laravel. If you are using Laravel 5.4 or below, you need to manually register the service provider in config/app.php:

    'providers' => [
        // Other service providers...
        DanyalDK\LaravelFCM\LaravelFCMServiceProvider::class,
    ],

## Usage
### Sending Notifications
You can send notifications to Android and iOS devices using the NotificationSender class.

Example: Sending an Android Notification

    use DanyalDK\LaravelFCM\Services\FCM\NotificationSender;

    $response = NotificationSender::send(
        'android',
        'your-device-token',
        'Test Title',
        'Test Body',
        'https://example.com'
    );
    
    if (isset($response['success']) && $response['success']) {
        echo "Notification sent successfully!";
    } else {
        echo "Failed to send notification.";
    }


Example: Sending an iOS Notification

    use DanyalDK\LaravelFCM\Services\FCM\NotificationSender;
    
    $response = NotificationSender::send(
        'ios',
        'your-device-token',
        'Test Title',
        'Test Body',
        'https://example.com'
    );
    
    if (isset($response['success']) && $response['success']) {
        echo "Notification sent successfully!";
    } else {
        echo "Failed to send notification.";
    }

### Handling Errors

The send method returns a response array. You can check for errors and handle them accordingly:

    $response = NotificationSender::send(
        'android',
        'your-device-token',
        'Test Title',
        'Test Body',
        'https://example.com'
    );
    
    if (isset($response['error'])) {
        echo "Error: " . $response['error'];
    } else {
        echo "Notification sent successfully!";
    }

### Contributing

If you find any issues or have suggestions for improvements, feel free to open an issue or submit a pull request on GitHub.

### License

This package is open-source software licensed under the MIT license.
This README.md file provides a comprehensive guide for end users, covering installation, configuration, usage, error handling, testing, contributing, and licensing. Make sure to replace placeholder values with actual information relevant to your Firebase project.