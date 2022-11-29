<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]// rajout de l'entrée unique
    private ?string $matchId = null;

    #[ORM\Column]
    private ?bool $surrender = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\OneToOne(mappedBy: 'game', cascade: ['persist', 'remove'])]
    private ?GameEvent $events = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Player::class, cascade: ['persist', 'remove'])]
    private Collection $players;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gameMode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gameType = null;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchId(): ?string
    {
        return $this->matchId;
    }

    public function setMatchId(string $matchId): self
    {
        $this->matchId = $matchId;

        return $this;
    }

    public function isSurrender(): ?bool
    {
        return $this->surrender;
    }

    public function setSurrender(bool $surrender): self
    {
        $this->surrender = $surrender;

        return $this;
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getEvents(): ?GameEvent
    {
        return $this->events;
    }

    public function setEvents(?GameEvent $events): self
    {
        // unset the owning side of the relation if necessary
        if ($events === null && $this->events !== null) {
            $this->events->setGame(null);
        }

        // set the owning side of the relation if necessary
        if ($events !== null && $events->getGame() !== $this) {
            $events->setGame($this);
        }

        $this->events = $events;

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
    
    public function getGameMode(): ?string
    {
        return $this->gameMode;
    }

    public function setGameMode(?string $gameMode): self
    {
        $this->gameMode = $gameMode;

        return $this;
    }

    public function getGameType(): ?string
    {
        return $this->gameType;
    }

    public function setGameType(?string $gameType): self
    {
        $this->gameType = $gameType;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return array(
            "matchId" => $this->getMatchId(),
            "surrender" => $this->isSurrender(),
            "date" => $this->getDate(),
            "duration" => $this->getDuration(),
            "players" => $this->getPlayers()->toArray(),
            "gameMode" => $this->getGameMode(),
            "gameType" => $this->getGameType()
        );
    }

    public function jsonSerializeEvent(): array {
        return array(
            "matchId" => $this->getMatchId(),
            "surrender" => $this->isSurrender(),
            "date" => $this->getDate(),
            "duration" => $this->getDuration(),
            "players" => $this->getPlayers()->toArray(),
            "events" => $this->getEvents(),
            "gameMode" => $this->getGameMode(),
            "gameType" => $this->getGameType()
        );
    }
}
