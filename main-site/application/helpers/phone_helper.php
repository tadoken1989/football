<?php
    function phone_formatter($phone_number){
        if(is_numeric($phone_number)){
            if(strlen($phone_number) == 10 && substr($phone_number,0,2) == '09')
                return '84'.substr($phone_number,1,9);
            elseif(strlen($phone_number) == 11 && substr($phone_number,0,2) == '01')
                return '84'.substr($phone_number,1,10);
            elseif(strlen($phone_number) == 11 && substr($phone_number,0,3) == '849')
                return $phone_number;
            elseif(strlen($phone_number) == 12 && substr($phone_number,0,3) == '841')
                return $phone_number;
        }

        return false;
    }

    function phone_supplier($phone_number){
        $mobifone = array('090','093','0120','0121','0122','0126','0128','089');
        $viettel = array('098','097','096','0169','0168','0167','0166','0165','0164','0163','0162','086');
        $vinaphone = array('091','094','0123','0124','0125','0127','0129','088');
        $vietnammobile = array('092','0188','0186');
        $sfone = array('095');
        $gmobile = array('0993','0994','0995','0996','0199');

        if(is_numeric($phone_number)){
            if(strlen($phone_number) == 10){
                if(in_array(substr($phone_number,0,3),$mobifone)) return 'mobifone';
                elseif(in_array(substr($phone_number,0,3),$viettel)) return 'viettel';
                elseif(in_array(substr($phone_number,0,3),$vinaphone)) return 'vinaphone';
                elseif(in_array(substr($phone_number,0,3),$vietnammobile)) return 'vietnammobile';
                elseif(in_array(substr($phone_number,0,3),$sfone)) return 'sfone';
                elseif(in_array(substr($phone_number,0,3),$gmobile)) return 'gmobile';
                else return false;
            }
            elseif(strlen($phone_number) == 11){
                if(in_array(substr($phone_number,0,4),$mobifone)) return 'mobifone';
                elseif(in_array(substr($phone_number,0,4),$viettel)) return 'viettel';
                elseif(in_array(substr($phone_number,0,4),$vinaphone)) return 'vinaphone';
                elseif(in_array(substr($phone_number,0,4),$vietnammobile)) return 'vietnammobile';
                elseif(in_array(substr($phone_number,0,4),$sfone)) return 'sfone';
                elseif(in_array(substr($phone_number,0,4),$gmobile)) return 'gmobile';
                elseif(substr($phone_number,0,2) == 84){
                    if(in_array('0'.substr($phone_number,2,2),$mobifone)) return 'mobifone';
                    elseif(in_array('0'.substr($phone_number,2,2),$viettel)) return 'viettel';
                    elseif(in_array('0'.substr($phone_number,2,2),$vinaphone)) return 'vinaphone';
                    elseif(in_array('0'.substr($phone_number,2,2),$vietnammobile)) return 'vietnammobile';
                    elseif(in_array('0'.substr($phone_number,2,2),$sfone)) return 'sfone';
                    elseif(in_array('0'.substr($phone_number,2,2),$gmobile)) return 'gmobile';
                    else return false;
                }
                else return false;
            }
            elseif(strlen($phone_number) == 12){
                if(substr($phone_number,0,2) == 84){
                    if(in_array('0'.substr($phone_number,2,3),$mobifone)) return 'mobifone';
                    elseif(in_array('0'.substr($phone_number,2,3),$viettel)) return 'viettel';
                    elseif(in_array('0'.substr($phone_number,2,3),$vinaphone)) return 'vinaphone';
                    elseif(in_array('0'.substr($phone_number,2,3),$vietnammobile)) return 'vietnammobile';
                    elseif(in_array('0'.substr($phone_number,2,3),$sfone)) return 'sfone';
                    elseif(in_array('0'.substr($phone_number,2,3),$gmobile)) return 'gmobile';
                    else return false;
                }
                else return false;
            }
        }
        else return false;
    }