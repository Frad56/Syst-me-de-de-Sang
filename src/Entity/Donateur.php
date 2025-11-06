<?php

namespace App\Entity;

use App\Repository\DonateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonateurRepository::class)]
class Donateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 80)]
    private ?string $password = null;

    #[ORM\Column(length: 200)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $groupeSanguin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $derniereDateDon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role = null;

    /**
     * @var Collection<int, Don>
     */
    #[ORM\OneToMany(targetEntity: Don::class, mappedBy: 'donateurId')]
    private Collection $dons;

    #[ORM\OneToOne(mappedBy: 'Rendezvous', cascade: ['persist', 'remove'])]
    private ?Don $don = null;

    /**
     * @var Collection<int, RendezVous>
     */
    #[ORM\OneToMany(targetEntity: RendezVous::class, mappedBy: 'donateur')]
    private Collection $rendezVouses;

    public function __construct()
    {
        $this->dons = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupeSanguin;
    }

    public function setGroupeSanguin(string $groupeSanguin): static
    {
        $this->groupeSanguin = $groupeSanguin;

        return $this;
    }

    public function getDerniereDateDon(): ?\DateTime
    {
        return $this->derniereDateDon;
    }

    public function setDerniereDateDon(?\DateTime $derniereDateDon): static
    {
        $this->derniereDateDon = $derniereDateDon;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Don>
     */
    public function getDons(): Collection
    {
        return $this->dons;
    }

    public function addDon(Don $don): static
    {
        if (!$this->dons->contains($don)) {
            $this->dons->add($don);
            $don->setDonateurId($this);
        }

        return $this;
    }

    public function removeDon(Don $don): static
    {
        if ($this->dons->removeElement($don)) {
            // set the owning side to null (unless already changed)
            if ($don->getDonateurId() === $this) {
                $don->setDonateurId(null);
            }
        }

        return $this;
    }

    public function getDon(): ?Don
    {
        return $this->don;
    }

    public function setDon(Don $don): static
    {
        // set the owning side of the relation if necessary
        //if ($don->getRendezvous() !== $this) {
          //  $don->setRendezvous($this);
        // }

        $this->don = $don;

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): static
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setDonateur($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): static
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getDonateur() === $this) {
                $rendezVouse->setDonateur(null);
            }
        }

        return $this;
    }
}
