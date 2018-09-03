@extends('layouts.app')
@section('content')
    <div class="New_col-centre">
        @if($team)
            <form name="formCLB" method="post">
                <div class="CLB_bg">
                    <div style="margin:8px 0 8px 5px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td width="15%" class="CLB_kc">
                                    <img class="CLB_logo"
                                         onerror="this.src='http://static.bongda.wap.vn/images/nophoto.jpg'"
                                         src="http://admin.keobong.info/{{ $team->image }}">
                                </td>
                                <td class="CLB_TT">
                                    <b>Đội:</b> {{ $team->name }}<br>
                                    <b>Sân : {{ $team->stadium }}</b><br>
                                    <b>Quốc gia: {{ $team->country->name }}</b>
                                    <br>
                                    <b>TT Khác: {{ $team->website }}</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="menu_trd">
                        <a id="tab_trandau" href="javascript:void(0);" onclick="showCLB(0);"
                           class="kc_menu_trd selected">Trận
                            đấu</a>
                        <a id="tab_cauthu" href="javascript:void(0);" onclick="showCLB(1);" class="kc_menu_trd">Cầu
                            thủ</a>
                    </div>
                </div>
                <div id="cauthu"
                     style="padding-top: 0px; background-color: rgb(233, 236, 228); text-align: left; display: none;">
                    <div class="sale" style="padding-top:3px;">
                        <h2 class="bg_h2">Danh sách cầu thủ {{ $team->name }}</h2>
                    </div>

                    <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" ;="">
                        <tbody>
                        <tr class="CLB_bang1">
                            <td class="CLB_CT1" style="width: 4%;"><b>Số</b></td>
                            <td class="CLB_CT2"><b>Tên</b></td>
                            <td class="CLB_CT2"><b>Quốc tịch</b></td>
                            <td class="CLB_CT1"><b>Tuổi</b></td>
                        </tr>

                        <tr class="CLB_CT11">
                            <td colspan="3" height="2" bgcolor="#FFFFFF" ;=""></td>
                        </tr>
                        @if($team->players)
                        @foreach($team->players as $key => $player)
                        <tr class="CLB_CT11">
                            <td style="border-radius: 5px;" class="CLB_CT4 number positionTM"> {{ $player->player_number }}</td>
                            <td class="CLB_CT5">
                                <img style="width: 25px;"
                                     src="{{ $player->avatar }}"
                                     onerror="this.src='http://static.bongda.wap.vn/images/player-default.png'">
                                &nbsp;{{ $player->name }}
                            </td>
                            <td class="CLB_CT5">
                                {{ $player->nationality }}
                            </td>
                            <td class="CLB_CT4">{{ countAge($player->birthday) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div style="border-bottom: 1px solid #C1C1C1;"></div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
                <div id="trandau">
                    <h2 class="bg_h2">Kết quả {{ $team->name }}</h2>
                    <div class="LS">
                        <table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tbody>
                            <tr class="bg_LS_web">
                                <td class="LS_a_web">Giải</td>
                                <td class="LS_b_web">Ngày</td>
                                <td class="LS_c_web">TT</td>
                                <td class="LS_d_web">Chủ</td>
                                <td class="LS_e_web">Tỷ số</td>
                                <td class="LS_f_web">Khách</td>
                                <td class="LS_g_web">Hiệp 1</td>
                            </tr>
                            @if($list_history)
                                @foreach($list_history as $key =>$history)
                                    <tr class="@if($key%2 == 0) {{ 'bg_LS2_web' }}@else {{ 'bg_LS3_web' }}@endif">
                                        <td class="LS_1_web"
                                            bgcolor="{{ randomColorFromLeagueId($history->league->id) }}">
                                            <a style="color: #fff;"
                                               href="{{ route_kq_league($history->league->alias,$history->league->id) }}">
                                                {{ getFirstLetter($history->league->name) }}
                                            </a>
                                        </td>
                                        <td class="LS_2_web">
                                            16.10.17
                                        </td>
                                        <td class="LS_3_web">
                                            FT
                                        </td>
                                        <td class="LS_4_web">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_4a_web">
                                    <span style="float: right;">
                                        <sup>&nbsp;</sup>
                                        <a class="xam"
                                           href={{ routes_teams($history->home_team->alias,$history->home_team->team_id) }}>
                                               @if($history->home_team->team_id == $team->team_id)
                                                <b>{{ $history->home_team->name }}</b>
                                            @else
                                                {{ $history->home_team->name }}
                                            @endif
                                        </a>

                                    </span>

                                                        <span style="float: right;" class="card_web red_card_web"
                                                              title="thẻ đỏ">

                                    </span>
                                                        <span style="float: right;" class="card_web yellow_card_web"
                                                              title="thẻ vàng">

                                    </span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_4b_web">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_5_web ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_5a_web"><b class="camdam"><a
                                                                    href="{{ route_truc_tiep($history->home_team->alias, $history->away_team->alias, $history->home_team->team_id, $history->away_team->team_id, $history->match_api_id, null) }}">
                                                                <font color="red"><b>{{ $history->home_goals }}
                                                                        - {{ $history->away_goals }}</b></font> </a></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_5b_web">
                                                        -3/4

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_6_web">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_6a_web">
                                    <span style="float: left;">
                                        <a class="xam"
                                           href="{{ routes_teams($history->away_team->alias,$history->away_team->team_id) }}">
                                                 @if($history->away_team->team_id == $team->team_id)
                                                <b>{{ $history->away_team->name }}</b>
                                            @else
                                                {{ $history->away_team->name }}
                                            @endif
                                        </a>

                                        <sup>&nbsp;</sup>

                                    </span>

                                                        <span style="float: left;" class="card_web red_card_web"
                                                              title="thẻ đỏ">

                                    </span>
                                                        <span style="float: left;" class="card_web yellow_card_web"
                                                              title="thẻ vàng">

                                    </span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_6b_web">&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_7_web"><b>{{ $history->half_time_home_goals }}
                                                - {{ $history->half_time_away_goals }}</b></td>
                                    </tr>
                                @endforeach
                            @endif

                            <tr>
                                <td colspan="10">
                                    <div class="sale">
                                        <h2 class="bg_h2">Lịch thi đấu {{ $team->name }}</h2>
                                    </div>
                                </td>
                            </tr>
                            @if($list_fixtures)
                                @foreach($list_fixtures as $key =>$fixture)
                                    <tr class="@if($key%2 == 0) {{ 'bg_LS2_web' }}@else {{ 'bg_LS3_web' }}@endif">
                                        <td class="LS_1_web" bgcolor="{{randomColorFromLeagueId($fixture->league_id)}}">
                                            <font color="#fff"> {{ getFirstLetter($fixture->league->name) }}</font>
                                        </td>

                                        <td class="LS_2_web">
                                               {{ parseDateTimeToDate($fixture->date) }}
                                        </td>
                                        <td class="LS_3_web">

                                        </td>
                                        <td class="LS_4_web">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_4a_web">
                                    <span style="float: right;">

                                        <sup>&nbsp;</sup>
                                       <a class="xam"
                                          href="{{ routes_teams($fixture->home_team->alias,$fixture->home_team->team_id) }}">
                                                    {{ $fixture->home_team->name }}
                                                </a>

                                    </span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_4b_web">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_5_web ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_5a_web"><b class="camdam"><a
                                                                    href="{{ route_phong_do_doi_dau($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id) }}"><span
                                                                        class="xam"
                                                                        style="font-weight: normal;"> vs </span></a></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_5b_web">

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_6_web">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="LS_6a_web">
                                    <span style="float: left;">
                                        <a class="xam"
                                           href="{{ routes_teams($fixture->away_team->alias,$fixture->away_team->team_id) }}">
                                                    {{ $fixture->away_team->name }}
                                                </a>

                                        <sup>&nbsp;</sup>

                                    </span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="LS_6b_web">&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="LS_7_web"><b>-</b></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
@section('extra-js')
    <script type="text/javascript">
        function showCLB(tab) {
            document.getElementById("tab_trandau").removeAttribute("class");
            document.getElementById("tab_cauthu").removeAttribute("class");

            if (tab == 1) {
                document.getElementById("tab_trandau").setAttribute("class", "kc_menu_trd");
                document.getElementById("tab_cauthu").setAttribute("class", "kc_menu_trd selected");

                document.getElementById("trandau").style.display = "none";
                document.getElementById("cauthu").style.display = "block";
            } else {
                document.getElementById("tab_trandau").setAttribute("class", "kc_menu_trd selected");
                document.getElementById("tab_cauthu").setAttribute("class", "kc_menu_trd");

                document.getElementById("trandau").style.display = "block";
                document.getElementById("cauthu").style.display = "none";
            }
        }
    </script>
@endsection