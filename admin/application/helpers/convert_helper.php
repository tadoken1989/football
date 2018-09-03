<?php
    /* convert san nha */
    function get_data_san_khach_is_cup($league_group_cup , $leagues)
    {
        $CI = &get_instance();
        $league_group_cup_array = [];
        if (!empty($league_group_cup)) {
            foreach ($league_group_cup as $key => $value) 
            {
                $league_team_cup_standing = $CI->mdl_league_team_cup_standing->where('group_id',$value->league_group_id)->get_all();
                $data = [];
                foreach ($league_team_cup_standing as $h => $home) 
                {
                    $mdl_teams = $CI->mdl_matches_history->where('away_team_id',$home->team_id)->where('league_id',$leagues->id)->get_all();
                    if (!empty($mdl_teams)) 
                    {
                        $points = 0;
                        $won = 0;
                        $draw = 0;
                        $lost = 0;
                        $home_goals = 0;
                        $away_goals = 0;
                        
                        foreach ($mdl_teams as $hc => $element):
                            $home_goals+=$element->home_goals;
                            $away_goals+=$element->away_goals;
                            if ($element->away_goals > $element->home_goals) {
                               $points+=3;
                               $won+=1;
                            }else if($element->home_goals == $element->away_goals){
                               $points+=1;
                               $draw+= 1;
                            }else{
                               $lost+= 1;
                            }
                        endforeach;
                        $goals = $away_goals -  $home_goals;
                        $data[$h]['team']             = $home->team;
                        $data[$h]['team_id']          = $home->team_id;
                        $data[$h]['played_away']   = $home->played_away;
                        $data[$h]['points']           = $points;
                        $data[$h]['won']              = $won;
                        $data[$h]['draw']             = $draw;
                        $data[$h]['lost']             = $lost;
                        $data[$h]['home_goals']       = $home_goals;
                        $data[$h]['away_goals']       = $away_goals;
                        $data[$h]['goals']            = $goals;
                        $teams_convert = sort_by_value($data,'points','away_goals',false);
                        $league_group_cup_array[$value->name] = $teams_convert;
                    }
                    
                }
            }
        }
        return $league_group_cup_array;
    }

    /* convert san nha */
    function get_data_san_nha_is_cup($league_group_cup , $leagues)
    {
        $CI = &get_instance();
        $league_group_cup_array = [];
        if (!empty($league_group_cup)) {
            foreach ($league_group_cup as $key => $value) 
            {
                $league_team_cup_standing = $CI->mdl_league_team_cup_standing->where('group_id',$value->league_group_id)->get_all();
                $data = [];
                foreach ($league_team_cup_standing as $h => $home) 
                {
                    $mdl_teams = $CI->mdl_matches_history->where('home_team_id',$home->team_id)->where('league_id',$leagues->id)->get_all();
                    if (!empty($mdl_teams)) 
                    {
                        $points = 0;
                        $won = 0;
                        $draw = 0;
                        $lost = 0;
                        $home_goals = 0;
                        $away_goals = 0;
                        
                        foreach ($mdl_teams as $hc => $element):
                            $home_goals+=$element->home_goals;
                            $away_goals+=$element->away_goals;
                            if ($element->home_goals > $element->away_goals) {
                               $points+=3;
                               $won+=1;
                            }else if($element->home_goals == $element->away_goals){
                               $points+=1;
                               $draw+= 1;
                            }else{
                               $lost+= 1;
                            }
                        endforeach;
                        $goals = $home_goals -  $away_goals;
                        $data[$h]['team']             = $home->team;
                        $data[$h]['team_id']          = $home->team_id;
                        $data[$h]['played_at_home']   = $home->played_at_home;
                        $data[$h]['points']           = $points;
                        $data[$h]['won']              = $won;
                        $data[$h]['draw']             = $draw;
                        $data[$h]['lost']             = $lost;
                        $data[$h]['home_goals']       = $home_goals;
                        $data[$h]['away_goals']       = $away_goals;
                        $data[$h]['goals']            = $goals;
                        $teams_convert = sort_by_value($data,'points','home_goals',false);
                        $league_group_cup_array[$value->name] = $teams_convert;
                    }
                    
                }
            } 
        }
        return $league_group_cup_array;
    }
    /* convert san nha */
    function get_data_san_nha($league_team_standing , $leagues)
    {
        $data = [];
        if(!empty($league_team_standing))
        {
            foreach ($league_team_standing as $key => $ele) {

                $history = covert_sannha($ele->team_id , $leagues->id);

                if (!empty($history)) 
                {
                    $points = 0;
                    $won = 0;
                    $draw = 0;
                    $lost = 0;
                    $home_goals = 0;
                    $away_goals = 0;
                    foreach ($history as $h => $element):
                        $home_goals+=$element->home_goals;
                        $away_goals+=$element->away_goals;
                        if ($element->home_goals > $element->away_goals) {
                           $points+=3;
                           $won+=1;
                        }else if($element->home_goals == $element->away_goals){
                           $points+=1;
                           $draw+= 1;
                        }else{
                           $lost+= 1;
                        }
                    endforeach;
                    $goals = $home_goals -  $away_goals;

                    $data[$key]['team']             = $ele->team;
                    $data[$key]['team_id']          = $ele->team_id;
                    $data[$key]['played_at_home']   = $ele->played_at_home;
                    $data[$key]['points']           = $points;
                    $data[$key]['won']              = $won;
                    $data[$key]['draw']             = $draw;
                    $data[$key]['lost']             = $lost;
                    $data[$key]['home_goals']       = $home_goals;
                    $data[$key]['away_goals']       = $away_goals;
                    $data[$key]['goals']            = $goals;
                }
            }
        }
        $teams_convert = sort_by_value($data,'points','home_goals',false);
        return $teams_convert;
    }

    function covert_sannha($team_id,$leagues_id)
    {
        $CI = &get_instance();
        $self = $CI->load->model('mdl_matches_history');
        $matches_history = $self->load->mdl_matches_history->where('home_team_id', $team_id)->where('league_id',$leagues_id)->get_all();
        return $matches_history;
    }
    /* convert san khach */
    function covert_sankhach($team_id,$leagues_id)
    {
        $CI = &get_instance();
        $self = $CI->load->model('mdl_matches_history');
        $matches_history = $self->load->mdl_matches_history->where('away_team_id', $team_id)->where('league_id',$leagues_id)->get_all();
        return $matches_history;
    }

    function get_data_san_khach($league_team_standing , $leagues)
    {
        $data = [];
        if (!empty($league_team_standing)) 
        {
            foreach ($league_team_standing as $key => $ele) {

                $history = covert_sankhach($ele->team_id , $leagues->id);
                if (!empty($history)) 
                {
                    $points = 0;
                    $won = 0;
                    $draw = 0;
                    $lost = 0;
                    $home_goals = 0;
                    $away_goals = 0;
                    foreach ($history as $h => $element):
                        $home_goals+=$element->home_goals;
                        $away_goals+=$element->away_goals;
                        if ($element->away_goals > $element->home_goals) {
                           $points+=3;
                           $won+=1;
                        }else if($element->home_goals == $element->away_goals){
                           $points+=1;
                           $draw+= 1;
                        }else{
                           $lost+= 1;
                        }
                    endforeach;
                    $goals = $away_goals - $home_goals;

                    $data[$key]['team']             = $ele->team;
                    $data[$key]['team_id']          = $ele->team_id;
                    $data[$key]['played_at_home']   = $ele->played_at_home;
                    $data[$key]['points']           = $points;
                    $data[$key]['won']              = $won;
                    $data[$key]['draw']             = $draw;
                    $data[$key]['lost']             = $lost;
                    $data[$key]['home_goals']       = $home_goals;
                    $data[$key]['away_goals']       = $away_goals;
                    $data[$key]['goals']            = $goals;
                }
            }
        }
        $teams_convert = sort_by_value($data,'points','away_goals',false);
        return $teams_convert;
    }
    /* sort by value */
    function sort_by_value($array, $value, $value2 , $asc = true, $preserveKeys = false)
    {
        if ($preserveKeys) {
            $c = array();
            if (is_object(reset($array))) {
                foreach ($array as $k => $v) {
                    $b[$k] = strtolower($v->$value);
                }
            } else {
                foreach ($array as $k => $v) {
                    $b[$k] = strtolower($v[$value]);
                }
            }
            $asc ? asort($b) : arsort($b);
            foreach ($b as $k => $v) {
                $c[$k] = $array[$k];
            }
            $array = $c;
        } else {
            if (is_object(reset($array))) {
                usort($array, function ($a, $b) use ($value, $asc ,$value2) {
                    return $a->{$value} == $b->{$value} ? ($a->{$value2} - $b->{$value2}) * ($asc ? 1 : -1) : ($a->{$value} - $b->{$value}) * ($asc ? 1 : -1);
                });
            } else {
                usort($array, function ($a, $b) use ($value, $asc,$value2) {
                    return $a[$value] == $b[$value] ? ($a[$value2] - $b[$value2]) * ($asc ? 1 : -1) : ($a[$value] - $b[$value]) * ($asc ? 1 : -1);
                });
            }
        }

        return $array;
    }

    function sort_string ($array, $index, $order, $natsort=FALSE, $case_sensitive=FALSE) {
         if(is_array($array) && count($array)>0) {
             foreach(array_keys($array) as $key) { 
                $temp[$key]=$array[$key][$index];
             }
             if(!$natsort) {
                 if ($order=='asc') {
                     asort($temp);
                 } else {    
                     arsort($temp);
                 }
             }
             else 
             {
                 if ($case_sensitive===true) {
                     natsort($temp);
                 } else {
                     natcasesort($temp);
                 }
                if($order!='asc') { 
                 $temp=array_reverse($temp,TRUE);
                }
             }
             foreach(array_keys($temp) as $key) { 
                 if (is_numeric($key)) {
                     $sorted[]=$array[$key];
                 } else {    
                     $sorted[$key]=$array[$key];
                 }
             }
             return $sorted;
         }
        return $sorted;
    }


    function convert($str) 
    {
        $chars = array(
            ''  =>  array('”','“','"','\'','  ',' -','- ',':','?','~','!','@','#','$','%','*',';',',','(',')','.','&','/'),
            '-' =>  array(' ','  ','#','@','!','#'),
            'a' =>  array('á','ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă','A'),
            'e' =>  array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê','E'),
            'i' =>  array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị','I'),
            'o' =>  array('ố','ồ','ổ','ỗ','ộ','Ố','Ỗ','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ','O'),
            'u' =>  array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư','U'),
            'y' =>  array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ','Y'),
            'd' =>  array('đ','Đ','D'),
            'b' =>  array('B'),
            'c' =>  array('C'),
            'g' =>  array('G'),
            'h' =>  array('H'),
            'k' =>  array('K'),
            'l' =>  array('L'),
            'm' =>  array('M'),
            'n' =>  array('N'),
            'p' =>  array('P'),
            'q' =>  array('Q'),
            'r' =>  array('R'),
            's' =>  array('S'),
            't' =>  array('T'),
            'v' =>  array('V'),
            'x' =>  array('X'),
            'w' =>  array('W'),
            'f' =>  array('F'),
            'j' =>  array('J')
        );

        foreach ($chars as $key => $arr){
           foreach ($arr as $val)
                $str = str_replace($val,$key,$str);
        }   
            
        return $str;
    }

    function convert_country($leagues)
    {
        $CI = &get_instance();
        $country = $CI->mdl_country
            ->where('id',$leagues->country_id)
            ->get();
        if (!empty($country)) 
        {
            return $country->name;
        }
        return "";
    }

    function filterOverUnder($value)
    {
        return ($value->type == 'Over/Under');
    }
    function filter1X2($value)
    {
        return ($value->type == '1X2');
    }
    function filterAsianHandicap($value)
    {
        return ($value->type == 'Asian Handicap');
    }
    
    // info giai dau
    function league_info($league)
    {
        $CI = &get_instance();
        $CI = $CI->load->model('mdl_league_info');
        $league_info = $CI->mdl_league_info->where('league_id',$league->id)->get();
        if ($league_info) {
            return nl2br($league_info->content);
        }
        return "Chưa có thông tin";
    }

    function format_day_in_week($date) {
        $weekday = strtolower($date);
        switch($weekday) {
            case 'monday':
                $weekday = 'Thứ 2';
                break;
            case 'tuesday':
                $weekday = 'Thứ 3';
                break;
            case 'wednesday':
                $weekday = 'Thứ 4';
                break;
            case 'thursday':
                $weekday = 'Thứ 5';
                break;
            case 'friday':
                $weekday = 'Thứ 6';
                break;
            case 'saturday':
                $weekday = 'Thứ 7';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday;
    }

    function add7DayInWeek()
    {
        $today = date('Y-m-d 00:00:00',strtotime("-1 day"));
        $inWeek = [];
        for ($i = 1; $i <= 7; $i++) 
        {
            $sw_get_current_weekday = date("l", strtotime("$today +$i day"));
            $inWeek[] = format_day_in_week($sw_get_current_weekday);
        }
        return $inWeek;
    }

    function ty_le_ca_tran_trong_tuan($day , $key)
    {
        $day = str_replace("-", "", convert($day));
        echo base_url('ty-le-cac-tran-ngay-'.$day.'-'.$key.'.html');
    }
    //get all fixture_matches today tyle keo nhacai
    function odds_by_fixture_match($fixture_matches_id,$type ='Over/Under',$sort = 'desc')
    {
        $CI = &get_instance();
        $odds_by_fixture_match = $CI->db->from('odds_by_fixture_match_id')
            ->where('fixture_matches_id',$fixture_matches_id)
            ->where('type',$type)
            ->order_by('odds_id',$sort)
            ->get()
            ->row();
        return $odds_by_fixture_match;
    }

    //get all fixture_matches today tyle
    function fixture_matches($league_id,$array)
    {
        $CI = &get_instance();
        $CI->load->model('mdl_fixture_matches');
        $fixture_matches = $CI->mdl_fixture_matches->where('league_id',$league_id)
                ->with_home_team()
                ->with_away_team()
                ->with_fixture_match_odds()
                ->where('date >=', $array['today'])
                ->where('date <', $array['addday'])
                ->order_by('date','asc')
                ->get_all();
        return $fixture_matches;
    }

    function get_team($team_id)
    {
        $CI = &get_instance();
        $CI->load->model('mdl_teams');
        $team = $CI->mdl_teams->where('team_id',$team_id)->get();
        return $team;
    }

    function selected($slug , $slug2)
    {
        if ($slug == $slug2) {
            return "selected";
        }
    }


    function add_class($c1,$c2,$leagues,$key)
    {
        $i = $key+1;
        $addClass = "";
        if ($i < $c1)
        {
            $addClass = "bg_C1";
        }
        else if($i == $c1)
        {
            $addClass = "bg_VLC1";
        }
        else if($i > $c1 && $i < ($c2 + $c1))
        {
         $addClass = "bg_C2";
        }
        else if($i > 17 && $i<= count($leagues))
        {
            $addClass = "bg_XH";
        }
        return $addClass;
    }

    function load_configs($value)
    {
        $CI = &get_instance();
        $CI->load->model('mdl_setting');
        $setting = $CI->mdl_setting->where('name',$value)->get();
        if (!empty($setting))
        {
            return $setting->value;
        }
    }


    function back_link($position = 'wraper')
    {
        $CI = &get_instance();
        $CI->load->model('mdl_back_link');
        $back_link = $CI->mdl_back_link->where('position',$position)->order_by('sort_by','asc')->get_all();
        if (!empty($back_link))
        {
            return $back_link;
        }
    }

    function region()
    {
        $CI = &get_instance();
        $CI->load->model('mdl_region');
        $region = $CI->mdl_region->with_country()->where('status',1)->get_all();
        if (!empty($region))
        {
            return $region;
        }
        return "";
    }

    function league_in_country($country)
    {
        $CI = &get_instance();
        $CI->load->model('mdl_leagues');
        $country = $CI->mdl_leagues->where('country_id',$country->id)->get();
        return $country;
    }

