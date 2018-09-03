<?php

class Tip extends MY_Controller
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

    // list link sopcast

    public function index()
    {
        return $this->blade->render('list');
    }
    public function live() {
        return $this->blade->render('live');
    }
    public function ykcg(){
        return $this->blade->render('ykcg');

    }
    public function news(){
        return $this->blade->render('news');

    }
}