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
        foreach ($array as $value) {
            $this->checkArgumentType($value);
        }
        parent::__construct($array, $flags);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->checkArgumentType($value);
        parent::offsetSet($key, $value);
    }

    public function append(mixed $value): void
    {
        $this->checkArgumentType($value);
        parent::append($value);
    }

    protected function checkArgumentType(mixed $value): void
    {
        $itemType = $this->getItemType();
        if (!$value instanceof $itemType) {
            // Get variable type
            $detectedType = gettype($value);
            if ($detectedType === 'object') {
                $detectedType = get_class($value);
            }
            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type: %s, expected instance of %s.',
                $detectedType,
                $itemType
            ));
        }
    }
}
