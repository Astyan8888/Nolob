<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 *@UniqueEntity(
 * fields={"email"},
 *message="E-mail déjà utilisé")
 *@UniqueEntity(
 *fields={"username"},
 *message="Username déjà utilisé"
 *)
 */

class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas un mail valide",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\Length(
     *    min = 6,
     *    max = 12,
     *  minMessage ="Votre mot de passe doit etre composer de au moins  {{ limit }} caractéres",
     * maxMessage ="Votre mot de passe ne doit pas depasser  {{ limit }} caractéres"
     * )
     */
    private $password;

    /**
     *@Assert\EqualTo(propertyPath="password", message="Mot de passe differents")
     */

    public $confirm_password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="string")
     *@Assert\Length(
     *    min = 4,
     *    max = 12,
     *  minMessage ="Votre nom doit contenir au moins {{ limit }} caractéres",
     * maxMessage ="Votre nom ne doit pas depasser  {{ limit }} caractéres"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activate;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Poids", mappedBy="user", orphanRemoval=true)
     */
    private $poidsuser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Size", mappedBy="user", orphanRemoval=true)
     */
    private $size;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Feeding", mappedBy="user", orphanRemoval=true)
     */
    private $feedings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diaper", mappedBy="user", orphanRemoval=true)
     */
    private $diaper;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bath", mappedBy="user", orphanRemoval=true)
     */
    private $bath;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="user",orphanRemoval=true)
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sleeper", mappedBy="user", orphanRemoval=true)
     */
    private $sleeper;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PC", mappedBy="user", orphanRemoval=true)
     */
    private $PCuser;

    public function __construct()
    {
        $this->poidsuser = new ArrayCollection();
        $this->size = new ArrayCollection();
        $this->feedings = new ArrayCollection();
        $this->diaper = new ArrayCollection();
        $this->bath = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->sleeper = new ArrayCollection();
        $this->PCuser = new ArrayCollection();
    }

   
    
   
    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function eraseCredentials()
    {}

    public function getSalt()
    {}

    public function getRoles()
    {
        return ['ROLE_USER'];

    }

    public function getActivate(): ?bool
    {
        return $this->activate;
    }

    public function setActivate(bool $activate): self
    {
        $this->activate = $activate;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection|Poids[]
     */
    public function getPoidsuser(): Collection
    {
        return $this->poidsuser;
    }

    public function addPoidsuser(Poids $poidsuser): self
    {
        if (!$this->poidsuser->contains($poidsuser)) {
            $this->poidsuser[] = $poidsuser;
            $poidsuser->setUser($this);
        }

        return $this;
    }

    public function removePoidsuser(Poids $poidsuser): self
    {
        if ($this->poidsuser->contains($poidsuser)) {
            $this->poidsuser->removeElement($poidsuser);
            // set the owning side to null (unless already changed)
            if ($poidsuser->getUser() === $this) {
                $poidsuser->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Size[]
     */
    public function getSize(): Collection
    {
        return $this->size;
    }

    public function addSize(Size $size): self
    {
        if (!$this->size->contains($size)) {
            $this->size[] = $size;
            $size->setUser($this);
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        if ($this->size->contains($size)) {
            $this->size->removeElement($size);
            // set the owning side to null (unless already changed)
            if ($size->getUser() === $this) {
                $size->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Feeding[]
     */
    public function getFeedings(): Collection
    {
        return $this->feedings;
    }

    public function addFeeding(Feeding $feeding): self
    {
        if (!$this->feedings->contains($feeding)) {
            $this->feedings[] = $feeding;
            $feeding->setUser($this);
        }

        return $this;
    }

    public function removeFeeding(Feeding $feeding): self
    {
        if ($this->feedings->contains($feeding)) {
            $this->feedings->removeElement($feeding);
            // set the owning side to null (unless already changed)
            if ($feeding->getUser() === $this) {
                $feeding->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Diaper[]
     */
    public function getDiaper(): Collection
    {
        return $this->diaper;
    }

    public function addDiaper(Diaper $diaper): self
    {
        if (!$this->diaper->contains($diaper)) {
            $this->diaper[] = $diaper;
            $diaper->setUser($this);
        }

        return $this;
    }

    public function removeDiaper(Diaper $diaper): self
    {
        if ($this->diaper->contains($diaper)) {
            $this->diaper->removeElement($diaper);
            // set the owning side to null (unless already changed)
            if ($diaper->getUser() === $this) {
                $diaper->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bath[]
     */
    public function getBath(): Collection
    {
        return $this->bath;
    }

    public function addBath(Bath $bath): self
    {
        if (!$this->bath->contains($bath)) {
            $this->bath[] = $bath;
            $bath->setUser($this);
        }

        return $this;
    }

    public function removeBath(Bath $bath): self
    {
        if ($this->bath->contains($bath)) {
            $this->bath->removeElement($bath);
            // set the owning side to null (unless already changed)
            if ($bath->getUser() === $this) {
                $bath->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sleeper[]
     */
    public function getSleeper(): Collection
    {
        return $this->sleeper;
    }

    public function addSleeper(Sleeper $sleeper): self
    {
        if (!$this->sleeper->contains($sleeper)) {
            $this->sleeper[] = $sleeper;
            $sleeper->setUser($this);
        }

        return $this;
    }

    public function removeSleeper(Sleeper $sleeper): self
    {
        if ($this->sleeper->contains($sleeper)) {
            $this->sleeper->removeElement($sleeper);
            // set the owning side to null (unless already changed)
            if ($sleeper->getUser() === $this) {
                $sleeper->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PC[]
     */
    public function getPCuser(): Collection
    {
        return $this->PCuser;
    }

    public function addPCuser(PC $pCuser): self
    {
        if (!$this->PCuser->contains($pCuser)) {
            $this->PCuser[] = $pCuser;
            $pCuser->setUser($this);
        }

        return $this;
    }

    public function removePCuser(PC $pCuser): self
    {
        if ($this->PCuser->contains($pCuser)) {
            $this->PCuser->removeElement($pCuser);
            // set the owning side to null (unless already changed)
            if ($pCuser->getUser() === $this) {
                $pCuser->setUser(null);
            }
        }

        return $this;
    }

   
    
}
