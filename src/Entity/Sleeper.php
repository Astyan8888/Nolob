<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SleeperRepository")
 */
class Sleeper
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="time")
     */
    private $durationsleep;

    /**
     * @ORM\Column(type="date")
     */
    private $startsleep;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="sleeper",cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDurationsleep(): ?\DateTimeInterface
    {
        return $this->durationsleep;
    }

    public function setDurationsleep(\DateTimeInterface $durationsleep): self
    {
        $this->durationsleep = $durationsleep;

        return $this;
    }

    public function getStartsleep(): ?\DateTimeInterface
    {
        return $this->startsleep;
    }

    public function setStartsleep(?\DateTimeInterface $startsleep): self
    {
        $this->startsleep = $startsleep;

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
