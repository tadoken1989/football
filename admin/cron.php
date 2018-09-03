<?php
/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 10/26/2017
 * Time: 2:35 PM
 */
/*
|---------------------------------------------------------------
| CASTING argc AND argv INTO LOCAL VARIABLES
|---------------------------------------------------------------
|
*/
$argc = $_SERVER['argc'];
$argv = $_SERVER['argv'];

// INTERPRETTING INPUT

if ($argc > 1 && isset($argv[1])) {
    $_SERVER['PATH_INFO'] = $argv[1];
    $_SERVER['REQUEST_URI'] = $argv[1];
} else {
    $_SERVER['PATH_INFO'] = '/cron/getHistoryMatchDay';
    $_SERVER['REQUEST_URI'] = '/cron/getHistoryMatchDay';
}

/*
|---------------------------------------------------------------
| PHP SCRIPT EXECUTION TIME ('0' means Unlimited)
|---------------------------------------------------------------
|
*/
set_time_limit(0);

require_once('index.php');

/* End of file test.php */