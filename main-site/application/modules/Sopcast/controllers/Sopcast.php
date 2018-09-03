<?php

class Sopcast extends MY_Controller
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
        $this->load->model('mdl_link_sopcast');
    }

    // list link sopcast

    public function index()
    {
        $link_sopcast = $this->mdl_link_sopcast->where('status',1)->get_all();
        return $this->blade->set('link_sopcast',$link_sopcast)->render('list');
    }

    public function detail($id)
    {
        $sopcast = $this->mdl_link_sopcast->where('id_link',$id)->where('status',1)->get();
        return $this->blade->set('sopcast',$sopcast)->render('detail');
    }
}