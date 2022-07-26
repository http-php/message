# Message

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
[![Tests][badge-tests]][tests]
[![Total Downloads][badge-downloads]][downloads]

[badge-tests]: https://github.com/http-php/message/actions/workflows/test.yml/badge.svg
[badge-release]: https://img.shields.io/packagist/v/http-php/message.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/http-php/message.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/http-php/message.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/http-php/message
[php]: https://php.net
[downloads]: https://packagist.org/packages/http-php/message
[tests]: https://github.com/http-php/message/actions/workflows/test.yml
<!-- BADGES_END -->

This package is to allow you to create HTTP Messages in PHP, in a simple and reliable way.

## Installation

```bash
composer require http-php/message
```

## Usage

To use this package, it is very simple. Create a message using the following code:

```php
use HttpPHP\Message\Message;

$message = Message::make(
    payload: ['test' => 'payload'],
);

// Add a header
$message->withHeader(
    key: 'Authorization',
    value: 'Bearer some-super-secret-token',
);

// Fetch the header value
$message->header(
    key: 'Authorization',
)->toString(); // 'Bearer some-super-secret-token'

// Fetch all headers
$message->headers();

// Fetch the payload
$message->payload()->parse(); // Returns an array representation of the payload.
$message->payload()->body(); // Returns the raw payload you wish to send.
```

## Testing

To run the test suite:

```bash
composer run test
```

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## LICENSE

The MIT LIcense (MIT). Please see [License File](./LICENSE) for more information.