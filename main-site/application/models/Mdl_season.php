<?php

    class Mdl_season extends MY_Model
    {
        public $table = 'season';
        public $primary_key = 'season_id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array

            parent::__construct();
        }
    }