<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sportradar
{
    protected $baseAPIUrl = "https://api.sportradar.us/soccer-p3/global/en/";
    protected $timeout = 300000;
    protected $apiKey;
    protected $oddsKey;

    public function __construct()
    {
        $CI = &get_instance();
        $CI->load->helper('convert');
        if (load_configs('api_key')) {
            $this->apiKey = load_configs('api_key');
        } else {
            $this->apiKey = 'bsyb9w9vu7njewraemygpam3';
        }
    }

    public function request($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        $data = curl_exec($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code == 200) {
            return (object)(json_decode($data, true));
        }

        return false;
    }

    public function getPlayersByTeam($teamId)
    {
        $url = $this->baseAPIUrl . 'teams/sr:competitor:' . $teamId . '/profile.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getAllLeagues()
    {
        $url = $this->baseAPIUrl . 'tournaments.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getAllSeasonByLeagueId($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/seasons.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getStandingByLeagueId($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/standings.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getLeagueInfo($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/info.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getTeamInfo($teamId)
    {
        $url = $this->baseAPIUrl . 'teams/sr:competitor:' . $teamId . '/profile.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getPlayerInfo($playerId)
    {
        $url = $this->baseAPIUrl . 'players/sr:player:' . $playerId . '/profile.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getDailyResults($daily)
    {
        $url = $this->baseAPIUrl . 'schedules/' . $daily . '/results.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getMatchInfo($matchId)
    {
        $url = $this->baseAPIUrl . 'matches/sr:match:' . $matchId . '/summary.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getLineUpOfMatch($matchId)
    {
        $url = $this->baseAPIUrl . 'matches/sr:match:' . $matchId . '/lineups.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getLeagueSchedule($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/schedule.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getTopScores($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/leaders.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getAllResultByLeagueId($leagueId)
    {
        $url = $this->baseAPIUrl . 'tournaments/sr:tournament:' . $leagueId . '/results.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getOddByMatchId($matchId)
    {
        if (load_configs('odds_key')) {
            $this->oddsKey = load_configs('odds_key');
        } else {
            $this->oddsKey = 't7j2yeyjwxa5crky4bnbvff4';
        }
        $url = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sport_events/sr:match:' . $matchId . '/markets.json?api_key='.$this->oddsKey;
        return $this->request($url);
    }

    public function getBookMarker()
    {
        if (load_configs('odds_key')) {
            $this->oddsKey = load_configs('odds_key');
        } else {
            $this->oddsKey = 't7j2yeyjwxa5crky4bnbvff4';
        }
        $url = 'https://api.sportradar.com/oddscomparison-rowt1/en/us/books.json?api_key='.$this->oddsKey;
        return $this->request($url);
    }
}
