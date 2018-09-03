<?php

class Ratings extends MY_Controller
{
    const PAGE = 30;

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
        $this->load->model('mdl_top_scorers');
        $this->load->model('mdl_fifa_standing');
    }


    public function index()
    {
        $region = region();
        $x = 0;
        $arrayLeague = [];
        foreach ($region as $key => $rg) {
            $i = 0;
            if (isset($rg->country) && $rg->country) {
                foreach ($rg->country as $ct => $val) {
                    $league = league_in_country($val);
                    if ($league) {
                        if ($i % 2 == 0) {
                            $x++;
                        }
                        $arrayLeague[$rg->name][$x][] = $league;

                    }
                    $i++;
                }
            }

        }
        // dd($arrayLeague);
        return $this->blade->set('arrayLeague', $arrayLeague)->render('ratings');
    }

    public function detail($slug, $id)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();

        if (!$leagues) {
            return redirect('/');
        }
        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();

        $league_group_cup = $this->mdl_league_group_cup
            ->where('league_id', $id)
            ->order_by('name', 'ASC')
            ->get_all();

        $league_team_standing = $this->mdl_league_team_standing->with_league()
            ->where('league_id', $id)
            ->order_by('points', 'DESC')
            ->get_all();

        return $this->blade->set('league_team_standing', $league_team_standing)
            ->set('country_leagues', $country_leagues)
            ->set('league_group_cup', $league_group_cup)
            ->set('leagues', $leagues)
            ->set('active', 'tong')
            ->render('ratings_detail');
    }

    public function bangXepHangSanNha($slug, $id)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();
        if (!$leagues) {
            return redirect('/');
        }
        $matches_history = $this->mdl_matches_history->where('league_id', $leagues->id)->get_all();

        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();

        $league_team_standing = $this->mdl_league_team_standing->with_league()
            ->where('league_id', $id)
            ->order_by('won', 'DESC')
            ->get_all();

        $teams_convert = get_data_san_nha($league_team_standing, $leagues);

        $league_group_cup = $this->mdl_league_group_cup
            ->where('league_id', $id)
            ->order_by('name', 'ASC')
            ->get_all();

        $league_group_cup_array = get_data_san_nha_is_cup($league_group_cup, $leagues);

        return $this->blade->set('league_team_standing', $league_team_standing)
            ->set('country_leagues', $country_leagues)
            ->set('league_group_cup', $league_group_cup)
            ->set('leagues', $leagues)
            ->set('active', 'sannha')
            ->set('teams_convert', $teams_convert)
            ->set('league_group_cup_array', $league_group_cup_array)
            ->render('bxh_sannha');
    }

    public function bangXepHangSanKhach($slug, $id)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();
        if (!$leagues) {
            return redirect('/');
        }
        $matches_history = $this->mdl_matches_history->where('league_id', $leagues->id)->get_all();

        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();

        $league_team_standing = $this->mdl_league_team_standing->with_league()
            ->where('league_id', $id)
            ->order_by('won', 'DESC')
            ->get_all();

        $teams_convert = get_data_san_khach($league_team_standing, $leagues);

        $league_group_cup = $this->mdl_league_group_cup
            ->where('league_id', $id)
            ->order_by('name', 'ASC')
            ->get_all();

        $league_group_cup_array = get_data_san_khach_is_cup($league_group_cup, $leagues);

        return $this->blade->set('league_team_standing', $league_team_standing)
            ->set('country_leagues', $country_leagues)
            ->set('league_group_cup', $league_group_cup)
            ->set('leagues', $leagues)
            ->set('active', 'sankhach')
            ->set('teams_convert', $teams_convert)
            ->set('league_group_cup_array', $league_group_cup_array)
            ->render('bxh_sankhach');
    }


    public function vuaphaluoi($alias, $id)
    {
        $leagues = $this->mdl_leagues->where('id', $id)->get();
        if (!$leagues) {
            return redirect('/');
        }
        $country_leagues = $this->mdl_leagues->where('country_id', $leagues->country_id)->get_all();

        $country = $this->mdl_country->where('id', $leagues->country_id)->get();
        $top_scorers = $this->mdl_top_scorers->where('league_id', $leagues->id)
            ->order_by('goals', 'DESC')
            ->with_league()
            ->with_team()
            ->limit(15)
            ->get_all();
        //dd($top_scorers);
        return $this->blade->set('leagues', $leagues)
            ->set('country_leagues', $country_leagues)
            ->set('country', $country)
            ->set('top_scorers', $top_scorers)
            ->render('vuaphaluoi');
    }

    public function bxhFifa($gender, $page = null)
    {
        $perpage = (isset($page) && $page > 0) ? (int)$page : 1;
        $status = ($gender == 'nam') ? 1 : 0;
        $limit = static::PAGE;
        $offset = ($perpage - 1) * $limit;
        $count_rows = $this->mdl_fifa_standing->count_rows(['gender' => $status]);
        $total_page = ceil($count_rows / $limit);

        $fifa = $this->db->from('fifa_standing')->where('gender', $status)
            ->order_by('point', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result();

        $this->blade->set('gender', $status)
            ->set('total_page', $total_page)
            ->set('fifa', $fifa)
            ->set('perpage', $perpage)
            ->render('bxh_fifa');
    }
}