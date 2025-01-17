<?php

declare(strict_types=1);

namespace Jose\Bundle\JoseFramework\Event;

use Jose\Component\Core\JWKSet;
use Jose\Component\Signature\JWS;
use Symfony\Contracts\EventDispatcher\Event;

final class JWSVerificationFailureEvent extends Event
{
    public function __construct(
        private JWS $jws,
        private JWKSet $JWKSet,
        private ?string $detachedPayload
    ) {
    }

    public function getJws(): JWS
    {
        return $this->jws;
    }

    public function getJWKSet(): JWKSet
    {
        return $this->JWKSet;
    }

    public function getDetachedPayload(): ?string
    {
        return $this->detachedPayload;
    }
}
