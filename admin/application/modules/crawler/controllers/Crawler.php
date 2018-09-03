<?php

class Crawler extends Authed_Controller
{
    protected $sportradar;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_region');
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_group_cup');
        $this->load->model('mdl_league_team_cup_standing');
        $this->load->model('mdl_odds_by_fixture_match_id');
        $this->load->model('mdl_fixture_matches');
        $this->load->model('mdl_matches_history');
        $this->load->model('mdl_league_team_standing');
        $this->load->model('mdl_top_scorers');
        $this->load->model('mdl_players');
        $this->load->model('mdl_books');
        $this->sportradar = new Sportradar();
    }

    public function get_all_leagues()
    {
        return $this->blade->render('getAllLeagues');
    }

    public function getAllLeaguesSubmit()
    {
        try {
            $allLeagues = $this->sportradar->getAllLeagues()->tournaments;
            if (!$this->mdl_region->where('region_id', 1)->get()) {
                $this->mdl_region->insert([
                    'region_id' => '1',
                    'name' => 'International',
                    'status' => '1',
                    'alias' => 'international',
                ]);
            }
            if (!$this->mdl_season->where('season_id', 1)->get()) {
                $this->mdl_season->insert([
                    'season_id' => '1',
                    'season_code' => '1',
                    'status' => '1',
                    'season_name' => '2017-2018',
                    'is_current' => '1',
                ]);
            }
            if (!$this->mdl_country->where('id', 1)->get()) {
                $this->mdl_country->insert([
                    'id' => '1',
                    'name' => '1',
                    'status' => '1',
                    'alias' => '1',
                ]);
            }
            $this->db->trans_start();
            foreach ($allLeagues as $key => $league) {
                $is_cup = boolval(!isset($league['category']['country_code']));
                echo('<pre>');
                if (isset($league['category']['country_code'])) {
                    $existCountry = $this->mdl_country->where('alias', $league['category']['country_code'])->get();
                    if (!$existCountry) {
                        $insert_country = [
                            'name' => $league['category']['name'],
                            'alias' => $league['category']['country_code'],
                        ];

                        $this->mdl_country->insert($insert_country);
                    }
                }

                $country_id = (!$is_cup) ? $this->mdl_country->where('alias',
                    $league['category']['country_code'])->get()->id : 1;
                $league_api_id = str_replace('sr:tournament:', '', $league['id']);
                $existLeague = $this->mdl_leagues->where('id', $league_api_id)->get();
                if (!$existLeague) {
                    $insert_data = array(
                        'id' => $league_api_id,
                        'name' => $league['name'],
                        'alias' => slug($league['name']),
                        'league_api_id' => $league_api_id,
                        'is_cup' => $is_cup,
                        'country_id' => $country_id,
                        'status' => 0
                    );
                    $this->mdl_leagues->insert($insert_data);
                    echo('<pre>');
                    echo "Insert done league: " . $league['name'];
                }
            }
            $this->db->trans_complete();
        } catch (Exception $e) {
            echo "Has error: " . $e->getMessage();
        }
        echo "<pre>";
        print_r('Done all data');
        echo "</pre>";
        exit();
    }

    // load view

    public function get_team_info()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getTeamInfo');
    }

    // lay toan bo doi bong cua 1 giai

    public function getAllTeamsByLeagueAndSeason()
    {
        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $leagueId = $this->input->post('league');

        try {
            $getLeagueInfo = $this->sportradar->getLeagueInfo($leagueId);

            if ($getLeagueInfo) {
                $listTeams = $getLeagueInfo->groups;

                foreach ($listTeams as $key => $itemTeam) {
                    $teams = $itemTeam['teams'];

                    foreach ($teams as $team) {
                        $teamId = str_replace('sr:competitor:', '', $team['id']);
                        // check team exits in database
                        if (isset($team['country_code'])) {
                            $country = $this->mdl_country->where('alias', $team['country_code'])->get();
                            $teamInfo = $this->sportradar->getTeamInfo($teamId);

                            if (!$country) {
                                $insert_country_data = [
                                    'name' => $team['country'],
                                    'alias' => $team['country_code'],
                                ];
                                $this->db->trans_start();
                                $this->mdl_country->insert($insert_country_data);
                                $this->db->trans_complete();
                            }
                        }

                        $team_check = $this->mdl_teams->where('alias', slug($team['name']))->get();
                        if (!$team_check && isset($team['country_code'])) {
                            $countryId = $this->mdl_country->where('alias', $team['country_code'])->get();
                            if ($countryId) {
                                $insert_team_data = array(
                                    'team_id' => $teamId,
                                    'team_api_id' => $teamId,
                                    'name' => $team['name'],
                                    'alias' => slug($team['name']),
                                    'country_id' => $countryId->id,
                                    'stadium' => isset($teamInfo->venue['name']) ? $teamInfo->venue['name'] : 'No info',
                                );
                                $this->db->trans_start();
                                $teamId = $this->mdl_teams->insert($insert_team_data);
                                $this->db->trans_complete();
                                echo "<pre>";
                                print_r('Insert done : ' . $team['name'] . ' ID ' . $teamId);
                                echo "</pre>";
                            }
                        } else {
                            echo "<pre>";
                            print_r($value = "team_exits_database " . $team['name']);
                            echo "</pre>";
                        }

                        if (isset($teamInfo) && isset($team['country_code'])) {
                            foreach ($teamInfo->statistics['seasons'] as $leagueTeam) {
                                echo('<pre>');
                                $leagueApiId = str_replace('sr:tournament:', '', $leagueTeam['tournament']['id']);

                                $league_team_check = $this->mdl_league_team
                                    ->where('team_id', $teamId)
                                    ->where('league_id', $leagueApiId)
                                    ->get();
                                if (!$league_team_check && $this->mdl_leagues->where('id', $leagueApiId)->get()) {
                                    $insert_league_team = array(
                                        'league_id' => $leagueApiId,
                                        'team_id' => $teamId,
                                        'season_id' => 1
                                    );
                                    $this->db->trans_start();
                                    $this->mdl_league_team->insert($insert_league_team);
                                    $this->db->trans_complete();
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo "Has error: " . $e->getMessage();
        }
        echo "<pre>";
        print_r('Done all data,redirecting to admin after 5s');
        echo "</pre>";
        exit();
    }

    // lay toan bo cau thu cua giai

    public function get_player_of_league()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getPlayerOfLeague');
    }

    public function getPlayersByLeague()
    {
        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $leagueId = $this->input->post('league');

        $teams = [];
        foreach ($this->sportradar->getLeagueInfo($leagueId)->groups as $group) {
            foreach ($group['teams'] as $team) {
                $teamId = str_replace('sr:competitor:', '', $team['id']);
                // check team exits in database
                if (isset($team['country_code'])) {
                    $country = $this->mdl_country->where('alias', $team['country_code'])->get();
                    $teamInfo = $this->sportradar->getTeamInfo($teamId);

                    if (!$country) {
                        $insert_country_data = [
                            'name' => $team['country'],
                            'alias' => $team['country_code'],
                        ];
                        $this->db->trans_start();
                        $this->mdl_country->insert($insert_country_data);
                        $this->db->trans_complete();
                    }
                }

                $team_check = $this->mdl_teams->where('team_id', $teamId)->get();

                if (!$team_check && isset($team['country_code'])) {
                    $countryId = $this->mdl_country->where('alias', $team['country_code'])->get();
                    if ($countryId) {
                        $insert_team_data = array(
                            'team_id' => $teamId,
                            'team_api_id' => $teamId,
                            'name' => $team['name'],
                            'alias' => slug($team['name']),
                            'country_id' => $countryId->id,
                            'stadium' => isset($teamInfo->venue['name']) ? $teamInfo->venue['name'] : 'No info',
                        );
                        $this->db->trans_start();
                        $teamId = $this->mdl_teams->insert($insert_team_data);
                        $this->db->trans_complete();
                        echo "<pre>";
                        print_r('Insert done : ' . $team['name'] . ' ID ' . $teamId);
                        echo "</pre>";
                    }
                }

                $league_team_check = $this->mdl_league_team
                    ->where('team_id', $teamId)
                    ->where('league_id', $leagueId)
                    ->get();
                if (!$league_team_check && $this->mdl_leagues->where('id', $leagueId)->get()) {
                    $insert_league_team = array(
                        'league_id' => $leagueId,
                        'team_id' => $teamId,
                        'season_id' => 1
                    );
                    $this->db->trans_start();
                    $this->mdl_league_team->insert($insert_league_team);
                    $this->db->trans_complete();
                }

                $teams[] = $teamId;
            }
        }
        $teams = array_unique($teams);

        foreach ($teams as $team_id) {
            try {
                $getPlayer = $this->sportradar->getPlayersByTeam($team_id);
                if (isset($getPlayer->players)) {
                    $players = $getPlayer->players;

                    if ($players) {
                        $this->db->trans_start();
                        foreach ($players as $player) {
                            $name = implode(' ', array_reverse(explode(',', $player['name'])));
                            $id = str_replace('sr:player:', '', $player['id']);
                            $player_exits = $this->mdl_players
                                ->where('player_id', intval($id))
                                ->where('team_id', intval($team_id))->get();

                            if (!$player_exits && isset($player['country_code'])) {
                                $country = $this->mdl_country->where('alias', $player['country_code'])->get();

                                if (!$country) {
                                    $insert_data_country = array(
                                        'name' => $player['nationality'],
                                        'alias' => $player['country_code'],
                                    );

                                    $this->mdl_country->insert($insert_data_country);
                                }

                                $insert_player_data = array(
                                    'player_id' => intval($id),
                                    'team_id' => $team_id,
                                    'name' => $name,
                                    'height' => isset($player['height']) ? $player['height'] : null,
                                    'weight' => isset($player['weight']) ? $player['weight'] : null,
                                    'position' => $player['type'],
                                    'nationality' => isset($player['nationality']) ? $player['nationality'] : 'No info',
                                    'player_number' => isset($player['jersey_number']) ? $player['jersey_number'] : null,
                                    'birthday' => isset($player['date_of_birth']) ? $player['date_of_birth'] : null,
                                    'alias' => slug($name),
                                );
                                $this->mdl_players->insert($insert_player_data);
                                echo "<pre>";
                                print_r("Insert done player" . $name);
                                echo "</pre>";
                            } else {
                                echo "<pre>";
                                print_r('Player exits on DB');
                                echo "</pre>";
                            }
                        }
                        $this->db->trans_complete();
                    }
                }
            } catch (Exception $e) {
                echo "XMLSoccerException: " . $e->getMessage();
            }
        }
    }

    // load view lay bang xep hang
    public function get_standing_info()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getStandingByLeagueAndSeason');
    }

    public function getLeagueStandingsBySeason()
    {
        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $league = $this->input->post('league');
        $is_cup = $this->mdl_leagues->where('id', $league)->get()->is_cup;
        $standings = $this->sportradar->getStandingByLeagueId($league);

        try {
            if ($is_cup) {
                if ($standings->standings) {
                    $this->db->trans_start();
                    foreach ($standings->standings[0]["groups"] as $standingGroup) {
                        foreach ($standingGroup["team_standings"] as $standing) {
                            $teamId = intval(str_replace("sr:competitor:", "", $standing["team"]["id"]));
                            $team_standing = $this->mdl_teams->where('team_api_id', $teamId)->get();

                            if ($team_standing) {
                                // check exits on database team_standing
                                // if exits delete data and update again

                                $this->mdl_league_team_standing
                                    ->where('league_id', $league)
                                    ->where('team_id', $teamId)
                                    ->delete();

                                $this->mdl_league_team_cup_standing->where('team_id', $teamId)->delete();
                                $insert_data_standing = array(
                                    'team_id' => $teamId,
                                    'team_api_id' => $teamId,
                                    'team' => $standing["team"]["name"],
                                    'played' => $standing["played"],
                                    'won' => $standing["win"],
                                    'draw' => $standing["draw"],
                                    'lost' => $standing["loss"],
                                    'goals_for' => $standing["goals_for"],
                                    'goals_against' => $standing["goals_against"],
                                    'goal_difference' => $standing["goal_diff"],
                                    'points' => $standing["points"],
                                    'group' => $standingGroup['name'],
                                    'group_id' => $this->mdl_league_group_cup
                                        ->where('league_id', $league)
                                        ->where('name', $standingGroup['name'])->get()->league_group_id,
                                );
                                if ($this->mdl_league_team_cup_standing->insert($insert_data_standing)) {
                                    echo "<pre>";
                                    print_r('Insert complete standing for team :' . $team_standing->name);
                                    echo "</pre>";
                                }
                            }
                        }
                    }
                    $this->db->trans_complete();
                }
            } else {
                if ($standings->standings) {
                    $this->db->trans_start();
                    foreach ($standings->standings[0]["groups"] as $standingGroup) {
                        foreach ($standingGroup["team_standings"] as $standing) {
                            $teamId = intval(str_replace("sr:competitor:", "", $standing["team"]["id"]));
                            $team_standing = $this->mdl_teams->where('team_api_id', $teamId)->get();
                            if ($team_standing) {
                                // check exits on database team_standing
                                // if exits delete data and update again
                                $existTeamStanding = $this->mdl_league_team_standing->where('team_id',
                                    $teamId)->where('league_id', $league)->delete();
                                $insert_data_standing = array(
                                    'team_id' => $teamId,
                                    'league_id' => $league,
                                    'season_id' => 1,
                                    'team_api_id' => $teamId,
                                    'team' => $standing["team"]["name"],
                                    'played' => $standing["played"],
                                    'won' => $standing["win"],
                                    'draw' => $standing["draw"],
                                    'lost' => $standing["loss"],
                                    'goals_for' => $standing["goals_for"],
                                    'goals_against' => $standing["goals_against"],
                                    'goal_difference' => $standing["goal_diff"],
                                    'points' => $standing["points"],
                                );
                                if ($this->mdl_league_team_standing->insert($insert_data_standing)) {
                                    echo "<pre>";
                                    print_r('Insert complete standing for team :' . $team_standing->name);
                                    echo "</pre>";
                                }
                            }
                        }
                    }
                    $this->db->trans_complete();
                }
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        echo "<pre>";
        print_r($value = 'Hoàn tất BXH');
        echo "</pre>";
        exit();
    }

    // load view ket qua

    public function get_historic()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getHistoricMatchesByLeagueAndSeason');
    }

    // lay ket qua giai dau theo giai dau


    public function getHistoricMatchesByLeagueAndSeason()
    {
        $leagueId = $this->input->get('league');
        if(!$leagueId){
            exit();
        }
        $results = $this->sportradar->getAllResultByLeagueId($leagueId);
        try {
            $this->db->trans_start();
            foreach ($results->results as $result) {
                $homeId = str_replace('sr:competitor:', '', $result['sport_event']['competitors'][0]['id']);
                $awayId = str_replace('sr:competitor:', '', $result['sport_event']['competitors'][1]['id']);
                $matchId = str_replace('sr:match:', '', $result['sport_event']['id']);

                if (!$this->mdl_teams->where('team_id', $homeId)->get()) {
                    $homeTeamInfo = $this->sportradar->getTeamInfo($homeId);

                    if (isset($homeTeamInfo->team['country_code'])) {
                        $country = $this->mdl_country->where('alias', $homeTeamInfo->team['country_code'])->get();
                        if (!$country) {
                            $insert_country_data = [
                                'name' => $homeTeamInfo->team['country'],
                                'alias' => $homeTeamInfo->team['country_code'],
                            ];
                            $this->mdl_country->insert($insert_country_data);
                        }

                        $insert_team_info = [
                            'team_id' => $homeId,
                            'team_api_id' => $homeId,
                            'name' => $homeTeamInfo->team['name'],
                            'country_id' => $this->mdl_country->where('alias',
                                $homeTeamInfo->team['country_code'])->get()->id,
                            'stadium' => isset($homeTeamInfo->venue['name']) ? $homeTeamInfo->venue['name'] : 'No info',
                            'alias' => slug($homeTeamInfo->team['name']),
                        ];
                        $this->mdl_teams->insert($insert_team_info);
                    }
                }

                if (!$this->mdl_teams->where('team_id', $awayId)->get()) {
                    $awayTeamInfo = $this->sportradar->getTeamInfo($awayId);
                    if (isset($awayTeamInfo->team['country_code'])) {
                        $country = $this->mdl_country->where('alias', $awayTeamInfo->team['country_code'])->get();
                        if (!$country) {
                            $insert_country_data = [
                                'name' => $awayTeamInfo->team['country'],
                                'alias' => $awayTeamInfo->team['country_code'],
                            ];
                            $this->mdl_country->insert($insert_country_data);
                        }

                        $insert_team_info = [
                            'team_id' => $awayId,
                            'team_api_id' => $awayId,
                            'name' => $awayTeamInfo->team['name'],
                            'country_id' => $this->mdl_country->where('alias',
                                $awayTeamInfo->team['country_code'])->get()->id,
                            'stadium' => isset($awayTeamInfo->venue['name']) ? $awayTeamInfo->venue['name'] : 'No info',
                            'alias' => slug($awayTeamInfo->team['name']),
                        ];
                        $this->mdl_teams->insert($insert_team_info);
                    }
                }

                $matchSumary = $this->sportradar->getMatchInfo($matchId);

                if (isset($matchSumary->statistics)) {
                    $matchInfos = $matchSumary->statistics['teams'];
                    $homeMatchInfo = $matchInfos[0]['statistics'];
                    $awayMatchInfo = $matchInfos[1]['statistics'];
                }

                $lineUp = $this->sportradar->getLineUpOfMatch($matchId);
                if (isset($lineUp->lineups)) {
                    $lineUpHomeInfo = $lineUp->lineups[0];
                    $lineUpAwayInfo = $lineUp->lineups[1];

                    $home_line_up_defense = [];
                    $home_line_up_midfield = [];
                    $home_line_up_forward = [];

                    foreach ($lineUpHomeInfo['starting_lineup'] as $info) {
                        if ($info['type'] == 'defender') {
                            $home_line_up_defense[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'midfielder') {
                            $home_line_up_midfield[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'forward') {
                            $home_line_up_forward[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'goalkeeper') {
                            $home_line_up_goal_keeper = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                    }

                    $home_line_up_substitutes = [];

                    foreach ($lineUpHomeInfo['substitutes'] as $info) {
                        $home_line_up_substitutes[] = implode(' ', array_reverse(explode(',', $info['name'])));
                    }

                    $home_line_up_defense = implode(', ', $home_line_up_defense);
                    $home_line_up_midfield = implode(', ', $home_line_up_midfield);
                    $home_line_up_forward = implode(', ', $home_line_up_forward);
                    $home_line_up_coach = implode(' ', array_reverse(explode(',', $lineUpHomeInfo['manager']['name'])));
                    $home_line_up_substitutes = implode(', ', $home_line_up_substitutes);
                    $home_team_formation = isset($lineUpHomeInfo['formation']) ? $lineUpHomeInfo['formation'] : 'No info';

                    $away_line_up_defense = [];
                    $away_line_up_midfield = [];
                    $away_line_up_forward = [];

                    foreach ($lineUpAwayInfo['starting_lineup'] as $info) {
                        if ($info['type'] == 'defender') {
                            $away_line_up_defense[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'midfielder') {
                            $away_line_up_midfield[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'forward') {
                            $away_line_up_forward[] = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                        if ($info['type'] == 'goalkeeper') {
                            $away_line_up_goal_keeper = implode(' ', array_reverse(explode(',', $info['name'])));
                        }
                    }

                    $away_line_up_substitutes = [];

                    foreach ($lineUpAwayInfo['substitutes'] as $info) {
                        $away_line_up_substitutes[] = implode(' ', array_reverse(explode(',', $info['name'])));
                    }

                    $away_line_up_defense = implode(', ', $away_line_up_defense);
                    $away_line_up_midfield = implode(', ', $away_line_up_midfield);
                    $away_line_up_forward = implode(', ', $away_line_up_forward);
                    $away_line_up_coach = implode(' ', array_reverse(explode(',', $lineUpAwayInfo['manager']['name'])));
                    $away_line_up_substitutes = implode(', ', $away_line_up_substitutes);
                    $away_team_formation = isset($lineUpAwayInfo['formation']) ? $lineUpAwayInfo['formation'] : 'No info';
                }

                $homeInfo = $this->mdl_teams->where('team_id', $homeId)->get();
                $awayInfo = $this->mdl_teams->where('team_id', $awayId)->get();

                $round = (isset($result['sport_event']['tournament_round']['number'])) ? $result['sport_event']['tournament_round']['number'] : 0;
                $date = date('Y-m-d H:i:s', strtotime($result['sport_event']['scheduled']));
                $existFixtureMatch = $this->mdl_fixture_matches->where('fixture_matches_id', $matchId)->get();

                if (!$existFixtureMatch && $this->mdl_teams->where('team_id',
                        $homeId)->get() && $this->mdl_teams->where('team_id', $awayId)->get()) {
                    $insert_fixture_match = array(
                        'fixture_matches_id' => $matchId,
                        'fixture_matches_api_id' => $matchId,
                        'league_id' => $leagueId,
                        'season_id' => 1,
                        'round' => $round,
                        'date' => $date,
                        'home_team' => $this->mdl_teams->where('team_id', $homeId)->get()->name,
                        'home_team_api_id' => $homeId,
                        'home_team_id' => $homeId,
                        'home_goals' => $result['sport_event_status']['home_score'],
                        'away_team' => $this->mdl_teams->where('team_id', $awayId)->get()->name,
                        'away_team_id' => $awayId,
                        'away_team_api_id' => $awayId,
                        'away_goals' => $result['sport_event_status']['away_score'],
                        'time' => date('H:i', strtotime($result['sport_event']['scheduled'])),
                        'location' => $matchSumary->sport_event['venue']['name'],
                        'referee' => isset($matchSumary->sport_event_conditions['referee']['name']) ?
                            implode(' ', array_reverse(explode(',',
                                $matchSumary->sport_event_conditions['referee']['name']))) : 'No info',
                    );
                    $this->mdl_fixture_matches->insert($insert_fixture_match);
                }
                if ($homeInfo && $awayInfo && isset($result['sport_event']['venue']['capacity']) && isset($result['sport_event_status']['home_score'])
                    && $this->mdl_teams->where('team_id', $homeId)->get() && $this->mdl_teams->where('team_id',
                        $awayId)->get()
                    && !$this->mdl_matches_history->where('fixture_matches_id', $matchId)->get()) {
                    $insert_history_data = array(
                        'season_id' => 1,
                        'match_api_id' => $matchId,
                        'fixture_matches_id' => $matchId,
                        'date' => $date,
                        'round' => $round,
                        'league_id' => $leagueId,
                        'spectators' => $result['sport_event']['venue']['capacity'],

                        'home_team' => $this->mdl_teams->where('team_id', $homeId)->get()->name,
                        'home_team_id' => $homeId,
                        'home_team_api_id' => $homeId,
                        'home_corners' => isset($homeMatchInfo['corner_kicks']) ? $homeMatchInfo['corner_kicks'] : 0,
                        'home_goals' => $result['sport_event_status']['home_score'],
                        'half_time_home_goals' => $result['sport_event_status']['period_scores'][0]['home_score'],
                        'home_shots' => isset($homeMatchInfo['shots_off_target']) ? $homeMatchInfo['shots_off_target'] : 0,
                        'home_shots_on_target' => isset($homeMatchInfo['shots_on_target']) ? $homeMatchInfo['shots_on_target'] : 0,
                        'home_fouls' => isset($homeMatchInfo['fouls']) ? $homeMatchInfo['fouls'] : 0,
                        'home_line_up_goal_keeper' => $home_line_up_goal_keeper,
                        'home_line_up_defense' => $home_line_up_defense,
                        'home_line_up_midfield' => $home_line_up_midfield,
                        'home_line_up_forward' => $home_line_up_forward,
                        'home_line_up_substitutes' => $home_line_up_substitutes,
                        'home_line_up_coach' => $home_line_up_coach,
                        'home_yellow_cards' => isset($homeMatchInfo['yellow_cards']) ? $homeMatchInfo['yellow_cards'] : 0,
                        'home_red_cards' => isset($homeMatchInfo['red_cards']) ? $homeMatchInfo['red_cards'] : 0,
                        'home_team_formation' => $home_team_formation,

                        'away_team' => $this->mdl_teams->where('team_id', $awayId)->get()->name,
                        'away_team_id' => $awayId,
                        'away_team_api_id' => $awayId,
                        'away_corners' => isset($awayMatchInfo['corner_kicks']) ? $awayMatchInfo['corner_kicks'] : 0,
                        'away_goals' => $result['sport_event_status']['away_score'],
                        'half_time_away_goals' => $result['sport_event_status']['period_scores'][0]['away_score'],
                        'away_shots' => isset($awayMatchInfo['shots_off_target']) ? $awayMatchInfo['shots_off_target'] : 0,
                        'away_shots_on_target' => isset($awayMatchInfo['shots_on_target']) ? $awayMatchInfo['shots_on_target'] : 0,
                        'away_fouls' => isset($awayMatchInfo['fouls']) ? $awayMatchInfo['fouls'] : 0,
                        'away_line_up_goal_keeper' => $away_line_up_goal_keeper,
                        'away_line_up_defense' => $away_line_up_defense,
                        'away_line_up_midfield' => $away_line_up_midfield,
                        'away_line_up_forward' => $away_line_up_forward,
                        'away_line_up_substitutes' => $away_line_up_substitutes,
                        'away_line_up_coach' => $away_line_up_coach,
                        'away_yellow_cards' => isset($awayMatchInfo['yellow_cards']) ? $awayMatchInfo['yellow_cards'] : 0,
                        'away_red_cards' => isset($awayMatchInfo['red_cards']) ? $awayMatchInfo['red_cards'] : 0,
                        'away_team_formation' => $away_team_formation,
                    );

                    $this->mdl_matches_history->insert($insert_history_data);
                    $this->db->trans_complete();
                }
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        echo "<pre>";
        print_r($value = 'Hoàn tất lấy lịch sử trận');
        echo "</pre>";
    }

    public function get_historic_by_date()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getHistoricMatchesByLeagueAndDateInterval');
    }


    public function getHistoricMatchesByLeagueAndDateInterval()
    {
        $this->form_validation->set_rules('league', 'League', 'required');

        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }

        try {
            $current_day = date('Y-m-d', (strtotime('-1 day', strtotime(date('Y-m-d')))));
            $results = $this->sportradar->getDailyResults($current_day);

            if ($results) {
                $this->db->trans_start();
                foreach ($results->results as $key => $result) {
                    $matchResult = $result['sport_event'];
                    $matchEventStatus = $result['sport_event_status'];
                    $period_scores = isset($matchEventStatus['period_scores']) ? $matchEventStatus['period_scores'] : [];
                    $teams = $matchResult['competitors'];
                    $matchId = str_replace('sr:match:', '', $matchResult['id']);

                    $home_id = str_replace('sr:competitor:', '', $teams[0]['id']);
                    $away_id = str_replace('sr:competitor:', '', $teams[1]['id']);

                    $existHome = $this->mdl_teams->where('team_api_id', $home_id)->get();
                    $existAway = $this->mdl_teams->where('team_api_id', $away_id)->get();
                    $leagueId = str_replace('sr:tournament:', '', $matchResult['tournament']['id']);

                    $homeTeamInfo = $this->sportradar->getTeamInfo($home_id);
                    if (!$existHome && isset($homeTeamInfo->team['country_code'])) {

                        $country = $this->mdl_country->where('alias', $homeTeamInfo->team['country_code'])->get();
                        if (!$country) {
                            $insert_country_data = [
                                'name' => $homeTeamInfo->team['country'],
                                'alias' => $homeTeamInfo->team['country_code'],
                            ];
                            $this->mdl_country->insert($insert_country_data);
                        }

                        $insert_team_info = [
                            'team_id' => $home_id,
                            'team_api_id' => $home_id,
                            'name' => $homeTeamInfo->team['name'],
                            'country_id' => $this->mdl_country->where('alias',
                                $homeTeamInfo->team['country_code'])->get()->id,
                            'stadium' => isset($homeTeamInfo->venue['name']) ? $homeTeamInfo->venue['name'] : 'No info',
                            'alias' => slug($homeTeamInfo->team['name']),
                        ];
                        $this->mdl_teams->insert($insert_team_info);
                    }
                    $awayTeamInfo = $this->sportradar->getTeamInfo($away_id);
                    if (!$existAway && isset($awayTeamInfo->team['country_code'])) {

                        $country = $this->mdl_country->where('alias', $awayTeamInfo->team['country_code'])->get();
                        if (!$country) {
                            $insert_country_data = [
                                'name' => $awayTeamInfo->team['country'],
                                'alias' => $awayTeamInfo->team['country_code'],
                            ];
                            $this->mdl_country->insert($insert_country_data);
                        }

                        $insert_team_info = [
                            'team_id' => $away_id,
                            'team_api_id' => $away_id,
                            'name' => $awayTeamInfo->team['name'],
                            'country_id' => $this->mdl_country->where('alias',
                                $awayTeamInfo->team['country_code'])->get()->id,
                            'stadium' => isset($awayTeamInfo->venue['name']) ? $awayTeamInfo->venue['name'] : 'No info',
                            'alias' => slug($awayTeamInfo->team['name']),
                        ];
                        $this->mdl_teams->insert($insert_team_info);
                    }

                    $matchSummary = (object)($this->sportradar->getMatchInfo($matchId));
                    $home_line_up_defense = [];
                    $home_line_up_midfield = [];
                    $home_line_up_forward = [];
                    $home_line_up_goal_keeper = [];

                    $away_line_up_defense = [];
                    $away_line_up_midfield = [];
                    $away_line_up_forward = [];
                    $away_line_up_goal_keeper = [];

                    $home_line_up_substitutes = [];
                    $away_line_up_substitutes = [];
                    if (isset($matchSummary->statistics)) {

                        if (isset($matchSummary->teams)) {
                            $matchInfos = $matchSummary->teams;

                            $homeMatchInfo = $matchInfos[0]['statistics'];
                            $awayMatchInfo = $matchInfos[1]['statistics'];

                            $lineUp = $this->sportradar->getLineUpOfMatch($matchId)->lineups;
                            $lineUpHomeInfo = $lineUp[0];
                            $lineUpAwayInfo = $lineUp[1];

                            foreach ($lineUpHomeInfo['starting_lineup'] as $info) {
                                if ($info['type'] == 'defender') {
                                    $home_line_up_defense[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'midfielder') {
                                    $home_line_up_midfield[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'forward') {
                                    $home_line_up_forward[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'goalkeeper') {
                                    $home_line_up_goal_keeper = implode(' ',
                                        array_reverse(explode(',', $info['name'])));
                                }
                            }

                            foreach ($lineUpHomeInfo['substitutes'] as $info) {
                                $home_line_up_substitutes[] = implode(' ', array_reverse(explode(',', $info['name'])));
                            }

                            $home_line_up_defense = implode(', ', $home_line_up_defense);
                            $home_line_up_midfield = implode(', ', $home_line_up_midfield);
                            $home_line_up_forward = implode(', ', $home_line_up_forward);
                            $home_line_up_coach = implode(' ',
                                array_reverse(explode(',', $lineUpHomeInfo['manager']['name'])));
                            $home_line_up_substitutes = implode(', ', $home_line_up_substitutes);
                            $home_team_formation = $lineUpHomeInfo['formation'];

                            foreach ($lineUpAwayInfo['starting_lineup'] as $info) {
                                if ($info['type'] == 'defender') {
                                    $away_line_up_defense[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'midfielder') {
                                    $away_line_up_midfield[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'forward') {
                                    $away_line_up_forward[] = implode(' ', array_reverse(explode(',', $info['name'])));
                                }
                                if ($info['type'] == 'goalkeeper') {
                                    $away_line_up_goal_keeper = implode(' ',
                                        array_reverse(explode(',', $info['name'])));
                                }
                            }

                            foreach ($lineUpAwayInfo['substitutes'] as $info) {
                                $away_line_up_substitutes[] = implode(' ', array_reverse(explode(',', $info['name'])));
                            }

                            $away_line_up_defense = implode(', ', $away_line_up_defense);
                            $away_line_up_midfield = implode(', ', $away_line_up_midfield);
                            $away_line_up_forward = implode(', ', $away_line_up_forward);
                            $away_line_up_coach = implode(' ',
                                array_reverse(explode(',', $lineUpAwayInfo['manager']['name'])));
                            $away_line_up_substitutes = implode(', ', $away_line_up_substitutes);
                            $away_team_formation = $lineUpAwayInfo['formation'];
                        }
                    }

                    if ($this->mdl_teams->where('team_id', $home_id)->get() && $this->mdl_teams->where('team_id',
                            $away_id)->get() && !$this->mdl_matches_history->where('match_api_id', $matchId)->get()) {
                        $insert_history_data = array(
                            'season_id' => 1,
                            'match_api_id' => $matchId,
                            'fixture_matches_id' => $matchId,
                            'date' => date('Y-m-d H:i:s', strtotime($matchResult['scheduled'])),
                            'round' => isset($matchResult['tournament_round']['number']) ? $matchResult['tournament_round']['number'] : 0,
                            'league_id' => $leagueId,
                            'spectators' => isset($matchResult['venue']['capacity']) ? $matchResult['venue']['capacity'] : 0,
                            'home_team' => isset($teams[0]['name']) ? $teams[0]['name'] : 'No info',
                            'home_team_id' => $home_id,
                            'home_team_api_id' => $home_id,
                            'home_corners' => isset($homeMatchInfo['corner_kicks']) ? $homeMatchInfo['corner_kicks'] : 0,
                            'home_goals' => isset($matchEventStatus['home_score']) ? $matchEventStatus['home_score'] : 0,
                            'half_time_home_goals' => isset($period_scores[0]['home_score']) ? $period_scores[0]['home_score'] : 0,
                            'home_shots' => isset($homeMatchInfo['shots_off_target']) ? $homeMatchInfo['shots_off_target'] : 0,
                            'home_shots_on_target' => isset($homeMatchInfo['shots_on_target']) ? $homeMatchInfo['shots_on_target'] : 0,
                            'home_fouls' => isset($homeMatchInfo['fouls']) ? $homeMatchInfo['fouls'] : 0,
                            'home_line_up_goal_keeper' => count($home_line_up_goal_keeper) ? $home_line_up_goal_keeper : 'No info',
                            'home_line_up_defense' => count($home_line_up_defense) ? $home_line_up_defense : 'No info',
                            'home_line_up_midfield' => count($home_line_up_midfield) ? $home_line_up_midfield : 'No info',
                            'home_line_up_forward' => count($home_line_up_forward) ? $home_line_up_forward : 'No info',
                            'home_line_up_substitutes' => count($home_line_up_substitutes) ? $home_line_up_substitutes : 'No info',
                            'home_line_up_coach' => isset($home_line_up_coach) ? $home_line_up_coach : 'No info',
                            'home_yellow_cards' => isset($homeMatchInfo['yellow_cards']) ? $homeMatchInfo['yellow_cards'] : 0,
                            'home_red_cards' => isset($homeMatchInfo['red_cards']) ? $homeMatchInfo['red_cards'] : 0,
                            'home_team_formation' => isset($home_team_formation) ? $home_team_formation : 0,

                            'away_team' => isset($teams[1]['name']) ? $teams[1]['name'] : 'No info',
                            'away_team_id' => $away_id,
                            'away_team_api_id' => $away_id,
                            'away_corners' => isset($awayMatchInfo['corner_kicks']) ? $awayMatchInfo['corner_kicks'] : 0,
                            'away_goals' => isset($matchEventStatus['away_score']) ? $matchEventStatus['away_score'] : 0,
                            'half_time_away_goals' => isset($period_scores[0]['away_score']) ? $period_scores[0]['away_score'] : 0,
                            'away_shots' => isset($awayMatchInfo['shots_off_target']) ? $awayMatchInfo['shots_off_target'] : 0,
                            'away_shots_on_target' => isset($awayMatchInfo['shots_on_target']) ? $awayMatchInfo['shots_on_target'] : 0,
                            'away_fouls' => isset($awayMatchInfo['fouls']) ? $awayMatchInfo['fouls'] : 0,
                            'away_line_up_goal_keeper' => count($away_line_up_goal_keeper) ? $away_line_up_goal_keeper : 'No info',
                            'away_line_up_defense' => count($away_line_up_defense) ? $away_line_up_defense : 'No info',
                            'away_line_up_midfield' => count($away_line_up_midfield) ? $away_line_up_midfield : 'No info',
                            'away_line_up_forward' => count($away_line_up_forward) ? $away_line_up_forward : 'No info',
                            'away_line_up_substitutes' => count($away_line_up_substitutes) ? $away_line_up_substitutes : 'No info',
                            'away_line_up_coach' => isset($away_line_up_coach) ? $away_line_up_coach : 'No info',
                            'away_yellow_cards' => isset($awayMatchInfo['yellow_cards']) ? $awayMatchInfo['yellow_cards'] : 0,
                            'away_red_cards' => isset($awayMatchInfo['red_cards']) ? $awayMatchInfo['red_cards'] : 0,
                            'away_team_formation' => isset($away_team_formation) ? $away_team_formation : 0,
                        );

                        $historyId = $this->mdl_matches_history->insert($insert_history_data);
                    }

                    echo "<pre>";
                    print_r('Insert done :' . $historyId);
                    echo "</pre>";
                }
                $this->db->trans_complete();
            } else {
                echo "<pre>";
                print_r('Không có kết quả trong ngày: ' . $current_day);
                echo "</pre>";
                exit();
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        echo "<pre>";
        print_r($value = 'Hoàn tất lấy lịch sử trận');
        echo "</pre>";
        exit();
    }

    public function get_fixture_info()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getFixturesByLeagueAndSeason');
    }

    public function getFixturesByLeagueAndSeason()
    {
        $league = $this->input->get('league');
        if(!$league){
            exit();
        }
        try {
            $allFixtures = $this->sportradar->getLeagueSchedule($league);
            if ($allFixtures) {

                foreach ($allFixtures->sport_events as $key => $fixture) {
                    $fixture = (object)$fixture;
                    $matchId = str_replace('sr:match:', '', $fixture->id);
                    $existFixture = $this->mdl_fixture_matches->where('fixture_matches_id', $matchId)->get();
                    if (!$existFixture) {
                        $matchInfo = $this->sportradar->getMatchInfo($matchId);
                        $homeId = str_replace('sr:competitor:', '', $fixture->competitors[0]['id']);
                        $awayId = str_replace('sr:competitor:', '', $fixture->competitors[1]['id']);

                        $round = (isset($fixture->tournament_round['number'])) ? $fixture->tournament_round['number'] : $fixture->tournament_round['name'];

                        if ($this->mdl_teams->where('team_id', $homeId)->get() && $this->mdl_teams->where('team_id', $awayId)->get() && !$existFixture) {
                            $insert_fixture_data = array(
                                'season_id' => 1,
                                'fixture_matches_id' => $matchId,
                                'fixture_matches_api_id' => $matchId,
                                'date' => date('Y-m-d H:i:s', strtotime($fixture->scheduled)),
                                'round' => $round,
                                'league_id' => $league,

                                'home_team' => $fixture->competitors[0]['name'],
                                'home_goals' => isset($matchInfo->sport_event_status['home_score']) ? $matchInfo->sport_event_status['home_score'] : null,
                                'home_team_id' => $homeId,
                                'home_team_api_id' => $homeId,

                                'away_team' => $fixture->competitors[1]['name'],
                                'away_goals' => isset($matchInfo->sport_event_status['away_score']) ? $matchInfo->sport_event_status['away_score'] : null,
                                'away_team_id' => $awayId,
                                'away_team_api_id' => $awayId,

                                'time' => date('H:i', strtotime($fixture->scheduled)),
                                'location' => $fixture->venue['name'],
                                'referee' => isset($matchInfo->sport_event_conditions['referee']['name']) ?
                                    implode(' ', array_reverse(explode(',',
                                        $matchInfo->sport_event_conditions['referee']['name']))) : 'No info',
                            );
                            $this->db->trans_start();
                            $this->mdl_fixture_matches->insert($insert_fixture_data);
                            $this->db->trans_complete();
                        }
                    }
                    echo "<pre>";
                    print_r('Insert done '.$matchId);
                    echo "</pre>";
                }

            } else {
                echo "<pre>";
                print_r('No data');
                echo "</pre>";
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        exit();
    }

    public function get_top_scorers()
    {

        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getTopScorersByLeagueAndSeason');
    }

    public function getTopScorersByLeagueAndSeason()
    {

        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $league = $this->input->post('league');

        try {
            $allTop = $this->sportradar->getTopScores($league);
            if ($allTop) {
                foreach ($allTop->top_goals as $key => $top) {
                    if ($key == 15) {
                        break;
                    }
                    $top = (object)$top;
                    $teamId = str_replace('sr:competitor:', '', $top->team['id']);
                    $playerId = str_replace('sr:player:', '', $top->player['id']);
                    $leagueId = str_replace('sr:tournament:', '', $allTop->tournament['id']);
                    $playerInfo = $this->sportradar->getPlayerInfo($playerId)->player;
                    $playerName = implode(' ', array_reverse(explode(',', $playerInfo['name'])));
                    $this->mdl_top_scorers->where('league_id', $leagueId)->where('name', $playerName)->delete();
                    $insert_data = array(
                        'season_id' => 1,
                        'league_id' => $leagueId,
                        'team_id' => $teamId,
                        'team_name' => $top->team['name'],
                        'name' => $playerName,
                        'rank' => $top->rank,
                        'alias' => slug(trim($top->player['name'])),
                        'nationality' => $playerInfo['nationality'],
                        'goals' => $top->goals,
                    );
                    $this->db->trans_start();
                    $this->mdl_top_scorers->insert($insert_data);
                    $this->db->trans_complete();
                    echo "<pre>";
                    print_r($value = 'Insert done Cau thu ' . $top->player['name']);
                    echo "</pre>";
                }
            } else {
                echo "<pre>";
                print_r('No data');
                echo "</pre>";
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
    }

    public function get_player_of_team()
    {
        $teams = $this->mdl_teams->where('status', 1)->order_by('name')->get_all();
        $this->blade->set('teams', $teams)
            ->render('getPlayersByTeam');
    }

    public function getPlayersByTeam()
    {
        $this->form_validation->set_rules('team_id', 'Team', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $team_api_id = $this->input->post('team_id');

        try {
            $getPlayer = $this->sportradar->getPlayersByTeam($team_api_id);
            if (isset($getPlayer->players)) {
                $players = $getPlayer->players;

                if ($players) {
                    $this->db->trans_start();
                    foreach ($players as $player) {
                        $name = implode(' ', array_reverse(explode(',', $player['name'])));
                        $id = str_replace('sr:player:', '', $player['id']);
                        $player_exits = $this->mdl_players
                            ->where('player_id', intval($id))
                            ->where('team_id', intval($team_api_id))->get();

                        if (!$player_exits && isset($player['country_code'])) {
                            $country = $this->mdl_country->where('alias', $player['country_code'])->get();

                            if (!$country) {
                                $insert_data_country = array(
                                    'name' => $player['nationality'],
                                    'alias' => $player['country_code'],
                                );

                                $this->mdl_country->insert($insert_data_country);
                            }

                            $insert_player_data = array(
                                'player_id' => intval($id),
                                'team_id' => intval($team_api_id),
                                'name' => $name,
                                'height' => isset($player['height']) ? $player['height'] : null,
                                'weight' => isset($player['weight']) ? $player['weight'] : null,
                                'position' => $player['type'],
                                'nationality' => isset($player['nationality']) ? $player['nationality'] : 'No info',
                                'player_number' => isset($player['jersey_number']) ? $player['jersey_number'] : null,
                                'birthday' => $player['date_of_birth'],
                                'alias' => slug($name),
                            );
                            $this->mdl_players->insert($insert_player_data);
                            echo "<pre>";
                            print_r("Insert done player" . $name);
                            echo "</pre>";
                        } else {
                            echo "<pre>";
                            print_r('Player exits on DB');
                            echo "</pre>";
                        }
                    }
                    $this->db->trans_complete();
                }
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        exit();
    }

// lay bang dau cua 1 giai dau ( chi lay giai nao cho truong is_cup = 1 )
    public function get_all_groups()
    {
        $this->load->model('mdl_leagues');
        $leagues = $this->mdl_leagues->where('status', 1)->where('is_cup', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getAllGroupsByLeagueAndSeason');
    }

    public function getAllGroupsByLeagueAndSeason()
    {
        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $leagueId = $this->input->post('league');

        try {
            $allGroup = $this->sportradar->getLeagueInfo($leagueId);
            if ($allGroup) {
                $this->db->trans_start();
                $groupId_array = array();
                foreach ($allGroup->groups as $key => $group) {
                    // check exits on database
                    if (isset($group['name'])) {
                        $group_exits = $this->mdl_league_group_cup
                            ->where('league_id', $leagueId)
                            ->where('name', $group['name'])->get();

                        if (!$group_exits) {
                            // insert new data
                            $insert_data = array(
                                'name' => $group['name'],
                                'alias' => slug($group['name']),
                                'league_id' => $leagueId,
                                'season_id' => 1,
                            );
                            $groupId = $this->mdl_league_group_cup->insert($insert_data);
                            array_push($groupId_array, $groupId);
                        } else {
                            array_push($groupId_array, $group_exits->league_group_id);
                        }
                    }
                }
                $this->db->trans_complete();

                // get standing by group Id

                echo "<pre>";
                print_r($value = 'Done get group table,next will get Cup standing !');
                echo "</pre>";

                $this->getCupStandingsByLeagueId($leagueId);
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        echo "<pre>";
        print_r('Done All');
        echo "</pre>";
    }

    public function getCupStandingsByLeagueId($leagueId)
    {
        try {
            $getStandingLeague = $this->sportradar->GetStandingByLeagueId($leagueId);

            if ($getStandingLeague->standings) {
                $this->db->trans_start();
                foreach ($getStandingLeague->standings as $standing) {

                    if (isset($standing['groups'])) {
                        $groups = $standing['groups'];
                        foreach ($groups as $group) {
                            $teams = $group['team_standings'];

                            foreach ($teams as $team) {
                                $teamId = str_replace('sr:competitor:', '', $team['team']['id']);
                                $this->mdl_league_team_cup_standing->where('team_id', $teamId)->where('group',
                                    $group['name'])->delete();
                                $insert_standing = array(
                                    'team' => $team['team']['name'],
                                    'team_id' => str_replace('sr:competitor:', '', $team['team']['id']),
                                    'played' => $team['played'],
                                    'won' => $team['win'],
                                    'draw' => $team['draw'],
                                    'lost' => $team['loss'],
                                    'goals_against' => $team['goals_against'],
                                    'goals_for' => $team['goals_for'],
                                    'goal_difference' => $team['goal_diff'],
                                    'points' => $team['points'],
                                    'group' => $group['name'],
                                    'group_id' => $this->mdl_league_group_cup
                                        ->where('league_id', $leagueId)
                                        ->where('name', $group['name'])->get()->league_group_id,
                                );

                                $this->mdl_league_team_cup_standing->insert($insert_standing);
                            }
                        }

                        echo "<pre>";
                    }
                }
                $this->db->trans_complete();
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }
        echo "<pre>";
        print_r($value = 'Done get standing table !');
        echo "</pre>";

        return 1;
    }

    // lay ti le cua nhung cap dau trong 2 ngay gan nhat

    public function get_odds_by_match()
    {
        $leagues = $this->mdl_leagues->where('status', 1)->get_all();
        $this->blade->set('leagues', $leagues)
            ->render('getAllOddsByFixtureMatchId');
    }


    public function getOddsByFixtureMatchId()
    {
        // lay toan bo tran trong 7 ngày
        $this->form_validation->set_rules('league', 'League', 'required');
        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'result' => false,
                'message' => validation_errors()
            ));

            return false;
        }
        $league = $this->input->post('league');
        $date_from = date('Y-m-d 00:00:00');
        $date_to = date("Y-m-d 00:00:00", strtotime("$date_from +7 day"));

        $books = $this->sportradar->getBookMarker()->books;
        if ($books) {
            foreach ($books as $book) {
                $book = (object)$book;
                $id = str_replace('sr:book', '', $book->id);
                $existBookMarker = $this->mdl_books->where('id', $id)->get();
                if (!$existBookMarker) {
                    $insert_bookmarker = array(
                        'id' => $id,
                        'name' => $book->name
                    );
                    $this->mdl_books->insert($insert_bookmarker);
                }
            }
        }
        $matches = $this->mdl_fixture_matches
            ->where('league_id', $league)
            ->where('date >=', $date_from)
            ->where('date <=', $date_to)
            ->get_all();

        if ($matches) {
            foreach ($matches as $match) {
                $odds = $this->sportradar->getOddByMatchId($match->fixture_matches_id);
                if (isset($odds->schema)) {
                    try {
                        if ($odds) {
                            foreach ($odds->sport_event['markets'] as $key => $oddBooks) {
                                $type = $oddBooks['name'];

                                if ($type == '3way' && $oddBooks['group_name'] == 'regular') {
                                    foreach ($oddBooks['books'] as $odd) {
                                        $odd = (object)$odd;
                                        $this->mdl_odds_by_fixture_match_id
                                            ->where('type', $type)
                                            ->where('fixture_matches_id', $match->fixture_matches_id)
                                            ->delete();
                                        if (!isset($odd->outcomes[0]['deep_link'])) {
                                            $insert_odds = array(
                                                'fixture_matches_id' => $match->fixture_matches_id,
                                                'bookmaker' => ($this->mdl_books->where('id',
                                                    str_replace('sr:book:', '', $odd->id))->get()) ?
                                                    $this->mdl_books->where('id',
                                                        str_replace('sr:book:', '', $odd->id))->get()->name : 'No info',
                                                'updated_date' => $odds->sport_event['markets_last_updated'],
                                                'type' => $type,
                                                'home_odds' => (isset($odd->outcomes[0]['odds'])) ? substr($odd->outcomes[0]['odds'], 0, 4) : '0',
                                                'away_odds' => (isset($odd->outcomes[1]['odds'])) ? substr($odd->outcomes[1]['odds'], 0, 4) : '0',
                                                'handicap' => (isset($odd->outcomes[2]['odds'])) ? substr($odd->outcomes[2]['odds'], 0, 4) : '0',
                                            );
                                            echo "</pre>";
                                            $this->db->trans_start();
                                            $this->mdl_odds_by_fixture_match_id->insert($insert_odds);
                                            $this->db->trans_complete();
                                        }


                                        echo "<pre>";
                                    }
                                }
                                if ($type == 'asian_handicap' && $oddBooks['group_name'] == 'regular') {
                                    foreach ($oddBooks['books'] as $odd) {
                                        $odd = (object)$odd;
                                        $this->mdl_odds_by_fixture_match_id
                                            ->where('type', $type)
                                            ->where('fixture_matches_id', $match->fixture_matches_id)
                                            ->delete();
                                        if ($odd->id == 'sr:book:988') {
                                            $h = (float)$odd->outcomes[0]['odds'];
                                            $a = (float)$odd->outcomes[1]['odds'];
                                            $home_odd = (($h - 1) > 1) ? -1/($h - 1) : ($h - 1)/1;
                                            $away_odd = (($a - 1) > 1) ? -1/($a - 1) : ($a - 1)/1;
                                            $handicap = '';
                                            if ($odd->outcomes[0]['handicap'] == 0) {
                                                $handicap = 0;
                                            }
                                            if (strpos($odd->outcomes[0]['handicap'], '.75')) {
                                                $handicap = (int)(abs((float)$odd->outcomes[0]['handicap']) + 0.25);
                                            }
                                            if (strpos($odd->outcomes[0]['handicap'], '0.25')) {
                                                $handicap = '0-0.5';
                                            }
                                            if (strpos($odd->outcomes[0]['handicap'], '.5')) {
                                                $handicap = $odd->outcomes[0]['handicap'];
                                            }

                                            $insert_odds = array(
                                                'fixture_matches_id' => $match->fixture_matches_id,
                                                'bookmaker' => ($this->mdl_books->where('id',
                                                    str_replace('sr:book:', '', $odd->id))->get()) ?
                                                    $this->mdl_books->where('id',
                                                        str_replace('sr:book:', '', $odd->id))->get()->name : 'No info',
                                                'updated_date' => $odds->sport_event['markets_last_updated'],
                                                'type' => $type,
                                                'home_odds' => round($home_odd, 2),
                                                'away_odds' => round($away_odd, 2),
                                                'handicap' => $handicap,
                                            );
                                            echo "</pre>";
                                            $this->db->trans_start();
                                            $this->mdl_odds_by_fixture_match_id->insert($insert_odds);
                                            $this->db->trans_complete();
                                        }
                                    }
                                }
                                if ($type == 'total' && $oddBooks['group_name'] == 'regular') {
                                    foreach ($oddBooks['books'] as $odd) {
                                        $odd = (object)$odd;
                                        $this->mdl_odds_by_fixture_match_id
                                            ->where('type', $type)
                                            ->where('fixture_matches_id', $match->fixture_matches_id)
                                            ->delete();
                                        if ($odd->id == 'sr:book:988') {
                                            $home_odd = (float)$odd->outcomes[0]['odds'] - 1;
                                            $away_odd = (float)$odd->outcomes[1]['odds'] - 1;
                                            $handicap = $odd->outcomes[0]['total'];

                                            $insert_odds = array(
                                                'fixture_matches_id' => $match->fixture_matches_id,
                                                'bookmaker' => ($this->mdl_books->where('id',
                                                    str_replace('sr:book:', '', $odd->id))->get()) ?
                                                    $this->mdl_books->where('id',
                                                        str_replace('sr:book:', '', $odd->id))->get()->name : 'No info',
                                                'updated_date' => $odds->sport_event['markets_last_updated'],
                                                'type' => $type,
                                                'home_odds' => round($home_odd, 2),
                                                'away_odds' => round($away_odd, 2),
                                                'handicap' => $handicap,
                                            );
                                            echo "</pre>";
                                            $this->db->trans_start();
                                            $this->mdl_odds_by_fixture_match_id->insert($insert_odds);
                                            $this->db->trans_complete();
                                        }
                                    }
                                }
                            }
                        }
                    } catch (Exception $e) {
                        echo "XMLSoccerException: " . $e->getMessage();
                    }
                }
            }
        }
        echo "<pre>";
        print_r($value = 'done');
        echo "</pre>";
    }
}