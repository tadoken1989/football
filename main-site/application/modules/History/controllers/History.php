<?php

class History extends MY_Controller
{
    protected $sportradar;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_fixture_matches');
        $this->load->model('mdl_matches_history');
        $this->load->model('mdl_league_team_standing');
        $this->load->model('mdl_league_team_cup_standing');
        $this->load->model('mdl_league_group_cup');
        $this->sportradar = new Sportradar();
    }

    // trang ket qua all
    public function all($day = null)
    {
        // example data query
        $countryId = $this->input->post('slbCountry') ? $this->input->post('slbCountry') : 0;
        $slbDay = !is_null($this->input->post('slbDay')) ? $this->input->post('slbDay') : -1;
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
        $list_history = $this->mdl_matches_history
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
            $list_history = $list_history->where_league_id(implode(',', $array_league_id));
        }
        // query by league

        // query season
        $list_history = $list_history
            // query date
            ->where('date >=', $date_from)
            ->where('date <=', $date_to)
            ->order_by('date', 'ASC')
            ->get_all();
        if ($slbType == 1) {
            return $this->blade
                ->set('list_history', $list_history)
                ->set('date_from', $date_from)
                ->set('slbDay', $slbDay)
                ->set('slbType', $slbType)
                ->set('countryId', $countryId)
                ->set('today', $day)
                ->render('history_league');

        } else {
            return $this->blade
                ->set('list_history', $list_history)
                ->set('date_from', $date_from)
                ->set('slbDay', $slbDay)
                ->set('slbType', $slbType)
                ->set('countryId', $countryId)
                ->set('today', $day)
                ->render('history_time');
        }
    }

    // trang phong do doi dau cua 2 doi

    public function detail($home_id, $away_id, $match_id)
    {

        $match = $this->mdl_fixture_matches->with_home_team()
                                           ->with_away_team()->where('fixture_matches_id', $match_id)->get();

        if (!$match) {
            return $this->blade
                ->set('match', false)
                ->render('detail');
        }
        $league = $this->mdl_leagues->where('id', $match->league_id)->where('status', 1)->get();
        if ($home_id && $away_id && $match) {
            // lay lich su doi dau cua 2 doi trong 10 tran gan nhat
            $list_home_away_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_id)
                ->where('away_team_id', $away_id)
                ->where('matches_history.home_team_id', '=', $away_id, TRUE, TRUE, FALSE)
                ->where('away_team_id', $home_id)
                ->limit($this->limitHistory)->get_all();
            // lay lich su tran thi dau 10 tran gan nhat cua home team

            $list_home_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_id)
                ->where('matches_history.away_team_id', '=', $home_id, TRUE, TRUE, FALSE)
                ->order_by('date', 'DESC')
                ->limit($this->limitHistory)->get_all();

            $list_away_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $away_id)
                ->where('matches_history.away_team_id', '=', $away_id, TRUE, TRUE, FALSE)
                ->order_by('date', 'DESC')
                ->limit($this->limitHistory)->get_all();

            // lay lich thi dau home_team

            $list_home_fixtures = $this->mdl_fixture_matches
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_id)
                ->where('date >=', date('Y-m-d'))
                ->where('fixture_matches.away_team_id', '=', $home_id, TRUE, TRUE, FALSE)
                ->where('date >=', date('Y-m-d'))
                ->order_by('date', 'ASC')
                ->limit($this->limitFixtures)->get_all();

            $list_away_fixtures = $this->mdl_fixture_matches
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $away_id)
                ->where('date >=', date('Y-m-d'))
                ->where('fixture_matches.away_team_id', '=', $away_id, TRUE, TRUE, FALSE)
                ->where('date >=', date('Y-m-d'))
                ->order_by('date', 'ASC')
                ->limit($this->limitFixtures)->get_all();

            // lay bxh giai dau
            $group_cup = null;
            if ($league->is_cup == $this->isCup) {
                $league_standing = $this->mdl_league_team_standing->where('league_id', $league->id)->get_all();
            } else {
                $groupId = [];
                $group_cup = $this->mdl_league_group_cup->where('league_id', $league->id)->get_all();
                if ($group_cup) {
                    foreach ($group_cup as $group) {
                        array_push($groupId, $group->league_group_id);
                    }
                    $league_standing = $this->mdl_league_team_cup_standing->where_group_id(implode(',', $groupId))->get_all();
                } else {
                    $league_standing = null;
                }

            }

        }
        return $this->blade
            ->set('list_home_away_history', $list_home_away_history)
            ->set('list_home_history', $list_home_history)
            ->set('list_away_history', $list_away_history)
            ->set('list_home_fixtures', $list_home_fixtures)
            ->set('list_away_fixtures', $list_away_fixtures)
            ->set('league_standing', $league_standing)
            ->set('group_cup', $group_cup)
            ->set('league', $league)
            ->set('match', $match)
            ->render('detail');
    }


    public function detailAlias($home_alias, $away_alias)
    {

        $home_team = $this->mdl_teams->where('team_id', $home_alias)->get();
        $away_team = $this->mdl_teams->where('team_id', $away_alias)->get();
        $group_cup = null;

        $match = $league = $list_home_away_history = $list_home_history = $list_away_history = $list_home_fixtures = $list_away_fixtures = $league_standing = null;
        if ($home_team && $away_team) {
            $match = $this->mdl_fixture_matches->with_home_team()
                                               ->with_away_team()->where('home_team_id', $home_team->team_id)->where('away_team_id', $away_team->team_id)->get();
            if ($match) {
                $league = $this->mdl_leagues->where('id', $match->league_id)->where('status', 1)->get();
            }
        }
        if ($home_team && $away_team && $match) {

            $list_home_away_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_team->team_id)
                ->where('away_team_id', $away_team->team_id)
                ->where('matches_history.home_team_id', '=', $away_team->team_id, TRUE, TRUE, FALSE)
                ->where('away_team_id', $home_team->team_id)
                ->limit($this->limitHistory)->get_all();

            // lay lich su tran thi dau 10 tran gan nhat cua home team

            $list_home_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_team->team_id)
                ->where('matches_history.away_team_id', '=', $home_team->team_id, TRUE, TRUE, FALSE)
                ->order_by('date', 'DESC')
                ->limit($this->limitHistory)->get_all();

            $list_away_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $away_team->team_id)
                ->where('matches_history.away_team_id', '=', $away_team->team_id, TRUE, TRUE, FALSE)
                ->order_by('date', 'DESC')
                ->limit($this->limitHistory)->get_all();

            // lay lich thi dau home_team

            $list_home_fixtures = $this->mdl_fixture_matches
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $home_team->team_id)
                ->where('date >=', date('Y-m-d'))
                ->where('fixture_matches.away_team_id', '=', $home_team->team_id, TRUE, TRUE, FALSE)
                ->where('date >=', date('Y-m-d'))
                ->order_by('date', 'ASC')
                ->limit($this->limitFixtures)->get_all();

            $list_away_fixtures = $this->mdl_fixture_matches
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $away_team->team_id)
                ->where('date >=', date('Y-m-d'))
                ->where('fixture_matches.away_team_id', '=', $away_team->team_id, TRUE, TRUE, FALSE)
                ->where('date >=', date('Y-m-d'))
                ->order_by('date', 'ASC')
                ->limit($this->limitFixtures)->get_all();

            // lay bxh giai dau

            if ($league->is_cup == $this->isCup) {
                $league_standing = $this->mdl_league_team_standing->where('league_id', $league->id)->get_all();
            } else {
                $groupId = [];
                $group_cup = $this->mdl_league_group_cup->where('league_id', $league->id)->get_all();
                if ($group_cup) {
                    foreach ($group_cup as $group) {
                        array_push($groupId, $group->league_group_id);
                    }
                    $league_standing = $this->mdl_league_team_cup_standing->where_group_id(implode(',', $groupId))->get_all();
                } else {
                    $league_standing = null;
                }

            }

        }

        return $this->blade
            ->set('list_home_away_history', $list_home_away_history)
            ->set('list_home_history', $list_home_history)
            ->set('list_away_history', $list_away_history)
            ->set('list_home_fixtures', $list_home_fixtures)
            ->set('list_away_fixtures', $list_away_fixtures)
            ->set('league_standing', $league_standing)
            ->set('league', $league)
            ->set('group_cup', $group_cup)
            ->set('match', $match)
            ->render('detail');
    }


    // Trang truc tiep cap dau

    public function live($fixture_matches_id)
    {
        $fixture = $this->sportradar->getMatchInfo($fixture_matches_id);
        if (!$fixture) {
            $fixture = null;
        }
        $matchTimeLine = $this->sportradar->getMatchTimeLine($fixture_matches_id);
        if(!$matchTimeLine){
            $matchTimeLine = null;
        }

        return $this->blade->set('fixture', $fixture)->set('matchTimeLine',$matchTimeLine)->render('live');
    }

}