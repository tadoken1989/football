<?php

    /**
     * @package         Utilities
     * @author          Huu Toan
     */
    class Alta
    {

        function curl2($url, $post = FALSE, $cookie = FALSE, $header = 0, $ip_version = 'ipv4')
        {
            $ch = @curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            $head[] = "Connection: keep-alive";
            $head[] = "Keep-Alive: 300";
            $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
            $head[] = "Accept-Language: en-us,en;q=0.5";
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
            if ($post) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            }
            if ($header) {
                curl_setopt($ch, CURLOPT_HEADER, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
            }
            else {
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            }
            if (strtolower($ip_version) == 'ipv6') {
                curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            $page = curl_exec($ch);
            curl_close($ch);

            return $page;
        }

        function curl($type, $url, $params = array(), $headers = array(), $timeout = 30)
        {
            $ch = curl_init();

            switch (strtolower($type)) {
                case 'post':
                    // $data_json = json_encode($params);
                    // $headers[] = 'Content-Type: application/json';
                    // $headers[] = 'Content-Length: ' . strlen($data_json);
                    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    break;
                case 'post_json':
                    $data_json = json_encode($params);
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'Content-Length: ' . strlen($data_json);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                    break;
                case 'put':
                    $data_json = json_encode($params);
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'Content-Length: ' . strlen($data_json);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                    break;
                case 'delete':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                    break;
                default:
                    $url = $url . '?' . http_build_query($params);
                    break;
            }

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            if ($headers) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        }

        function getImdb($imdb_link)
        {
            $result = $this->curl2($imdb_link);

            echo "<textarea>$result</textarea>";
        }

        function api_truong($url)
        {
            $id      = '';
            $sources = [];

            preg_match('/\/d\/(.*)\//', $url, $matches1);
            preg_match('/\/d\/(.*)/', $url, $matches2);
            if (isset($matches1[1])) {
                $id = $matches1[1];
            }
            elseif (isset($matches2[1])) {
                $id = $matches1[1];
            }

            if ($id) {
                $api_link = 'http://nguyentruong1.iocodes.com/v3/player.php?link=' . urlencode($id);

                $result = $this->curl2($api_link);

                if (is_json($result)) {
                    $json = json_decode($result);

                    if (isset($json->data->medium->url)) {
                        $sources['480p'] = $json->data->medium->url;
                    }
                    if (isset($json->data->hd720->url)) {
                        $sources['720p'] = $json->data->hd720->url;
                    }
                    if (isset($json->data->large->url)) {
                        $sources['1080p'] = $json->data->large->url;
                    }

                }
            }

            return $sources;
        }

        function api_duongtang($url)
        {
            $sources = [];

            $api_link = 'https://duongtang.clgt.vn/?apikey=' . urlencode('ciz9amv1y01gj0fobxqdwo0xh') . '&drive=' . urlencode($url);

            $result = $this->curl2($api_link);

            if (is_json($result)) {
                $json = json_decode($result);

                foreach ($json as $quality) {
                    $sources[ $quality->label . 'p' ] = $quality->file;
                }
            }

            return $sources;
        }

        function api_getsalefiles($url)
        {
            $cookie = tempnam('./cookie', 'sf');

            $params = array(
                'op'       => 'login',
                'redirect' => '',
                'login'    => 'norival1992',
                'password' => 'Net4Viet'
            );

            $result = $this->curl2('http://salefiles.com/', $params, $cookie);

            $result = $this->curl2($url, [], $cookie, 1);

            $location = trim(get_between($result, 'Location: ', 'Vary: Accept-Encoding'));

            $sources['720p'] = $location;

            return $sources;
        }

        function api_getfastload($url, $user = '8671139', $pass = 'qwe123')
        {
            $cookie = tempnam('./cookie', 'sf');

            $params = array(
                'op'       => 'login',
                'redirect' => '',
                'login'    => $user,
                'password' => $pass
            );

            $result = $this->curl2('http://fastload.co/', $params, $cookie);

            $result = $this->curl2($url, [], $cookie, 1);

            $location = trim(get_between($result, 'Location: ', "\n"));

            $sources['720p'] = $location;

            return $sources;
        }

        function api_getkatfiles($url)
        {
            $cookie = tempnam('./cookie', 'kf');

            $params = array(
                'op'       => 'login',
                'token'    => '',
                'rand'     => '',
                'redirect' => '',
                'login'    => 'takevoucher',
                'password' => 'Net4Viet'
            );

            $result = $this->curl2('http://katfile.com/', $params, $cookie, 0, 'ipv6');

            echo "<textarea>$result</textarea>";
            exit;

            $result = $this->curl2($url, [], $cookie, 1, 'ipv6');

            $location = trim(get_between($result, 'Location: ', 'Server:'));

            $sources['720p'] = $location;

            return $sources;
        }

        function api_getlinkdrive($url)
        {
            $params = array(
                'url' => $url
            );

            $result = $this->curl2('http://api.getlinkdrive.com/getlink?url=' . urlencode($url));

            $sources = [];

            if (is_json($result)) {
                $json = json_decode($result);

                foreach ($json as $quality) {
                    $sources[ $quality->label ] = str_replace('&filename=video.mp4', '', $quality->file);
                }
            }

            return $sources;
        }

        function api_animevshd($url)
        {
            $result = $this->curl2('https://api.animevshd.com/?url=' . urlencode($url));

            $arr_from = [
                '{file:',
                ',label:',
                ' type:'
            ];
            $arr_to   = [
                '{"file":',
                ',"label":',
                '"type":'
            ];

            $result = str_replace($arr_from, $arr_to, $result);

            $sources = [];

            if (is_json($result)) {
                $json = json_decode($result);

                foreach ($json as $quality) {
                    $sources[ $quality->label ] = str_replace('&filename=video.mp4', '', $quality->file);
                }
            }

            return $sources;
        }
    }