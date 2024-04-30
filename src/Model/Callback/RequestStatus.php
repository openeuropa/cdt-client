<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class RequestStatus.
 *
 * Represents the single callback sent to the defined endpoint
 */
class RequestStatus
{
    protected string $requestIdentifier;

    protected string $status;

    /**
     * @var \DateTimeInterface
     */
    protected \DateTimeInterface $date;

    protected string $correlationId;

    public function getRequestIdentifier(): string
    {
        return $this->requestIdentifier;
    }

    public function setRequestIdentifier(string $requestIdentifier): self
    {
        $this->requestIdentifier = $requestIdentifier;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getCorrelationId(): string
    {
        return $this->correlationId;
    }

    public function setCorrelationId(string $correlationId): self
    {
        $this->correlationId = $correlationId;
        return $this;
    }
}
