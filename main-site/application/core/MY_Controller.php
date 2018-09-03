<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller
{
    protected $apiXmlSoccerKey = 'ZJBBJHCZTRVFXTSGHYRYWGAXEUAZTRRGKGNLGGZNINWCVSIVFG';

    // page detail cap dau
    protected $limitHistory = 10;
    protected $limitFixtures = 5;

    // page detail team

    protected $configRowHistory = 20;
    protected $configRowFixture = 20;

    protected $isCup = 0;

    protected $currentSeasonDefault = 1;

    protected $season_id;

    public function __construct()
    {
        parent::__construct();
        $this->season_id = initCurrentSeason();
    }

    public function callApi($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}