<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;
use OpenEuropa\CdtClient\Traits\SerializerAwareTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EndpointBase
 *
 * Serves as the base for endpoint classes with static or configurable URLs.
 *
 * The class provides methods for setting, verifying, and retrieving the endpoint URL.
 * It also allows you to get a default serializer for decoding the endpoint response.
 *
 * @see ConfigurationAwareTrait
 * @see SerializerAwareTrait
 */
abstract class EndpointBase
{
    use ConfigurationAwareTrait;
    use SerializerAwareTrait;

    const ENDPOINT_URL_PATH = '';

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(protected RestInterface $rest, string $baseUrl, array $configuration = [])
    {
        $configuration['endpointUrl'] = rtrim($baseUrl, '/') . static::ENDPOINT_URL_PATH;
        $this->configuration = $this->getConfigurationResolver()->resolve($configuration);
    }

    protected function getConfigurationResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired('endpointUrl')
            ->setAllowedTypes('endpointUrl', 'string')
            ->setAllowedValues('endpointUrl', function (string $value) {
                return filter_var($value, FILTER_VALIDATE_URL);
            });

        return $resolver;
    }

    /**
     * @param array<string, string> $replacements
     */
    protected function getEndpointUrl(array $replacements = []): string
    {
        $url = $this->getConfigValue('endpointUrl');
        if (!empty($replacements)) {
            $url = str_replace(array_keys($replacements), array_values($replacements), $url);
        }

        return $url;
    }
}
