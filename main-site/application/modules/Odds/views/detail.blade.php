@extends('layouts.app')
@section('content')
@if($fixture)
   <div class="New_col-centre">
   <div class="trd_bg">
      <center>
         <div class="trd_td bogoc bongdo">
            <a style="color: #C83233;" href="{{ route_truc_tiep($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id, null) }}">
            {{ $fixture->league->name }}<span style="font-weight: normal;color: #C83233;">, {{ $fixture->round }}</span><br>
            </a>
            <span></span>
         </div>
         <div class="trd_kcach">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <td class="trd_ts_l">
                        <img class="img_web" onerror="this.src='http://static.bongda.wap.vn/images/nophoto.jpg'" title="{{ $fixture->home_team->name }}" src="{{ $fixture->home_team->image }}">
                     </td>
                     <td class="trd_ts_c">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tbody>
                              <tr>
                                 <td class="trd_ts2"><span id="cols1_453235"><b class="xam">{{ format_date_asia_hi($fixture->date) }}<br>{{ format_date_asia_day($fixture->date) }}</b></span></td>
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
                        <img class="img_web" onerror="this.src='http://static.bongda.wap.vn/images/nophoto.jpg'" title="{{ $fixture->away_team->name }}" src="{{ $fixture->away_team->image }}">
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
                        ({{ getFirstLetter($fixture->home_team->name) }})
                        </b> 
                        <b class="xam">{{ $fixture->home_team->name }}</b><br>
                     </td>
                     <td class="trd_ts_c1"></td>
                     <td class="trd_ts_r1">
                        <b class="xam">{{ $fixture->away_team->name }}</b> 
                        <b class="tim">
                        ({{ getFirstLetter($fixture->away_team->name) }})
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
        <a id="tt_m" class="kc_menu_trd" href="{{ route_truc_tiep($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id, null) }}">Tường thuật</a>

        <a id="pd_m" href="{{ route_phong_do_doi_dau($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id) }}#nav" class="kc_menu_trd">Phong độ</a>
        <a id="tl_m" href="{{ route_ty_le($fixture) }}#nav" class="kc_menu_trd current">Tỷ lệ</a>

    </div>
   <div style="display: none;" class="div_hid">
      <div style="padding:11px 0 0 8px;">
         <a id="tt_m" style="display:;" href="{{ route_truc_tiep($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id, null) }}" class="trd_dh">Tường thuật</a>
         <a id="dh_m" style="display:;" href="{{ route_phong_do_doi_dau($fixture->home_team->alias, $fixture->away_team->alias, $fixture->home_team->team_id, $fixture->away_team->team_id, $fixture->fixture_matches_id) }}" class="trd_dh">Đội hình</a>
         <a id="tl_m" class="current" href="{{ route_ty_le($fixture) }}">Tỷ lệ</a>
      </div>
   </div>
   <div id="content">
   	  <?php 
   	      $fm_over_under = odds_by_fixture_match($fixture->fixture_matches_id,'Over/Under');
   	      $fm_over_under_asc = odds_by_fixture_match($fixture->fixture_matches_id,'Over/Under','asc');
            $fm_asian_handicap = odds_by_fixture_match($fixture->fixture_matches_id,'Asian Handicap');
            $fm_asian_handicap_asc = odds_by_fixture_match($fixture->fixture_matches_id,'Asian Handicap','asc');
            $fm_1X2 = odds_by_fixture_match($fixture->fixture_matches_id,'1X2');
   	  ?>
      <div class="trd_tyle">
         <h2 class="bg_h2">
            Châu á
         </h2>
         <div class="TYLETT">
            <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
               <tbody>
                  <tr class="BXH_tyle1">
                     <td class="BXH_tyle1a" style="width: 15%;">TĐ</td>
                     <td class="BXH_tyle1b" style="width: 42%;">Châu á</td>
                     <td class="BXH_tyle1a" style="width: 43%;">Bàn thắng</td>
                  </tr>
                  <tr class="BXH_tyle3">
                     <td class="BXH_tyle3a">Cả trận</td>
                     <td class="BXH_tyle3b">

                     	@if($fm_asian_handicap)
                     	{{ $fm_asian_handicap->home_odds }}*{{ $fm_asian_handicap->handicap }} : {{ $fm_asian_handicap->away_odds }}*{{ $fm_asian_handicap->handicap }}
                     	@endif
                     </td>
                     <td class="BXH_tyle3a">
                     	@if($fm_over_under)
                     	{{ $fm_over_under->home_odds }}*{{ $fm_over_under->handicap }} : {{ $fm_over_under->away_odds }}*{{ $fm_over_under->handicap }}
                     	@endif
                     </td>
                  </tr>
                  <tr>
                     <td colspan="4">
                        <div style="border-bottom: 1px solid #C1C1C1;"></div>
                     </td>
                  </tr>
                  <tr class="BXH_tyle3">
                     <td class="BXH_tyle3a">Hiệp 1</td>
                     <td class="BXH_tyle3b">
                     	@if($fm_asian_handicap_asc)
                     	{{ $fm_asian_handicap_asc->home_odds }}*{{ $fm_asian_handicap_asc->handicap }} : {{ $fm_asian_handicap_asc->away_odds }}*{{ $fm_asian_handicap_asc->handicap }}
                     	@endif
                     </td>
                     <td class="BXH_tyle3a">
                     	@if($fm_over_under_asc)
                     	{{ $fm_over_under_asc->home_odds }}*{{ $fm_over_under_asc->handicap }} : {{ $fm_over_under_asc->away_odds }}*{{ $fm_over_under_asc->handicap }}
                     	@endif
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <h2 class="bg_h2">
            Châu âu
         </h2>
         <div class="TYLETT">
            <strong>Thắng: @if($fm_1X2) 
            	{{ $fm_1X2->home_odds }} - Hòa: {{ $fm_1X2->away_odds }} - Thua: {{ $fm_1X2->handicap }}
            	@endif
            </strong>      
         </div>
      </div>
   </div>

</div>
@else
   <div class="New_col-centre">
      <div class="menu2">Không có thông tin nào được đưa ra trong khoảng thời gian lựa chọn.</div>
   </div>
@endif
@endsection