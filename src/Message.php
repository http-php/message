<?php

declare(strict_types=1);

namespace HttpPHP\Messages;

use HttpPHP\Headers\Contracts\HeaderContract;
use HttpPHP\Headers\Header;
use HttpPHP\Messages\Contracts\MessageContract;
use HttpPHP\Messages\Exceptions\HeaderNotPresentException;
use HttpPHP\Payload\Contracts\PayloadContract;

final class Message implements MessageContract
{
    /**
     * @param null|PayloadContract $payload
     * @param array<int|string,HeaderContract> $headers
     */
    public function __construct(
        private readonly null|PayloadContract $payload = null,
        private array $headers = [],
    ) {
    }

    /**
     * @param null|PayloadContract $payload
     * @param array<int|string,HeaderContract> $headers
     * @return MessageContract
     */
    public static function make(
        null|PayloadContract $payload = null,
        array $headers = [],
    ): MessageContract {
        return new Message(
            payload: $payload,
            headers: $headers,
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
     * @return array<int|string,HeaderContract>
     */
    public function headers(): array
    {
        return $this->headers;
    }
}
