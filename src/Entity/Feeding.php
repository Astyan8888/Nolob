<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedingRepository")
 */
class Feeding
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $datefeeding;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $duration;

  

    /**
     * @ORM\Column(type="integer")
     */
    private $breast;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="feedings",cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDatefeeding(): ?\DateTimeInterface
    {
        return $this->datefeeding;
    }

    public function setDatefeeding(?\DateTimeInterface $datefeeding): self
    {
        $this->datefeeding = $datefeeding;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(?\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

   

    public function getBreast(): ?int
    {
        return $this->breast;
    }

    public function setBreast(int $breast): self
    {
        $this->breast = $breast;

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
