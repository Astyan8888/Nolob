<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints  as  Assert ;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datevent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $textevent;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventstick;

/**
     * @ORM\Column(type="string", length=255, )
     *
     * maxSize = "16M"
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
     */
    private $pict;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatevent(): ?\DateTimeInterface
    {
        return $this->datevent;
    }

    public function setDatevent(?\DateTimeInterface $datevent): self
    {
        $this->datevent = $datevent;

        return $this;
    }

    public function getTextevent(): ?string
    {
        return $this->textevent;
    }

    public function setTextevent(?string $textevent): self
    {
        $this->textevent = $textevent;

        return $this;
    }



    public function getEventstick(): ?string
    {
        return $this->eventstick;
    }

    public function setEventstick(?string $eventstick): self
    {
        $this->eventstick = $eventstick;

        return $this;
    }
     public function getPict()
    {
        return $this->pict;
    }

    public function setPict($pict)
    {
        $this->pict = $pict;

        return $this;
    }

    public function getDatecreate(): ?\DateTimeInterface
    {
        return $this->datecreate;
    }

    public function setDatecreate(\DateTimeInterface $datecreate): self
    {
        $this->datecreate = $datecreate;

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
