<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]

    #[ORM\Column]

    #[ORM\GeneratedValue]
    
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $username;
    
   

    #[Assert\NotBlank(message: 'Email cannot be blank')]
    #[Assert\Email(message: 'The email "{{ value }}" is not a valid email.')]
    #[ORM\Column(length: 50, nullable: false)]
    private ?string $Email;


    #[ORM\Column(length: 200)]
    private ?string $Password ;
    #[ORM\Column(type: 'json')]
    private array $roles = [];
    

    #[ORM\Column]
    private bool $is_Verified = false;

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->Email ?? '';
    }
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $Username): static
    {
        $this->username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): static
    {
        $this->Password = $Password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // Clear sensitive data (if applicable)
    }

    public function isVerified(): bool
    {
        return $this->is_Verified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->is_Verified = $isVerified;

        return $this;
    }
}
