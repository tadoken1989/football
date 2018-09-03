<?php

class Sportradar
{
    protected $baseAPIUrl = "https://api.sportradar.us/soccer-p3/global/en/";
    protected $timeout = 3000;
    protected $apiKey;
    protected $lang = 'vi';

    public function __construct()
    {
        $CI = &get_instance();
        $CI->load->helper('convert');
        if (load_configs('api_key')) {
            $this->apiKey = load_configs('api_key');
        } else {
            $this->apiKey = 'bsyb9w9vu7njewraemygpam3';
        }
        $this->baseAPIUrl = "https://api.sportradar.us/soccer-p3/global/".$this->lang."/";
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

    public function getLiveScore()
    {
        $url = $this->baseAPIUrl . 'schedules/live/results.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getMatchInfo($matchId)
    {
        $url = $this->baseAPIUrl . 'matches/sr:match:' . $matchId . '/summary.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }


    public function getMatchTimeLine($matchId)
    {
        $url = $this->baseAPIUrl . 'matches/sr:match:' . $matchId . '/timeline.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }

    public function getLineUp($matchId)
    {
        $url = $this->baseAPIUrl . 'matches/sr:match:' . $matchId . '/lineups.json?api_key=' . $this->apiKey;
        return $this->request($url);
    }
}