<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model;

class Token
{
    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $tokenType;

    /**
     * @var int
     */
    protected $expiresIn;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @param string $accessToken
     *
     * @return $this
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $scope
     *
     * @return $this
     */
    public function setScope(string $scope): self
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $tokenType
     *
     * @return $this
     */
    public function setTokenType(string $tokenType): self
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @param int $expiresIn
     *
     * @return $this
     */
    public function setExpiresIn(int $expiresIn): self
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     *
     * @return $this
     */
    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }
}
