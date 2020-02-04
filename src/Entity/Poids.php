<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\GreaterThan;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PoidsRepository")
 */
class Poids
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string" , length=255)
     */
    private $createAtpoids;

    /**
     * @Assert\GreaterThan(1.8)
     * @Assert\LessThan(25)
     * @ORM\Column(type="float")
     */
    private $weight;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="poidsuser",cascade = {"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAtpoids(): ?string
    {
        return $this->createAtpoids;
    }

    public function setCreateAtpoids(string $createAtpoids): self
    {
        $this->createAtpoids = $createAtpoids;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

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
