<?php

class League extends MY_Controller
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
        $this->load->model('mdl_league_team_standing');
        $this->load->model('mdl_league_team_cup_standing');
        $this->load->model('mdl_league_group_cup');
        $this->load->model('mdl_matches_history');
    }

    public function index($alias,$id)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();

        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();


        $records = $this->db->select_max('round')
        				->from('fixture_matches')
        				->where('league_id',$leagues->id)
				        ->get()
				        ->row();
		$matches_history_max = $this->db->select_max('round')
        				->from('matches_history')
        				->where('league_id',$leagues->id)
				        ->get()
				        ->row();
		$slRound = $this->input->post('slRound')?$this->input->post('slRound'):$matches_history_max->round;

		$live_result = $this->mdl_matches_history->where('league_id',$leagues->id)
			->with_home_team()
            ->with_away_team()
            ->where('round',$slRound)
            ->get_all();
        
		$result_football = [];

		if ($live_result) {
			foreach ($live_result as $key => $value) 
			{
				$date = format_date_asia_date($value->date);
				$result_football[$date][] = $value;
			}
		}
        return $this->blade->set('leagues',$leagues)
        		->set('records',$records)
        		->set('live_result',$live_result)
        		->set('matches_history_max',$matches_history_max)
        		->set('country_leagues',$country_leagues)
        		->set('slRound',$slRound)
        		->set('result_football',$result_football)
        		->render('home');
    }

    public function ketquatheovong($alias,$id , $round)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();

        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();


        $records = $this->db->select_max('round')
                        ->from('fixture_matches')
                        ->where('league_id',$leagues->id)
                        ->get()
                        ->row();
        $matches_history_max = $this->db->select_max('round')
                        ->from('matches_history')
                        ->where('league_id',$leagues->id)
                        ->get()
                        ->row();
        $slRound = $slRound = $this->input->post('slRound')?$this->input->post('slRound'):$round;

        $live_result = $this->mdl_matches_history->where('league_id',$leagues->id)
            ->with_home_team()
            ->with_away_team()
            ->where('round',$slRound)
            ->get_all();
        
        $result_football = [];

        if ($live_result) {
            foreach ($live_result as $key => $value) 
            {
                $date = format_date_asia_date($value->date);
                $result_football[$date][] = $value;
            }
        }
        return $this->blade->set('leagues',$leagues)
                ->set('records',$records)
                ->set('live_result',$live_result)
                ->set('matches_history_max',$matches_history_max)
                ->set('country_leagues',$country_leagues)
                ->set('slRound',$slRound)
                ->set('result_football',$result_football)
                ->render('home');
    }
    

    public function lichthidauthevong($alias , $id)
    {
        $leagues = $this->mdl_leagues->where('id',$id)->get();

        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();
        $matches_history_max = $this->db->select_max('round')
                        ->from('matches_history')
                        ->where('league_id',$leagues->id)
                        ->get()
                        ->row();
        $beetween = $matches_history_max->round + 5;
        $live_result = $this->mdl_fixture_matches->where('league_id',$leagues->id)
            ->with_home_team()
            ->with_away_team()
            ->where("round >= ",$matches_history_max->round)
            ->where("round <= ",$beetween)
            ->where("date >= ",date('Y-m-d 00:00:00'))
            ->order_by('date','asc')
            ->get_all();
        $result_football = [];

        if ($live_result) {
            foreach ($live_result as $key => $value) 
            {
                $date = format_date_asia_date($value->date);
                $result_football[$date][] = $value;
            }
        }
        return $this->blade->set('leagues',$leagues)
                ->set('country_leagues',$country_leagues)
                ->set('result_football',$result_football)
                ->render('lichthidau');
    }
}