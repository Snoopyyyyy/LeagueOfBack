<?php

namespace App\Services;

use App\Entity\Game;
use App\Entity\GameEvent;
use App\Entity\Player;
use App\Entity\Summoner;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RiotService
{
    private readonly HttpClientInterface $client;
    private readonly array $continents;

    public function __construct(HttpClientInterface $client){
        $this->client = $client;
        $this->continents = array (
            'BR1'  =>'AMERICAS',
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
        $summoner->setProfileIconId($content['profileIconId']);
        $summoner->setName($content['name']);
        $summoner->setPuuid($content['puuid']);
        $summoner->setSummonerLevel($content['summonerLevel']);

        return $summoner;
    }

    public function getSummonerHistory(string $region,string $puuid): array {
        $continent = $this->continents[strtoupper($region)];
        $url = 'https://'.$continent.'.api.riotgames.com/lol/match/v5/matches/by-puuid/'.$puuid.'/ids?start=0&count=10&api_key='.$_ENV["RIOT_TOKEN"];

        $response = $this->client->request('GET',$url);
        return $response->toArray();
    }

    public function getGameInfo(string $region, string $gameId): Game {
        $continent = $this->continents[strtoupper($region)];
        $url = 'https://'.$continent.'.api.riotgames.com/lol/match/v5/matches/'.$gameId.'?api_key='.$_ENV["RIOT_TOKEN"];

        $response = $this->client->request('GET', $url);

        $json = $response->toArray();
        $game = new Game();;
        $game->setMatchId($json["metadata"]["matchId"]);
        $game->setSurrender(false);
        $creation = new \DateTime();
        $creation->setTimestamp($json["info"]["gameCreation"]/1000);
        $game->setDate($creation);
        $game->setDuration($json["info"]["gameDuration"]);
        $game->setGameMode($json["info"]["gameMode"]);


        foreach ($json["info"]["participants"] as $jsonPly) {
            $game->addPlayer($this->createPlayer($jsonPly));
            if($jsonPly["teamEarlySurrendered"]) $game->setSurrender(true);
        }

        return $game;
    }

    public function getGameEvents(string $region, string $gameId): GameEvent {
        $continent = $this->continents[strtoupper($region)];
        $url = 'https://'.$continent.'.api.riotgames.com/lol/match/v5/matches/'.$gameId.'/timeline?api_key='.$_ENV["RIOT_TOKEN"];

        $response = $this->client->request('GET', $url);
        $json = $response->toArray();

        $events = [];
        foreach($json["info"]["frames"] as $frame) {
            array_push($events, ...$frame["events"]);
        }

        $gameEvent = new GameEvent();
        $gameEvent->setEvents($events);
        return $gameEvent;
    }

    private function createPlayer(array $json): Player {
        $player = new Player();
        $player->setSummonerName($json["summonerName"]);
        $player->setTeamId($json["teamId"]);
        $player->setChampionName($json["championName"]);
        $player->setLevel($json["champLevel"]);
        $player->setKills($json["kills"]);
        $player->setDeath($json["deaths"]);
        $player->setAssists($json["assists"]);
        $player->setCs($json["totalMinionsKilled"]);
        $player->setPost($json["individualPosition"]);
        $player->setParticipantId($json["participantId"]);
        $player->setVisionScore($json["visionScore"]);
        $player->setWin($json["win"]);
        $player->setItem1($json["item1"]);
        $player->setItem2($json["item2"]);
        $player->setItem3($json["item3"]);
        $player->setItem4($json["item4"]);
        $player->setItem5($json["item5"]);
        $player->setItem6($json["item6"]);
        $player->setFirstRune($json["perks"]["styles"][0]["style"]);
        $player->setSecondRune($json["perks"]["styles"][1]["style"]);
        $player->setSummoner1($json["summoner1Id"]);
        $player->setSummoner2($json["summoner2Id"]);

        return $player;
    }



}