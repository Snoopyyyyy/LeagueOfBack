<?php

namespace App\Controller;

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
        try {
            $summoner = $riotService->getSummoner($region, $summonerName);
            $em->persist($summoner);
            $em->flush();
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            if(str_contains($mess, "Could not resolve host")) {
                return new JsonResponse(['error' => "Invalid region", 'region' => $region], 400);
            }else{
                return new JsonResponse(['error' => "No summoner found", 'summonerName' => $summonerName], 404);
            }
        }

        try {
            $history = $riotService->getSummonerHistory($region, $summoner->getPuuid());
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            dd($mess);
        }

        try {
            foreach ($history as $gameId) {
                $game = $riotService->getGameInfo($region, $gameId);
                $gameEvent = $riotService->getGameEvents($region, $gameId);
                $game->setEvents($gameEvent);

                $em->persist($game);
                $em->flush();
            }
        }catch (\Exception $e) {
            $mess = $e->getMessage();
            dd($mess);
        }

        return $this->json([
            'message' => 'Done',
        ]);
    }
}
