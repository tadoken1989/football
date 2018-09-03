<?php

class Tip extends Authed_Controller
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
        $this->load->model('mdl_television');
        $this->load->model('mdl_tip');
    }

    public function index()
    {
        $link_tv = $this->mdl_tip->with_league()->with_home_team()->with_away_team()->order_by('datetime', 'DESC')->get_all();
        return $this->blade->set('link_tv', $link_tv)->render('index');
    }

    public function add()
    {
        return $this->blade->render('add');
    }

    public function edit($id)
    {
        $link_tv = $this->mdl_tip->with_league()->with_home_team()->with_away_team()->where('id', $id)->get();
        return $this->blade->set('link', $link_tv)->render('edit');
    }

    public function addAction()
    {
        $this->form_validation->set_rules('league', 'League', 'required');
        $this->form_validation->set_rules('home_team', 'Home Team', 'required');
        $this->form_validation->set_rules('away_team', 'Away Team', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('home_team_goals', 'home_team_goals', 'required');
        $this->form_validation->set_rules('away_team_goals', 'away_team_goals', 'required');
        $this->form_validation->set_rules('round', 'Round', 'required');
        $this->form_validation->set_rules('select', 'Select', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $fixture_match = $this->mdl_fixture_matches->with_home_team()->with_away_team()
            ->where('home_team_id',$this->input->post('home_team'))
            ->where('away_team_id',$this->input->post('away_team'))
            ->where('league_id',$this->input->post('league'))
            ->where('round',$this->input->post('round'))
            ->get();
        if($fixture_match) {
            $insert_data = array(
                'datetime' => $fixture_match->date,
                'channel' => $this->input->post('channel'),
                'round' => $this->input->post('round'),
                'home_team_id' => $this->input->post('home_team'),
                'home_team_goals' => $this->input->post('home_team_goals'),
                'away_team_goals' => $this->input->post('away_team_goals'),
                'select' => $this->input->post('select'),
                'away_team_id' => $this->input->post('away_team'),
                'league_id' => $this->input->post('league'),
                'home_team' => $fixture_match->home_team->name,
                'away_team' => $fixture_match->away_team->name,
                'fixture_matches_id' => $fixture_match->fixture_matches_id,
                'alias' => slug($fixture_match->home_team->name).'-vs-'.slug($fixture_match->away_team->name).generateRandomString()
            );
            if($this->mdl_tip->insert($insert_data)) {
                $this->session->set_flashdata('success', 'Insert Done');
                redirect(site_url('tip'));
            }
        }
        $this->session->set_flashdata('error', 'Insert failed');
        redirect(site_url('tip'));
    }

    public function updateAction($id)
    {

        $this->form_validation->set_rules('league', 'League', 'required');
        $this->form_validation->set_rules('home_team', 'Home Team', 'required');
        $this->form_validation->set_rules('away_team', 'Away Team', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('home_team_goals', 'home_team_goals', 'required');
        $this->form_validation->set_rules('away_team_goals', 'away_team_goals', 'required');
        $this->form_validation->set_rules('round', 'Round', 'required');
        $this->form_validation->set_rules('select', 'Select', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }

        $fixture_match = $this->mdl_fixture_matches->with_home_team()->with_away_team()
            ->where('home_team_id',$this->input->post('home_team'))
            ->where('away_team_id',$this->input->post('away_team'))
            ->where('league_id',$this->input->post('league'))
            ->where('round',$this->input->post('round'))
            ->get();
        if($fixture_match && $id) {
            $insert_data = array(
                'datetime' => $fixture_match->date,
                'channel' => $this->input->post('channel'),
                'round' => $this->input->post('round'),
                'home_team_id' => $this->input->post('home_team'),
                'home_team_goals' => $this->input->post('home_team_goals'),
                'away_team_goals' => $this->input->post('away_team_goals'),
                'select' => $this->input->post('select'),
                'away_team_id' => $this->input->post('away_team'),
                'league_id' => $this->input->post('league'),
                'home_team' => $fixture_match->home_team->name,
                'away_team' => $fixture_match->away_team->name,
                'fixture_matches_id' => $fixture_match->fixture_matches_id,
                'alias' => slug($fixture_match->home_team->name).'-vs-'.slug($fixture_match->away_team->name).generateRandomString()
            );
            if($this->mdl_tip->update($insert_data,$id)) {
                $this->session->set_flashdata('success', 'Update Done');
                redirect(site_url('tip'));
            }
        }
        $this->session->set_flashdata('error', 'Update failed');
        redirect(site_url('tip'));
    }

}