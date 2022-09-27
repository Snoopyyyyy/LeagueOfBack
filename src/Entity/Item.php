<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $item_id = null;

    #[ORM\Column]
    private ?int $player_id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    #[ORM\Column]
    private ?int $gold_gain = null;

    #[ORM\Column]
    private ?int $before_id = null;

    #[ORM\Column]
    private ?int $after_id = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemId(): ?int
    {
        return $this->item_id;
    }

    public function setItemId(int $item_id): self
    {
        $this->item_id = $item_id;

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

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getGoldGain(): ?int
    {
        return $this->gold_gain;
    }

    public function setGoldGain(int $gold_gain): self
    {
        $this->gold_gain = $gold_gain;

        return $this;
    }

    public function getBeforeId(): ?int
    {
        return $this->before_id;
    }

    public function setBeforeId(int $before_id): self
    {
        $this->before_id = $before_id;

        return $this;
    }

    public function getAfterId(): ?int
    {
        return $this->after_id;
    }

    public function setAfterId(int $after_id): self
    {
        $this->after_id = $after_id;

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