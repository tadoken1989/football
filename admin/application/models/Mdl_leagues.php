<?php

    class Mdl_leagues extends MY_Model
    {
        public $table = 'leagues';
        public $primary_key = 'id';
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

            $this->has_one['region'] = array(
                'foreign_model' => 'Mdl_region',
                'foreign_table' => 'region',
                'foreign_key'   => 'region_id',
                'local_key'     => 'region_id'
            );

            parent::__construct();
        }
    }