<?php

    class Mdl_country extends MY_Model
    {
        public $table = 'country';
        public $primary_key = 'id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array

            $this->has_many['leagues'] = array(
                'foreign_model' => 'mdl_leagues',
                'foreign_table' => 'leagues',
                'foreign_key'   => 'country_id',
                'local_key'     => 'id'
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