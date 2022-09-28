<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RiotService;

#[Route("/api", name: "api_")]
class RiotController extends AbstractController
{
    #[Route('/riot', name: 'app_riot')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RiotController.php',
        ]);
    }

    #[Route('/riot/{region}/{summoner}', methods: ['GET', 'HEAD'])]
    public function refresh(string $region, string $summoner, RiotService $riotService, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        try {
            $sum = $riotService->getSummoner($region, $summoner);
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'getSummonerFailled'], 501);
        }
        $em->persist($sum);

        try {
            $history = $riotService->getSummonerHistory($region, $sum->getPuuid());
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'getSummonerHistory'], 502);
        }

        $game = $riotService->getGame($region, $history[0]);
        $game->setSummoner($sum);


        /*foreach ($history as $game_id) {
            try {
                $game = $riotService->getGame($region, $game_id);
                $game->setSummoner($sum);

                $em->persist($game);
            } catch (Exception $e) {

            }
        }*/
        $em->persist($game);
        $em->flush();
        return new JsonResponse(['success'=>'GG'],212);
    }
}
