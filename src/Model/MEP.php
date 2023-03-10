<?php

namespace App\Model;

class MEP
{
    public string  $id;
    public string  $fullName;
    public string  $country;
    public string  $nationalPoliticalGroup;
    private array $contacts;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getNationalPoliticalGroup(): string
    {
        return $this->nationalPoliticalGroup;
    }

    /**
     * @param string $nationalPoliticalGroup
     */
    public function setNationalPoliticalGroup(string $nationalPoliticalGroup): void
    {
        $this->nationalPoliticalGroup = $nationalPoliticalGroup;
    }
    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function setContacts(array $contacts): void
    {
        $this->contacts = $contacts;
    }
}