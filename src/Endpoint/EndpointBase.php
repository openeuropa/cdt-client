<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
 * Class EndpointBase
 *
 * Serves as the base for endpoint classes with static or configurable URLs.
 *
 * The class provides methods for setting, verifying, and retrieving the endpoint URL.
 * It also allows you to get a default serializer for decoding the endpoint response.
 *
 * @see ConfigurationAwareTrait
 */
abstract class EndpointBase
{
    use ConfigurationAwareTrait;

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(protected RestInterface $rest, string $endpointUrl, array $configuration = [])
    {
        $configuration['endpointUrl'] = $endpointUrl;
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

    /**
     * Returns a serializer configured to decode the endpoint response.
     */
    protected function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new JsonSerializableNormalizer(),
            new GetSetMethodNormalizer(
                new ClassMetadataFactory(
                    new AttributeLoader()
                ),
                null,
                new PhpDocExtractor()
            ),
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
