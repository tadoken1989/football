<?php


    if (!function_exists('get_last_words')) {
        function get_last_words($text, $numWords = 1)
        {
            $nonWordChars = ':;,.?![](){}*';
            $result       = '';
            $words        = explode(' ', $text);
            $wordCount    = count($words);
            if ($numWords > $wordCount) {
                $numWords = $wordCount;
            }
            for ($w = $numWords; $w > 0; $w--) {
                if (!empty($result)) {
                    $result .= ' ';
                }
                $result .= trim($words[ $wordCount - $w ], $nonWordChars);
            }

            return $result;
        }
    }



    function is_json($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    function remove_vn_string($str)
    {
        $unicode = array('a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                         'd' => 'đ',
                         'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                         'i' => 'í|ì|ỉ|ĩ|ị',
                         'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                         'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                         'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                         'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                         'D' => 'Đ',
                         'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                         'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
                         'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                         'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                         'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',);

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        return $str;
    }

    function get_between($string, $start, $stop){
        $str = @explode($start, $string, 2);
        if(isset($str[1])){
            $str = @explode($stop, $str[1]);
            return $str[0];
        }
        return '';
    }

    function slug($str){
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }
    function parseDateTime($date) {
        echo date('H:i', strtotime($date));
    }

    function parseDateTimeToDate($date) {
        echo date('d.m.Y', strtotime($date));
    }


    function parseGmt7ToGmt($date) {
        echo date('d.m.Y', strtotime($date));
    }


function getFirstLetter($str) {
        $acronym = '';
        $word = '';
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }


