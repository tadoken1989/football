@extends('layouts.app')
@section('content')
   <style type="text/css">
      table > tr {
         font-size: 11px !important;
      }
   </style>
   <div class="New_col-centre">
      <!--start-->
      <form name="frmControl" method="post">
         <div class="LTD_menu">
            <span class="flagsp"></span>&nbsp;<b>{{ convert_country($leagues) }}:</b>
            <select name="code" onchange="window.top.location=frmControl.code.options[frmControl.code.selectedIndex].value" style="font-family:Arial, Tahoma">
               @foreach($country_leagues as $league)
                  <option value="{{ route_kq_league($league->alias , $league->id) }}" @if($league->id == $leagues->id) selected="" @endif>{{ $league->name }}</option>
               @endforeach
            </select>
         </div>
      </form>
      <div class="menu_trd">
         <a href="" class="kc_menu_trd selected">Kết quả</a>
         <a href="{{ lich_thi_dau_5_vong($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Lịch</a>
         <a class="kc_menu_trd" href="{{ routes_bangxephang($leagues->alias,$leagues->id) }}">BXH</a>
         <a href="{{ base_url('ty-le-bong-da.html') }}" class="kc_menu_trd">Tỷ lệ</a>
         <a href="{{ route_vua_pha_luoi($leagues->alias,$leagues->id) }}" class="kc_menu_trd">VPL</a>
      </div>

      <div style="background-color:#e9ece4; text-align:left;">
         <form name="formKetQua" method="post">
            <div class="sale">
               <h2 class="bg_h2">
                  KẾT QUẢ VĐQG {{ strtoupper($leagues->name) }}
                  <form action="" method="POST">
                     <select name="slRound" onchange="formKetQua.submit();">
                        @for($i = 1; $i <= $records->round ; $i++)
                           <option value="{{ $i }}" @if($slRound == $i) selected="" @endif>Vòng {{ $i }}</option>
                        @endfor
                     </select>
                  </form>
               </h2>
            </div>
         </form>
      </div>
      <div class="LS">
         <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" ;="">
            <tbody>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="LTD_b_web">Giờ</td>
               <td class="LTD_c_web">TT</td>
               <td class="LTD_d_web">Chủ</td>
               <td class="LTD_e_web">Tỷ số</td>
               <td class="LTD_f_web">Khách</td>
               <td class="LTD_g_web">Hiệp 1</td>
            </tr>
            @if(count($result_football) > 0)
               @foreach($result_football as $key => $kqbdLive)
                  <tr>
                     <td colspan="6" class="LTD_1">
                        {{ $key }}
                     </td>
                  </tr>
                  @if(count($kqbdLive) > 0)
                     @foreach($kqbdLive as $kqbd)

                        <tr class="bg_LS2_web">
                           <td class="LTD_2_web">{{ parseDateTime($kqbd->date) }}</td>
                           <td class="LTD_3_web">FT</td>
                           <td class="LTD_4_web">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tbody>
                                 <tr>
                                    <td class="LTD_4a_web">
                                    <span style="float: right;">
                                    <a class="xam" href="{{ routes_teams($kqbd->home_team->alias,$kqbd->home_team->team_id) }}">
                                    {{ $kqbd->home_team->name }}
                                    </a>
                                    </span>
                                       @if($kqbd->home_red_cards > 0)
                                          <span style="float: right;" class="card_web red_card_web" title="thẻ đỏ">
                                       {{ $kqbd->home_red_cards }}
                                    </span>
                                       @endif
                                       @if($kqbd->home_yellow_cards > 0)
                                          <span style="float: right;" class="card_web yellow_card_web" title="thẻ vàng">
                                       {{ $kqbd->home_yellow_cards }}
                                    </span>
                                       @endif
                                    </td>
                                 </tr>
                                 </tbody>
                              </table>
                           </td>
                           <td class="LTD_5_web  has-tt-dh">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tbody>
                                 <tr>
                                    <td class="LTD_5a_web">
                                       <a class="xam" href="{{ route_truc_tiep($kqbd->home_team->alias, $kqbd->away_team->alias, $kqbd->home_team->team_id, $kqbd->away_team->team_id, $kqbd->match_api_id, null) }} ">
                                          <b class="camdam">{{ $kqbd->home_goals }} - {{ $kqbd->away_goals }}</b>
                                       </a>
                                    </td>
                                 </tr>
                                 </tbody>
                              </table>
                           </td>
                           <td class="LTD_6_web">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tbody>
                                 <tr>
                                    <td class="LTD_6a_web">
                                    <span style="float: left;">
                                    <a class="xam" href="{{ routes_teams($kqbd->away_team->alias,$kqbd->away_team->team_id) }}">
                                        {{ $kqbd->away_team->name }}
                                    </a>
                                       </a>
                                       &nbsp;
                                    </span>
                                       @if($kqbd->away_red_cards > 0)
                                          <span style="float: left;" class="card_web red_card_web" title="thẻ đỏ">
                                          {{$kqbd->away_red_cards}}
                                    </span>
                                       @endif
                                       @if($kqbd->away_yellow_cards > 0)
                                          <span style="float: left;" class="card_web yellow_card_web" title="thẻ vàng">
                                       {{$kqbd->away_yellow_cards}}
                                    </span>
                                       @endif
                                    </td>
                                 </tr>
                                 </tbody>
                              </table>
                           </td>
                           <td class="LTD_7_web"><b>  {{ $kqbd->half_time_home_goals }} - {{ $kqbd->half_time_away_goals }} </b></td>
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

            <tr style="font-size: 11px;">
               <td colspan="10">
                  <strong>Vòng: </strong>
                  @for($i = 1; $i <= $records->round ; $i++)
                     <a class="xanhlacay" href="{{ ket_qua_bd_the_vong($leagues->name,$leagues->id,$i) }}">{{ $i }}</a> @if($i != $records->round) | @endif
                  @endfor


               </td>
            </tr>
            <tr>
               <td colspan="10">
                  <div style="border-bottom: 1px solid #C1C1C1;"></div>
               </td>
            </tr>

            <tr>
               <td colspan="10">
                  <h2 class="bg_h2">
                     Bảng xếp hạng các giải bóng đá {{ $leagues->name }}
                  </h2>
               </td>
            </tr>
            @foreach($country_leagues as $league)
               <tr>
                  <td colspan="10" style="line-height: 24px;padding-left: 10px;"><a href="{{ route_kq_league($league->alias , $league->id) }}">Kết quả {{ $league->name }}</a></td>
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

      <div style="padding-top:4px; background-color:#e9ece4; text-align:left;">
         <h2 class="bg_h2">THÔNG TIN GIẢI VĐQG {{ strtoupper($leagues->name) }}</h2>
         <div style="padding:4px; background-color:#fff; text-align:left;">
             <?php echo league_info($leagues); ?>
         </div>
      </div>
   </div>
@endsection