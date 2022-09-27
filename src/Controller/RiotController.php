<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RiotService;

#[Route("/api",name:"api_")]
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

    #[Route('/riot/{region}/{summoner}', methods:['GET', 'HEAD'])]
    public function refresh(string $region, string $summoner, RiotService $riotService, ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        try{
            $sum = $riotService->getSummoner($region, $summoner);
        }catch(Exception $e){
            return new JsonResponse(['error' => 'getSummonerFailled'],500);
        }
        $em->persist($sum);

        try{
            $history = $riotService->getSummonerHistory($region, $sum->getPuuid());
        }catch(Exception $e){
            return new JsonResponse(['error' => 'getSummonerHistory'],500);
        }

        $em->flush();
    }
}
