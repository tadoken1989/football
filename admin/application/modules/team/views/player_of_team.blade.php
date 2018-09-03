@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div id="cauthu">
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
                </div>
            </div>
        </div>
    </div>
@endsection