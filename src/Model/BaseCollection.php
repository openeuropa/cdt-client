<?php

declare(strict_types=1);

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
     * @var array<int|string, mixed>
     */
    protected array $collection;

    abstract public static function getItemType(): string;

    /**
     * @param array<int|string, mixed> $array
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
        $itemType = static::getItemType();
        if ($itemType === 'string') {
            // This is a special case for collections of strings.
            $hasProperType = is_string($value);
        } else {
            $hasProperType = $value instanceof $itemType;
        }

        if (!$hasProperType) {
            $detectedType = gettype($value);
            if ($detectedType === 'object') {
                $detectedType = $value::class;
            }

            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type: %s, expected instance of %s.',
                $detectedType,
                $itemType,
            ));
        }
    }
}
