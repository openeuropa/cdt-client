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

    /**
     * The constant should be overridden in child classes.
     *
     * @var class-string|string ITEM_TYPE
     */
    public const ITEM_TYPE = '';

    /**
     * @param array<int|string, mixed> $array
     */
    public function __construct(array $array, int $flags = 0)
    {
        if (empty(static::ITEM_TYPE)) {
            throw new \LogicException('The ITEM_TYPE constant must be overridden in child classes.');
        }

        foreach ($array as $key => $value) {
            $this->checkArgumentType($value, $key);
        }

        parent::__construct($array, $flags);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->checkArgumentType($value, $key);

        parent::offsetSet($key, $value);
    }

    public function append(mixed $value): void
    {
        $this->checkArgumentType($value);

        parent::append($value);
    }

    abstract protected function checkArgumentType(mixed $value, mixed $affectedKey = null): void;
}
