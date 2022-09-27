<?php

namespace App\Service;

use App\Entity\Summoner;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RiotService
{
    private $client;
    public $continents =array();

    public function __construct(HttpClientInterface $client){
        $this->client      = $client;
        $this->continents = array ('BR1'  =>'AMERICAS',
                                   'EUN1' =>'EUROPE',
                                   'EUW1' =>'EUROPE',
                                   'JP1'  =>'ASIA',
                                   'KR'   =>'ASIA',
                                   'LA1'  =>'AMERICAS',
                                   'LA2'  =>'AMERICAS',
                                   'NA1'  =>'AMERICAS',
                                   'OC1'  =>'AMERICAS',
                                   'TR1'  =>'EUROPE',
                                   'RU'   =>'EUROPE'
        );

    }

    public function getSummoner(string $region, string $summonerName):Summoner{
        $url = 'https://'.$region.'.api.riotgames.com/lol/summoner/v4/summoners/by-name/'.$summonerName.'?api_key='.$_ENV["RIOT_TOKEN"];

            $response = $this->client->request('GET', $url);
            $content = $response->toArray();

            $summoner = new Summoner();
            $summoner->setPuuid($content['puuid']);
            $summoner->setSummerner($content['name']);

            return $summoner;
    }

    public function getSummonerHistory(string $region,string $puuid): array{
        $continent = $this->continents[strtoupper($region)];
        $url = 'https://'.$continent.'.api.riotgames.com/lol/match/v5/matches/by-puuid/'.$puuid.'/ids?start=0&count=10&api_key='.$_ENV["RIOT_TOKEN"];

        $response = $this->client->request('GET',$url);
        return $response->toArray();
    }
}