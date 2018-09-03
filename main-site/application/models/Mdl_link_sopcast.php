<?php

    class Mdl_link_sopcast extends MY_Model
    {
        public $table = 'link_sopcast';
        public $primary_key = 'id_link';
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