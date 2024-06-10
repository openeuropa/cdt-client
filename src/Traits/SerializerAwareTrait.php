<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Trait SerializerAwareTrait
 *
 * Provides method for getting default serializer.
 */
trait SerializerAwareTrait
{
    /**
     * Returns a serializer configured to decode the API response.
     */
    protected function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new JsonSerializableNormalizer(),
            new GetSetMethodNormalizer(
                new ClassMetadataFactory(
                    new AttributeLoader(),
                ),
                null,
                new PhpDocExtractor(),
            ),
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
