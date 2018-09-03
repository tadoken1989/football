@extends('layouts.app')
@section('content')
    @if($fixture)
        <?php
        $lineUp = get_line_up_match(str_replace('sr:match:', '', $fixture->sport_event['id']));
        if (isset($lineUp->lineups)) {
            $lineUpHomeInfo = $lineUp->lineups[0];
            $lineUpAwayInfo = $lineUp->lineups[1];
            $homeLineUp = [];
            $awayLineUp = [];
            $rows = [];
            $i = 0;
            $j = 0;
            foreach ($lineUpHomeInfo['starting_lineup'] as $info) {
                $rows[$i][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                    'color' => getColorByPosition($info['type']),
                    'type' => $info['type'],
                );
                $i++;
                $homeLineUp[$info['type']][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                );
            }

            $substitutes = [];
            $x = 0;
            $y = 0;

            foreach ($lineUpHomeInfo['substitutes'] as $info) {
                $substitutes[$x][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                );
                $x++;
            }

            foreach ($lineUpAwayInfo['starting_lineup'] as $info) {
                $rows[$j][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                    'color' => getColorByPosition($info['type']),
                    'type' => $info['type'],
                );
                $j++;
                $awayLineUp[$info['type']][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                );
            }

            foreach ($lineUpAwayInfo['substitutes'] as $info) {
                $substitutes[$y][] = array(
                    'name' => implode(' ', array_reverse(explode(',', $info['name']))),
                    'jersey_number' => $info['jersey_number'],
                );
                $y++;
            }
        }
        $home = slug($fixture->sport_event['competitors'][0]['name']);
        $away = slug($fixture->sport_event['competitors'][1]['name']);
        $homeId = str_replace('sr:competitor:', '', $fixture->sport_event['competitors'][0]['id']);
        $awayId = str_replace('sr:competitor:', '', $fixture->sport_event['competitors'][1]['id']);
        $matchId = str_replace('sr:match:', '', $fixture->sport_event['id']);

        $data = [];
        $data['home_team']['alias'] = $home;
        $data['away_team']['alias'] = $away;
        $data['fixture_matches_id'] = $matchId;

        $data = json_decode(json_encode($data), FALSE);
        ?>
        <div class="New_col-centre">
            <div class="trd_bg">
                <center>

                    <div class="trd_td bogoc bongdo">
                        <a style="color: #C83233;">
                            {{ $fixture->sport_event['tournament']['name'] }}<br>
                        </a>
                        <span>SSPORT, K+1</span>
                    </div>
                    <div class="trd_kcach">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="trd_ts_l">
                                    <img class="img_web"
                                         onerror="this.src='http://static.bongda.wap.vn/images/nophoto.jpg'"
                                         title="Chelsea" src="">
                                </td>
                                <td class="trd_ts_c">
                                    @if(isset($fixture->sport_event_status['home_score']))

                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="trd_ts2">FT</td>
                                            </tr>
                                            <tr>
                                                <td class="trd_ts1">
                                                    <div id="match_tiso"><span id="ts_434295">{{ $fixture->sport_event_status['home_score'] }}
                                                            - {{ $fixture->sport_event_status['away_score'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                @if(isset($fixture->sport_event_status['period_scores']))
                                                    <td class="trd_ts3">{{ $fixture->sport_event_status['period_scores'][0]['home_score'] }}
                                                        - {{ $fixture->sport_event_status['period_scores'][0]['away_score'] }}</td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                                <td class="trd_ts_r">
                                    <img class="img_web"
                                         onerror="this.src='http://static.bongda.wap.vn/images/nophoto.jpg'"
                                         title="Watford" src="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if(isset($fixture->sport_event['venue']['name']))
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td class="trd_ts2">{{ $fixture->sport_event['venue']['name'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="tendoi">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="trd_ts_l1">
                                    <b class="cam">
                                        ({{ getFirstLetter($fixture->sport_event['competitors'][0]['name']) }})
                                    </b>
                                    <b class="xam">{{ $fixture->sport_event['competitors'][0]['name'] }}</b><br>
                                </td>
                                <td class="trd_ts_c1"></td>
                                <td class="trd_ts_r1">
                                    <b class="xam">{{ $fixture->sport_event['competitors'][1]['name'] }}</b>
                                    <b class="tim">
                                        ({{ getFirstLetter($fixture->sport_event['competitors'][1]['name']) }})
                                    </b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </center>
            </div>

            <div class="menu_trd" id="nav">
                <a id="tt_m" class="current kc_menu_trd" style="display:;"
                   href="{{ route_truc_tiep(null, null, null, null, null, (array)$fixture) }}">Tường thuật</a>
                <a id="pd_m" class="kc_menu_trd"
                   href="{{ route_phong_do_doi_dau($home, $away, $homeId, $awayId, $matchId) }}">Phong độ</a>
                <a id="tl_m" class="kc_menu_trd" href="{{ route_ty_le($data) }}">Tỷ lệ</a>
            </div>
            <div id="content">
                <div class="drop">&nbsp;</div>
                <div style="display: block;" id="temp_tyso"></div>
                <div class="trd_bgtk">
                    <h2 class="bg_h2">Đội hình {{ $fixture->sport_event['competitors'][0]['name'] }}
                        vs {{ $fixture->sport_event['competitors'][1]['name'] }}</h2>
                    <div align="center">

                        <link href="http://static.bongda.wap.vn/css/tactics.css" rel="stylesheet" type="text/css">
                        <div>
                            <div class="team clearfix">
                                <article>
                                    <ul id="fld1" class="field_web">
                                        @if (isset($homeLineUp['goalkeeper']))
                                            <li id="fld1tkn1" class="token posGK" style="top: 48%; left: 5%;">
                                                <div class="team_tm_web team_tm_item_web">
                                                    <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                        {{ $homeLineUp['goalkeeper'][0]['jersey_number'] }}
                                                    </div>
                                                </div>
                                                <var class="tknName"
                                                     data-name="{{ $homeLineUp['goalkeeper'][0]['name'] }}">
                    <span class="text">
                        <span title="Begovic" class="plyr">{{ $homeLineUp['goalkeeper'][0]['name'] }}</span>
                        <br>
                    </span>
                                                </var>
                                            </li>
                                        @endif
                                        @if (isset($homeLineUp['defender']))
                                            @foreach($homeLineUp['defender'] as $index => $defender)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($homeLineUp['defender']), $index) }}%; left: 15%;">
                                                    <div class="home_team_web home_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $defender['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $defender['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if (isset($homeLineUp['midfielder']))

                                            @foreach($homeLineUp['midfielder'] as $index => $midfielder)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($homeLineUp['midfielder']), $index) }}%; left: 30%;">
                                                    <div class="home_team_web home_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $midfielder['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $midfielder['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if(isset($homeLineUp['forward']))
                                            @foreach($homeLineUp['forward'] as $index => $forward)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($homeLineUp['forward']), $index) }}%; left: 42%;">
                                                    <div class="home_team_web home_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $forward['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $forward['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif

                                        @if(isset($awayLineUp['goalkeeper']))

                                            <li id="fld1tkn1" class="token posGK" style="top: 48%; left: 95%;">
                                                <div class="team_tm_web team_tm_item_web">
                                                    <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                        {{ $awayLineUp['goalkeeper'][0]['jersey_number'] }}
                                                    </div>
                                                </div>
                                                <var class="tknName"
                                                     data-name="{{ $awayLineUp['goalkeeper'][0]['name'] }}">
                    <span class="text">
                        <span title="Begovic" class="plyr">{{ $awayLineUp['goalkeeper'][0]['name'] }}</span>
                        <br>
                    </span>
                                                </var>
                                            </li>
                                        @endif
                                        @if(isset($awayLineUp['defender']))

                                            @foreach($awayLineUp['defender'] as $index => $defender)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($awayLineUp['defender']), $index) }}%; left: 85%;">
                                                    <div class="away_team_web away_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $defender['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $defender['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if(isset($awayLineUp['midfielder']))

                                            @foreach($awayLineUp['midfielder'] as $index => $midfielder)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($awayLineUp['midfielder']), $index) }}%; left: 70%;">
                                                    <div class="away_team_web away_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $midfielder['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $midfielder['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if(isset($awayLineUp['forward']))
                                            @foreach($awayLineUp['forward'] as $index => $forward)
                                                <li id="fld1tkn6" class="token posDL"
                                                    style="top: {{ getPercent(count($awayLineUp['forward']), $index) }}%; left: 57%;">
                                                    <div class="away_team_web away_team_item_web">
                                                        <div style="position: absolute; top: 7px; text-align: center; width: 100%; font-family: tahoma, verdana, arial; font-size: 11px; font-weight: bold; padding-left: 1px; color: #353535;">
                                                            {{ $forward['jersey_number'] }}
                                                        </div>
                                                    </div>
                                                    <var class="tknName" data-name="J. Stanislas">
                    <span class="text">
                        <span title="J. Stanislas" class="plyr">{{ $forward['name'] }}</span>
                        <br>
                    </span>
                                                    </var>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>


                    <div class="trd_doihinh">
                        @if($lineUp)
                            <div class="DH">
                                <div class="DH_left">{{ $fixture->sport_event['competitors'][0]['name'] }}
                                    <span> ({{ isset($lineUp->lineups[0]['formation']) ? $lineUp->lineups[0]['formation'] : 'No info' }}
                                        )</span></div>
                                <div class="DH_right">
                                    <span>({{ isset($lineUp->lineups[1]['formation']) ? $lineUp->lineups[1]['formation'] : 'No info' }}
                                        )</span>{{ $fixture->sport_event['competitors'][1]['name'] }}</div>
                                <div class="both"></div>
                            </div>
                            <div style="background-color:#FFF">
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tbody>
                                    @foreach($rows as $row)
                                        <tr>
                                            <td width="3%;" style="text-align: left;color:{{ $row[0]['color'] }}">
                                                <div class="float-left number positionTM"
                                                     style="background:{{ $row[0]['color'] }}">{{ $row[0]['jersey_number'] }}</div>
                                            </td>
                                            <td width="20%;" style="text-align: left;color:#018486;"><span
                                                        style="float: left;">{{ $row[0]['name'] }}</span>&nbsp;&nbsp;
                                            </td>
                                            <td width="20%;" style="text-align: right;color:#018486;"><span
                                                        style="float: right;">{{ $row[1]['name'] }}</span> &nbsp;&nbsp;
                                            </td>
                                            <td width="3%;" style="text-align: right;color:{{ $row[1]['color'] }};">
                                                <div class="float-right number positionTM"
                                                     style="background:{{ $row[1]['color'] }}">{{ $row[1]['jersey_number'] }}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <div style="border-bottom: 1px solid #C1C1C1;"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td align="center" colspan="6" class="DH"><b>Dự bị</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div style="border-bottom: 1px solid #C1C1C1;"></div>
                                        </td>
                                    </tr>
                                    @foreach($substitutes as $substitute)
                                        <tr>
                                            @if(isset($substitute[0]))
                                                <td width="3%;" style="text-align: left;color:#666666;">
                                                    <div class="float-left number positionDB">{{ $substitute[0]['jersey_number'] }}</div>
                                                </td>
                                                <td width="20%;" style="text-align: left;color:#666666;"><span
                                                            style="float: left;">{{ $substitute[0]['name'] }}</span>&nbsp;&nbsp;
                                                </td>
                                            @endif
                                            @if(isset($substitute[1]))
                                                <td width="20%;" style="text-align: right;color:#666666;"><span
                                                            style="float: right;">{{ $substitute[1]['name'] }}</span>
                                                    &nbsp;&nbsp;
                                                </td>
                                                <td width="3%;" style="text-align: right;color:#666666;">
                                                    <div class="float-right number positionDB">{{ $substitute[1]['jersey_number'] }}</div>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <div style="border-bottom: 1px solid #C1C1C1;"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    @if($fixture && isset($fixture->statistics) && isset($fixture->statistics['teams'][0]['statistics']))
                    <div style="margin-top: 5px;"></div>
                    <h2 class="bg_h2">Thống kê</h2>
                    @if(isset($fixture->statistics['teams'][0]['statistics']['ball_possession'] ))
                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: {{ $fixture->statistics['teams'][0]['statistics']['ball_possession'] }}%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['ball_possession']) ? $fixture->statistics['teams'][0]['statistics']['ball_possession'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Kiểm soát bóng</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: {{ $fixture->statistics['teams'][1]['statistics']['ball_possession'] }}%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['ball_possession']) ? $fixture->statistics['teams'][1]['statistics']['ball_possession'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>
                     @endif

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: {{ isset($fixture->statistics['teams'][0]['statistics']['throw_ins']) ? $fixture->statistics['teams'][0]['statistics']['throw_ins'] : '0' }}%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['throw_ins']) ? $fixture->statistics['teams'][0]['statistics']['throw_ins'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Ném biên</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: {{ isset($fixture->statistics['teams'][1]['statistics']['throw_ins']) ? $fixture->statistics['teams'][1]['statistics']['throw_ins'] : '0' }}%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['throw_ins']) ? $fixture->statistics['teams'][1]['statistics']['throw_ins'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: {{ isset($fixture->statistics['teams'][0]['statistics']['shots_off_target']) ? $fixture->statistics['teams'][0]['statistics']['shots_off_target'] : '0' }}%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['shots_off_target']) ? $fixture->statistics['teams'][0]['statistics']['shots_off_target'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Số pha dứt điểm</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: {{ isset($fixture->statistics['teams'][1]['statistics']['shots_off_target']) ? $fixture->statistics['teams'][1]['statistics']['shots_off_target'] : '0' }}%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['shots_off_target']) ? $fixture->statistics['teams'][1]['statistics']['shots_off_target'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 46.666666666666664%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['free_kicks']) ? $fixture->statistics['teams'][0]['statistics']['free_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Đá phạt</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 53.333333333333336%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['free_kicks']) ? $fixture->statistics['teams'][1]['statistics']['free_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 46.666666666666664%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['goal_kicks']) ? $fixture->statistics['teams'][0]['statistics']['goal_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Phát bóng</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 53.333333333333336%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['goal_kicks']) ? $fixture->statistics['teams'][1]['statistics']['goal_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>


                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 50.0%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['corner_kicks']) ? $fixture->statistics['teams'][0]['statistics']['corner_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Phạt góc</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 50.0%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['corner_kicks']) ? $fixture->statistics['teams'][1]['statistics']['corner_kicks'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 50.0%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['offsides']) ? $fixture->statistics['teams'][0]['statistics']['offsides'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Việt vị</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 50.0%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['offsides']) ? $fixture->statistics['teams'][1]['statistics']['offsides'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>


                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 46.666666666666664%">
                                <span class="text_left"> {{ isset($fixture->statistics['teams'][0]['statistics']['shots_on_target']) ? $fixture->statistics['teams'][0]['statistics']['shots_on_target'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Sút trúng đích</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 53.333333333333336%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['shots_on_target']) ? $fixture->statistics['teams'][1]['statistics']['shots_on_target'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 61.53846153846154%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['shots_saved']) ? $fixture->statistics['teams'][0]['statistics']['shots_saved'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Cứu thua</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 38.46153846153847%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['shots_saved']) ? $fixture->statistics['teams'][1]['statistics']['shots_saved'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>


                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: {{ isset($fixture->statistics['teams'][0]['statistics']['injuries']) ? $fixture->statistics['teams'][0]['statistics']['injuries'] : '0' }}%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['injuries']) ? $fixture->statistics['teams'][0]['statistics']['injuries'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Chấn thuơng</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: {{ isset($fixture->statistics['teams'][1]['statistics']['injuries']) ? $fixture->statistics['teams'][1]['statistics']['injuries'] : '0' }}%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['injuries']) ? $fixture->statistics['teams'][1]['statistics']['injuries'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>

                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: {{ isset($fixture->statistics['teams'][0]['statistics']['fouls']) ? $fixture->statistics['teams'][0]['statistics']['fouls'] : '0' }}%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['fouls']) ? $fixture->statistics['teams'][0]['statistics']['fouls'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Phạm lỗi</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: {{ isset($fixture->statistics['teams'][1]['statistics']['fouls']) ? $fixture->statistics['teams'][1]['statistics']['fouls'] : '0' }}%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['fouls']) ? $fixture->statistics['teams'][1]['statistics']['fouls'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>
                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 50%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['red_cards']) ? $fixture->statistics['teams'][0]['statistics']['red_cards'] : '0'}}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Thẻ đỏ</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 50%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['red_cards']) ? $fixture->statistics['teams'][1]['statistics']['red_cards'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>
                    <div class="TK_moi">
                        <div class="TK_moi_1">
                            <div class="box_TK_moi_1 bg_box_TK_moi_1" style="width: 40.0%">
                                <span class="text_left">{{ isset($fixture->statistics['teams'][0]['statistics']['yellow_cards']) ? $fixture->statistics['teams'][0]['statistics']['yellow_cards'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="TK_moi_2">Thẻ vàng</div>
                        <div class="TK_moi_3">
                            <div class="box_TK_moi_3 bg_box_TK_moi_3" style="width: 50.0%">
                                <span class="text_right">{{ isset($fixture->statistics['teams'][1]['statistics']['yellow_cards']) ? $fixture->statistics['teams'][1]['statistics']['yellow_cards'] : '0' }}</span>
                            </div>
                        </div>
                        <div class="both"></div>
                    </div>
                    @endif
                </div>

            </div>
            @if($matchTimeLine && isset($matchTimeLine->timeline))
                <div class="trd_tt_ct">
                    <h2 class="bg_h2">Tường thuật</h2>
                    @foreach($matchTimeLine->timeline as $timeLine)
                        @if(array_key_exists('commentaries',$timeLine) &&$timeLine['commentaries'])
                        <ul @if($timeLine['type'] == 'match_started') {{ 'style="background-color: #e3e7dc;"' }} @endif>
                            <li>
                                @if($timeLine['type'] == 'match_started')
                                    <img src="http://bongda.wap.vn/images/gamestart.png" alt="" width="16">&nbsp;&nbsp;
                                @elseif($timeLine['type'] == 'substitution')
                                    <img src="http://bongda.wap.vn/images/substitution.png" alt="" width="16">
                                @elseif($timeLine['type'] == 'score_change')
                                    <img src="http://bongda.wap.vn/images/goal.png" alt="" width="16">
                                @elseif($timeLine['type'] == 'match_ended')
                                    <img src="http://bongda.wap.vn/images/fulltime.png" alt="" width="16">
                                @else
                                    <span style="padding-left: 16px;">&nbsp;&nbsp;</span>
                                @endif
                                @if(array_key_exists('match_time',$timeLine) && $timeLine['match_time']) {{ $timeLine['match_time']  }}' @endif
                                @if(array_key_exists('team',$timeLine) && $timeLine['team'] == 'home')
                                    <a style="margin-left: 1px;padding: 1px 1px;text-align: center;background-color: #FF7E00">&nbsp;</a>
                                @elseif(array_key_exists('team',$timeLine) &&$timeLine['team'] == 'away')
                                    <a style="margin-left: 1px;padding: 1px 1px;text-align: center;background-color: #C71883">&nbsp;</a>
                                @endif
                                @if(array_key_exists('commentaries',$timeLine) &&$timeLine['commentaries'])
                                    @foreach($timeLine['commentaries'] as $commentaries)
                                        @if($timeLine['type'] == 'score_change')
                                            <span class="content_tt" style="color:#FF3300;font-weight:bold;">
                                            {{ $commentaries['text'] }}
                                            </span>
                                        @else
                                            <span class="content_tt">
                                            {{ $commentaries['text'] }}
                                        </span>
                                        @endif
                                    @endforeach
                                @else
                                    @if($timeLine['type'] == 'break_start')
                                            {{ 'H1 Trận đấu kết thúc' }}
                                    @elseif($timeLine['type'] == 'period_start' && $timeLine['period'] == 2 )
                                            {{ 'H2 Bắt đầu' }}
                                    @elseif($timeLine['type'] == 'match_ended')
                                        {{ 'Trận đấu kết thúc' }}
                                    @endif
                                @endif
                                <div style="border-bottom: 1px solid #C1C1C1;"></div>
                            </li>
                        </ul>
                        @endif
                    @endforeach
                </div>
            @endif
            <br>
        </div>
    @endif
@endsection