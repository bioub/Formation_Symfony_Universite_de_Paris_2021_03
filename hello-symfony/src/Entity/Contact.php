<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

use App\Repository\ContactRepository;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(length=60, nullable=false)
     */
    protected $firstName;

    /**
     * @ORM\Column(length=60, nullable=false)
     */
    protected $lastName;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", fetch="EAGER", inversedBy="contacts")
     */
    protected $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }



}
