<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Serializer;

use OpenEuropa\CdtClient\Model\Callback\JobStatus;
use OpenEuropa\CdtClient\Model\Callback\RequestStatus;
use OpenEuropa\CdtClient\Model\Callback\RequestUpdate;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CallbackSerializer
 *
 * Provides a set of methods to deserialize the callback data into the corresponding model objects.
 */
class CallbackSerializer
{
    public static function deserializeJobStatus(string $data): JobStatus
    {
        return self::getSerializer()->deserialize($data, JobStatus::class, 'json');
    }

    public static function deserializeRequestStatus(string $data): RequestStatus
    {
        return self::getSerializer()->deserialize($data, RequestStatus::class, 'json');
    }

    public static function deserializeRequestUpdate(string $data): RequestUpdate
    {
        return self::getSerializer()->deserialize($data, RequestUpdate::class, 'json');
    }

    private static function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new GetSetMethodNormalizer(
                new ClassMetadataFactory(
                    new AttributeLoader()
                ),
                new CamelCaseToSnakeCaseNameConverter(),
                new PhpDocExtractor()
            ),
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
