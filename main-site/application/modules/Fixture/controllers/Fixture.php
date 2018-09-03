<?php

class Fixture extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_fixture_matches');
    }

    public function index($day = null)
    {
        // example data query
        $countryId = $this->input->post('slbCountry') ? $this->input->post('slbCountry') : 0;
        $slbDay = $this->input->post('slbDay') ? $this->input->post('slbDay') : 0;
        $slbType = $this->input->post('slbType') ? $this->input->post('slbType') : 0;
        if (is_null($day)) {
            $day = date('d.m.Y');
            if (is_null($slbDay) || $slbDay == 0) {
                $date_from = date('Y-m-d 00:00:00');
                $date_to = date("Y-m-d 00:00:00", strtotime("$date_from +1 day"));
            } else {
                $today = date('Y-m-d 00:00:00');
                $date_from = date("Y-m-d 00:00:00", strtotime("$today +$slbDay day"));
                $date_to = date("Y-m-d 00:00:00", strtotime("$date_from +1 day"));
            }
        } else {
            $date_from = date("Y-m-d 00:00:00", strtotime("$day"));
            $date_to = date("Y-m-d 00:00:00", strtotime("$date_from +1 day"));
        }
        // query
        $list_fixture = $this->mdl_fixture_matches
            ->with_home_team()
            ->with_away_team()
            ->with_league()
            ->with_season();
        if ($countryId) {
            $array_league_id = [];
            $leagues = $this->mdl_leagues->where('country_id', $countryId)->get_all();
            foreach ($leagues as $league) {
                array_push($array_league_id, $league->id);
            }
            $list_fixture = $list_fixture->where_league_id(implode(',', $array_league_id));
        }
        // query by league

        // query season
        $list_fixture = $list_fixture
            // query date
            ->where('date >=', $date_from)
            ->where('date <=', $date_to)
            ->order_by('date', 'ASC')
            ->get_all();
        if ($slbType == 1) {
            return $this->blade
                ->set('list_fixture', $list_fixture)
                ->set('date_from', $date_from)
                ->set('slbDay', $slbDay)
                ->set('slbType', $slbType)
                ->set('countryId', $countryId)
                ->set('today', $day)
                ->render('fixture_league');
        }
        return $this->blade
            ->set('list_fixture', $list_fixture)
            ->set('date_from', $date_from)
            ->set('slbDay', $slbDay)
            ->set('slbType', $slbType)
            ->set('countryId', $countryId)
            ->set('today', $day)
            ->render('fixture_time');
    }

    public function tylebongda()
    {
        $today = date('Y-m-d 00:00:00');
        $today1day = date('Y-m-d 00:00:00', strtotime("$today +1 day"));
        $list_fixture = $this->db->select('leagues.name as leagues_name,leagues.alias,leagues.id as league_id')
            ->from('fixture_matches')
            ->join('leagues', 'fixture_matches.league_id = leagues.id')
            ->where('fixture_matches.date >=', $today)
            ->where('fixture_matches.date <', $today1day)
            ->order_by('leagues.sort', 'asc')
            ->group_by('leagues.name')
            ->get()
            ->result();

        $date = ['today' => $today, 'addday' => $today1day];
        $todayInWeek = format_day_in_week(date('l'));
        return $this->blade->set('vdqg', $list_fixture)->set('date', $date)->set('todayInWeek',
            $todayInWeek)->render('tyle_bongda');
    }

    public function get_data()
    {
        $link = [];
        $home = [];
        $away = [];
        $linkBXH = [];
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, 'http://bongda.wap.vn/process-rate-live-web.jsp');
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

        $html = preg_replace('/href=\'http:\/\/bongda.wap.vn\/ket-qua-.{0,30}.html\'/', ' ', $data);
        $html = preg_replace('/\(Soạn: BD TL.{0,30}\)/', ' ', $html);

        $dataHTML = str_replace('<div><h2 class="bg_h2">KEO BONG DA TRUC TUYEN</h2></div>', '', (string)$data);
        $doc = new DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $doc->loadHTML($dataHTML);
        libxml_use_internal_errors($internalErrors);

        if (isset($doc->childNodes[1])) {
            foreach ($doc->childNodes[1]->childNodes[0]->getElementsByTagName('table') as $index => $tables) {
                if (!preg_match('/\d+\.\d+/', $tables->nodeValue) && !strpos($tables->nodeValue,
                        'BD TL') && strlen($tables->nodeValue) > 2) {
                    if (strlen($this->gen_slug($tables->childNodes[0]->childNodes[0]->childNodes[0]->childNodes[0]->nodeValue)) > 5) {
                        $home[] = $this->gen_slug($tables->childNodes[0]->childNodes[0]->childNodes[0]->childNodes[0]->nodeValue);
                        $away[] = $this->gen_slug($tables->childNodes[1]->childNodes[0]->childNodes[0]->childNodes[0]->nodeValue);
                    }
                }
            }

            foreach ($home as $index => $item) {
                $home_team = $this->mdl_teams->where('alias', $item)->get();
                $away_team = $this->mdl_teams->where('alias', $away[$index])->get();

                if ($home_team && $away_team) {
                    $link[] = '/phong-do-' . $home_team->alias . '-vs-' . $away_team->alias . '-' . $home_team->team_id . '-' . $away_team->team_id . '.html';
                } else {
                    $link[] = '#';
                }
            }

            foreach ($doc->childNodes[1]->childNodes[0]->getElementsByTagName('strong') as $index => $strongs) {
                if (!preg_match('/\d+\.\d+|\d - \d/', $strongs->nodeValue)) {
                    $league_alias = $this->gen_slug($strongs->nodeValue);

                    $league = $this->mdl_leagues->where('alias', $league_alias)->get();
                    if ($league) {
                        $linkBXH[] = '/bang-xep-hang-'. $league->alias .'-'. $league->id .'.html';
                    } else {
                        $linkBXH[] = '#';
                    }
                }
            }
        }

        $link = implode(', ', $link);
        $linkBXH = implode(', ', $linkBXH);
        return $this->blade->set('html', $html)->set('link', $link)->set('linkBXH', $linkBXH)->render('tyle_tructiep');
    }

    public function tylebongdatheothu($alias, $i)
    {
        if($i == 0) {
            return redirect('ty-le-bong-da.html');
        }
        $today = date('Y-m-d 00:00:00', strtotime("+$i day"));
        $addSubDay = date('Y-m-d 00:00:00', strtotime("$today +1 day"));

        $list_fixture = $this->db->select('leagues.name as leagues_name,leagues.alias,leagues.id as league_id')
            ->from('fixture_matches')
            ->join('leagues', 'fixture_matches.league_id = leagues.id')
            ->where('fixture_matches.date >=', $today)
            ->where('fixture_matches.date <', $addSubDay)
            ->order_by('leagues.sort', 'asc')
            ->group_by('leagues.name')
            ->get()
            ->result();
        $date = ['today' => $today, 'addday' => $addSubDay];
        $todayInWeek = format_day_in_week(date('l', strtotime("+$i day")));
        return $this->blade->set('vdqg', $list_fixture)->set('date', $date)->set('todayInWeek',
            $todayInWeek)->render('tyle_bongda_day');
    }

    public function tylebongdatheongay($day = null)
    {
        if($day == 0) {
            return redirect('ty-le-bong-da.html');
        }
        if (is_null($day)) {
            return $this->tylebongda();
        } else {
            $from = date("Y-m-d 00:00:00", strtotime("$day"));
            $to = date("Y-m-d 23:59:59", strtotime("$day"));
            $list_fixture = $this->db->select('leagues.name as leagues_name,leagues.alias,leagues.id as league_id')
                ->from('fixture_matches')
                ->join('leagues', 'fixture_matches.league_id = leagues.id')
                ->where('fixture_matches.date >=', $from)
                ->where('fixture_matches.date <', $to)
                ->order_by('leagues.sort', 'asc')
                ->group_by('leagues.name')
                ->get()
                ->result();
            $date = ['today' => $from, 'addday' => $to];
            $todayInWeek = format_day_in_week(date('l', strtotime("+0 day")));

            return $this->blade->set('vdqg', $list_fixture)->set('date', $date)->set('todayInWeek',
                $todayInWeek)->render('tyle_bongda');
        }
    }
}