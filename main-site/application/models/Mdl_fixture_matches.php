<?php

    class Mdl_fixture_matches extends MY_Model
    {
        public $table = 'fixture_matches';
        public $primary_key = 'fixture_matches_id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array


            $this->has_one['home_team'] = array(
                'foreign_model' => 'Mdl_teams',
                'foreign_table' => 'teams',
                'foreign_key'   => 'team_id',
                'local_key'     => 'home_team_id'
            );

            $this->has_one['away_team'] = array(
                'foreign_model' => 'Mdl_teams',
                'foreign_table' => 'teams',
                'foreign_key'   => 'team_id',
                'local_key'     => 'away_team_id'
            );

            $this->has_one['league'] = array(
                'foreign_model' => 'Mdl_leagues',
                'foreign_table' => 'leagues',
                'foreign_key'   => 'id',
                'local_key'     => 'league_id'
            );

            $this->has_one['season'] = array(
                'foreign_model' => 'Mdl_season',
                'foreign_table' => 'seasons',
                'foreign_key'   => 'season_id',
                'local_key'     => 'season_id'
            );


            $this->has_one['history'] = array(
                'foreign_model' => 'Mdl_matches_history',
                'foreign_table' => 'matches_history',
                'foreign_key'   => 'fixture_matches_id',
                'local_key'     => 'fixture_matches_id'
            );
            
            $this->has_many['fixture_match_odds'] = array(
                'foreign_model' => 'Mdl_odds_by_fixture_match_id',
                'foreign_table' => 'odds_by_fixture_match_id',
                'foreign_key'   => 'fixture_matches_id',
                'local_key'     => 'fixture_matches_id'
            );

            $this->has_many['odds'] = array(
                'foreign_model' => 'mdl_odds',
                'foreign_table' => 'odds_by_fixture_match_id',
                'foreign_key'   => 'fixture_matches_id',
                'local_key'     => 'fixture_matches_id'
            );

            parent::__construct();
        }
    }