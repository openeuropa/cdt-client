<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Normalizer;

use OpenEuropa\CdtClient\Model\BaseCollection;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 *  Class CollectionDenormalizer.
 *
 *  Provides a denormalizer for classes extending BaseCollection.
 */
class CollectionDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param class-string $type
     * @param array<mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = [])
    {
        if (class_exists($type)) {
            $elementType = $type::getItemType();
            foreach ($data as $key => $item) {
                $data[$key] = $this->denormalizer->denormalize($item, $elementType, $format, $context);
            }
        }

        return new $type($data);
    }

    /**
     * @param class-string $type
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null)
    {
        if (class_exists($type)) {
            $class = new \ReflectionClass($type);

            return $class->isSubclassOf(BaseCollection::class);
        }

        return false;
    }
}
