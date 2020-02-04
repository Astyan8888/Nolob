<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\GreaterThan;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SizeRepository")
 */
class Size
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@ORM\Column(type="string" , length=255)
     */
    private $datesize;

    /**
     * @Assert\GreaterThan(35)
     * @Assert\LessThan(120)
     * @ORM\Column(type="float")
     */
    private $size;

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="size",cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatesize(): ?string
    {
        return $this->datesize;
    }

    public function setDatesize(string $datesize): self
    {
        $this->datesize = $datesize;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

  

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
