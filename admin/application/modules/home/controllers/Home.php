<?php

class Home extends Authed_Controller
{
    //123abc123
    public function index()
    {
        return $this->blade->render('index');
    }
}