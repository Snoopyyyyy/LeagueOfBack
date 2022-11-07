<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Summoner;
use App\Services\RiotService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api", name: "api_")]
class RiotController extends AbstractController
{
    #[Route('/riot/{region}/{summonerName}', name: 'app_riot', methods: ['GET', 'HEAD'])]
    public function index(ManagerRegistry $doctrine, RiotService $riotService, string $region, string $summonerName): JsonResponse
    {
        $em = $doctrine->getManager();
        $nbMatchFetch = 0;
        // Summoner
        try {
            $summoner = $riotService->getSummoner($region, $summonerName);
            $exist = $em->getRepository(Summoner::class)->findOneBy(['puuid' => $summoner->getPuuid()]);
            if($exist == null) {
                $em->persist($summoner);
                $em->flush();
            }else{
                $summoner = $exist;
            }
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            if(str_contains($mess, "Could not resolve host")) {
                return new JsonResponse(['error' => "Invalid region", 'region' => $region], 400);
            }else {
                return new JsonResponse(['error' => "No summoner found", 'summonerName' => $summonerName], 404);
            }
        }

        // History
        try {
            $history = $riotService->getSummonerHistory($region, $summoner->getPuuid());
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            dd($mess);
        }

        // game events
        try {
            foreach ($history as $gameId) {
                $lastGame = $em->getRepository(Game::class)->findOneBy(['matchId' => $gameId]);
                if($lastGame == null) {
                    $game = $riotService->getGameInfo($region, $gameId);
                    $gameEvent = $riotService->getGameEvents($region, $gameId);
                    $game->setEvents($gameEvent);
                    $em->persist($game);
                    $em->flush();
                    $nbMatchFetch++;
                }
            }
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            dd($mess);
        }

        return $this->json([
            'message' => 'Done',
            'Summoner' => $summoner->getName(),
            'nb_games' => $nbMatchFetch
        ]);
    }
}
