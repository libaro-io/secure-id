# Description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/libaro/secure-id.svg?style=flat-square)](https://packagist.org/packages/libaro/secure-id)
[![Total Downloads](https://img.shields.io/packagist/dt/libaro/secure-id.svg?style=flat-square)](https://packagist.org/packages/libaro/secure-id)
![GitHub Actions](https://github.com/libaro/secure-id/actions/workflows/main.yml/badge.svg)

The Secure ID Laravel Package simplifies the integration of the Secure ID functionality into your Laravel projects. Secure ID is designed to facilitate a secure login procedure by generating sign requests, managing user responses through QR codes or SMS, and seamlessly logging users into your projects.

## Installation

You can install the package via composer:

```bash
composer require libaro/secure-id
```

Publish the config file: 
```php
php artisan vendor:publish --provider="Libaro\SecureId\SecureIdServiceProvider" --tag="config"
```
The content of the config file:
```php
return [
    'api_url' => env('SECURE_ID_API_URL', 'https://secureid.digitalhq.com/api/generate'),
    'api_key' => env('SECURE_ID_API_KEY'),
    'api_url_prefix' => env('SECURE_ID_API_URL_PREFIX', '/api/secure-id'),

    'webhook_handlers' => [
        \Support\Interfaces\SecureIdWebhookHandler::class,
    ],
];
```

## Usage

The default WebhookHandler can be replaced by a custom handler in the config file for handling events to authenticating users.
```php
class SecureIdWebhookHandler implements WebhookHandlerInterface
{
	public function handleWebhook(string $phone, string $code): void
	{
		event(new SMSSignRequestReceived($code, $phone));
	}
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


### Security

If you discover any security related issues, please email tim@libaro.be instead of using the issue tracker.

## Credits
Props to:
-   [Tim Vande Walle](https://github.com/libaro-io)
-   [Libaro](https://github.com/libaro-io)
-   [DigitalHQ](https://digitalhq.com)
- https://www.laravelpackage.com
- https://laravelpackageboilerplate.com

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
