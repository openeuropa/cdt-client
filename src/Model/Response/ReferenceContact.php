<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class ReferenceContact.
 *
 * Represents the single contact from the business reference data obtained from the CDT API.
 * Stores the personal data.
 */
class ReferenceContact
{
    /**
     * The email.
     */
    protected string $email;

    /**
     * The first name.
     */
    protected string $firstName;

    /**
     * The last name.
     */
    protected string $lastName;

    /**
     * The username.
     */
    protected string $userName;

    /**
     * The country code.
     */
    protected ?string $countryCode;

    /**
     * The phone country code.
     */
    protected ?string $phoneCountryCode;

    /**
     * The phone number.
     */
    protected string $phoneNumber;

    /**
     * The country name.
     */
    protected string $countryName;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getPhoneCountryCode(): ?string
    {
        return $this->phoneCountryCode;
    }

    public function setPhoneCountryCode(?string $phoneCountryCode): self
    {
        $this->phoneCountryCode = $phoneCountryCode;
        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;
        return $this;
    }
}
