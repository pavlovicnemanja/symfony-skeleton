<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

use \Datetime;

/**
 * @ORM\Entity
 * @ORM\Table(name="np_company")
 */
class Company
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"list_view", "single_view"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups({"list_view", "single_view"})
     */
    private $name;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"single_view"})
     */
    private $code;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"single_view"})
     */
    private $vat;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups({"list_view", "single_view"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups({"list_view", "single_view"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups({"single_view"})
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"single_view"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"list_view", "single_view"})
     */
    private $edited;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"list_view", "single_view"})
     */
    private $deleted;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"list_view", "single_view"})
     */
    private $created;

    public function __construct()
    {
        $this->edited = new DateTime();
        $this->created = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(int $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEdited(): ?\DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(\DateTimeInterface $edited): self
    {
        $this->edited = $edited;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
