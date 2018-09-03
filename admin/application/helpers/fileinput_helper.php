<?php
    function reArrayFiles($file_post)
    {
        $file_ary = array();

        foreach ($file_post as $name => $val) {
            if (is_array($val['name'])) {
                foreach ($val['name'] as $i => $file_name) {
                    $file_ary[ $name.'_'.$i ] = array(
                        'name'     => $val['name'][ $i ],
                        'type'     => $val['type'][ $i ],
                        'tmp_name' => $val['tmp_name'][ $i ],
                        'error'    => $val['error'][ $i ],
                        'size'     => $val['size'][ $i ],
                    );
                }
            } else {
                $file_ary[ $name ] = $val;
            }
        }

        return $file_ary;
    }