<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Model\Token;
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

    public function execute(): Token
    {
        /** @var Token $token */
        $token = $this->getSerializer()->deserialize(
            $this->send('POST')->getBody()->__toString(),
            Token::class,
            'json'
        );
        return $token;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getRequestFormElements(): array
    {
        return [
            'grant_type' => 'password',
            'username' => $this->getConfigValue('username'),
            'password' => $this->getConfigValue('password'),
            'client' => $this->getConfigValue('client'),
        ];
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
