<?php

declare(strict_types=1);

namespace Jose\Bundle\JoseFramework\Services;

use Jose\Component\Encryption\Serializer\JWESerializerManagerFactory;
use Jose\Component\Signature\Serializer\JWSSerializerManagerFactory;
use Psr\EventDispatcher\EventDispatcherInterface;

final class NestedTokenBuilderFactory
{
    public function __construct(
        private JWEBuilderFactory $jweBuilderFactory,
        private JWESerializerManagerFactory $jweSerializerManagerFactory,
        private JWSBuilderFactory $jwsBuilderFactory,
        private JWSSerializerManagerFactory $jwsSerializerManagerFactory,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function create(
        array $jwe_serializers,
        array $keyEncryptionAlgorithms,
        array $contentEncryptionAlgorithms,
        array $compressionMethods,
        array $jws_serializers,
        array $signatureAlgorithms
    ): NestedTokenBuilder {
        $jweBuilder = $this->jweBuilderFactory->create(
            $keyEncryptionAlgorithms,
            $contentEncryptionAlgorithms,
            $compressionMethods
        );
        $jweSerializerManager = $this->jweSerializerManagerFactory->create($jwe_serializers);
        $jwsBuilder = $this->jwsBuilderFactory->create($signatureAlgorithms);
        $jwsSerializerManager = $this->jwsSerializerManagerFactory->create($jws_serializers);

        return new NestedTokenBuilder(
            $jweBuilder,
            $jweSerializerManager,
            $jwsBuilder,
            $jwsSerializerManager,
            $this->eventDispatcher
        );
    }
}
