<?php

class Cron extends MY_Controller
{
    protected $soccer;
    protected $sportradar;

    public function __construct()
    {
        parent::__construct();
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
        $this->soccer = new XMLSoccer($this->apiXmlSoccerKey);
        $this->sportradar = new Sportradar();
    }


    public function init()
    {
        echo "Cron job data starting at ... " . date("Y-m-d") . "............. \n";
        echo "Step 1 : getHistoryMatchDay() \n";
        $this->getHistoryMatchDay();
        echo "Finish Step 1 : getHistoryMatchDay() \n";
        log_message('info', 'Finish step 1 getHistoryMatchDay()' . date("Y-m-d"));
        echo "Step 2 : getOddsByFixtureMatchId() \n";
        $this->getOddsByFixtureMatchId();
        echo "Finish Step 2 : getOddsByFixtureMatchId() \n";
        log_message('info', 'Finish step 2 getOddsByFixtureMatchId()' . date("Y-m-d"));
        echo "Step 3 : getStandingDay() \n";
        $this->getStandingDay();
        echo "Finish Step 3 : getStandingDay() \n";
        echo "Step 4 : topScorers() \n";
        $this->topScorers();
        echo "Finish Step 4 : topScorers() \n";

        echo "DONE ALL \n";

        exit();

    }


    // step 1 get History match and fixture match

    // cd /home/admin/web/admin.football.vdev.vn/public_html/ && php cron.php /cron/getHistoryMatchDay

