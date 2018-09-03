<?php

    class Mdl_teams extends MY_Model
    {
        public $table = 'teams';
        public $primary_key = 'team_id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array

            $this->has_one['country'] = array(
                'foreign_model' => 'Mdl_country',
                'foreign_table' => 'country',
                'foreign_key'   => 'id',
                'local_key'     => 'country_id'
            );
            $this->has_many['players'] = array(
                'foreign_model' => 'mdl_players',
                'foreign_table' => 'players',
                'foreign_key'   => 'team_id',
                'local_key'     => 'team_id'
            );

            parent::__construct();
        }
    }