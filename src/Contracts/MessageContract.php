<?php

declare(strict_types=1);

namespace HttpPHP\Messages\Contracts;

use HttpPHP\Headers\Contracts\HeaderContract;
use HttpPHP\Messages\Exceptions\HeaderNotPresentException;
use HttpPHP\Payload\Contracts\PayloadContract;

interface MessageContract
{
    /**
     * @param null|PayloadContract $payload
     * @return MessageContract
     */
    public static function make(null|PayloadContract $payload = null): MessageContract;

    /**
     * @return PayloadContract|null
     */
    public function payload(): null|PayloadContract;

    /**
     * @param string $key
     * @param float|bool|int|string $value
     * @return MessageContract
     */
    public function withHeader(string $key, int|string|bool|float $value): MessageContract;

    /**
     * @param string $key
     * @return HeaderContract
     * @throws HeaderNotPresentException
     */
    public function header(string $key): HeaderContract;

    /**
     * @return array<int|string,HeaderContract>
     */
    public function headers(): array;
}
