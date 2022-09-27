<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Item;
use App\Entity\Summoner;
use App\Entity\Ward;
use DateTime;
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

    public function getGame(string $region, string $idGame ): Game {
        $continent = $this->continents[strtoupper($region)];
        $url = 'https://'.$continent.'.api.riotgames.com/lol/match/v5/matches/'.$idGame.'/timeline?api_key='.$_ENV["RIOT_TOKEN"];

        $response = $this->client->request('GET', $url);
        $json = $response->toArray();

        $game = new Game();
        $game->setRiotId($idGame);

        foreach($json["info"]["frames"] as $frames) {
            foreach($frames["events"] as $event) {
                $game = $this->convertEvent($game, $event);
            }
        }
        return $game;
    }

    private function convertEvent(Game $game,array $event): Game{
        switch ($event["type"]) {
            case "PAUSE_END":
                $game->setDate(new DateTime(strtotime($event["realTimestamp"])));
                break;
            case "GAME_END":
                $game->setDuree($event["timestamp"]);
                $game->setWin(true);
                break;

            case "WARD_PLACED":
                $ward = new Ward();
                $ward->setWardType($event["wardType"]);
                $ward->setType("WARD_PLACED");
                $ward->setTimestamp($event["timestamp"]);
                $ward->setPlayerId($event["creatorId"]);
                $game->addWard($ward);
                break;
            case "WARD_KILL":
                $ward = new Ward();
                $ward->setWardType($event["wardType"]);
                $ward->setType("WARD_KILL");
                $ward->setTimestamp($event["timestamp"]);
                $ward->setPlayerId($event["killerId"]);
                $game->addWard($ward);
                break;

            case "ITEM_PURCHASED":
                $item = new Item();
                $item->setPlayerId($event["participantId"]);
                $item->setTimestamp($event["timestamp"]);
                $item->setItemId($event["itemId"]);
                $item->setType($event["type"]);
                $game->addItem($item);
                break;
        }
        return $game;
    }

    private function createPlayer(Game $game, array $json): Game {
        return $game;
    }
}