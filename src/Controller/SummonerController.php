<?php

namespace App\Controller;

use App\Entity\Summoner;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api", name: "api_")]
class SummonerController extends AbstractController
{
    #[Route('/summoner/{summonerName}', name: 'app_summoner', methods: ['GET', 'HEAD'])]
    public function index(ManagerRegistry $doctrine, string $summonerName): JsonResponse
    {
        $summoner = $doctrine->getRepository(Summoner::class)->findOneBy(['name' => $summonerName]);
        if($summoner == null) {
            return $this->json(['error' => 'No summoner Found', 'summonerName' => $summonerName], 404);
        }else {
            return $this->json($summoner);
        }
    }
}
