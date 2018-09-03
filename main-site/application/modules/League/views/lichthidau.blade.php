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
      <a href="{{ route_kq_league($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Kết quả</a>
      <a class="kc_menu_trd selected">Lịch</a>
      <a class="kc_menu_trd" href="{{ routes_bangxephang($leagues->alias,$leagues->id) }}">BXH</a> 
      <a href="{{ base_url('ty-le-bong-da.html') }}" class="kc_menu_trd">Tỷ lệ</a>
      <a href="{{ route_vua_pha_luoi($leagues->alias,$leagues->id) }}" class="kc_menu_trd">VPL</a>
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
      
         @if($result_football)
         @foreach($result_football as $ks => $val)
            <tr>
               <td colspan="6" class="LTD_1">
                  {{ $ks }}
               </td>
            </tr>
            @if($val)
               @foreach($val as $league)
                  <tr class="bg_LS2_web">
                     <td class="LTD_2_web">{{ format_date_asia_hi($league->date) }}</td>
                     <td class="LTD_3_web"></td>
                     <td class="LTD_4_web">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tbody><tr>
                             <td class="LTD_4a_web">
                              <span style="float: right;">
                                 <a class="xam" href="{{ routes_teams($league->home_team->alias,$league->home_team->team_id) }}">
                                    {{ $league->home_team->name }}
                                 </a>
                                 
                              </span>
                              
                             </td>
                           </tr>
                         </tbody></table>
                     </td>
                     <td class="LTD_5_web  has-tt-dh">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tbody><tr>
                             <td class="LTD_5a_web">
                              <a class="xam" href="{{ route_truc_tiep($league->home_team->alias, $league->away_team->alias, $league->home_team->team_id, $league->away_team->team_id, $val[0]->fixture_matches_id, null) }}">vs</a>
                             </td>
                           </tr>
                         </tbody></table>
                     </td>
                     <td class="LTD_6_web">
                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tbody><tr>
                             <td class="LTD_6a_web">
                              <span style="float: left;">
                                 <a class="xam" href="{{ routes_teams($league->away_team->alias,$league->away_team->team_id) }}">
                                    {{ $league->away_team->name }}
                                 </a>
                                    &nbsp; 
                           </span>
                           
                             </td>
                           </tr>
                         </tbody></table>
                     </td>
                     <td class="LTD_7_web"><b>  - </b></td>
                  </tr>
                  <tr>
                     <td colspan="10"><div style="border-bottom: 1px solid #C1C1C1;"></div></td>
                  </tr>
               @endforeach
            @endif
         @endforeach
         @endif
       <tr> 
      <td colspan="10">
         <h2 class="bg_h2">LỊCH THI ĐẤU {{ strtoupper($leagues->name) }}
      </td>
       @foreach($country_leagues as $league)
         <tr>
         <td colspan="10" style="line-height: 24px;padding-left: 10px;"><a href="{{ lich_thi_dau_5_vong($league->alias , $league->id) }}">Lịch thi đấu {{ $league->name }}</a></td>
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