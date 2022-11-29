<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Game $game = null;

    #[ORM\Column(length: 255)]
    private ?string $summonerName = null;

    #[ORM\Column]
    private ?int $teamId = null;

    #[ORM\Column(length: 255)]
    private ?string $championName = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $death = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column]
    private ?int $cs = null;

    #[ORM\Column(length: 255)]
    private ?string $post = null;

    #[ORM\Column]
    private ?int $participantId = null;

    #[ORM\Column]
    private ?int $visionScore = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\Column(nullable: true)]
    private ?int $item0 = null;
    
    #[ORM\Column(nullable: true)]
    private ?int $item1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $item2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $item3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $item4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $item5 = null;

    #[ORM\Column(nullable: true)]
    private ?int $item6 = null;

    #[ORM\Column(nullable: true)]
    private ?int $firstRune = null;

    #[ORM\Column]
    private ?int $secondRune = null;

    #[ORM\Column]
    private ?int $summoner1 = null;

    #[ORM\Column]
    private ?int $summoner2 = null;

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

    public function getSummonerName(): ?string
    {
        return $this->summonerName;
    }

    public function setSummonerName(string $summonerName): self
    {
        $this->summonerName = $summonerName;

        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    public function setTeamId(int $teamId): self
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function getChampionName(): ?string
    {
        return $this->championName;
    }

    public function setChampionName(string $championName): self
    {
        $this->championName = $championName;

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

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getDeath(): ?int
    {
        return $this->death;
    }

    public function setDeath(int $death): self
    {
        $this->death = $death;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): self
    {
        $this->assists = $assists;

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

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getParticipantId(): ?int
    {
        return $this->participantId;
    }

    public function setParticipantId(int $participantId): self
    {
        $this->participantId = $participantId;

        return $this;
    }

    public function getVisionScore(): ?int
    {
        return $this->visionScore;
    }

    public function setVisionScore(int $visionScore): self
    {
        $this->visionScore = $visionScore;

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

    public function getItem1(): ?int
    {
        return $this->item1;
    }

    public function setItem1(int $item1): self
    {
        $this->item1 = $item1;

        return $this;
    }

    public function getItem2(): ?int
    {
        return $this->item2;
    }

    public function setItem2(int $item2): self
    {
        $this->item2 = $item2;

        return $this;
    }

    public function getItem3(): ?int
    {
        return $this->item3;
    }

    public function setItem3(int $item3): self
    {
        $this->item3 = $item3;

        return $this;
    }

    public function getItem4(): ?int
    {
        return $this->item4;
    }

    public function setItem4(int $item4): self
    {
        $this->item4 = $item4;

        return $this;
    }

    public function getItem5(): ?int
    {
        return $this->item5;
    }

    public function setItem5(int $item5): self
    {
        $this->item5 = $item5;

        return $this;
    }

    public function getItem6(): ?int
    {
        return $this->item6;
    }

    public function setItem6(int $item6): self
    {
        $this->item6 = $item6;

        return $this;
    }

    public function getFirstRune(): ?int
    {
        return $this->firstRune;
    }

    public function setFirstRune(int $firstRune): self
    {
        $this->firstRune = $firstRune;

        return $this;
    }

    public function getSecondRune(): ?int
    {
        return $this->secondRune;
    }

    public function setSecondRune(int $secondRune): self
    {
        $this->secondRune = $secondRune;

        return $this;
    }

    public function getSummoner1(): ?int
    {
        return $this->summoner1;
    }

    public function setSummoner1(int $summoner1): self
    {
        $this->summoner1 = $summoner1;

        return $this;
    }

    public function getSummoner2(): ?int
    {
        return $this->summoner2;
    }

    public function setSummoner2(int $summoner2): self
    {
        $this->summoner2 = $summoner2;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return array(
            "summonerName" => $this->getSummonerName(),
            "teamId" => $this->getTeamId(),
            "championName" => $this->getChampionName(),
            "level" => $this->getLevel(),
            "kills" => $this->getKills(),
            "deaths" => $this->getDeath(),
            "assists" => $this->getAssists(),
            "cs" => $this->getCs(),
            "post" => $this->getPost(),
            "participantId" => $this->getParticipantId(),
            "visionScore" => $this->getVisionScore(),
            "win" => $this->isWin(),
            "item0" => $this->getItem0(),
            "item1" => $this->getItem1(),
            "item2" => $this->getItem2(),
            "item3" => $this->getItem3(),
            "item4" => $this->getItem4(),
            "item5" => $this->getItem5(),
            "item6" => $this->getItem6(),
            "FirstRune" => $this->getFirstRune(),
            "SecondRune" => $this->getSecondRune(),
            "Summoner1" => $this->getSummoner1(),
            "Summoner2" => $this->getSummoner2(),
        );
    }

    public function getItem0(): ?int
    {
        return $this->item0;
    }

    public function setItem0(int $item0): self
    {
        $this->item0 = $item0;

        return $this;
    }
}
