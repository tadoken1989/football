<?php

class Fixture extends Authed_Controller
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

    public function index()
    {
        $this->load->helper('url');
        return $this->blade->render('index');
    }

    public function getData()
    {

        $today = date('Y-m-d');

        $list = $this->mdl_fixture_matches->with_league()->with_home_team()->with_away_team()->with_season()->where('date >=',$today)->where('league_id',1)->limit($_GET['length'], $_GET['start'])->get_all();
        $data = array();
        foreach ($list as $fixture) {
            $row = array();
            $row['fixture_matches_id'] = $fixture->fixture_matches_id;
            $row['date'] = $fixture->date;
            $row['round'] = $fixture->round;
            $row['location'] = $fixture->location;
            $row['home_team'] = $fixture->home_team->name;
            $row['away_team'] = $fixture->away_team->name;
            $row['league'] = $fixture->league->name;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->mdl_fixture_matches->count_rows(),
            "recordsFiltered" => $this->mdl_fixture_matches->count_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}