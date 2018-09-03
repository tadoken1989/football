<?php

    class Mdl_odds_by_fixture_match_id extends MY_Model
    {
        public $table = 'odds_by_fixture_match_id';
        public $primary_key = 'id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array

            $this->has_one['fixture_matche'] = array(
                'foreign_model' => 'Mdl_fixture_matches',
                'foreign_table' => 'fixture_matches',
                'foreign_key'   => 'fixture_matches_id',
                'local_key'     => 'fixture_matches_id'
            );
            parent::__construct();
        }
    }