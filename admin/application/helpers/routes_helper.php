<?php
    function dd($data)
    {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
        die();
    }
    function formatGif($value)
    {
        if ($value > 0) {
            return "len";
        }elseif($value == 0){
             return "ngang";
        }else{
             return "xuong";
        }
    }
    function routes_bangxephang($alias,$id)
    {
        echo base_url("bang-xep-hang-".convert($alias)."-".$id.".html");
    }

    function route_bang_xep_hang_san_nha($alias,$id)
    {
        echo base_url("bang-xep-hang-san-nha-".$alias."-".$id.".html");
    }

    function route_bang_xep_hang_san_khach($alias,$id)
    {
        echo base_url("bang-xep-hang-san-khach-".$alias."-".$id.".html");
    }

    function routes_teams($alias,$id)
    {
        echo base_url("doi-".$alias."-".$id.".html");
    }

    function league_team_cup_standing($group_id){
        $CI = get_instance();
        $CI->load->model('mdl_league_team_cup_standing');
        return $CI->load->mdl_league_team_cup_standing->where('group_id', $group_id)->order_by('points','DESC')->get_all();
    }

    function route_kq_league($alias,$id) {
        echo base_url('/ket-qua-'.$alias.'-'.$id.'.html');
    }
    function route_phong_do_doi_dau($data){
        echo base_url('phong-do-'.$data->home_team->alias.'-vs-'.$data->away_team->alias.'-'.$data->home_team->team_id.'-'.$data->away_team->team_id.'-'.$data->fixture_matches_id.'.html');
    }
    function route_truc_tiep($data) {
        echo base_url('truc-tiep-'.$data->home_team->alias.'-vs-'.$data->away_team->alias.'-'.$data->fixture_matches_id.'.html');
    }
    function route_ty_le($data) {
        echo base_url('ty-le-'.$data->home_team->alias.'-vs-'.$data->away_team->alias.'-'.$data->fixture_matches_id.'.html');
    }

    function format_date_asia_hi($date)
    {
        if (!empty($date)) 
        {
            return date("H:i",strtotime("$date +7 hours"));
        }
        return "";
    }
    function format_date_asia_date($date)
    {
        if (!empty($date)) 
        {
            return date("l , d/m/Y",strtotime("$date +7 hours"));
        }
        return "";
    }

    function format_date_asia_day($date)
    {
        if (!empty($date)) 
        {
            return date("d/m",strtotime("$date +7 hours"));
        }
        return "";
        
    }

    function route_vua_pha_luoi($alias,$id)
    {
        echo base_url('vua-pha-luoi-'.slug($alias).'-'.$id.'.html');
    }

    function ket_qua_bd_the_vong($alias,$id,$round){
        echo base_url('ket-qua-'.slug($alias).'-'.$id.'-vong-'.$round.'.html');
    }
    function lich_thi_dau_5_vong($alias,$id){
        echo base_url('lich-thi-dau-'.slug($alias).'-'.$id.'.html');
    }



