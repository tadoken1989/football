@extends('layouts.app')
@section('content')
    @if($match)
    <div class="New_col-centre">
        <div class="trd_bg">
            <center>
                <div class="trd_td bogoc bongdo">
                    <a style="color: #C83233;" href="http://bongda.wap.vn/ket-qua-cup-c1-chau-au-c1.html">
                        {{ getFirstLetter($league->name) }}<span
                                style="font-weight: normal;color: #C83233;">, Vòng {{ $match->round }}</span><br>
                    </a>
                    <span></span>
                </div>
                <div class="trd_kcach">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="trd_ts_l">
                                <img class="img_web" title="Maribor"
                                     src="http://static.bongda.wap.vn/images/nophoto.jpg">
                            </td>
                            <td class="trd_ts_c">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td class="trd_ts2"><span id="cols1_453235"><b class="xam">{{ parseDateTime($match->date) }}
                                                    <br> {{ parseDateTimeToDate($match->date) }}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td class="trd_ts1">
                                            <div id="match_tiso"><span id="ts_453235"></span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="trd_ts3">(-)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="trd_ts_r">
                                <img class="img_web" title="Liverpool"
                                     src="http://static.bongda.wap.vn/images/nophoto.jpg">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tendoi">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="trd_ts_l1">
                                <b class="cam">
                                    {{ getFirstLetter($match->home_team->name) }}
                                </b>
                                <b class="xam">{{ $match->home_team->name }}</b><br>
                            </td>
                            <td class="trd_ts_c1"></td>
                            <td class="trd_ts_r1">
                                <b class="xam">{{ $match->away_team->name }}</b>
                                <b class="tim">
                                    {{ getFirstLetter($match->away_team->name) }}
                                </b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div>

                </div>
            </center>
        </div>

        <div class="menu_trd" id="nav">
            <a id="tt_m" style="display:;" href="{{ route_truc_tiep($match->home_team->alias, $match->away_team->alias, $match->home_team->team_id, $match->away_team->team_id, $match->fixture_matches_id, null) }}#nav"
               class="kc_menu_trd">Tường thuật</a>

            <a id="pd_m" class="current kc_menu_trd" href="{{ route_phong_do_doi_dau($match->home_team->alias, $match->away_team->alias, $match->home_team->team_id, $match->away_team->team_id, $match->fixture_matches_id) }}#nav">Phong
                độ</a>
            <a id="tl_m" href="{{ route_ty_le($match) }}#nav" class="kc_menu_trd">Tỷ lệ</a>

        </div>
        <div style="display: none;" class="div_hid">
            <div style="padding:11px 0 0 8px;">
                <a id="tt_m" style="display:;" href="{{ route_truc_tiep($match->home_team->alias, $match->away_team->alias, $match->home_team->team_id, $match->away_team->team_id, $match->fixture_matches_id, null) }}#nav" class="trd_dh">Tường
                    thuật</a>

                <a id="pd_m" class="current" href="{{ route_phong_do_doi_dau($match->home_team->alias, $match->away_team->alias, $match->home_team->team_id, $match->away_team->team_id, $match->fixture_matches_id) }}#nav">Phong độ</a>
                <a id="tl_m" href="{{ route_truc_tiep($match->home_team->alias, $match->away_team->alias, $match->home_team->team_id, $match->away_team->team_id, $match->fixture_matches_id, null) }}#nav" class="trd_dh">Tỷ lệ</a>
            </div>
        </div>
        <div id="content">
            <div class="drop">&nbsp;</div>
            <div class="trd_phongdo">
                &#65279;
                <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                    <tbody>
                    <tr>
                        <td colspan="9" class="trd_phongdo1">
                            <b>Đối đầu</b>
                        </td>
                    </tr>
                    <tr class="trd_phongdo2">
                        <td class="trd_phongdoweb_1"><b>Giải</b></td>
                        <td class="trd_phongdoweb_1"><b>Ngày</b></td>
                        <td class="trd_phongdoweb_2"><b>Chủ</b></td>
                        <td class="trd_phongdoweb_1"><b>Tỷ số</b></td>
                        <td class="trd_phongdoweb_2"><b>Khách</b></td>
                        <td class="trd_phongdoweb_1"><b>Kèo</b></td>
                        <td class="trd_phongdoweb_1"><b>TX.FT</b></td>
                        <td class="trd_phongdoweb_1"><b>TS.H1</b></td>
                        <td class="trd_phongdoweb_1"><b>TX.H1</b></td>
                    </tr>
                    @if($list_home_away_history)
                        @foreach($list_home_away_history as $h)
                            <tr class="trd_phongdo4">
                                <td class="trd_phongdoweb_3" bgcolor="{{ randomColorFromLeagueId($h->league->id) }}">

                                    <a style="color: #fff;" href="http://bongda.wap.vn/ket-qua-ngoai-hang-anh-anh.html">
                                        {{ getFirstLetter($h->league->name) }}
                                    </a>

                                </td>
                                <td class="trd_phongdoweb_3">{{ date("d.m.Y", strtotime("$h->date")) }}</td>
                                <td class="trd_phongdoweb_3a">{{ $h->home_team->name }}</td>
                                <td class="trd_phongdoweb_3c"><b class="camdam"><b>{{ $h->home_goals }}
                                            - {{ $h->away_goals }}</b></b></td>
                                <td class="trd_phongdoweb_3b">{{ $h->away_team->name }}</td>
                                <td class="trd_phongdoweb_3">
                                    <span style="color:#FF3300;">W</span>

                                </td>
                                <td class="trd_phongdoweb_3">
                                    <span style="color:#6699FF;">X</span>

                                </td>
                                <td class="trd_phongdoweb_3"><b class="camdam">{{ $h->half_time_home_goals }}
                                        -{{ $h->half_time_away_goals }}</b></td>
                                <td class="trd_phongdoweb_3">
                                    <span style="color:#FF3300;">T</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="trd_pdthongke">
                    <span style="float: left;"><b>Thống kê:&nbsp;</b><a class="form-icon form-loss">L</a><a
                                class="form-icon form-loss">L</a><a class="form-icon form-draw">D</a><a
                                class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                class="form-icon form-loss">L</a><a class="form-icon form-loss">L</a><a
                                class="form-icon form-loss">L</a><a class="form-icon form-loss">L</a><a
                                class="form-icon form-loss">L</a></span>
                </div>
                <br>
                <div id="pdChung{{ $match->home_team->alias }}">
                    <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td colspan="9" class="trd_phongdo1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td class="trd_phongdo1a"><b>{{ $match->home_team->name }}</b></td>
                                        <td class="trd_phongdo1b"><a class="trd_phongdo_FT bogocpd1 "
                                                                     href="javascript:view_phong_do(0,'{{ $match->home_team->alias }}');">Tổng</a><a
                                                    class="trd_phongdo_HT bogocpd2 trang"
                                                    href="javascript:view_phong_do(1,'{{ $match->home_team->alias }}');">Sân
                                                Nhà</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="trd_phongdo2">
                            <td class="trd_phongdoweb_1"><b>Giải</b></td>
                            <td class="trd_phongdoweb_1"><b>Ngày</b></td>
                            <td class="trd_phongdoweb_2"><b>Chủ</b></td>
                            <td class="trd_phongdoweb_1"><b>Tỷ số</b></td>
                            <td class="trd_phongdoweb_2"><b>Khách</b></td>
                            <td class="trd_phongdoweb_1"><b>Kèo</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.FT</b></td>
                            <td class="trd_phongdoweb_1"><b>TS.H1</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.H1</b></td>
                        </tr>

                        @if($list_home_history)
                            @foreach($list_home_history as $h)
                                <tr class="trd_phongdo4">
                                    <td class="trd_phongdoweb_3"
                                        bgcolor="{{ randomColorFromLeagueId($h->league->id) }}">

                                        <a style="color: #fff;"
                                           href="http://bongda.wap.vn/ket-qua-cup-c1-chau-au-c1.html">
                                            {{ getFirstLetter($h->league->name) }}
                                        </a>

                                    </td>
                                    <td class="trd_phongdoweb_3">  {{ date("d.m.Y", strtotime("$h->date")) }}</td>
                                    <td class="trd_phongdoweb_3a">{{ $h->home_team->name }}</td>
                                    <td class="trd_phongdoweb_3c"><b class="camdam"><b>{{ $h->home_goals }}
                                                - {{ $h->away_goals }}</b></b></td>
                                    <td class="trd_phongdoweb_3b">{{ $h->away_team->name }}</td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">W</span>

                                    </td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#6699FF;">X</span>

                                    </td>
                                    <td class="trd_phongdoweb_3"><b class="camdam">{{ $h->half_time_home_goals }}
                                            -{{ $h->half_time_away_goals }}</b></td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">T</span>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="trd_pdthongke">
                        <span style="float: left;"><b>Thống kê:&nbsp;</b><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a></span>
                    </div>
                </div> <!-- end div #pdChung -->
                <!-- s div #pdRieng -->
                <div id="pdRieng{{ $match->home_team->alias }}" style="display: none; ">
                    <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td colspan="9" class="trd_phongdo1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td class="trd_phongdo1a"><b>{{ $match->home_team->name }}</b></td>
                                        <td class="trd_phongdo1b"><a class="trd_phongdo_FT bogocpd1 "
                                                                     href="javascript:view_phong_do(0,'{{ $match->home_team->alias }}');">Tổng</a><a
                                                    class="trd_phongdo_HT bogocpd2 trang"
                                                    href="javascript:view_phong_do(1,'{{ $match->home_team->alias }}');">Sân
                                                Nhà</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="trd_phongdo2">
                            <td class="trd_phongdoweb_1"><b>Giải</b></td>
                            <td class="trd_phongdoweb_1"><b>Ngày</b></td>
                            <td class="trd_phongdoweb_2"><b>Chủ</b></td>
                            <td class="trd_phongdoweb_1"><b>Tỷ số</b></td>
                            <td class="trd_phongdoweb_2"><b>Khách</b></td>
                            <td class="trd_phongdoweb_1"><b>Kèo</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.FT</b></td>
                            <td class="trd_phongdoweb_1"><b>TS.H1</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.H1</b></td>
                        </tr>
                        @if($list_home_history)
                            @foreach($list_home_history as $h)
                                <tr class="trd_phongdo4">
                                    <td class="trd_phongdoweb_3"
                                        bgcolor="{{ randomColorFromLeagueId($h->league->id) }}">

                                        <a style="color: #fff;"
                                           href="http://bongda.wap.vn/ket-qua-cup-c1-chau-au-c1.html">
                                            {{ getFirstLetter($h->league->name) }}
                                        </a>

                                    </td>
                                    <td class="trd_phongdoweb_3">  {{ date("d.m.Y", strtotime("$h->date")) }}</td>
                                    <td class="trd_phongdoweb_3a">{{ $h->home_team->name }}</td>
                                    <td class="trd_phongdoweb_3c"><b class="camdam"><b>{{ $h->home_goals }}
                                                - {{ $h->away_goals }}</b></b></td>
                                    <td class="trd_phongdoweb_3b">{{ $h->away_team->name }}</td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">W</span>

                                    </td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#6699FF;">X</span>

                                    </td>
                                    <td class="trd_phongdoweb_3"><b class="camdam">{{ $h->half_time_home_goals }}
                                            -{{ $h->half_time_away_goals }}</b></td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">T</span>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="trd_pdthongke">
                        <span style="float: left;"><b>Thống kê:&nbsp;</b><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-loss">L</a><a
                                    class="form-icon form-loss">L</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a></span>
                    </div>
                </div> <!-- end div #pdRieng -->

                <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                    <tbody>
                    <tr>
                        <td colspan="7" class="trd_phongdo1">
                            <b>Lịch thi đấu {{ $match->home_team->name }}</b>
                        </td>
                    </tr>
                    @if($list_home_fixtures)
                        @foreach($list_home_fixtures as $l)
                            <tr>
                                <td class="LS_1" bgcolor="{{ randomColorFromLeagueId($l->league->id) }}"
                                    style="width: 10%;">

                                    <a style="color: #fff;"
                                       href="http://bongda.wap.vn/ket-qua-lien-doan-anh-league.html">
                                        {{ getFirstLetter($l->league->name) }}
                                    </a>

                                </td>
                                <td class="LS_2_web" style="width: 15%;">
                                    {{ parseDateTime($l->date) }} - {{ parseDateTimeToDate($l->date) }}
                                </td>
                                <td class="LS_4_web" style="width: 20%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_4a_web">
                                                <a class="xam" href="{{ routes_teams($l->home_team->alias,$l->home_team->team_id) }}">
                                                    {{ $l->home_team->name }}
                                                </a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_5_web" style="width: 5%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_5a_web"><b> - </b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_6_web" style="width: 25%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_6a_web">
                                                <a class="xam" href="{{ routes_teams($l->away_team->alias,$l->away_team->team_id) }}">
                                                    {{ $l->away_team->name }}
                                                </a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width: 5%;" class="LS_7_web"><b>&nbsp;</b></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <div id="pdChung{{$match->away_team->alias}}">
                    <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td colspan="9" class="trd_phongdo1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td class="trd_phongdo1a"><b>{{ $match->away_team->name }}</b></td>
                                        <td class="trd_phongdo1b"><a class="trd_phongdo_FT bogocpd1 "
                                                                     href="javascript:view_phong_do(0,'{{ $match->away_team->alias }}');">Tổng</a><a
                                                    class="trd_phongdo_HT bogocpd2 trang"
                                                    href="javascript:view_phong_do(1,'{{ $match->away_team->alias }}');">Sân
                                                Nhà</a></td>

                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="trd_phongdo2">
                            <td class="trd_phongdoweb_1"><b>Giải</b></td>
                            <td class="trd_phongdoweb_1"><b>Ngày</b></td>
                            <td class="trd_phongdoweb_2"><b>Chủ</b></td>
                            <td class="trd_phongdoweb_1"><b>Tỷ số</b></td>
                            <td class="trd_phongdoweb_2"><b>Khách</b></td>
                            <td class="trd_phongdoweb_1"><b>Kèo</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.FT</b></td>
                            <td class="trd_phongdoweb_1"><b>TS.H1</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.H1</b></td>
                        </tr>
                        @if($list_away_history)
                            @foreach($list_away_history as $h)
                                <tr class="trd_phongdo4">
                                    <td class="trd_phongdoweb_3"
                                        bgcolor="{{ randomColorFromLeagueId($h->league->id) }}">

                                        <a style="color: #fff;"
                                           href="http://bongda.wap.vn/ket-qua-cup-c1-chau-au-c1.html">
                                            {{ getFirstLetter($h->league->name) }}
                                        </a>

                                    </td>
                                    <td class="trd_phongdoweb_3">  {{ date("d.m.Y", strtotime("$h->date")) }}</td>
                                    <td class="trd_phongdoweb_3a">{{ $h->home_team->name }}</td>
                                    <td class="trd_phongdoweb_3c"><b class="camdam"><b>{{ $h->home_goals }}
                                                - {{ $h->away_goals }}</b></b></td>
                                    <td class="trd_phongdoweb_3b">{{ $h->away_team->name }}</td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">W</span>

                                    </td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#6699FF;">X</span>

                                    </td>
                                    <td class="trd_phongdoweb_3"><b class="camdam">{{ $h->half_time_home_goals }}
                                            -{{ $h->half_time_away_goals }}</b></td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">T</span>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="trd_pdthongke">
                        <span style="float: left;"><b>Thống kê:&nbsp;</b><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-loss">L</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-loss">L</a><a
                                    class="form-icon form-win">W</a></span>
                    </div>
                </div> <!-- end div #pdChung -->

                <div id="pdRieng{{ $match->away_team->alias }}" style="display: none; ">
                    <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td colspan="9" class="trd_phongdo1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td class="trd_phongdo1a"><b>{{ $match->away_team->name }}</b></td>
                                        <td class="trd_phongdo1b"><a class="trd_phongdo_FT bogocpd1 "
                                                                     href="javascript:view_phong_do(0,'{{ $match->away_team->alias }}');">Tổng</a><a
                                                    class="trd_phongdo_HT bogocpd2 trang"
                                                    href="javascript:view_phong_do(1,'{{ $match->away_team->alias }}');">Sân
                                                Nhà</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="trd_phongdo2">
                            <td class="trd_phongdoweb_1"><b>Giải</b></td>
                            <td class="trd_phongdoweb_1"><b>Ngày</b></td>
                            <td class="trd_phongdoweb_2"><b>Chủ</b></td>
                            <td class="trd_phongdoweb_1"><b>Tỷ số</b></td>
                            <td class="trd_phongdoweb_2"><b>Khách</b></td>
                            <td class="trd_phongdoweb_1"><b>Kèo</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.FT</b></td>
                            <td class="trd_phongdoweb_1"><b>TS.H1</b></td>
                            <td class="trd_phongdoweb_1"><b>TX.H1</b></td>
                        </tr>
                        @if($list_away_history)
                            @foreach($list_away_history as $h)
                                <tr class="trd_phongdo4">
                                    <td class="trd_phongdoweb_3"
                                        bgcolor="{{ randomColorFromLeagueId($h->league->id) }}">

                                        <a style="color: #fff;"
                                           href="http://bongda.wap.vn/ket-qua-cup-c1-chau-au-c1.html">
                                            {{ getFirstLetter($h->league->name) }}
                                        </a>

                                    </td>
                                    <td class="trd_phongdoweb_3">  {{ date("d.m.Y", strtotime("$h->date")) }}</td>
                                    <td class="trd_phongdoweb_3a">{{ $h->home_team->name }}</td>
                                    <td class="trd_phongdoweb_3c"><b class="camdam"><b>{{ $h->home_goals }}
                                                - {{ $h->away_goals }}</b></b></td>
                                    <td class="trd_phongdoweb_3b">{{ $h->away_team->name }}</td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">W</span>

                                    </td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#6699FF;">X</span>

                                    </td>
                                    <td class="trd_phongdoweb_3"><b class="camdam">{{ $h->half_time_home_goals }}
                                            -{{ $h->half_time_away_goals }}</b></td>
                                    <td class="trd_phongdoweb_3">
                                        <span style="color:#FF3300;">T</span>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="trd_pdthongke">
                        <span style="float: left;"><b>Thống kê:&nbsp;</b><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a><a class="form-icon form-loss">L</a><a
                                    class="form-icon form-loss">L</a><a class="form-icon form-win">W</a><a
                                    class="form-icon form-draw">D</a><a class="form-icon form-draw">D</a><a
                                    class="form-icon form-win">W</a></span>
                    </div>
                </div> <!-- end div #pdRieng -->

                <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
                    <tbody>
                    <tr>
                        <td colspan="7" class="trd_phongdo1">
                            <b>Lịch thi đấu {{ $match->away_team->name }}</b>
                        </td>
                    </tr>
                    @if($list_away_fixtures)
                        @foreach($list_away_fixtures as $l)
                            <tr>
                                <td class="LS_1" bgcolor="{{ randomColorFromLeagueId($l->league->id) }}"
                                    style="width: 10%;">

                                    <a style="color: #fff;"
                                       href="http://bongda.wap.vn/ket-qua-lien-doan-anh-league.html">
                                        {{ getFirstLetter($l->league->name) }}
                                    </a>

                                </td>
                                <td class="LS_2_web" style="width: 15%;">
                                    {{ parseDateTime($l->date) }} - {{ parseDateTimeToDate($l->date) }}
                                </td>
                                <td class="LS_4_web" style="width: 20%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_4a_web">
                                                <a class="xam"
                                                   href="{{ routes_teams($l->home_team->alias,$l->home_team->team_id) }}">
                                                    {{ $l->home_team->name }}
                                                </a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_5_web" style="width: 5%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_5a_web"><b> - </b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_6_web" style="width: 25%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_6a_web">
                                                <a class="xam"
                                                   href="{{ routes_teams($l->away_team->alias,$l->away_team->team_id) }}">
                                                    {{ $l->away_team->name }}
                                                </a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width: 5%;" class="LS_7_web"><b>&nbsp;</b></td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

                <div style="text-align:left; background-color:#FFF; padding:3px 0 0 0; margin:3px 0 0 0;">

                    <div class="trd-ttkhac2"><a><b>- Bảng Xếp hạng</b></a></div>
                    <div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr bgcolor="#C83233"
                                style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;"
                                height="19px">
                                <td class="bxh_gd_1">
                                    <b>XH</b>
                                </td>
                                <td class="bxh_gd_2">
                                    <b>Đội</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>Tr</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>T</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>H</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>B</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>BT</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>BB</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>HS</b>
                                </td>
                                <td class="bxh_gd_1">
                                    <b>Đ</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10" height="1px" bgcolor="#FFFFFF"></td>
                            </tr>
                            @if($league_standing & $league->is_cup == 0)
                                @foreach($league_standing as $key => $standing)
                                    <tr class="">
                                        <td class="bxh_gd_1">{{ ++$key }}</td>
                                        <td class="bxh_gd_2">
                                            <a class="xanhbxh" href="{{ routes_teams(slug($standing->team),$standing->team_id) }}">
                                                {{ $standing->team }}
                                            </a>
                                        </td>
                                        <td class="bxh_gd_1">{{ $standing->played }}</td>
                                        <td class="bxh_gd_1">{{ $standing->won }}</td>
                                        <td class="bxh_gd_1">{{ $standing->draw }}</td>
                                        <td class="bxh_gd_1">{{ $standing->lost }}</td>
                                        <td class="bxh_gd_1">{{ $standing->goals_for }}</td>
                                        <td class="bxh_gd_1">{{ $standing->goals_against }}</td>

                                        <td align="center">{{ $standing->goal_difference }}</td>
                                        <td align="center"><b>{{ $standing->points }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="10">
                                            <div style="border-bottom: 1px solid #C1C1C1;"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @if($group_cup)
                                    @foreach($group_cup as $key => $cup)

                                        <tr bgcolor="#B1B1B1" style="font-weight: bold;color: #333333;font-family:Tahoma,Verdana,Arial;" height="19px">
                                            <td colspan="6" style="padding-left: 10px;">
                                                <span style="font-size: 11px;">{{ $cup->name }}</span>
                                            </td>
                                            <td colspan="4" align="right" style="padding-right: 10px;">
                                                <a style="font-weight: normal;color: #333333;font-size: 11px;" href="/">Chi tiết</a>
                                            </td>
                                        </tr>

                                        @foreach(league_team_cup_standing($cup->league_group_id) as $tg => $team_group)
                                            <tr class="">
                                                <td class="bxh_gd_1">{{ ++$tg }}</td>
                                                <td class="bxh_gd_2">
                                                    <a class="xanhbxh" href="{{ routes_teams(slug($team_group->team),$team_group->team_id) }}">
                                                        {{ $team_group->team }}
                                                    </a>
                                                </td>
                                                <td class="bxh_gd_1">{{ $team_group->played }}</td>
                                                <td class="bxh_gd_1">{{ $team_group->won }}</td>
                                                <td class="bxh_gd_1">{{ $team_group->draw }}</td>
                                                <td class="bxh_gd_1">{{ $team_group->lost }}</td>
                                                <td class="bxh_gd_1">{{ $team_group->goals_for }}</td>
                                                <td class="bxh_gd_1">{{ $team_group->goals_against }}</td>
                                                <td class="bxh_gd_1">{{ ($team_group->goal_difference > 0)?"+".$team_group->goal_difference:$team_group->goal_difference }}</td>
                                                <td class="bxh_gd_1"><b>{{ $team_group->points }}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="10">
                                                    <div style="border-bottom: 1px solid #C1C1C1;"></div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                @endif
                            @endif
                            </tbody>
                        </table>
                        <div style="background-color:#FFF; height:2px;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('extra-js')
            <script type="text/javascript">
                function ShowHidden(obj, displayText) {
                    var ele = document.getElementById(obj);
                    var text = document.getElementById(displayText);
                    if (ele.style.overflow == "hidden") {
                        ele.style.overflow = "auto";
                        ele.style.display = "block";
                        ele.style.height = "100%";
                        ele.style.width = "100%";
                        text.innerHTML = "<strong>[-] Bảng xếp hạng Tài Xỉu</strong>";
                    }
                    else {
                        ele.style.overflow = "hidden";
                        ele.style.height = "0px";
                        ele.style.display = "block";
                        text.innerHTML = "<strong>[+] Bảng xếp hạng Tài Xỉu</strong>";
                    }
                }

                function ShowHiddenBXHPhatGoc(obj, displayText) {
                    var ele = document.getElementById(obj);
                    var text = document.getElementById(displayText);
                    if (ele.style.overflow == "hidden") {
                        ele.style.overflow = "auto";
                        ele.style.display = "block";
                        ele.style.height = "100%";
                        ele.style.width = "100%";
                        text.innerHTML = "<strong>[-] Bảng xếp hạng Phạt Góc</strong>";
                    }
                    else {
                        ele.style.overflow = "hidden";
                        ele.style.height = "0px";
                        ele.style.display = "block";
                        text.innerHTML = "<strong>[+] Bảng xếp hạng Phạt Góc</strong>";
                    }
                }

                function hideDiv(value) {
                    var totalc = document.getElementById('totalc');
                    var home = document.getElementById('home');
                    var away = document.getElementById('away');
                    if (value == 1) {
                        totalc.style.display = "none";
                        home.style.display = "";
                        away.style.display = "none";
                    } else if (value == 2) {
                        totalc.style.display = "none";
                        home.style.display = "none";
                        away.style.display = "";
                    } else {
                        totalc.style.display = "";
                        home.style.display = "none";
                        away.style.display = "none";
                    }
                }

                function hideDivTX(value) {
                    var totalc = document.getElementById('totalcTX');
                    var home = document.getElementById('homeTX');
                    var away = document.getElementById('awayTX');
                    if (value == 1) {
                        totalc.style.display = "none";
                        home.style.display = "";
                        away.style.display = "none";
                    } else if (value == 2) {
                        totalc.style.display = "none";
                        home.style.display = "none";
                        away.style.display = "";
                    } else {
                        totalc.style.display = "";
                        home.style.display = "none";
                        away.style.display = "none";
                    }
                }

                function hideDivPG(value) {
                    var totalc = document.getElementById('totalcPG');
                    var home = document.getElementById('homePG');
                    var away = document.getElementById('awayPG');
                    if (value == 1) {
                        totalc.style.display = "none";
                        home.style.display = "";
                        away.style.display = "none";
                    } else if (value == 2) {
                        totalc.style.display = "none";
                        home.style.display = "none";
                        away.style.display = "";
                    } else {
                        totalc.style.display = "";
                        home.style.display = "none";
                        away.style.display = "none";
                    }
                }
            </script>
            <script type="text/javascript">
                function view_phong_do(value, teamCode) {
                    if (value == 0) {
                        document.getElementById("pdChung" + teamCode).style.display = "block";
                        document.getElementById("pdRieng" + teamCode).style.display = "none";
                    } else {
                        document.getElementById("pdChung" + teamCode).style.display = "none";
                        document.getElementById("pdRieng" + teamCode).style.display = "block";
                    }
                }
            </script>
    @else
        <div class="New_col-centre">
            <div class="menu2">Không có thông tin nào được đưa ra trong khoảng thời gian lựa chọn.</div>
        </div>
    @endif
@endsection




