<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Authed_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth'));

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }
}