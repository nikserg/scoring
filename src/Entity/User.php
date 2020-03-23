<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Пользователь
 *
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="idx_score", columns={"score"}),
 *     @ORM\Index(name="idx_last_name", columns={"last_name"}),
 *     @ORM\Index(name="idx_first_name", columns={"first_name"}),
 *     @ORM\Index(name="idx_phone", columns={"phone"}),
 *     @ORM\Index(name="idx_personal_data", columns={"personal_data"}),
 * })
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @Assert\NotBlank
     * @Assert\Regex("/^8\d{10}$/")
     * @ORM\Column(type="string", length=11)
     */
    private $phone;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $grade;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $personal_data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getPersonalData(): ?bool
    {
        return $this->personal_data;
    }

    public function setPersonalData(bool $personal_data): self
    {
        $this->personal_data = $personal_data;

        return $this;
    }
}
