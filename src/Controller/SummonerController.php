<?php

namespace App\Controller;

use App\Entity\Summoner;
use App\Repository\SummonerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route("/api", name: "api_")]

class SummonerController extends AbstractController
{


    #[Route('/summoner/{summoner}', name: 'app_summoner')]
    public function getSummoner(SerializerInterface $serializer, SummonerRepository $summonerRepository,ManagerRegistry $doctrine, $summoner):Response{

        $summonerRepository = $doctrine->getRepository(Summoner::class);
        $summonerP = $summonerRepository->findOneBy(['summoner'=>$summoner]);
        $summonerPJSON = $serializer->serialize($summonerP, 'json',  ['groups' => 'toto']);
        return new Response('success'.$summonerPJSON,200);
    }
}
