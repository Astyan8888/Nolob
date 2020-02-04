<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PCRepository")
 */
class PC
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $PC;

    /**
     * @ORM\Column(type="date")
     */
    private $datepc;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="PCuser")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPC(): ?float
    {
        return $this->PC;
    }

    public function setPC(float $PC): self
    {
        $this->PC = $PC;

        return $this;
    }

    public function getDatepc(): ?\DateTimeInterface
    {
        return $this->datepc;
    }

    public function setDatepc(\DateTimeInterface $datepc): self
    {
        $this->datepc = $datepc;

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
