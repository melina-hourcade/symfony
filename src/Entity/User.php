<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     */
    
    private $email;
//don't use nothing here for password because is not map here, see UserRegistrationFormeType.php    
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $password;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

///////////// interface methods ////////////////////
    /**
     * @see userInterface
     */
    public function getRoles() {
        return ['ROLE_USER'];
    }

    /**
     * @see userInterface
     */
    public function getSalt() {
        //not needed if a modern algorithm is used 
    }
    /**
     * @see useInterface
     */
    public function getUsername() {
        //userName it's just a ID for debug bar
        return $this->email;
    }
    public function eraseCredentials() {
        //
    }








}
