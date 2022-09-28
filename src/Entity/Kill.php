<?php

namespace App\Entity;

use App\Repository\KillRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KillRepository::class)]
#[ORM\Table(name: '`kill`')]
class Kill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $assistance = [];

    #[ORM\Column]
    private ?int $bounty = null;

    #[ORM\Column]
    private ?int $killer_id = null;

    #[ORM\Column]
    private ?int $killer_streak = null;

    #[ORM\Column]
    private ?int $position_x = null;

    #[ORM\Column]
    private ?int $position_y = null;

    #[ORM\Column]
    private ?int $shutdown_bounty = null;

    #[ORM\Column]
    private ?int $timestamp = null;

    #[ORM\Column]
    private ?int $victime_id = null;


    #[ORM\ManyToOne(inversedBy: 'kills')]
    private ?Game $game = null;

    #[ORM\Column]
    private ?int $killerTeamId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssistance(): array
    {
        return $this->assistance;
    }

    public function setAssistance(array $assistance): self
    {
        $this->assistance = $assistance;

        return $this;
    }

    public function getBounty(): ?int
    {
        return $this->bounty;
    }

    public function setBounty(int $bounty): self
    {
        $this->bounty = $bounty;

        return $this;
    }

    public function getKillerId(): ?int
    {
        return $this->killer_id;
    }

    public function setKillerId(int $killer_id): self
    {
        $this->killer_id = $killer_id;

        return $this;
    }

    public function getKillerStreak(): ?int
    {
        return $this->killer_streak;
    }

    public function setKillerStreak(int $killer_streak): self
    {
        $this->killer_streak = $killer_streak;

        return $this;
    }

    public function getPositionX(): ?int
    {
        return $this->position_x;
    }

    public function setPositionX(int $position_x): self
    {
        $this->position_x = $position_x;

        return $this;
    }

    public function getPositionY(): ?int
    {
        return $this->position_y;
    }

    public function setPositionY(int $position_y): self
    {
        $this->position_y = $position_y;

        return $this;
    }

    public function getShutdownBounty(): ?int
    {
        return $this->shutdown_bounty;
    }

    public function setShutdownBounty(int $shutdown_bounty): self
    {
        $this->shutdown_bounty = $shutdown_bounty;

        return $this;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getVictimeId(): ?int
    {
        return $this->victime_id;
    }

    public function setVictimeId(int $victime_id): self
    {
        $this->victime_id = $victime_id;

        return $this;
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

    public function getKillerTeamId(): ?int
    {
        return $this->killerTeamId;
    }

    public function setKillerTeamId(int $killerTeamId): self
    {
        $this->killerTeamId = $killerTeamId;

        return $this;
    }
}
