<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Summoner;
use App\Repository\GameRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api", name: "api_")]
class GameController extends AbstractController
{
    #[Route('/game/{summonerPuuid}/history', name: 'app_game', methods: ['GET', 'HEAD'])]
    public function index(ManagerRegistry $doctrine, string $summonerPuuid): JsonResponse
    {
        $summoner = $doctrine->getRepository(Summoner::class)->findOneBy(['puuid' => $summonerPuuid]);
        $players = $doctrine->getRepository(Player::class)->findBy(['summonerName' => $summoner->getName()]);
        $games = [];
        foreach ($players as $player) $games[] = $player->getGame();

        return $this->json($games);
    }

    #[Route('/game/{gameId}', name: 'app_game_events', methods: ['GET', 'HEAD'])]
    public function getEvents(ManagerRegistry $doctrine, string $gameId): JsonResponse
    {
        $game = $doctrine->getRepository(Game::class)->findOneBy(['matchId' => $gameId]);
        return $this->json($game->jsonSerializeEvent());
    }
}
