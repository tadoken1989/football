@extends('layouts.app')
@section('content')
    <div class="New_col-centre">
        <!--start-->
        <div class="Background_trandau" style="width:100%">
            <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
                <tbody>
                <tr bgcolor="#C83233"
                    style="font-size: 11px;font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;"
                    height="19px">
                    <td height="19px" align="center">Thời gian</td>
                    <td align="center">Trận đấu</td>
                    <td align="center">Kênh</td>
                </tr>
                @if($list_tv)
                    @foreach($list_tv as $list)
                        <tr>
                            <td height="22" align="left" colspan="7">
                                <div class="calendar_tv" style="padding-left: 20px;margin: 0px; ">
                                    <strong>Hôm nay, ngày 25/10</strong>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td align="center" height="16px" width="15%" style="color: #444444;font-weight: normal;">
                                {{ date("d/m", strtotime("$list->datetime")) }} - {{ parseDateTime($list->datetime) }}

                            </td>
                            <td class="list" align="center" width="60%" style="color: #444444;">
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a style="font-weight: normal;font-size: 10px;color: #8B3E2F;"
                                               href="{{ route_kq_league($list->league->alias,$list->league->id) }}">
                                                {{ $list->league->name }}, {{ $list->round }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a style="font-size: 12px;font-weight: normal;color: #444444;"
                                               href="{{ route_truc_tiep($list) }}">
                                                {{ $list->home_team->name }}
                                                -
                                                {{ $list->away_team->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td align="center" width="25%" style="color: #444444;font-weight: normal;">
                                {{ $list->channel }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>

                <tr>
                    <td colspan="10">
                        <h2 class="bg_h2">CHÚ THÍCH CÁC KÊNH SÓNG</h2>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;K+1</td>
                    <td colspan="2">Kênh thể thao giải trí của Đài truyền hình Vệ tinh VSTV</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;K+ NS</td>
                    <td colspan="2">Kênh Thể thao và giới trẻ của Đài truyền hình vệ tinh VSTV</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;K+ PC</td>
                    <td colspan="2">Kênh tổng hợp của Đài truyền hình vệ tinh VSTV</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;K+ PM</td>
                    <td colspan="2">Kênh giải trí giành cho Phái mạnh của Đài truyền hình vệ tinh VSTV</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;VTV2</td>
                    <td colspan="2">Kênh Giáo dục tổng hợp của Đài truyền hình Việt Nam</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;VTV3</td>
                    <td colspan="2">Kênh Thông tin kinh tế và giải trí của Đài Truyền hình Việt Nam</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;VTV6</td>
                    <td colspan="2">Kênh Thanh Thiếu Niên của Đài Truyền hình Việt Nam</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;SCTV15</td>
                    <td colspan="2">Kênh Thể thao đặc sắc của Truyền hình cáp Saigon Tourist</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;SCTV HD Thể Thao</td>
                    <td colspan="2">Kênh Thể thao chất lượng HD của Truyền hình cáp Saigon Tourist</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;VTC3</td>
                    <td colspan="2">Kênh &nbsp;thể thao của Truyền hình số VTC</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;HN1&nbsp;(Hà Nội 1)</td>
                    <td colspan="2">Kênh giải trí tổng hợp của Đài truyền hình Hà Nội</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;HN2&nbsp;(Hà Nội 2)</td>
                    <td colspan="2">Kênh giải trí tổng hợp của Đài truyền hình Hà Nội</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Star Sport</td>
                    <td colspan="2">Kênh Thể Thao Quốc Tế</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;ESPN</td>
                    <td colspan="2">Kênh Tin Thể thao Quốc Tế</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;HTVC Thể Thao</td>
                    <td colspan="2">Kênh Thể Thao của Truyền hình cáp – Đài TH Tp.HCM</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Fox Sports</td>
                    <td colspan="2">Kênh Thể thao Quốc Tế</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;BDTV</td>
                    <td colspan="2">VTVcab 16 - Kênh bóng đá của Truyền hình cáp Việt Nam</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Đồng Nai TV</td>
                    <td colspan="2">Kênh giải trí tổng hợp của Đài truyền hình Đồng Nai</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;TTTV</td>
                    <td colspan="2">VTVcab 3 - Kênh thể thao của Truyền hình cáp Việt Nam</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Invest TV</td>
                    <td colspan="2">InvestTV là kênh truyền hình chuyên biệt về lĩnh vực đầu tư, kinh tế và những vấn đề
                        kinh tế xã hội
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;VTVcab 17</td>
                    <td colspan="2">Kênh 17 là kênh ca nhạc giải trí dành cho giới trẻ</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection