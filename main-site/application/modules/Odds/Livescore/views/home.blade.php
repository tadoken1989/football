@extends('layouts.app')
@section('extra-css')
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
        }
        tr:nth-child(even) {background-color: #f1f5f7;}
    </style>
@endsection
<script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="application/javascript">
    $( document ).ready(function () {
        $('.hide_result').click(function (e) {
            var tr = this.closest('tr')
            tr.remove()
        })
    })

</script>
@section('extra-js')
@endsection
@section('content')
    <div class="New_col-centre">

        <div class="menubd_3_live" id="livescore_tab">
            <div id="livescore">
                <div class="LS">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="livescore">
                <tbody>
                <tr>
                    <td class="menubd_1a">
                        <a class="icon9">&nbsp;</a>
                    </td>
                    <td class="menubd_1b" id="td_livescore_exp" style="cursor: pointer;">
                        <h2><a class="xam" href="javascript:;"><b>LIVESCORE</b></a></h2>
                        <a class="xanhlacay2" href="javascript:;">Kết quả bóng đá trực tuyến </a>
                        |
                        <a class="xanhlacay2" style="cursor:pointer;" onclick="ShowAllMatch();"><span class="red"
                                                                                                      id="hiddencount">0</span>
                            Trận ẩn</a> |
                        <a class="xanhlacay2" style="cursor:pointer;" onclick="">
                            <img id="icon_sound" onclick="SoundOnSelect(this)"
                                 src="http://www.futbol24.com/i/live/ico_soundon.gif">
                        </a>
                    </td>
                    <td class="menubd_1b" id="td_livescore_col" style="display: none;cursor: pointer;"
                        onclick="expandTab();">
                        <h2><a class="xam" href="javascript:;"><b>LIVESCORE</b></a></h2>
                        <a class="xanhlacay2" href="javascript:;">Kết quả bóng đá trực tuyến</a>
                    </td>
                    <td>
                        <a href="javascript:void(0);">
                            <img id="livescore_exp" onclick="hideTab();"
                                 src="http://static.bongda.wap.vn/images/arr-left.png" alt="Livescore" width="9"
                                 height="16" style="padding-bottom:5px;">
                            <img id="livescore_col" onclick="expandTab();" style="display: none;"
                                 src="http://static.bongda.wap.vn/images/arr-down.png" alt="Livescore" width="14"
                                 height="9">
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
        <div id="livescore">
            <div id="ajax-loadform">
                <div class="drop"></div>
                <div class="LS">
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tbody>
                        <tr class="bg_LS_web">
                            <td class="LS_a_web">Giải</td>
                            <td class="LS_b_web">Giờ</td>
                            <td class="LS_c_web" style="width: 100px">TT</td>
                            <td class="LS_d_web">Chủ</td>
                            <td class="LS_e_web">Tỷ số</td>
                            <td class="LS_f_web">Khách</td>
                            <td class="LS_g_web">Tỷ lệ</td>
                            <td class="LS_g_web">Hiệp 1</td>
                        </tr>
                            @foreach($livescore as $key => $score)
                                @if(isset($score['sport_event_status']['clock']['match_time']))
                                    <tr id="trs_{{ str_replace('sr:match:', '', $score['sport_event']['id']) }}" class="bg_LS2_web">
                                        <td class="LS_1_web" bgcolor="{{randomColorFromLeagueId(str_replace('sr:match:', '', $score['sport_event']['id']))}}">
                                        <span class="lleft">
                                            <img style="cursor:pointer;" src="http://static.bongda.wap.vn/images/lclose.png" class="hide_result">
                                        </span>
                                            <span class="lright">
                                            <a style="color: #fff;">
                                                {{ getFirstLetter($score['sport_event']['tournament']['name']) }}</a>
                                        </span>
                                        </td>
                                        <td class="LS_2_web"> {{ parseDateTime($score['sport_event']['scheduled']) }}</td>
                                        <td class="LS_3_web" style="text-align: center">
                                            <img src="http://static.bongda.wap.vn/images/flash.gif">
                                            {{ substr_replace($score['sport_event_status']['clock']['match_time'], '', 2) }}'
                                        </td>
                                        <td class="LS_4_web">
                                            {{ $score['sport_event']['competitors'][0]['name'] }}
                                        </td>
                                        <td class="LS_5_web " style="text-align: center">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_5a_web">
                                                        <a href="{{ route_truc_tiep(null, null, null, null, null, $score) }}">
                                                            <b id="ts_467116" class="camdam">
                                                                <span id="ts1_467116">{{ $score['sport_event_status']['home_score'] }}</span>
                                                                -
                                                                <span id="ts2_467116">{{ $score['sport_event_status']['away_score'] }}</span>
                                                            </b></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                        <td class="LS_6_web">
                                            {{ $score['sport_event']['competitors'][1]['name'] }}
                                        </td>
                                        <td class="LS_7_web" style="color: #A0522D;"> {{ rand(-1,5) }}/{{ rand(1,5) }}</td>
                                        <td class="LS_7_web">
                                            @if(isset($score['sport_event_status']['period_scores'][1]))
                                                {{ $score['sport_event_status']['period_scores'][0]['home_score'] }} - {{$score['sport_event_status']['period_scores'][0]['away_score'] }}
                                            @endif
                                            @if($score['sport_event_status']['match_status'] == '1st_half')
                                                {{ $score['sport_event_status']['home_score'] }} - {{$score['sport_event_status']['away_score'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        @if($list_fixture)
                            @foreach($list_fixture as $key => $fixture)
                                <tr id="trs_{{ $fixture->fixture_matches_id }}" class="bg_LS2_web">
                                    <td class="LS_1_web" bgcolor="{{randomColorFromLeagueId($fixture->league_id)}}"><span class="lleft"><img
                                                    style="cursor:pointer;"
                                                    onclick="hidematch('{{ $fixture->fixture_matches_id }}');"
                                                    src="http://static.bongda.wap.vn/images/lclose.png"></span><span
                                                class="lright"><a style="color: #fff;"
                                                                  href="{{ route_kq_league($fixture->league->alias,$fixture->league->id) }}">{{ getFirstLetter($fixture->league->name) }}</a></span>
                                    </td>
                                    <td class="LS_2_web"> {{ parseDateTime($fixture->date) }}</td>
                                    <td id="cols1_{{ $fixture->fixture_matches_id }}" class="LS_3_web">
                                        {{--<img src="http://static.bongda.wap.vn/images/flash.gif"> 89'--}}
                                    </td>
                                    <td class="LS_4_web">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td id="fteam_{{ $fixture->fixture_matches_id }}" class="LS_4a_web"><span
                                                            style="float: right;"><sup>[{{ $fixture->round }}]</sup><a class="xam" href="{{ routes_teams($fixture->home_team->alias,$fixture->home_team->team_id) }}"> {{ $fixture->home_team->name }}</a></span><span
                                                            id="fred_{{ $fixture->fixture_matches_id }}" style="float: right;"
                                                            class="card_web red_card_web"
                                                            title="thẻ đỏ"></span><span style="float: right;"
                                                                                        id="fyellow_{{ $fixture->fixture_matches_id }}"
                                                                                        class="card_web yellow_card_web"
                                                                                        title="thẻ vàng"></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="LS_5_web ">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="LS_5a_web"><a href="{{ route_phong_do_doi_dau($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_api_id) }}"><b
                                                                id="ts_{{ $fixture->fixture_matches_id }}" class="camdam"><span
                                                                    id="ts1_{{ $fixture->fixture_matches_id }}">?</span> -
                                                            <span id="ts2_{{ $fixture->fixture_matches_id }}">?</span></b></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="LS_6_web">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td id="steam_{{ $fixture->fixture_matches_id }}" class="LS_6a_web"><span style="float: left;"><a
                                                                class="xam" href="{{ routes_teams($fixture->away_team->alias,$fixture->away_team->team_id) }}"></a>{{ $fixture->away_team->name }}<sup></sup>&nbsp;</span><span
                                                            style="float: left;" id="sred_{{ $fixture->fixture_matches_id }}"
                                                            class="card_web red_card_web"
                                                            title="thẻ đỏ"></span><span style="float: left;"
                                                                                        id="syellow_{{ $fixture->fixture_matches_id }}"
                                                                                        class="card_web yellow_card_web"
                                                                                        title="thẻ vàng"></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="LS_7_web" style="color: #A0522D;"> {{ rand(-1,5) }}/{{ rand(1,5) }}</td>
                                    <td id="tsh1_{{ $fixture->fixture_matches_id }}" class="LS_7_web"><strong>-</strong></td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <div style="background-color:#c1c1c1; height:1px;"></div>
            </div>
        </div>

    </div>
@endsection
