@extends('layouts.app')
@section('content')
    <style type="text/css">
        table{
            font-size: 11px !important;
        }
    </style>
    <div class="New_col-centre">
        <div class="menu_tyle">
            @foreach(add7DayInWeek() as $key => $day)
                <a href="{{ ty_le_ca_tran_trong_tuan($day,$key) }}" @if($day == $todayInWeek) class="selected" @endif >
                    {{ $day }}
                </a>&nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
        <div class="drop">&nbsp;</div>
        <div class="k_trang">&nbsp;</div>
        <div class="TYLETT">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tbody>
                <tr>
                    <td rowspan="2" class="Tyleweb_1">Giờ</td>
                    <td rowspan="2" class="Tyleweb_1a">TrậnĐấu</td>
                    <td colspan="3" class="Tyleweb_1c">Cả trận</td>
                    <td colspan="8" class="Tyleweb_1c">Hiệp 1</td>
                </tr>
                <tr class="trd_TYLETT_1">
                    <td class="Tyleweb_1">Ty Le</td>
                    <td class="Tyleweb_1">Tai Xiu</td>
                    <td class="Tyleweb_1">1x2</td>
                    <td class="Tyleweb_1">Ty Le</td>
                    <td class="Tyleweb_1">Tai Xiu</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="ajax-loadrate">
        </div>
        <!-- ND_300x250_Web -->
        <div>
            <h2 class="bg_h2">KEO BONG DA HOM NAY</h2>
        </div>
        <div class="TYLETT">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tbody>
                @if(!empty($vdqg))
                    @foreach($vdqg as $country => $fixtures)
                        <tr class="TYLETT_4">
                            <td colspan="7" class="TYLETT_2a"><a style="color: #363636;" href="#"> <strong>{{ $fixtures->leagues_name }}</strong></a><span><a style="color: #363636;float: right;padding-right:5px;" href="{{ routes_bangxephang($fixtures->alias,$fixtures->league_id) }}">BXH</a></span></td>
                        </tr>
                        <?php $fixture_matches = fixture_matches($fixtures->league_id, $date); $i = 1; ?>
                        @if(!empty($fixture_matches))
                            @foreach($fixture_matches as $key => $val)
                                <?php $clazz = ($i % 2 == 0)?'_1':''; ?>
                                <?php
                                //$f1 = odds_by_fixture_match($val->fixture_matches_id,'Over/Under');
                                // $f1_asc = odds_by_fixture_match($val->fixture_matches_id,'Over/Under','asc');
                                // $fm_asian_handicap = odds_by_fixture_match($val->fixture_matches_id,'Asian Handicap');
                                // $fm_asian_handicap_asc = odds_by_fixture_match($val->fixture_matches_id,'Asian Handicap','asc');
                                // $fm_1X2 = odds_by_fixture_match($val->fixture_matches_id,'1X2');
                                //$f1_asc = odds_by_fixture_match($val->fixture_matches_id,'Over/Under','asc');
                                $fm_odds = !empty($val->fixture_match_odds)?$val->fixture_match_odds:[];
                                $filterOverUnder     = array_filter($fm_odds, 'filterOverUnder');
                                $filter1X2           = array_filter($fm_odds, 'filter1X2');
                                $filterAsianHandicap = array_filter($fm_odds, 'filterAsianHandicap');
                                $f1      = array_slice($filterAsianHandicap, 0, 1);
                                $f2      = array_slice($filterOverUnder, 0, 1);

                                $f3      = $filter1X2;

                                $f4      = array_slice($filterOverUnder, 0, 1);
                                $f5      = array_slice($filterAsianHandicap, 4, 1);
                                $tren = true;
                                $hoa = false;
                                if (count($f3)) {
                                    $tren = ((float)($f3[0]->home_odds) - (float)($f3[0]->away_odds) < 0) ? true : false;
                                }
                                if (count($f1)) {
                                    $hoa = (float)$f1[0]->handicap == 0 ? true : false;
                                }
                                ?>
                                <tr class="TYLETT_3{{ $clazz }}">
                                    <td class="TYLETT_3a" width="10%"><b>{{ format_date_asia_day($val->date) }}</b><br><b class="chutyle">{{ format_date_asia_hi($val->date) }}</b></td>
                                    <td class="TYLETT_3b" width="30%">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr height="18px">
                                                @if(!$hoa)
                                                    <td><b class="{{ $tren ? 'chutyle' : '' }}">{{ $val->home_team->name }}</b></td>
                                                @else
                                                    <td><b>{{ $val->home_team->name }}</b></td>
                                                @endif
                                            </tr>
                                            <tr height="18px">
                                                @if(!$hoa)
                                                    <td><b class="{{ !$tren ? 'chutyle' : '' }}">{{ $val->away_team->name }}</b></td>
                                                @else
                                                    <td><b>{{ $val->away_team->name }}</b></td>
                                                @endif
                                            </tr>
                                            <tr height="18px">
                                                <td> | <a href="{{ route_phong_do_doi_dau($val->home_team->alias, $val->away_team->alias, $val->home_team->team_id, $val->away_team->team_id, $val->fixture_matches_api_id) }}" style="color:#669900;">Phong độ</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="TYLETT_3c" width="14%">
                                        @if(count($f1) > 0)
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    @if ($tren)
                                                        <td><b class="do"><b class="do">{{ $f1[0]->handicap }}</b></b></td>
                                                    @else
                                                        <td><b class="do">&nbsp;</b></td>
                                                    @endif
                                                    <td align="right"><b>{{ $f1[0]->home_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    @if (!$tren)
                                                        <td><b class="do"><b class="do">{{ $f1[0]->handicap }}</b></b></td>
                                                    @else
                                                        <td><b class="do">&nbsp;</b></td>
                                                    @endif
                                                    <td align="right"><b>{{ $f1[0]->away_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                    <td class="TYLETT_3c" width="14%">
                                        @if(count($f4) > 0)
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td><b class="do"><b class="do">{{ $f4[0]->handicap }}</b></b></td>
                                                    <td align="right"><b>{{ $f4[0]->home_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="do">&nbsp;</b></td>
                                                    <td align="right"><b>{{ $f4[0]->away_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                    <td class="TYLETT_3d" width="7%">
                                        @if(count($f3) > 0)
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td align="right"><b>{{ $f3[0]->home_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td align="right"><b>{{ $f3[0]->away_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="do">&nbsp;</b></td>
                                                    <td align="right"><b>{{ $f3[0]->handicap }}</b></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                    <td class="TYLETT_3c" width="13%">
                                        @if(count($f4) > 0)
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td><b class="do"><b class="do">{{ $f4[0]->home_odds }}</b></b></td>
                                                    <td align="right"><b>{{ $f4[0]->away_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="do">&nbsp;</b></td>
                                                    <td align="right"><b>{{ $f4[0]->handicap }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                    <td class="TYLETT_3c" width="12%">
                                        @if(count($f2) > 0)
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td><b class="do"><b class="do">{{ $f2[0]->home_odds }}</b></b></td>
                                                    <td align="right"><b>{{ $f2[0]->away_odds }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="do">&nbsp;</b></td>
                                                    <td align="right"><b>{{ $f2[0]->handicap }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
        <div class="TYLETT">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tbody>
                <tr>
                    <td colspan="10">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="10" align="center">
                        <a class="xanhlacay" style="font-size: large" href="{{ odd_day_pre($date['today']) }}"> « </a>
                        {{ date('d',strtotime($date['today'])) }} ngày {{ date('m',strtotime($date['today'])) }}
                        <a class="xanhlacay" style="font-size: large" href="{{ odd_day_next($date['today']) }}"> » </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@if($date['today'] == date('Y-m-d 00:00:00', time()))
@section('extra-js')
    <script>
        function startRefreshingRateWeb() {
            $.ajax({
                url: '/ty-le-bong-da-truc-tuyen.html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer 6QXNMEMFHNY4FJ5ELNFMP5KRW52WFXN5")
                }, success: function(data){
                    $('#ajax-loadrate').html(data)
                    var tds = $('.TYLETT_3b_LIVE')
                    var link = $('#link_phong_do').data('link').split(', ')
                    $.each(tds,  function (index, value) {
                        var html = "|<a href='"+ link[index] +"'>" + " Phong độ" + "</a>"
                        $(value).append(html)
                    })
                    var linkBXH = $('#link_BXH').data('link').split(', ')
                    var trs = $('.TYLETT_4_LIVE')
                    $.each(trs,  function (index, value) {
                        $(value).find('span').find('a').attr("href", linkBXH[index])
                    })
                    $.each(tds,  function (index, value) {
                        if ($(value).find('a').attr("href") == 'undefined') {
                            $(value).find('a').attr("href", '#')
                        }
                    })
                }
            })
        }
        $(document).ready(function () {
            startRefreshingRateWeb();
            setInterval(function () {
                startRefreshingRateWeb();
            }, 120000);
        });
    </script>
@endsection
@endif