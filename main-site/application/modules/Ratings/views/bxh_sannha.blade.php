@extends('layouts.app')
@section('content')
<div class="New_col-centre">
   <!--start-->
   <form name="frmControl" method="post">
      <div class="LTD_menu">
         <span class="flagsp"></span>&nbsp;<b>{{ convert_country($leagues) }}:</b>
         <select name="code" onchange="window.top.location=frmControl.code.options[frmControl.code.selectedIndex].value" style="font-family:Arial, Tahoma">
            @foreach($country_leagues as $league)
               <option value="{{ routes_bangxephang($league->alias , $league->id) }}" @if($league->id == $leagues->id) selected="" @endif>{{ $league->name }}</option>
            @endforeach
         </select>
      </div>
   </form>
   <div class="menu_trd">
      <a href="{{ route_kq_league($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Kết quả</a>
      <a href="{{ lich_thi_dau_5_vong($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Lịch</a>
      <a class="kc_menu_trd selected">BXH</a>   
      <a href="{{ base_url('ty-le-bong-da.html') }}" class="kc_menu_trd">Tỷ lệ</a>
      <a href="{{ route_vua_pha_luoi($leagues->alias,$leagues->id) }}" class="kc_menu_trd">VPL</a>
   </div>
   

   <div style="background-color:#e9ece4; text-align:left;">
      <h2 class="bg_h2">BẢNG XẾP HẠNG NGOẠI HẠNG ANH</h2>
   </div>
   <div class="menu_trd">
      <a href="{{ routes_bangxephang($leagues->alias,$leagues->id) }}" class="kc_menu_trd @if(isset($active) && ($active == 'tong')) selected @endif">Tổng</a>
      <a href="{{ route_bang_xep_hang_san_nha($leagues->alias,$leagues->id) }}" class="kc_menu_trd @if(isset($active) && ($active == 'sannha')) selected @endif">Sân nhà</a>
      <a href="{{ route_bang_xep_hang_san_khach($leagues->alias,$leagues->id) }}" class="kc_menu_trd @if(isset($active) && ($active == 'sankhach')) selected @endif">Sân khách</a>
   </div>
   <div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td class="bxh_gd_1"><b>T</b></td>
               <td class="bxh_gd_1"><b>H</b></td>
               <td class="bxh_gd_1"><b>B</b></td>
               <td class="bxh_gd_1"><b>BT</b></td>
               <td class="bxh_gd_1"><b>BB</b></td>
               <td class="bxh_gd_1"><b>HS</b></td>
               <td class="bxh_gd_1"><b>Đ</b></td>
            </tr>
            @if(isset($leagues) && $leagues !== false)
               @if($leagues->is_cup == 0)
                  @foreach($teams_convert as $key => $ele)
                     <tr>
                        <td class="bxh_gd_1">{{ ++$key }}</td>
                        <td class="bxh_gd_2">
                           <a class="xanhbxh" href="{{ routes_teams(slug($ele['team']),$ele['team_id']) }}">
                           {{ $ele['team'] }}
                           </a>
                        </td>
                        <td class="bxh_gd_1">{{ $ele['played_at_home'] }}</td>
                        <td class="bxh_gd_1">{{ $ele['won'] }}</td>
                        <td class="bxh_gd_1">{{ $ele['draw'] }}</td>
                        <td class="bxh_gd_1">{{ $ele['lost'] }}</td>
                        <td class="bxh_gd_1">{{ $ele['home_goals'] }}</td>
                        <td class="bxh_gd_1">{{ $ele['away_goals'] }}</td>
                        <td class="bxh_gd_1">{{ ($ele['goals'] > 0)?"+".$ele['goals']:$ele['goals'] }}</td>
                        <td class="bxh_gd_1"><b>{{  $ele['points'] }}</b></td>
                     </tr>
                  @endforeach
               @else
                  @if(isset($league_group_cup) && $league_group_cup !== false)
                     @foreach($league_group_cup_array as $key => $cup)

                     <tr bgcolor="#B1B1B1" style="font-weight: bold;color: #333333;font-family:Tahoma,Verdana,Arial;" height="19px">
                        <td colspan="6" style="padding-left: 10px;">
                           <span>{{ $key }}</span>
                        </td>
                        <td colspan="4" align="right" style="padding-right: 10px;">
                           <a style="font-weight: normal;color: #333333;" href="/thong-tin-bang-a-cup-c1-chau-au-c1.html">Chi tiết</a>
                        </td>
                     </tr>
                     @if(count($cup) > 0)
                        @foreach($cup as $tg => $team_group)
                           <tr class="">
                              <td class="bxh_gd_1">{{ ++$tg }}</td>
                              <td class="bxh_gd_2">
                                 <a class="xanhbxh" href="{{ routes_teams(slug($team_group['team']),$team_group['team_id']) }}">
                           {{ $team_group['team'] }}
                           </a>
                              </td>
                              <td class="bxh_gd_1">{{ $team_group['played_at_home'] }}</td>
                              <td class="bxh_gd_1">{{ $team_group['won'] }}</td>
                              <td class="bxh_gd_1">{{ $team_group['draw'] }}</td>
                              <td class="bxh_gd_1">{{ $team_group['lost'] }}</td>
                              <td class="bxh_gd_1">{{ $team_group['home_goals'] }}</td>
                              <td class="bxh_gd_1">{{ $team_group['away_goals'] }}</td>
                              <td class="bxh_gd_1">{{ ($team_group['goals'] > 0)?"+".$team_group['goals']:$team_group['goals'] }}</td>
                              <td class="bxh_gd_1"><b>{{ $team_group['points'] }}</b></td>
                           </tr>
                           <tr>
                              <td colspan="10">
                                 <div style="border-bottom: 1px solid #C1C1C1;"></div>
                              </td>
                           </tr>
                        @endforeach
                     @endif
                     @endforeach
                  @endif
               @endif
            @endif
         </tbody>
      </table>
   </div>
   {{-- is_cup --}}
   
   <div class="mm">
      <div class="note">
         <b class="xanh">Tr:</b> Trận, <b class="xanh">T:</b> Thắng, <b class="xanh">H:</b> Hòa, <b class="xanh">B:</b> Bại, <b class="xanh">BT:</b> Bàn thắng, <b class="xanh">BB</b>: Bàn bại, <b class="xanh">HS:</b> Hiệu số, <b class="xanh">Đ:</b> Điểm.<br>
      </div>
      <div class="note do ">
      </div>
   </div>
  
   <div>
      <table id="totalc" width="100%" border="0" cellspacing="0" cellpadding="0" style="display: none;">
         <tbody>
            <tr>
               <td colspan="7">
                  <div class="BXH_phu"><a style="color: #C83233;" href="#"><b>- Bảng xếp hạng Châu á:</b></a></div>
               </td>
            </tr>
            <tr>
               <td colspan="7">
                  <div class="menu_trd">
                     <a onclick="hideDiv(0);" style="cursor: pointer;" class="kc_menu_trd selected">Tổng</a>
                     <a onclick="hideDiv(1);" style="cursor: pointer;" class="kc_menu_trd">Sân nhà</a>
                     <a onclick="hideDiv(2);" style="cursor: pointer;" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1">XH</td>
               <td class="bxh_gd_4"><strong>Đội</strong></td>
               <td class="bxh_gd_3">Tr</td>
               <td class="bxh_gd_3">TK</td>
               <td class="bxh_gd_3">HK</td>
               <td class="bxh_gd_3">BK</td>
               <td class="bxh_gd_3">TB</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">77.8%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">66.7%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">66.7%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">66.7%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">66.7%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">55.6%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">55.6%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">55.6%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">55.6%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">44.4%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">44.4%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">44.4%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">22.2%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">22.2%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_1">22.2%</td>
            </tr>
         </tbody>
      </table>
      <table id="home" style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="7">
                  <div class="BXH_phu"><a style="color: #C83233;" href="#"><b>- Bảng xếp hạng Châu á Sân Nhà:</b></a></div>
               </td>
            </tr>
            <tr>
               <td colspan="7">
                  <div class="menu_trd">
                     <a onclick="hideDiv(0);" style="cursor: pointer;" class="kc_menu_trd">Tổng</a>
                     <a onclick="hideDiv(1);" style="cursor: pointer;" class="kc_menu_trd selected">Sân nhà</a>
                     <a onclick="hideDiv(2);" style="cursor: pointer;" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1">XH</td>
               <td class="bxh_gd_4"><strong>Đội</strong></td>
               <td class="bxh_gd_3">Tr</td>
               <td class="bxh_gd_3">TK</td>
               <td class="bxh_gd_3">HK</td>
               <td class="bxh_gd_3">BK</td>
               <td class="bxh_gd_3">TB</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">100.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">80.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">80.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">80.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">60.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">50.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">50.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">50.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>6</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
         </tbody>
      </table>
      <table id="away" style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="7">
                  <div class="BXH_phu"><a style="color: #C83233;" href="#"><b>- Bảng xếp hạng Châu á Sân Khách:</b></a></div>
               </td>
            </tr>
            <tr>
               <td colspan="7">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDiv(0);" class="kc_menu_trd">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDiv(1);" class="kc_menu_trd">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDiv(2);" class="kc_menu_trd selected">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1">XH</td>
               <td class="bxh_gd_4"><strong>Đội</strong></td>
               <td class="bxh_gd_3">Tr</td>
               <td class="bxh_gd_3">TK</td>
               <td class="bxh_gd_3">HK</td>
               <td class="bxh_gd_3">BK</td>
               <td class="bxh_gd_3">TB</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">80.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">80.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">75.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">50.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">50.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">40.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>3</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">33.3%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">25.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">20.0%</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">.0%</td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="mm">
      <div class="note"><b class="xanh">Tr:</b> Trận, <b class="xanh">TK:</b> Thắng , <b class="xanh">HK:</b> Hòa , <b class="xanh">BK:</b> Bại , <b class="xanh">TB:</b> Trung bình<br></div>
   </div>
   <div style="background-color:#FFF; height:2px;"></div>
   <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tbody>
         <tr>
            <td colspan="7">
               <div class="BXH_phu"><a style="color: #C83233;" id="displayMenuTX" href="javascript:ShowHidden('bxhTXText','displayMenuTX');"><strong>[+] Bảng xếp hạng bàn thắng</strong></a></div>
            </td>
         </tr>
      </tbody>
   </table>
   <div id="bxhTXText" style="display: block; height: 0px; overflow: hidden; width: 100%;font-size: 11px;">
      <table id="totalcTX" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivTX(0);" class="kc_menu_trd selected">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(1);" class="kc_menu_trd">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(2);" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr class="bg_xanhlc">
               <td class="bxh_gd_1" style="line-height:35px;"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td colspan="10">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td colspan="5" align="center" style="line-height:20px; font-size:11px;">Tổng bàn thắng</td>
                        </tr>
                        <tr class="bg_xanhlc2" style="font-size:11px;">
                           <td width="20%" align="center" class="do">0-1</td>
                           <td width="20%" align="center" class="do">2-3</td>
                           <td width="20%" align="center" class="do">4-5</td>
                           <td width="20%" align="center" class="do">&gt;7</td>
                           <td width="20%" align="center" class="do">TB</td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.3</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3.3</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">3.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.9</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2.9</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.3</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.1</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.1</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.9</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.9</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.9</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.9</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.8</td>
            </tr>
         </tbody>
      </table>
      <table id="homeTX" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;display: none;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivTX(0);" class="kc_menu_trd">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(1);" class="kc_menu_trd selected">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(2);" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr class="bg_xanhlc">
               <td class="bxh_gd_1" style="line-height:35px;"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td colspan="10">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td colspan="5" align="center" style="line-height:20px; font-size:11px;">Tổng bàn thắng</td>
                        </tr>
                        <tr class="bg_xanhlc2" style="font-size:11px;">
                           <td width="20%" align="center" class="do">0-1</td>
                           <td width="20%" align="center" class="do">2-3</td>
                           <td width="20%" align="center" class="do">4-5</td>
                           <td width="20%" align="center" class="do">&gt;7</td>
                           <td width="20%" align="center" class="do">TB</td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.5</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>6</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.0</td>
            </tr>
         </tbody>
      </table>
      <table id="awayTX" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;display: none;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivTX(0);" class="kc_menu_trd">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(1);" class="kc_menu_trd">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivTX(2);" class="kc_menu_trd selected">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr class="bg_xanhlc">
               <td class="bxh_gd_1" style="line-height:35px;"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td colspan="10">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td colspan="5" align="center" style="line-height:20px; font-size:11px;">Tổng bàn thắng</td>
                        </tr>
                        <tr class="bg_xanhlc2" style="font-size:11px;">
                           <td width="20%" align="center" class="do">0-1</td>
                           <td width="20%" align="center" class="do">2-3</td>
                           <td width="20%" align="center" class="do">4-5</td>
                           <td width="20%" align="center" class="do">&gt;7</td>
                           <td width="20%" align="center" class="do">TB</td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">4.6</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.4</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.4</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.4</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.2</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">2.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>3</b></td>
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">1.3</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">0</td>
               <td class="bxh_gd_1">.8</td>
            </tr>
         </tbody>
      </table>
   </div>
   <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tbody>
         <tr>
            <td colspan="7">
               <div class="BXH_phu"><a style="color: #C83233;" id="displayMenuPG" href="javascript:ShowHiddenBXHPhatGoc('bxhPhatGocText','displayMenuPG');"><strong>[+] Bảng xếp hạng Phạt Góc</strong></a></div>
            </td>
         </tr>
      </tbody>
   </table>
   <div id="bxhPhatGocText" style="display: block; height: 0px; overflow: hidden; width: 100%;font-size: 11px;">
      <table id="totalcPG" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivPG(0);" class="kc_menu_trd selected">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(1);" class="kc_menu_trd">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(2);" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td class="bxh_gd_1"><b>ĐH</b></td>
               <td class="bxh_gd_1"><b>ĐP</b></td>
               <td class="bxh_gd_1"><b>BK</b></td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">7.4</td>
               <td class="bxh_gd_1">4.7</td>
               <td class="bxh_gd_1">12.1</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">7.3</td>
               <td class="bxh_gd_1">11.9</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5.2</td>
               <td class="bxh_gd_1">6.1</td>
               <td class="bxh_gd_1">11.3</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5.6</td>
               <td class="bxh_gd_1">5.4</td>
               <td class="bxh_gd_1">11.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">6.3</td>
               <td class="bxh_gd_1">10.9</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6.7</td>
               <td class="bxh_gd_1">4.1</td>
               <td class="bxh_gd_1">10.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5.6</td>
               <td class="bxh_gd_1">5.2</td>
               <td class="bxh_gd_1">10.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6.8</td>
               <td class="bxh_gd_1">4.0</td>
               <td class="bxh_gd_1">10.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4.0</td>
               <td class="bxh_gd_1">6.0</td>
               <td class="bxh_gd_1">10.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3.7</td>
               <td class="bxh_gd_1">5.9</td>
               <td class="bxh_gd_1">9.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3.4</td>
               <td class="bxh_gd_1">6.1</td>
               <td class="bxh_gd_1">9.6</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4.3</td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">9.3</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3.6</td>
               <td class="bxh_gd_1">5.6</td>
               <td class="bxh_gd_1">9.1</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">4.4</td>
               <td class="bxh_gd_1">4.4</td>
               <td class="bxh_gd_1">8.9</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">6.2</td>
               <td class="bxh_gd_1">2.2</td>
               <td class="bxh_gd_1">8.4</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5.7</td>
               <td class="bxh_gd_1">2.7</td>
               <td class="bxh_gd_1">8.3</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3.4</td>
               <td class="bxh_gd_1">4.8</td>
               <td class="bxh_gd_1">8.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">3.1</td>
               <td class="bxh_gd_1">8.1</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">3.4</td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">8.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>9</b></td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
            </tr>
         </tbody>
      </table>
      <table id="homePG" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;display: none;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivPG(0);" class="kc_menu_trd">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(1);" class="kc_menu_trd selected">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(2);" class="kc_menu_trd">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td class="bxh_gd_1"><b>ĐH</b></td>
               <td class="bxh_gd_1"><b>ĐP</b></td>
               <td class="bxh_gd_1"><b>BK</b></td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">9.4</td>
               <td class="bxh_gd_1">4.4</td>
               <td class="bxh_gd_1">13.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">5.8</td>
               <td class="bxh_gd_1">5.8</td>
               <td class="bxh_gd_1">11.5</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.8</td>
               <td class="bxh_gd_1">6.5</td>
               <td class="bxh_gd_1">11.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>6</b></td>
               <td class="bxh_gd_1">7.7</td>
               <td class="bxh_gd_1">3.5</td>
               <td class="bxh_gd_1">11.2</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">5.8</td>
               <td class="bxh_gd_1">10.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.6</td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">10.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">6.8</td>
               <td class="bxh_gd_1">3.8</td>
               <td class="bxh_gd_1">10.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.8</td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">10.4</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.8</td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">10.4</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.2</td>
               <td class="bxh_gd_1">5.2</td>
               <td class="bxh_gd_1">10.4</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">7.5</td>
               <td class="bxh_gd_1">2.5</td>
               <td class="bxh_gd_1">10.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4.6</td>
               <td class="bxh_gd_1">5.4</td>
               <td class="bxh_gd_1">10.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">6.5</td>
               <td class="bxh_gd_1">2.8</td>
               <td class="bxh_gd_1">9.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">6.4</td>
               <td class="bxh_gd_1">2.2</td>
               <td class="bxh_gd_1">8.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">6.0</td>
               <td class="bxh_gd_1">2.5</td>
               <td class="bxh_gd_1">8.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.2</td>
               <td class="bxh_gd_1">3.8</td>
               <td class="bxh_gd_1">8.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2.0</td>
               <td class="bxh_gd_1">4.8</td>
               <td class="bxh_gd_1">6.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">2.2</td>
               <td class="bxh_gd_1">3.8</td>
               <td class="bxh_gd_1">6.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.0</td>
               <td class="bxh_gd_1">1.8</td>
               <td class="bxh_gd_1">5.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
            </tr>
         </tbody>
      </table>
      <table id="awayPG" width="100%" cellspacing="0" bordercolor="#999999" style="border-collapse: collapse;display: none;" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="11">
                  <div class="menu_trd">
                     <a style="cursor: pointer;" onclick="hideDivPG(0);" class="kc_menu_trd">Tổng</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(1);" class="kc_menu_trd">Sân nhà</a>
                     <a style="cursor: pointer;" onclick="hideDivPG(2);" class="kc_menu_trd selected">Sân khách</a>
                  </div>
               </td>
            </tr>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1"><b>XH</b></td>
               <td class="bxh_gd_2"><b>Đội</b></td>
               <td class="bxh_gd_1"><b>Tr</b></td>
               <td class="bxh_gd_1"><b>ĐH</b></td>
               <td class="bxh_gd_1"><b>ĐP</b></td>
               <td class="bxh_gd_1"><b>BK</b></td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">1</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Burnley-BURN.html">
                  Burnley
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4.4</td>
               <td class="bxh_gd_1">8.0</td>
               <td class="bxh_gd_1">12.4</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">2</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-LeicesterCity-LEIC.html">
                  Leicester City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4.4</td>
               <td class="bxh_gd_1">8.0</td>
               <td class="bxh_gd_1">12.4</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">3</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Huddersfield-HUD.html">
                  Huddersfield
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.8</td>
               <td class="bxh_gd_1">7.5</td>
               <td class="bxh_gd_1">12.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">4</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Watford-WAT.html">
                  Watford
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">6.8</td>
               <td class="bxh_gd_1">11.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">5</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Chelsea-CHE.html">
                  Chelsea
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">5.2</td>
               <td class="bxh_gd_1">6.5</td>
               <td class="bxh_gd_1">11.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">6</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Bournemouth-2047.html">
                  Bournemouth
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">3.8</td>
               <td class="bxh_gd_1">7.8</td>
               <td class="bxh_gd_1">11.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">7</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManUtd-MU.html">
                  Man Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">6.0</td>
               <td class="bxh_gd_1">5.4</td>
               <td class="bxh_gd_1">11.4</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">8</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-StokeCity-STO.html">
                  Stoke City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.0</td>
               <td class="bxh_gd_1">7.0</td>
               <td class="bxh_gd_1">11.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">9</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-CrystalPalace-CPA.html">
                  Crystal Palace
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.4</td>
               <td class="bxh_gd_1">4.8</td>
               <td class="bxh_gd_1">10.2</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">10</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Tottenham-TOT.html">
                  Tottenham
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">10.0</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">11</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Southampton-SOU.html">
                  Southampton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>3</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">10.0</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">12</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestHamUtd-WH.html">
                  West Ham Utd
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">3.0</td>
               <td class="bxh_gd_1">6.8</td>
               <td class="bxh_gd_1">9.8</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">13</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Newcastle-NEW.html">
                  Newcastle
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">4.0</td>
               <td class="bxh_gd_1">4.5</td>
               <td class="bxh_gd_1">8.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">14</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-ManCity-MC.html">
                  Man City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">6.0</td>
               <td class="bxh_gd_1">2.2</td>
               <td class="bxh_gd_1">8.2</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">15</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Liverpool-LIV.html">
                  Liverpool
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">4.2</td>
               <td class="bxh_gd_1">3.6</td>
               <td class="bxh_gd_1">7.8</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">16</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Arsenal-ARS.html">
                  Arsenal
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">2.6</td>
               <td class="bxh_gd_1">7.6</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">17</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-WestBrom-WB.html">
                  West Brom
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">2.6</td>
               <td class="bxh_gd_1">5.0</td>
               <td class="bxh_gd_1">7.6</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">18</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-SwanseaCity-1675.html">
                  Swansea City
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">.8</td>
               <td class="bxh_gd_1">6.8</td>
               <td class="bxh_gd_1">7.5</td>
            </tr>
            <tr class="">
               <td class="bxh_gd_1">19</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Everton-EVE.html">
                  Everton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>4</b></td>
               <td class="bxh_gd_1">1.2</td>
               <td class="bxh_gd_1">4.2</td>
               <td class="bxh_gd_1">5.5</td>
            </tr>
            <tr class="bg_xam">
               <td class="bxh_gd_1">20</td>
               <td class="bxh_gd_2">
                  <a class="xanh" href="../ket-qua/doi-Brighton-3783.html">
                  Brighton
                  </a>
               </td>
               <td class="bxh_gd_1"><b>5</b></td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
               <td class="bxh_gd_1">.0</td>
            </tr>
         </tbody>
      </table>
      <div class="mm">
         <div class="note"><b class="xanh">Tr:</b> Trận, <b class="xanh">ĐH:</b> Số lần Phạt góc Được hưởng, <b class="xanh">ĐP:</b> Số lần phạt góc Đối Phương hưởng, <b class="xanh">TB:</b> Trung bình cả trận<br></div>
      </div>
   </div>
   
   <div>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
         <tbody>
            <tr>
               <td colspan="10">
                  <h2 class="bg_h2">
                     Bảng xếp hạng các giải bóng đá {{ $leagues->name }}
                  </h2>
               </td>
            </tr>
            @foreach($country_leagues as $league)
               <tr>
               <td colspan="10" style="line-height: 24px;padding-left: 10px;"><a href="{{ routes_bangxephang($league->alias , $league->id) }}">Bảng xếp hạng {{ $league->name }}</a></td>
            </tr>
            @endforeach
            
            
            <tr>
               <td colspan="10">
                  <div style="border-bottom: 1px solid #C1C1C1;"></div>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <!--end-->
   <div style="padding-top:4px; background-color:#e9ece4; text-align:left;">
      <h2 class="bg_h2">THÔNG TIN GIẢI {{ strtoupper($leagues->name) }}</h2>
      <div style="padding:4px; background-color:#fff; text-align:left;">
         <?php echo league_info($leagues); ?>
      </div>
   </div>
</div>
@endsection