    public function getHistoryMatchDay()
    {
        echo "Starting get getHistoryMatchDay day ... " . date("Y-m-d") . "............. \n";
        try {
            $current_day = date('Y-m-d', (strtotime('-1 day', strtotime(date('Y-m-d')))));
            $results = $this->sportradar->getDailyResults($current_day);

            if ($results) {

                foreach ($results->results as $key => $result) {
                    $matchResult = $result['sport_event'];
                    $matchEventStatus = $result['sport_event_status'];
                    $period_scores = isset($matchEventStatus['period_scores']) ? $matchEventStatus['period_scores'] : [];
                    $teams = $matchResult['competitors'];
                    $matchId = str_replace('sr:match:', '', $matchResult['id']);

                    if (!$this->mdl_matches_history->where('match_api_id', $matchId)->get()) {
                        $home_id = str_replace('sr:competitor:', '', $teams[0]['id']);
                        $away_id = str_replace('sr:competitor:', '', $teams[1]['id']);

                        $existHome = $this->mdl_teams->where('team_api_id', $home_id)->get();
                        $existAway = $this->mdl_teams->where('team_api_id', $away_id)->get();
                        $leagueId = str_replace('sr:tournament:', '', $matchResult['tournament']['id']);

                        if (!$existHome) {
                            $homeTeamInfo = $this->sportradar->getTeamInfo($home_id);
                            if (isset($homeTeamInfo->team['country_code'])) {
                                $country = $this->mdl_country->where('alias', $homeTeamInfo->team['country_code'])->get();
                                if (!$country) {
                                    $insert_country_data = [
                                        'name' => $homeTeamInfo->team['country'],
                                        'alias' => $homeTeamInfo->team['country_code'],
                                    ];
                                    $this->db->trans_start();
                                    $this->mdl_country->insert($insert_country_data);
                                    $this->db->trans_complete();
                                }
                            }
                            $insert_team_info = [
                                'team_id' => $home_id,
                                'team_api_id' => $home_id,
                                'name' => $homeTeamInfo->team['name'],
                                'country_id' => isset($homeTeamInfo->team['country_code']) ? $this->mdl_country->where('alias', $homeTeamInfo->team['country_code'])->get()->id : 1,
                                'stadium' => isset($homeTeamInfo->venue['name']) ? $homeTeamInfo->venue['name'] : 'No info',
                                'alias' => slug($homeTeamInfo->team['name']),
                            ];
                            $this->db->trans_start();
                            $this->mdl_teams->insert($insert_team_info);
                            $this->db->trans_complete();
                        }
                        if (!$existAway) {
                            $awayTeamInfo = $this->sportradar->getTeamInfo($away_id);
                            if (isset($awayTeamInfo->team['country_code'])) {
                                $country = $this->mdl_country->where('alias', $awayTeamInfo->team['country_code'])->get();
                                if (!$country) {
                                    $insert_country_data = [
                                        'name' => $awayTeamInfo->team['country'],
                                        'alias' => $awayTeamInfo->team['country_code'],
                                    ];
                                    $this->db->trans_start();
                                    $this->mdl_country->insert($insert_country_data);
                                    $this->db->trans_complete();
                                }
                            }
                            $insert_team_info = [
                                'team_id' => $away_id,
                                'team_api_id' => $away_id,
                                'name' => $awayTeamInfo->team['name'],
                                'country_id' => isset($awayTeamInfo->team['country_code']) ? $this->mdl_country->where('alias', $awayTeamInfo->team['country_code'])->get()->id : 1,
                                'stadium' => isset($awayTeamInfo->venue['name']) ? $awayTeamInfo->venue['name'] : 'No info',
                                'alias' => slug($awayTeamInfo->team['name']),
                            ];
                            $this->db->trans_start();
                            $this->mdl_teams->insert($insert_team_info);
                            $this->db->trans_complete();
                        }

                        $getMatchInfo = $this->sportradar->getMatchInfo($matchId);
                        if (isset($getMatchInfo->statistics['teams'])) {
                            $matchInfos = $getMatchInfo->statistics['teams'];

                            $homeMatchInfo = $matchInfos[0]['statistics'];
                            $awayMatchInfo = $matchInfos[1]['statistics'];
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
                                $this->db->trans_start();
                                $historyId = $this->mdl_matches_history->insert($insert_history_data);
                                $this->db->trans_complete();
                                echo "Insert done: " . $historyId . " \n";
                            }
                        }
                    }
                }

            } else {
                echo "Không có kế quả nào ngày " . $current_day . " \n";
                exit();
            }
        } catch (Exception $e) {
            echo "XMLSoccerException: " . $e->getMessage();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            log_message('error', 'Cant not trans_complete for getHistoryMatchDay' . date("Y-m-d"));
        }
        exit();
    }

    public function getFixture()
    {
        echo "Starting get getFixture day ... " . date("Y-m-d") . "............. \n";

        $leagues = array_merge(loadLeague(), loadLeague());
        foreach ($leagues as $league) {
            $allFixtures = $this->sportradar->getLeagueSchedule($league->id);
            if ($allFixtures) {

                foreach ($allFixtures->sport_events as $key => $fixture) {
                    $fixture = (object)$fixture;
                    $matchId = str_replace('sr:match:', '', $fixture->id);
                    $existFixture = $this->mdl_fixture_matches->where('fixture_matches_id', $matchId)->get();
                    if (!$existFixture) {
                        $matchInfo = $this->sportradar->getMatchInfo($matchId);
                        $homeId = str_replace('sr:competitor:', '', $fixture->competitors[0]['id']);
                        $awayId = str_replace('sr:competitor:', '', $fixture->competitors[1]['id']);
                        if ($this->mdl_teams->where('team_id', $homeId)->get() && $this->mdl_teams->where('team_id',
                                $awayId)->get() && !$existFixture) {
                            $insert_fixture_data = array(
                                'season_id' => 1,
                                'fixture_matches_id' => $matchId,
                                'fixture_matches_api_id' => $matchId,
                                'date' => date('Y-m-d H:i:s', strtotime($fixture->scheduled)),
                                'round' => (isset($fixture->tournament_round['number'])) ? $fixture->tournament_round['number'] : null,
                                'league_id' => $league->id,

                                'home_team' => $fixture->competitors[0]['name'],
                                'home_goals' => isset($matchInfo->sport_event_status['home_score']) ? $matchInfo->sport_event_status['home_score'] : null,
                                'home_team_id' => $homeId,
                                'home_team_api_id' => $homeId,

                                'away_team' => $fixture->competitors[1]['name'],
                                'away_goals' => isset($matchInfo->sport_event_status['away_score']) ? $matchInfo->sport_event_status['away_score'] : null,
                                'away_team_id' => $awayId,
                                'away_team_api_id' => $awayId,

                                'time' => date('H:i', strtotime($fixture->scheduled)),
                                'location' => isset($fixture->venue['name']) ? $fixture->venue['name'] : 'No info',
                                'referee' => isset($matchInfo->sport_event_conditions['referee']['name']) ?
                                    implode(' ', array_reverse(explode(',',
                                        $matchInfo->sport_event_conditions['referee']['name']))) : 'No info',
                            );
                            $this->db->trans_start();
                            $this->mdl_fixture_matches->insert($insert_fixture_data);
                            $this->db->trans_complete();
                        }
                    }
                    echo "Insert done getFixture " . $matchId . " \n";
                }

            } else {
                echo "No data fixture \n";
            }
        }

        echo "Hoàn tất lấy lấy lịch thi đấu \n";
        echo "Kết thúc Step 1 \n";
        log_message('info', 'Insert done getFixture()' . date("Y-m-d"));
        log_message('info', '100% Done all cron Job Step 1 ' . date("Y-m-d"));
        exit();
    }


    public function getFixtureLeague()
    {
        echo "Starting get getFixture day ... " . date("Y-m-d") . "............. \n";

        $leagues = array_merge(loadLeague(), loadLeague());
        foreach ($leagues as $league) {
            $existLeagueFixture = $this->mdl_fixture_matches->where('league_id', $league->id)->get();
            if (!$existLeagueFixture) {
                $allFixtures = $this->sportradar->getLeagueSchedule($league->id);
                if ($allFixtures) {

                    foreach ($allFixtures->sport_events as $key => $fixture) {
                        $fixture = (object)$fixture;
                        $matchId = str_replace('sr:match:', '', $fixture->id);
                        $existFixture = $this->mdl_fixture_matches->where('fixture_matches_id', $matchId)->get();
                        if (!$existFixture) {
                            $matchInfo = $this->sportradar->getMatchInfo($matchId);
                            $homeId = str_replace('sr:competitor:', '', $fixture->competitors[0]['id']);
                            $awayId = str_replace('sr:competitor:', '', $fixture->competitors[1]['id']);
                            if ($this->mdl_teams->where('team_id', $homeId)->get() && $this->mdl_teams->where('team_id',
                                    $awayId)->get() && !$existFixture) {
                                $insert_fixture_data = array(
                                    'season_id' => 1,
                                    'fixture_matches_id' => $matchId,
                                    'fixture_matches_api_id' => $matchId,
                                    'date' => date('Y-m-d H:i:s', strtotime($fixture->scheduled)),
                                    'round' => (isset($fixture->tournament_round['number'])) ? $fixture->tournament_round['number'] : null,
                                    'league_id' => $league->id,

                                    'home_team' => $fixture->competitors[0]['name'],
                                    'home_goals' => isset($matchInfo->sport_event_status['home_score']) ? $matchInfo->sport_event_status['home_score'] : null,
                                    'home_team_id' => $homeId,
                                    'home_team_api_id' => $homeId,

                                    'away_team' => $fixture->competitors[1]['name'],
                                    'away_goals' => isset($matchInfo->sport_event_status['away_score']) ? $matchInfo->sport_event_status['away_score'] : null,
                                    'away_team_id' => $awayId,
                                    'away_team_api_id' => $awayId,

                                    'time' => date('H:i', strtotime($fixture->scheduled)),
                                    'location' => isset($fixture->venue['name']) ? $fixture->venue['name'] : 'No info',
                                    'referee' => isset($matchInfo->sport_event_conditions['referee']['name']) ?
                                        implode(' ', array_reverse(explode(',',
                                            $matchInfo->sport_event_conditions['referee']['name']))) : 'No info',
                                );
                                $this->db->trans_start();
                                $this->mdl_fixture_matches->insert($insert_fixture_data);
                                $this->db->trans_complete();
                            }
                        }
                        echo "Insert done getFixture " . $matchId . " \n";
                    }

                } else {
                    echo "No data fixture \n";
                }
            } else {
                echo "League exit fixture \n";
            }
        }
        echo "Hoàn tất lấy lấy lịch thi đấu \n";
        exit();
    }



    // Step 2 get standing
    // cd /home/admin/web/admin.football.vdev.vn/public_html/ && php cron.php /cron/getStandingDay


    public function getStandingDay()
    {
        echo "Starting get getStandingDay day ... " . date("Y-m-d") . "............. \n";
        $league_cron = array_merge(loadLeague(), loadFavoriteLeague());
        $this->db->trans_start();
        foreach ($league_cron as $league_data) {
            $league = $league_data->id;
            $is_cup = $this->mdl_leagues->where('id', $league_data->id)->get()->is_cup;
            $standings = $this->sportradar->getStandingByLeagueId($league);
            try {
                if ($is_cup) {
                    if (isset($standings->standings) && $standings->standings) {
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
                                    if (!$this->mdl_league_group_cup->where('league_id', $league)->where('name', $standingGroup['name'])->get()) {
                                        $insert_data = array(
                                            'name' => $standingGroup['name'],
                                            'alias' => slug($standingGroup['name']),
                                            'league_id' => $league,
                                            'season_id' => 1,
                                        );
                                        $this->mdl_league_group_cup->insert($insert_data);
                                    }
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
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'group_id' => $this->mdl_league_group_cup->where('league_id', $league)->where('name', $standingGroup['name'])->get()->league_group_id,
                                    );
                                    if ($this->mdl_league_team_cup_standing->insert($insert_data_standing)) {
                                        echo("Insert complete standing for team =>" . $team_standing->name . " league cup => ".$league_data->name." \n");
                                    }

                                }
                            }
                        }
                        $this->db->trans_complete();
                    }
                } else {
                    if (isset($standings->standings) && $standings->standings) {
                        $this->db->trans_start();
                        foreach ($standings->standings[0]["groups"] as $standingGroup) {
                            foreach ($standingGroup["team_standings"] as $standing) {
                                $teamId = intval(str_replace("sr:competitor:", "", $standing["team"]["id"]));
                                $team_standing = $this->mdl_teams->where('team_api_id', $teamId)->get();
                                if ($team_standing) {
                                    // check exits on database team_standing
                                    // if exits delete data and update again
                                    $existTeamStanding = $this->mdl_league_team_standing->where('team_id', $teamId)->where('league_id', $league)->delete();
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
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    if ($this->mdl_league_team_standing->insert($insert_data_standing)) {
                                        echo("Insert complete standing for team =>" . $team_standing->name . " league => ".$league_data->name." \n");
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
            echo("DONE LEAGUE :" . $league_data->id . " \n");
        }
        $this->db->trans_complete();
        echo "Hoàn tất lấy BXH Cup \n";
        log_message('info', 'Done all Standing()' . date("Y-m-d"));
        log_message('info', '100% Done all cron Job Step 2 ' . date("Y-m-d"));
        exit();
    }

//    Step 3 get Odds theo ID match

// cd /home/admin/web/admin.football.vdev.vn/public_html/ && php cron.php /cron/getOddsByFixtureMatchId


    public function getOddsByFixtureMatchId()
    {

        echo "Starting get getOddsByFixtureMatchId day ... " . date("Y-m-d") . "............. \n";

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
        $leagues = $this->mdl_leagues->get_all();

        foreach ($leagues as $league) {
            $matches = $this->mdl_fixture_matches
                ->where('league_id', $league->id)
                ->where('date >=', $date_from)
                ->where('date <=', $date_to)
                ->get_all();

            if ($matches) {
                foreach ($matches as $match) {
                    $odds = $this->sportradar->getOddByMatchId($match->fixture_matches_id);
                    try {
                        if ($odds) {
                            foreach ($odds->sport_event['markets'] as $key => $oddBooks) {
                                foreach ($oddBooks['books'] as $odd) {
                                    $odd = (object)$odd;
                                    // delete old odds
                                    $existOdd = $this->mdl_odds_by_fixture_match_id->where('bookmaker',
                                        str_replace('sr:book:', '', $odd->id))->
                                    where('fixture_matches_id', $match->fixture_matches_id)->get();
                                    if (!$existOdd) {
                                        $insert_odds = array(
                                            'handicap' => (isset($odd->outcomes[0]['handicap'])) ? $odd->outcomes[0]['handicap'] : 'NoInfo',
                                            'fixture_matches_id' => $match->fixture_matches_id,
                                            'bookmaker' => ($this->mdl_books->where('id', str_replace('sr:book:', '', $odd->id))->get()) ?
                                                $this->mdl_books->where('id', str_replace('sr:book:', '', $odd->id))->get()->name : 'No info',
                                            'updated_date' => $odds->sport_event['markets_last_updated'],
                                            'type' => trim($oddBooks['name']),
                                            'home_odds' => (isset($odd->outcomes[0]['odds'])) ? $odd->outcomes[0]['odds'] : 'NoInfo',
                                            'away_odds' => (isset($odd->outcomes[1]['odds'])) ? $odd->outcomes[1]['odds'] : 'NoInfo',
                                        );
                                        $this->db->trans_start();
                                        $this->mdl_odds_by_fixture_match_id->insert($insert_odds);
                                        $this->db->trans_complete();

                                    }
                                }
                            }
                        }
                    } catch (Exception $e) {
                        echo "XMLSoccerException: " . $e->getMessage();
                    }
                    echo "Hoàn tất lấy tỉ lệ trận đấu theo ID " . $match->fixture_matches_id . " \n";
                }
            }
        }
        echo "Hoàn tất lấy tỉ lệ trận đấu theo ID 7 ngày gần nhất !  \n";
        log_message('info', 'Done all getOddsByFixtureMatchId()' . date("Y-m-d"));
        log_message('info', '100% Done all cron Job Step 3 ' . date("Y-m-d"));
        exit();
    }


//    Step 4 get Top Score

// cd /home/admin/web/admin.football.vdev.vn/public_html/ && php cron.php /cron/topScorers

    public function topScorers()
    {
        echo "Starting get topScorers day ... " . date("Y-m-d") . "............. \n";
        $league_cron = array_merge(loadLeague(), loadFavoriteLeagueCup());
        $this->db->trans_start();
        foreach ($league_cron as $league_data) {
            $league = $league_data->id;
            try {
                $allTop = $this->sportradar->getTopScores($league);
                if ($allTop) {
                    $this->db->trans_start();

                    // delete league data exits

                    $this->mdl_top_scorers->where('league_id', $league)->delete();

                    foreach ($allTop->top_goals as $key => $top) {
                        $top = (object)$top;
                        $teamId = str_replace('sr:competitor:', '', $top->team['id']);
                        $playerId = str_replace('sr:player:', '', $top->player['id']);
                        $existPlayer = $this->mdl_players->where('player_id', $playerId)->get();
                        $existTeam = $this->mdl_teams->where('team_id', $teamId)->get();
                        if ($existTeam && $existPlayer) {
                            // insert new data
                            $insert_data = array(
                                'season_id' => 1,
                                'league_id' => str_replace('sr:tournament:', '', $allTop->tournament['id']),
                                'team_id' => $teamId,
                                'team_name' => $top->team['name'],
                                'name' => $this->mdl_players->where('player_id', $playerId)->get()->name,
                                'rank' => $top->rank,
                                'alias' => slug(trim($top->player['name'])),
                                'nationality' => $this->mdl_players->where('player_id', $playerId)->get()->nationality,
                                'goals' => $top->goals,
                            );
                            $this->mdl_top_scorers->insert($insert_data);
                            echo "Insert done Cau thu " . $top->player['name'] . " \n";
                        }
                    }
                    $this->db->trans_complete();
                } else {
                    echo "No data topScorers \n";
                }
            } catch (Exception $e) {
                echo "XMLSoccerException: " . $e->getMessage();
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'Cant not trans_complete for topScorers' . date("Y-m-d"));
        }
        echo "Hoàn tất lấy Vua phá lướt \n";
        log_message('info', 'Done all topScorers()' . date("Y-m-d"));
        log_message('info', '100% Done all cron Job Step 4 ' . date("Y-m-d"));
        exit();
    }
}