<?php

declare(strict_types=1);

namespace Jose\Component\NestedToken;

use Jose\Component\Encryption\JWELoaderFactory;
use Jose\Component\Signature\JWSLoaderFactory;

class NestedTokenLoaderFactory
{
    public function __construct(
        private JWELoaderFactory $jweLoaderFactory,
        private JWSLoaderFactory $jwsLoaderFactory
    ) {
    }

    /**
     * This method creates a Nested Token Loader with the given encryption/signature algorithms, serializers,
     * compression methods and header checkers.
     */
    public function create(
        array $jweSerializers,
        array $keyEncryptionAlgorithms,
        array $contentEncryptionAlgorithms,
        array $compressionMethods,
        array $jweHeaderCheckers,
        array $jwsSerializers,
        array $signatureAlgorithms,
        array $jwsHeaderCheckers
    ): NestedTokenLoader {
        $jweLoader = $this->jweLoaderFactory->create(
            $jweSerializers,
            $keyEncryptionAlgorithms,
            $contentEncryptionAlgorithms,
            $compressionMethods,
            $jweHeaderCheckers
        );
        $jwsLoader = $this->jwsLoaderFactory->create($jwsSerializers, $signatureAlgorithms, $jwsHeaderCheckers);

        return new NestedTokenLoader($jweLoader, $jwsLoader);
    }
}
