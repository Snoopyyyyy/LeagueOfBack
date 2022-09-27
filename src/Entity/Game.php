<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Summoner $summoner = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Player::class, cascade: ['persist'])]
    private Collection $players;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Ward::class, cascade: ['persist'])]
    private Collection $wards;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: ObjectifKill::class, cascade: ['persist'])]
    private Collection $objectifKills;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Item::class, cascade: ['persist'])]
    private Collection $items;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Plate::class, cascade: ['persist'])]
    private Collection $plates;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Kill::class, cascade: ['persist'])]
    private Collection $kills;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: TowerKill::class, cascade: ['persist'])]
    private Collection $towerKills;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: InhibiterKill::class, cascade: ['persist'])]
    private Collection $inhibiterKills;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->wards = new ArrayCollection();
        $this->objectifKills = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->plates = new ArrayCollection();
        $this->kills = new ArrayCollection();
        $this->towerKills = new ArrayCollection();
        $this->inhibiterKills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function isWin(): ?bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getSummoner(): ?Summoner
    {
        return $this->summoner;
    }

    public function setSummoner(?Summoner $summoner): self
    {
        $this->summoner = $summoner;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setGame($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getGame() === $this) {
                $player->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ward>
     */
    public function getWards(): Collection
    {
        return $this->wards;
    }

    public function addWard(Ward $ward): self
    {
        if (!$this->wards->contains($ward)) {
            $this->wards->add($ward);
            $ward->setGame($this);
        }

        return $this;
    }

    public function removeWard(Ward $ward): self
    {
        if ($this->wards->removeElement($ward)) {
            // set the owning side to null (unless already changed)
            if ($ward->getGame() === $this) {
                $ward->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ObjectifKill>
     */
    public function getObjectifKills(): Collection
    {
        return $this->objectifKills;
    }

    public function addObjectifKill(ObjectifKill $objectifKill): self
    {
        if (!$this->objectifKills->contains($objectifKill)) {
            $this->objectifKills->add($objectifKill);
            $objectifKill->setGame($this);
        }

        return $this;
    }

    public function removeObjectifKill(ObjectifKill $objectifKill): self
    {
        if ($this->objectifKills->removeElement($objectifKill)) {
            // set the owning side to null (unless already changed)
            if ($objectifKill->getGame() === $this) {
                $objectifKill->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setGame($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getGame() === $this) {
                $item->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plate>
     */
    public function getPlates(): Collection
    {
        return $this->plates;
    }

    public function addPlate(Plate $plate): self
    {
        if (!$this->plates->contains($plate)) {
            $this->plates->add($plate);
            $plate->setGame($this);
        }

        return $this;
    }

    public function removePlate(Plate $plate): self
    {
        if ($this->plates->removeElement($plate)) {
            // set the owning side to null (unless already changed)
            if ($plate->getGame() === $this) {
                $plate->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Kill>
     */
    public function getKills(): Collection
    {
        return $this->kills;
    }

    public function addKill(Kill $kill): self
    {
        if (!$this->kills->contains($kill)) {
            $this->kills->add($kill);
            $kill->setGame($this);
        }

        return $this;
    }

    public function removeKill(Kill $kill): self
    {
        if ($this->kills->removeElement($kill)) {
            // set the owning side to null (unless already changed)
            if ($kill->getGame() === $this) {
                $kill->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TowerKill>
     */
    public function getTowerKills(): Collection
    {
        return $this->towerKills;
    }

    public function addTowerKill(TowerKill $towerKill): self
    {
        if (!$this->towerKills->contains($towerKill)) {
            $this->towerKills->add($towerKill);
            $towerKill->setGame($this);
        }

        return $this;
    }

    public function removeTowerKill(TowerKill $towerKill): self
    {
        if ($this->towerKills->removeElement($towerKill)) {
            // set the owning side to null (unless already changed)
            if ($towerKill->getGame() === $this) {
                $towerKill->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InhibiterKill>
     */
    public function getInhibiterKills(): Collection
    {
        return $this->inhibiterKills;
    }

    public function addInhibiterKill(InhibiterKill $inhibiterKill): self
    {
        if (!$this->inhibiterKills->contains($inhibiterKill)) {
            $this->inhibiterKills->add($inhibiterKill);
            $inhibiterKill->setGame($this);
        }

        return $this;
    }

    public function removeInhibiterKill(InhibiterKill $inhibiterKill): self
    {
        if ($this->inhibiterKills->removeElement($inhibiterKill)) {
            // set the owning side to null (unless already changed)
            if ($inhibiterKill->getGame() === $this) {
                $inhibiterKill->setGame(null);
            }
        }

        return $this;
    }
}
