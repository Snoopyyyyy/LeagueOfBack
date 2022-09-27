<?php

namespace App\Entity;

use App\Repository\ObjectifKillRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjectifKillRepository::class)]
class ObjectifKill
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
    private ?int $player_id = null;

    #[ORM\Column]
    private ?int $position_x = null;

    #[ORM\Column]
    private ?int $position_y = null;

    #[ORM\Column]
    private ?int $team_id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    #[ORM\Column(length: 255)]
    private ?string $monster_type = null;

    #[ORM\Column(length: 255)]
    private ?string $sub_monster_type = null;

    #[ORM\ManyToOne(inversedBy: 'objectifKills')]
    private ?Game $game = null;

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

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function setPlayerId(int $player_id): self
    {
        $this->player_id = $player_id;

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

    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getMonsterType(): ?string
    {
        return $this->monster_type;
    }

    public function setMonsterType(string $monster_type): self
    {
        $this->monster_type = $monster_type;

        return $this;
    }

    public function getSubMonsterType(): ?string
    {
        return $this->sub_monster_type;
    }

    public function setSubMonsterType(string $sub_monster_type): self
    {
        $this->sub_monster_type = $sub_monster_type;

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
}