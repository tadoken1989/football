<?php

    class Mdl_television extends MY_Model
    {
        public $table = 'television';
        public $primary_key = 'id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array
            parent::__construct();

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



        }
    }