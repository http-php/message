<?php

declare(strict_types=1);

use HttpPHP\Headers\Contracts\HeaderContract;
use HttpPHP\Headers\Contracts\HeaderValueContract;
use HttpPHP\Headers\Header;
use HttpPHP\Messages\Contracts\MessageContract;
use HttpPHP\Messages\Exceptions\HeaderNotPresentException;
use HttpPHP\Messages\Message;
use HttpPHP\Payload\Contracts\PayloadContract;
use HttpPHP\Payload\Payload;

it('can build a new message', function () {
    expect(
        new Message(),
    )->toBeInstanceOf(MessageContract::class);
});

it('can add a new header to the message', function () {
    $message = new Message();

    expect(
        $message->headers(),
    )->toBeArray()->toBeEmpty();

    $message->withHeader(
        key: 'test',
        value: 'test',
    );

    expect(
        $message->headers(),
    )->toBeArray()->toHaveCount(1);
});

it('can return the value of a single header', function () {
    $message = (new Message())->withHeader(
        key: 'test',
        value: 'header',
    );

    expect(
        $message->header(
            key: 'test',
        ),
    )->toBeInstanceOf(HeaderContract::class)->key()->toEqual('test')
        ->value()->toBeInstanceOf(HeaderValueContract::class);

    expect(
        $message->header(
            key: 'test',
        )->value()->toString(),
    )->toEqual('header');
});

it('can get all headers', function () {
    $message = new Message(
        headers: [Header::make(
            key: 'test',
            value: 'header',
        )],
    );

    expect(
        $message->headers(),
    )->toBeArray()->toHaveCount(1);
});

it('can set the payload', function () {
    $message = new Message(
        payload: Payload::make(
            body: '{"test": "header"}',
        ),
    );

    expect(
        $message->payload(),
    )->toBeInstanceOf(PayloadContract::class);

    expect(
        $message->payload()->parse(),
    )->toBeArray()->toEqual(['test' => 'header']);
});

it('can create a message statically', function () {
    expect(
        Message::make(),
    )->toBeInstanceOf(MessageContract::class);
});

it('throws a header not present exception when trying to get a header that has not been set', function () {
    Message::make()->header(
        key: 'test',
    );
})->throws(HeaderNotPresentException::class);
