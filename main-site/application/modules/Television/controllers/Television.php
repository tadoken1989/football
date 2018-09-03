<?php

class Television extends MY_Controller
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
        $this->load->model('mdl_television');
    }

    // list link sopcast

    public function index()
    {
        $today = date ('Y-m-d');
        $list_tv = $this->mdl_television->with_league()->with('home_team')->with('away_team')->where('datetime >',$today)->where('status',1)->get_all();
        return $this->blade
            ->set('list_tv',$list_tv)
            ->render('list');
    }
}