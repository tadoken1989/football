<?php

//set global function for all site

function loadFavoriteLeague()
{
    $CI = get_instance();
    $CI->load->model('mdl_leagues');
    return $CI->load->mdl_leagues->where('favorite', 1)->where('status', 1)->get_all();
}

function initCurrentSeason()
{
    $CI = get_instance();
    $CI->load->model('mdl_season');
    $data = $CI->load->mdl_season->where('is_current', 1)->where('status', 1)->get();
    return $data->season_id;

}

function loadCountry()
{
    $CI = get_instance();
    $CI->load->model('mdl_country');
    return $CI->load->mdl_country->where('status', 1)->get_all();
}

function loadSelectDay()
{
    $current = date('d.m.Y');
    $date_array = [];
    $date_array[0] = [
        'key' => 0,
        'value' => $current
    ];
    for ($i = 1; $i <= 14; $i++) {
        $date_array[$i] =
            [
                'key' => $i,
                'value' => date("d.m.Y", strtotime("$current +$i day"))
            ];
    }
    return $date_array;
}


function loadSelectDayOdds()
{
    $current = date('m/d/Y');
    $date_array = [];
    for ($i = 1; $i <= 7; $i++) {
        $date_array[$i] =
            [
                'key' => $i,
                'value' => date("m/d/Y", strtotime("$current +$i day"))
            ];
    }
    return $date_array;
}

function loadSelectDayLeft()
{
    $current = date('d.m.Y');
    $date_array = [];
    $date_array[0] = [
        'key' => 0,
        'value' => $current
    ];
    for ($i = 0; $i >= -14; $i--) {
        $date_array[$i] =
            [
                'key' => $i,
                'value' => date("d.m.Y", strtotime("$current +$i day"))
            ];
    }
    return $date_array;
}
function randomColorFromLeagueId($id)
{
    $array = [
        '1' => '2BA282',
        '2' => '#292B80',
        '3' => '#339933',
        '4' => '#6FC809',
        '5' => '#D88000',
        '7' => '#D88000',
        '8' => '#D88000',
        '6' => '#FF3E3E',
        '9' => '#12333474',
        '10' => '#FB4253',
        '16' => '#8D7321',
        '17' => '#690000',
    ];
    if ($id <= 6) {
        return $array[$id];
    } else {
        $k = array_rand($array);
        return $array[$k];
    }
}

function loadMenuLeft()
{
    $CI = get_instance();
    $CI->load->model('mdl_leagues');
    $CI->load->model('mdl_country');
    $country = $CI->load->mdl_country->with_leagues()->where('status', 1)->get_all();
    return $country;
}

function countAge($birthday)
{
    $from = new DateTime($birthday);
    $to = new DateTime('today');
    return $from->diff($to)->y;
}

function getPlayerNumber($name)
{
    $CI = get_instance();
    $CI->load->model('mdl_players');
    $player = $CI->load->mdl_players->where('alias', slug($name))->get();
    if($player) {
        return $player->player_number;
    }
    return 0;
}
