<?php

declare(strict_types=1);

namespace Jose\Bundle\JoseFramework\Event;

use Jose\Component\Core\JWKSet;
use Jose\Component\Encryption\JWE;
use Symfony\Contracts\EventDispatcher\Event;

final class JWELoadingSuccessEvent extends Event
{
    public function __construct(
        private string $token,
        private JWE $jwe,
        private JWKSet $JWKSet,
        private int $recipient
    ) {
    }

    public function getJws(): JWE
    {
        return $this->jwe;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getJWKSet(): JWKSet
    {
        return $this->JWKSet;
    }

    public function getRecipient(): int
    {
        return $this->recipient;
    }
}
