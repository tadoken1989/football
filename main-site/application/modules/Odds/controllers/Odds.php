<?php

class Odds extends MY_Controller
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

    // detail ty le 1 cap dau

    public function detail($fixture_matches_id)
    {
        $fixture = $this->mdl_fixture_matches
            ->with_home_team()
            ->with_away_team()
            ->with_league()
            ->with_season()
            ->with_history()
            ->where('fixture_matches_id', intval($fixture_matches_id))->get();
        return $this->blade->set('fixture',$fixture)->render('detail');
    }
}