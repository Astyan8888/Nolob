<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BathRepository")
 */
class Bath
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="date")
     */
    private $datebath;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="bath")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDatebath(): ?\DateTimeInterface
    {
        return $this->datebath;
    }

    public function setDatebath(\DateTimeInterface $datebath): self
    {
        $this->datebath = $datebath;

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
