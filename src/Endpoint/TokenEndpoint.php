<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Model\Response\Token;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class TokenEndpoint
 *
 * Fetches an authentication token from the "Token" endpoint of the API using the password grant flow.
 *
 * @see EndpointBase
 */
class TokenEndpoint extends EndpointBase
{
    const ENDPOINT_URL_PATH = '/token';

    protected function getConfigurationResolver(): OptionsResolver
    {
        $resolver = parent::getConfigurationResolver();

        $resolver->setRequired('username')
            ->setAllowedTypes('username', 'string');
        $resolver->setRequired('password')
            ->setAllowedTypes('password', 'string');
        $resolver->setRequired('client')
            ->setAllowedTypes('client', 'string');

        return $resolver;
    }

    public function getToken(): Token
    {
        $response = $this->rest->postForm($this->getEndpointUrl(), [
            'grant_type' => 'password',
            'username' => $this->getConfigValue('username'),
            'password' => $this->getConfigValue('password'),
            'client' => $this->getConfigValue('client'),
        ]);
        return $this->getSerializer()->deserialize(
            $response->getBody()->__toString(),
            Token::class,
            'json'
        );
    }

    protected function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new GetSetMethodNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter(),
                new PhpDocExtractor()
            ),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
