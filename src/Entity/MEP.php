<?php

namespace App\Entity;

use App\Repository\MepRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MepRepository::class)]
class MEP
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalPoliticalGroup = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $contacts = [];



    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNationalPoliticalGroup(): ?string
    {
        return $this->nationalPoliticalGroup;
    }

    public function setNationalPoliticalGroup(string $nationalPoliticalGroup): self
    {
        $this->nationalPoliticalGroup = $nationalPoliticalGroup;

        return $this;
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
