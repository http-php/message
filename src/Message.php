<?php

declare(strict_types=1);

namespace HttpPHP\Messages;

use HttpPHP\Headers\Contracts\HeaderContract;
use HttpPHP\Headers\Header;
use HttpPHP\Messages\Contracts\MessageContract;
use HttpPHP\Messages\Exceptions\HeaderNotPresentException;
use HttpPHP\Payload\Contracts\PayloadContract;
use HttpPHP\Payload\Payload;

final class Message implements MessageContract
{
    /**
     * @param array<string,HeaderContract> $headers
     */
    public function __construct(
        private null|PayloadContract $payload = null,
        private array $headers = [],
    ) {
    }

    /**
     * @return MessageContract
     */
    public static function make(mixed $payload = null): MessageContract
    {
        return new Message(
            payload: Payload::make(
                body: $payload,
            ),
            headers: [],
        );
    }

    public function payload(): null|PayloadContract
    {
        return $this->payload;
    }

    /**
     * @param string $key
     * @param float|bool|int|string $value
     * @return MessageContract
     */
    public function withHeader(string $key, float|bool|int|string $value): MessageContract
    {
        $this->headers[$key] = Header::make(
            key: $key,
            value: $value,
        );

        return $this;
    }

    /**
     * @param string $key
     * @return HeaderContract
     * @throws HeaderNotPresentException
     */
    public function header(string $key): HeaderContract
    {
        if (array_key_exists($key, $this->headers)) {
            return $this->headers[$key];
        }

        throw new HeaderNotPresentException(
            message: "Header [$key] has not been set.",
        );
    }

    /**
     * @return array<string,HeaderContract>
     */
    public function headers(): array
    {
        return $this->headers;
    }
}
