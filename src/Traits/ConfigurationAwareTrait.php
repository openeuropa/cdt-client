<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

/**
 * Trait ConfigurationAwareTrait
 *
 * Provides methods for handling object configuration.
 */
trait ConfigurationAwareTrait
{
    /**
     * @var array<string, mixed>
     */
    protected array $configuration;

    protected function getConfigValue(string $configKey): mixed
    {
        if (!array_key_exists($configKey, $this->configuration)) {
            throw new \InvalidArgumentException("Invalid config key: '$configKey'. Valid keys: '" . implode("', '", array_keys($this->configuration)) . "'.");
        }
        return $this->configuration[$configKey];
    }

    /**
     * Extracts a subset of values from the client configuration.
     *
     * Non-existing and boolean keys are not returned.
     *
     * @param string[] $names
     *   A list of configuration keys to extract.
     *
     * @return array<string, mixed>
     */
    protected function extractConfigValues(array $names): array
    {
        return array_intersect_key(
            $this->configuration,
            array_flip($names)
        );
    }
}
