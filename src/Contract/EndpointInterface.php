<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

interface EndpointInterface
{
    public function execute(): mixed;

    public function setHttpClient(ClientInterface $httpClient): self;

    public function setRequestFactory(RequestFactoryInterface $requestFactory): self;

    public function setStreamFactory(StreamFactoryInterface $streamFactory): self;

    public function setUriFactory(UriFactoryInterface $uriFactory): self;

    public function setMultipartStreamBuilder(MultipartStreamBuilder $multipartStreamBuilder): self;

    public function setJsonEncoder(EncoderInterface $jsonEncoder): self;
}
