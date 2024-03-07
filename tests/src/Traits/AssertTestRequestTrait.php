<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use Psr\Http\Message\RequestInterface;

/**
 * Trait AssertTestRequestTrait
 *
 * Provides methods for asserting common request properties in tests, particularly those related to:
 *  - Authentication and authorization
 *
 * This trait can be used in test classes to streamline assertions and improve code readability.
 */
trait AssertTestRequestTrait
{
    protected function assertTokenRequest(RequestInterface $request): void
    {
        $this->assertEquals('https://example.com/token', $request->getUri());
        $this->assertSame('application/x-www-form-urlencoded', $request->getHeaderLine('Content-Type'));
        $this->assertSame('grant_type=password&username=baz&password=qux&client=foo', $request->getBody()->__toString());
    }

    protected function assertMainRequest(RequestInterface $request): void
    {
        $this->assertEquals('https://example.com/v2/CheckConnection', $request->getUri());
    }

    protected function assertReferenceDataRequest(RequestInterface $request): void
    {
        $this->assertEquals('https://example.com/v2/requests/businessReferenceData', $request->getUri());
    }

    protected function assertIdentifierRequest(RequestInterface $request, string $correlationId): void
    {
        $this->assertEquals('https://example.com/v2/requests/requestIdentifierByCorrelationId/' . $correlationId, $request->getUri());
    }

    protected function assertStatusRequest(RequestInterface $request, string $permanentId): void
    {
        $this->assertEquals('https://example.com/v2/requests/' . $permanentId, $request->getUri());
    }

    protected function assertFileRequest(RequestInterface $request, string $permanentId): void
    {
        $this->assertEquals('https://example.com/v2/requests/' . $permanentId . '/targets-base64', $request->getUri());
    }

    /**
     * @param RequestInterface $request
     */
    protected function assertAuthorizationHeaders(RequestInterface $request): void
    {
        $this->assertSame('Bearer JWT_TOKEN', $request->getHeaderLine('Authorization'));
    }
}
