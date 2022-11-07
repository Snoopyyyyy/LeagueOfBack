<?php

namespace App\Entity;

use App\Repository\GameEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameEventRepository::class)]
class GameEvent implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'events', cascade: ['persist', 'remove'])]
    private ?Game $game = null;

    #[ORM\Column]
    private array $events = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function setEvents(array $events): self
    {
        $this->events = $events;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->getEvents();
    }
}
