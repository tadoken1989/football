<?php

class Livescore extends MY_Controller
{
    protected $sportradar;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_fixture_matches');
        $this->sportradar = new Sportradar();
    }

    public function index()
    {

        $livescore = [];

        if ($this->sportradar->getLiveScore()) {
            $livescore = (object)($this->sportradar->getLiveScore()->results);
        }


        // get all list fixture match_today

        $date_from = date('Y-m-d 00:00:00');
        $date_to = date("Y-m-d 00:00:00", strtotime("$date_from +1 day"));

        // query
        $list_fixture = $this->mdl_fixture_matches
            ->with_home_team()
            ->with_away_team()
            ->with_league()
            ->with_season()
            ->with_odds()
            ->where('date >=', $date_from)
            ->where('date <=', $date_to)
            ->order_by('date', 'ASC')
            ->get_all();

        return $this->blade
            ->set('livescore', $livescore)
            ->set('list_fixture', $list_fixture)
            ->render('home');
    }

    public function odds_live()
    {
        return $this->blade->render('index');
    }

    public function iframe()
    {
        return $this->blade->render('iframe');
    }

    public function head()
    {
        return $this->blade->render('header');
    }

    public function homeleft()
    {
        return $this->blade->render('iframe_left');
    }

    public function menuData()
    {
        echo file_get_contents('http://odds.vdev.vn/menu.php');
        exit();
    }

    public function UnderOver_data()
    {
        $Market = $this->input->get('Market', TRUE);
        $Sport = $this->input->get('Sport', TRUE);
        $DT = $this->input->get('DT', TRUE);
        $RT = $this->input->get('RT', TRUE);
        $CT = $this->input->get('CT', TRUE);
        $Game = $this->input->get('Game', TRUE);
        $OrderBy = $this->input->get('OrderBy', TRUE);
        $OddsType = $this->input->get('OddsType', TRUE);
        $DispRang = $this->input->get('DispRang', TRUE);
        $MainLeague = $this->input->get('MainLeague', TRUE);
        $_ = $this->input->get('_', TRUE);

        $link = "http://odds.vdev.vn/odds.php?Market=" . $Market . "&Sport=" . $Sport . "&DT=" . $DT . "&RT=" . $RT . "&CT=" . urlencode($CT) . "&Game=" . $Game . "&OrderBy=" . $OrderBy . "&OddsType=" . $OddsType . "&DispRang=" . $DispRang . "&MainLeague=" . $MainLeague . "&_=" . $_;
        $result = file_get_contents($link);
        echo $result;
        exit();

    }


    public function UnderOverPop()
    {

    }

    public function UnderOver_tmpl()
    {
        $form = "  
                    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
                    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
            <html xmlns=\"http://www.w3.org/1999/xhtml\">
            <head>
                <title>Double_Line</title>
                <meta http-equiv=\"Pragma\" content=\"no-cache\"/>
                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
            </head>
            <body>
            <table id=\"tmplTable\" width=\"100%\" class=\"tabstyle02 tabstyle03 OddsTable\">
                <tbody id='tmplHeader'>
                <tr class=\"tabthdwn\">
                    <th width=\"57\" nowrap=\"nowrap\">Giờ</th>
                    <th colspan=\"2\">Lựa Chọn</th>
                    <th style=\"width: 87px;\" nowrap title=\"Toàn Thời Gian ĐIỀU CHẤP\">FT. HDP</th>
                    <th style=\"width: 87px;\" nowrap title=\"Toàn Thời Gian Tài/Xiu\">FT. O/U</th>
                    <th style=\"width: 48px;\" nowrap title=\"Toàn Thời Gian 1X2\" class=\"tabt_R\">FT. 1X2</th>
                    <th style=\"width: 87px;\" nowrap title=\"HIỆP 1 ĐIỀU CHẤP\">1H. HDP</th>
                    <th style=\"width: 87px;\" nowrap title=\"HIỆP 1 Tài/Xiu\">1H. O/U</th>
                    <th style=\"width: 48px;\" nowrap title=\"HIỆP 1 1X2\">1H. 1X2</th>
                    <th width=\"1\" class=\"none_rline\">&nbsp;</th>
                </tr>
                </tbody>
                <tbody id=\"tmplLeague_L\">
                <tr id=\"l_{%LeagueId}\" valign=\"middle\" onclick=\"refreshData_L();\" style=\"cursor:pointer\">
                    <td valign=\"middle\" class=\"none_rline tabtitle\">&nbsp;</td>
                    <td colspan=\"6\" valign=\"middle\" class=\"none_rline tabtitle\">{%LeagueName}</td>
                    <td colspan=\"3\" align=\"right\" class=\"tabtitle none_rline\"><a name=\"btnRefresh_L\" class=\"button-ref disabled\"
                                                                                 disabled><span><div class='iconRefresh wait'
                                                                                                     title='Xin vui lòng chờ đợi'></div></span></a>
                    </td>
                </tr>
                </tbody>
                <tbody id=\"tmplLive\">
                <tr id=\"e_{%MatchId}_{%MatchCount}_1\" class=\"{@Tr_Cls}\"
                    onmouseover=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','trbgov');\"
                    onmouseout=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','{@BgColor}');\">
                    <td nowrap=\"nowrap\" rowspan=\"2\" class=\"text_time {%Changed_Score}\"><b>{%ScoreH}-{%ScoreA}</b>
                        <div nowrap><span class=\"{@TimeSuspendCls}\" title=\"In Running\"><b class=\"IsLive\">IR</b></span><span
                                class=\"{@TimeSuspendCls1}\"><b class=\"{@LiveTimeCls}\">{%ShowTime}</b>{@InjuryTime}</span></div>
                    </td>
                    <td valign=\"top\" rowspan=\"2\" class=\"none_rline\">
                        <div class=\"{@Home_Cls} team_name_pad\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\">{%HomeName}{@RedCardH}</div>
                        <div class=\"{@Away_Cls} team_name_pad\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\">{%AwayName}{@RedCardA}</div>
                        <div class=\"team_name_pad\">{@Draw}</div>
                        <a href=\"javascript:;\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\" class=\"team_name_pad\">Phong độ</a>
                    </td>
                    <td align=\"right\" rowspan=\"2\" nowrap=\"nowrap\">{@SportRadarInfo}{@Streaming}<!--{@Favorites}--></td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{@Value_1_H}</span><br/>
                            <span class=\"ValueClass\">{@Value_1_A}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_1}\">
                            <span class=\" {@Odds_1_H_Cls}\">{@Odds_1_H}</span><br/>
                            <span class=\" {@Odds_1_A_Cls} BestOdds\">{@Odds_1_A}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{%Goal_3}</span><br/>
                            <span class=\"ValueClass\">{@UNDER_3}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_3}\"><span class=\" {@Odds_3_O_Cls}\">{@Odds_3_O}</span><br/>
                            <span class=\" {@Odds_3_U_Cls}\">{@Odds_3_U}</span></div>
                    </td>
                    <td rowspan=\"2\" align=\"right\" valign=\"top\" class=\"tabt_R\">
                        <div class=\"{%Changed_5}\"><span class=\" {@Odds_5_1_Cls}\">{%Odds_5_1}</span><br/>
                            <span class=\" {@Odds_5_2_Cls}\">{%Odds_5_2}</span><br/>
                            <span class=\" {@Odds_5_X_Cls}\">{%Odds_5_X}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{@Value_7_H}</span><br/>
                            <span class=\"ValueClass\">{@Value_7_A}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_7}\"><span class=\" {@Odds_7_H_Cls}\">{@Odds_7_H}</span><br/>
                            <span class=\" {@Odds_7_A_Cls}\">{@Odds_7_A}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{%Goal_8}</span><br/>
                            <span class=\"ValueClass\">{@UNDER_8}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_8}\"><span class=\" {@Odds_8_O_Cls}\">{@Odds_8_O}</span><br/>
                            <span class=\" {@Odds_8_U_Cls}\">{@Odds_8_U}</span></div>
                    </td>
                    <td align=\"right\" rowspan=\"2\" valign=\"top\">
                        <div class=\"{%Changed_15}\"><span class=\" {@Odds_15_1_Cls}\">{%Odds_15_1}</span><br/>
                            <span class=\" {@Odds_15_2_Cls}\">{%Odds_15_2}</span><br/>
                            <span class=\" {@Odds_15_X_Cls}\">{%Odds_15_X}</span></div>
                    </td>
                    <td rowspan=\"2\" align=\"center\" class=\"none_rline\"><!--{@ScoreMap}-->
                        <div>{@StatsInfo}</div>
                    </td>
                </tr>
                <tr id=\"e_{%MatchId}_{%MatchCount}_2\" class=\"{@Tr_Cls}\"
                    onmouseover=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','trbgov');\"
                    onmouseout=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','{@BgColor}');\">
                </tr>
                <tr class=\"tabtitle Alpha {@Display_More}\">
                    <td class=\"moreBetType tag {@Display_More} none_rline\" colspan=\"10\">{@MoreData}</td>
                </tr>
                </tbody>
                <tbody id=\"tmplLeague\">
                <tr id=\"l_{%LeagueId}\" valign=\"middle\" onclick=\"refreshData_D();\" style=\"cursor:pointer\">
                    <td class=\"tabtitle none_rline\"></td>
                    <td colspan=\"6\" class=\"tabtitle none_rline\">{%LeagueName}</td>
                    <td colspan=\"3\" align=\"right\" valign=\"middle\" class=\"tabtitle none_rline\"><a name=\"btnRefresh_D\"
                                                                                                 class=\"button-ref disabled\"
                                                                                                 disabled><span><div
                           class='iconRefresh wait' title='Xin vui lòng chờ đợi'></div></span></a></td>
                </tr>
                </tbody>
                <tbody id=\"tmplEvent\">
                <tr id=\"e_{%MatchId}_{%MatchCount}_1\" class=\"{@Tr_Cls}\"
                    onmouseover=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','trbgov');\"
                    onmouseout=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','{@BgColor}');\">
                    <td rowspan=\"2\" class=\"text_time\">{%ShowTime}</td>
                    <td rowspan=\"2\" class=\"none_rline\" valign=\"top\">
                        <div class=\"{@Home_Cls} team_name_pad\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\">{%HomeName}</div>
                        <div class=\"{@Away_Cls} team_name_pad\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\">{%AwayName}</div>
                        <div class=\"team_name_pad\">{@Draw}</div>
                        <a href=\"javascript:;\" onclick=\"showHistory('{%HomeName}','{%AwayName}')\" class=\"team_name_pad\">Phong độ</a>
                    </td>
                    <td align=\"right\" rowspan=\"2\" nowrap=\"nowrap\">{@SportRadarInfo}{@Streaming}<!--{@Favorites}--></td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{@Value_1_H}</span><br/>
                            <span class=\"ValueClass\">{@Value_1_A}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_1}\"><span class=\" {@Odds_1_H_Cls}\">{@Odds_1_H}</span><br/>
                            <span class=\" {@Odds_1_A_Cls}\">{@Odds_1_A}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{%Goal_3}</span><br/>
                            <span class=\"ValueClass\">{@UNDER_3}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_3}\"><span class=\" {@Odds_3_O_Cls}\">{@Odds_3_O}</span><br/>
                            <span class=\" {@Odds_3_U_Cls}\">{@Odds_3_U}</span></div>
                    </td>
                    <td rowspan=\"2\" align=\"right\" valign=\"top\" class=\"tabt_R\">
                        <div class=\"{%Changed_5}\"><span class=\" {@Odds_5_1_Cls}\">{%Odds_5_1}</span><br/>
                            <span class=\" {@Odds_5_2_Cls}\">{%Odds_5_2}</span><br/>
                            <span class=\" {@Odds_5_X_Cls}\">{%Odds_5_X}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{@Value_7_H}</span><br/>
                            <span class=\"ValueClass\">{@Value_7_A}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_7}\"><span class=\" {@Odds_7_H_Cls}\">{@Odds_7_H}</span><br/>
                            <span class=\" {@Odds_7_A_Cls}\">{@Odds_7_A}</span></div>
                    </td>
                    <td valign=\"top\">
                        <div class=\"line_divL\"><span class=\"ValueClass\">{%Goal_8}</span><br/>
                            <span class=\"ValueClass\">{@UNDER_8}</span></div>
                        <div class=\"line_divR OddsDiv {%Changed_8}\"><span class=\" {@Odds_8_O_Cls}\">{@Odds_8_O}</span><br/>
                            <span class=\" {@Odds_8_U_Cls}\">{@Odds_8_U}</span></div>
                    </td>
                    <td rowspan=\"2\" align=\"right\" valign=\"top\">
                        <div class=\"{%Changed_15}\"><span class=\" {@Odds_15_1_Cls}\">{%Odds_15_1}</span><br/>
                            <span class=\" {@Odds_15_2_Cls}\">{%Odds_15_2}</span><br/>
                            <span class=\" {@Odds_15_X_Cls}\">{%Odds_15_X}</span></div>
                    </td>
                    <td rowspan=\"2\" align=\"center\" class=\"none_rline\"><!--{@ScoreMap}-->
                        <div>{@StatsInfo}</div>
                    </td>
                </tr>
                <tr id=\"e_{%MatchId}_{%MatchCount}_2\" class=\"{@Tr_Cls}\"
                    onmouseover=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','trbgov');\"
                    onmouseout=\"changeBGClass2('e_{%MatchId}_{%MatchCount}','{@BgColor}');\">
                </tr>
                <tr class=\"tabtitle Alpha {@Display_More}\">
                    <td class=\"moreBetType tag {@Display_More} none_rline\" colspan=\"10\">{@MoreData}</td>
                </tr>
                </tbody>
            </table>
            <span id=\"tmplEnd\"></span>
            </body>
            </html>";
        echo $form;
        exit();
    }

    public function getUrl()
    {
        $home = $this->input->get('home', TRUE);
        $away = $this->input->get('away', TRUE);
        $this->output->set_content_type('application/json');

        $home_team = $this->mdl_teams->where('alias','LIKE',$this->gen_slug($home))->get();
        $away_team = $this->mdl_teams->where('alias','LIKE',$this->gen_slug($away))->get();

        if ($home_team && $away_team) {
            $link= base_url().'phong-do-' . $home_team->alias . '-vs-' . $away_team->alias . '-' . $home_team->team_id . '-' . $away_team->team_id . '.html';
        } else {
            $link = '#';
        }
        echo json_encode($link);
        exit();
    }

    public function ajaxLoad()
    {
        $this->output->set_content_type('application/json');

        $data = json_decode(file_get_contents('http://bongda.wap.vn/refresh_data_content.jsp'));

        echo json_encode($data);
        exit();
    }

    public function gen_slug($str)
    {
        $a = array(
            'À',
            'Á',
            'Â',
            'Ã',
            'Ä',
            'Å',
            'Æ',
            'Ç',
            'È',
            'É',
            'Ê',
            'Ë',
            'Ì',
            'Í',
            'Î',
            'Ï',
            'Ð',
            'Ñ',
            'Ò',
            'Ó',
            'Ô',
            'Õ',
            'Ö',
            'Ø',
            'Ù',
            'Ú',
            'Û',
            'Ü',
            'Ý',
            'ß',
            'à',
            'á',
            'â',
            'ã',
            'ä',
            'å',
            'æ',
            'ç',
            'è',
            'é',
            'ê',
            'ë',
            'ì',
            'í',
            'î',
            'ï',
            'ñ',
            'ò',
            'ó',
            'ô',
            'õ',
            'ö',
            'ø',
            'ù',
            'ú',
            'û',
            'ü',
            'ý',
            'ÿ',
            'A',
            'a',
            'A',
            'a',
            'A',
            'a',
            'C',
            'c',
            'C',
            'c',
            'C',
            'c',
            'C',
            'c',
            'D',
            'd',
            'Ð',
            'd',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'G',
            'g',
            'G',
            'g',
            'G',
            'g',
            'G',
            'g',
            'H',
            'h',
            'H',
            'h',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            '?',
            '?',
            'J',
            'j',
            'K',
            'k',
            'L',
            'l',
            'L',
            'l',
            'L',
            'l',
            '?',
            '?',
            'L',
            'l',
            'N',
            'n',
            'N',
            'n',
            'N',
            'n',
            '?',
            'O',
            'o',
            'O',
            'o',
            'O',
            'o',
            'Œ',
            'œ',
            'R',
            'r',
            'R',
            'r',
            'R',
            'r',
            'S',
            's',
            'S',
            's',
            'S',
            's',
            'Š',
            'š',
            'T',
            't',
            'T',
            't',
            'T',
            't',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'W',
            'w',
            'Y',
            'y',
            'Ÿ',
            'Z',
            'z',
            'Z',
            'z',
            'Ž',
            'ž',
            '?',
            'ƒ',
            'O',
            'o',
            'U',
            'u',
            'A',
            'a',
            'I',
            'i',
            'O',
            'o',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            '?',
            '?',
            '?',
            '?',
            '?',
            '?'
        );
        $b = array(
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'AE',
            'C',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'D',
            'N',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'Y',
            's',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'ae',
            'c',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'n',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'y',
            'y',
            'A',
            'a',
            'A',
            'a',
            'A',
            'a',
            'C',
            'c',
            'C',
            'c',
            'C',
            'c',
            'C',
            'c',
            'D',
            'd',
            'D',
            'd',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'G',
            'g',
            'G',
            'g',
            'G',
            'g',
            'G',
            'g',
            'H',
            'h',
            'H',
            'h',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'IJ',
            'ij',
            'J',
            'j',
            'K',
            'k',
            'L',
            'l',
            'L',
            'l',
            'L',
            'l',
            'L',
            'l',
            'l',
            'l',
            'N',
            'n',
            'N',
            'n',
            'N',
            'n',
            'n',
            'O',
            'o',
            'O',
            'o',
            'O',
            'o',
            'OE',
            'oe',
            'R',
            'r',
            'R',
            'r',
            'R',
            'r',
            'S',
            's',
            'S',
            's',
            'S',
            's',
            'S',
            's',
            'T',
            't',
            'T',
            't',
            'T',
            't',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'W',
            'w',
            'Y',
            'y',
            'Y',
            'Z',
            'z',
            'Z',
            'z',
            'Z',
            'z',
            's',
            'f',
            'O',
            'o',
            'U',
            'u',
            'A',
            'a',
            'I',
            'i',
            'O',
            'o',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'A',
            'a',
            'AE',
            'ae',
            'O',
            'o'
        );
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''),
            str_replace($a, $b, $str)));
    }



    public function processLive()
    {
        $data = file_get_contents('http://bongda.wap.vn/process-live.jsp');
        echo $data;
        exit();
    }

    public function processWebLive()
    {
        $html = file_get_contents('http://bongda.wap.vn/process-web-live.jsp');
        echo $html;
        exit();
    }
}