<?php

namespace OpenEuropa\CdtClient\Model;

/**
 * Class BaseCollection.
 *
 * A base class for collections.
 *
 * @extends \ArrayIterator<int|string, mixed>
 */
abstract class BaseCollection extends \ArrayIterator
{
    /**
     * The collection.
     *
     * @var array<int|string, mixed>
     */
    protected array $collection;

    abstract public function getItemType(): string;

    /**
     * Instantiates a new object.
     *
     * @param array<int|string, mixed> $array
     *   A list of items.
     */
    public function __construct(array $array, int $flags = 0)
    {
        $itemType = $this->getItemType();
        foreach ($array as $value) {
            if (!$value instanceof $itemType) {
                throw new \InvalidArgumentException(sprintf(
                    'Invalid argument type: expected %s.',
                    $itemType
                ));
            }
        }

        parent::__construct($array, $flags);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $itemType = $this->getItemType();
        if (!$value instanceof $itemType) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type: expected %s.',
                $itemType
            ));
        }

        parent::offsetSet($key, $value);
    }

    public function append(mixed $value): void
    {
        $itemType = $this->getItemType();
        if (!$value instanceof $itemType) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type: expected %s.',
                $itemType
            ));
        }

        parent::append($value);
    }
}
