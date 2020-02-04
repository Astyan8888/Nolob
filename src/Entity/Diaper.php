<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiaperRepository")
 */
class Diaper
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
    private $datediaper;

    /**
     * @ORM\Column(type="integer")
     */
    private $diaperamount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="diaper",cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatediaper(): ?\DateTimeInterface
    {
        return $this->datediaper;
    }

    public function setDatediaper(\DateTimeInterface $datediaper): self
    {
        $this->datediaper = $datediaper;

        return $this;
    }

    public function getDiaperamount(): ?int
    {
        return $this->diaperamount;
    }

    public function setDiaperamount(int $diaperamount): self
    {
        $this->diaperamount = $diaperamount;

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
