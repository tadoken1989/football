<?php

class Team extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_players');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_fixture_matches');
        $this->load->model('mdl_matches_history');
        $this->load->model('mdl_league_team_standing');
        $this->load->model('mdl_league_team_cup_standing');
    }

    public function detail($alias, $id)
    {
        $team = $list_fixtures = $list_history = null;
        if ($alias && $id) {
            $team = $this->mdl_teams->with_country()->with_players()->where('team_id', intval($id))->where('alias', trim(strip_tags(slug($alias))))->get();
        }
        if ($team) {
            // history
            $list_fixtures = $this->mdl_fixture_matches
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $team->team_id)
                ->where('date >=', date('Y-m-d'))
                ->where('fixture_matches.away_team_id', '=', $team->team_id, TRUE, TRUE, FALSE)
                ->where('date >=', date('Y-m-d'))
                ->order_by('date', 'ASC')
                ->limit($this->configRowFixture)->get_all();

            // history
            $list_history = $this->mdl_matches_history
                ->with_home_team()
                ->with_away_team()
                ->with_league()
                ->with_season()
                ->where('home_team_id', $team->team_id)
                ->where('date <=', date('Y-m-d'))
                ->where('matches_history.away_team_id', '=', $team->team_id, TRUE, TRUE, FALSE)
                ->where('date <=', date('Y-m-d'))
                ->order_by('date', 'DESC')
                ->limit($this->configRowFixture)->get_all();
        }
        return $this->blade
            ->set('team', $team)
            ->set('list_fixtures', $list_fixtures)
            ->set('list_history', $list_history)
            ->render('detail');
    }
}