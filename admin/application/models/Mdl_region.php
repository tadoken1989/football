<?php

    class Mdl_region extends MY_Model
    {
        public $table = 'region';
        public $primary_key = 'id';
        public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
        public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

        public function __construct()
        {
            $this->timestamps = TRUE;
            $this->soft_deletes = FALSE;
            $this->return_as = 'object'; //array

            $this->has_many['country'] = array(
                'foreign_model' => 'mdl_country',
                'foreign_table' => 'country',
                'foreign_key'   => 'region_id',
                'local_key'     => 'region_id'
            );

            parent::__construct();
        }
    }