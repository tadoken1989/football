<?php

    class Mdl_league_group_cup extends MY_Model
    {
        public $table = 'league_group_cup';
        public $primary_key = 'league_team_id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array


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


            parent::__construct();
        }
    }