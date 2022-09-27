<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sumonner_name = null;

    #[ORM\Column(length: 255)]
    private ?string $champion_name = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $player_kill = null;

    #[ORM\Column]
    private ?int $player_death = null;

    #[ORM\Column]
    private ?int $player_assistance = null;

    #[ORM\Column(length: 255)]
    private ?string $first_rune = null;

    #[ORM\Column(length: 255)]
    private ?string $second_rune = null;

    #[ORM\Column(length: 255)]
    private ?string $first_summoner = null;

    #[ORM\Column(length: 255)]
    private ?string $second_summoner = null;

    #[ORM\Column]
    private ?int $team_id = null;

    #[ORM\Column]
    private ?int $cs = null;

    #[ORM\Column]
    private ?int $vision_score = null;

    #[ORM\Column(length: 255)]
    private ?string $post = null;

    #[ORM\Column]
    private ?int $id_in_game = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSumonnerName(): ?string
    {
        return $this->sumonner_name;
    }

    public function setSumonnerName(string $sumonnerName): self
    {
        $this->sumonner_name = $sumonnerName;

        return $this;
    }

    public function getChampionName(): ?string
    {
        return $this->champion_name;
    }

    public function setChampionName(string $champion_name): self
    {
        $this->champion_name = $champion_name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getPlayerKill(): ?int
    {
        return $this->player_kill;
    }

    public function setPlayerKill(int $player_kill): self
    {
        $this->player_kill = $player_kill;

        return $this;
    }

    public function getPlayerDeath(): ?int
    {
        return $this->player_death;
    }

    public function setPlayerDeath(int $player_death): self
    {
        $this->player_death = $player_death;

        return $this;
    }

    public function getPlayerAssistance(): ?int
    {
        return $this->player_assistance;
    }

    public function setPlayerAssistance(int $player_assistance): self
    {
        $this->player_assistance = $player_assistance;

        return $this;
    }

    public function getFirstRune(): ?string
    {
        return $this->first_rune;
    }

    public function setFirstRune(string $first_rune): self
    {
        $this->first_rune = $first_rune;

        return $this;
    }

    public function getSecondRune(): ?string
    {
        return $this->second_rune;
    }

    public function setSecondRune(string $second_rune): self
    {
        $this->second_rune = $second_rune;

        return $this;
    }

    public function getFirstSummoner(): ?string
    {
        return $this->first_summoner;
    }

    public function setFirstSummoner(string $first_summoner): self
    {
        $this->first_summoner = $first_summoner;

        return $this;
    }

    public function getSecondSummoner(): ?string
    {
        return $this->second_summoner;
    }

    public function setSecondSummoner(string $second_summoner): self
    {
        $this->second_summoner = $second_summoner;

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

    public function getCs(): ?int
    {
        return $this->cs;
    }

    public function setCs(int $cs): self
    {
        $this->cs = $cs;

        return $this;
    }

    public function getVisionScore(): ?int
    {
        return $this->vision_score;
    }

    public function setVisionScore(int $vision_score): self
    {
        $this->vision_score = $vision_score;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getIdInGame(): ?int
    {
        return $this->id_in_game;
    }

    public function setIdInGame(int $id_in_game): self
    {
        $this->id_in_game = $id_in_game;

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
