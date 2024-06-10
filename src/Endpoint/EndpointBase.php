<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Traits\AuthorizationHeadersAwareTrait;
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
 * @see AuthorizationHeadersAwareTrait
 * @see ConfigurationAwareTrait
 * @see SerializerAwareTrait
 */
abstract class EndpointBase
{
    use AuthorizationHeadersAwareTrait;
    use ConfigurationAwareTrait;
    use SerializerAwareTrait;

    public const ENDPOINT_URL_PATH = '';

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(protected RestInterface $rest, array $configuration = [], protected ?Token $token = null)
    {
        $this->configuration = $this->getConfigurationResolver()->resolve($configuration);
    }

    protected function getConfigurationResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired('apiBaseUrl')
            ->setAllowedTypes('apiBaseUrl', 'string')
            ->setAllowedValues('apiBaseUrl', function (string $value) {
                return filter_var($value, FILTER_VALIDATE_URL);
            });

        return $resolver;
    }

    /**
     * @param array<string, string> $replacements
     */
    protected function getEndpointUrl(array $replacements = []): string
    {
        $url = rtrim($this->getConfigValue('apiBaseUrl'), '/') . static::ENDPOINT_URL_PATH;
        if (!empty($replacements)) {
            $url = str_replace(array_keys($replacements), array_values($replacements), $url);
        }

        return $url;
    }
}
