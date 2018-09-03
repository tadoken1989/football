@extends('layouts.app')
@section('content')
    <form name="frmKQ" method="post" action="{{ base_url('ket-qua-bong-da.html') }}">
        <div class="New_col-centre">
            <div class="menu_ketqua">
                <a href="danh-sach-quoc-gia.html"><img
                            src="https://lh3.googleusercontent.com/-HfnK8W4YL4s/UtNtZ_qm_6I/AAAAAAAAAOo/4jPp2xuizyY/s20-no/bong-da-wap_icon-List.png"
                            alt="" width="20" height="20"></a>
                <select name="slbDay" onchange="frmKQ.submit();">
                    @foreach(loadSelectDayLeft() as $day)
                        @if($day['key'] == $slbDay)
                            <option value="{{ $day['key'] }}" selected>{{ $day['value'] }}</option>
                        @else
                            <option value="{{ $day['key'] }}">{{ $day['value'] }}</option>
                        @endif
                    @endforeach
                </select>
                <select name="slbCountry" onchange="frmKQ.submit();">
                    @if($countryId == 0)
                        <option value="0" selected>Quốc gia</option>
                    @else
                        <option value="0" >Quốc gia</option>
                    @endif
                    @foreach(loadCountry() as $country)
                        @if($country->id == $countryId)
                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                        @else
                            <option value="{{ $country->id }}">{{ $country->name }}</option>

                        @endif
                    @endforeach
                </select>
                <select name="slbType" onchange="frmKQ.submit();">
                    @if($slbType == 1)
                        <option value="0">Thời gian</option>
                        <option value="1" selected>Giải đấu</option>
                    @else
                        <option value="0" selected>Thời gian</option>
                        <option value="1">Giải đấu</option>
                    @endif
                </select>
            </div>
            <div class="drop">&nbsp;</div>
            <div class="k_trang">&nbsp;</div>
            <div class="LS">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tbody>
                    <tr class="bg_LS_web">
                        <td class="LS_a_web">Giải</td>
                        <td class="LS_b_web">Giờ</td>
                        <td class="LS_c_web">TT</td>
                        <td class="LS_d_web">Chủ</td>
                        <td class="LS_e_web">Tỷ số</td>
                        <td class="LS_f_web">Khách</td>
                        <td class="LS_g_web">Châu á</td>
                        <td class="LS_g_web">Hiệp 1</td>
                    </tr>
                    @if($list_history)
                        @foreach($list_history as $history)
                            <tr class="bg_LS2_web">

                                <td class="LS_1_web" bgcolor="{{randomColorFromLeagueId($history->league_id)}}">

                                    <a style="color: #fff;"
                                       href="{{ route_kq_league($history->league->alias,$history->league->id) }}">
                                        {{ getFirstLetter($history->league->name) }}
                                    </a>

                                </td>

                                <td class="LS_2_web">
                                    {{ parseDateTime($history->date) }}
                                </td>
                                <td class="LS_3_web">
                                </td>
                                <td class="LS_4_web">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_4a_web">

                                                <sup>[{{ $history->round }}]</sup>
                                                <a class="xam"
                                                   href="{{ routes_teams($history->home_team->alias,$history->home_team->team_id) }}">
                                                    {{ $history->home_team->name }}
                                                </a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_5_web ">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="LS_5a_web">
                                                <b class="camdam">
                                                    <a href="{{ route_truc_tiep($history) }}">
                                                        <font color="red">
                                                            <b>
                                                                {{ $history->home_goals }} - {{ $history->away_goals }}</b></font>
                                                    </a>
                                                </b>
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
                                                <a class="xam"
                                                   href="{{ routes_teams($history->away_team->alias,$history->away_team->team_id) }}">
                                                    {{ $history->away_team->name }}
                                                </a>

                                                <sup>[{{ $history->round }}]</sup>

                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td class="LS_7_web" style="color: #A0522D;">
                                    {{ rand(-1,5) }}/{{ rand(0,5) }}
                                </td>
                                <td class="LS_7_web"><b>{{ $history->half_time_home_goals }} - {{ $history->half_time_away_goals }}</b></td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="10" align="center">
                            <a class="xanhlacay" style="font-size: large"
                               href="{{ fixture_day_pre($today) }}"> « </a>
                            {{ date('d',strtotime("$today")) }} tháng {{ date('m',strtotime("$today")) }}
                            <a class="xanhlacay" style="font-size: large"
                               href="{{ fixture_day_next($today) }}"> » </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </form>
@endsection

