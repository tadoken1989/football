@extends('layouts.app')
@section('content')
	<div class="New_col-centre">
   <!--start-->
   <form name="frmControl" method="post">
      <div class="LTD_menu">
         <span class="flagsp"></span>&nbsp;<b>{{ convert_country($leagues) }}:</b>
         <select name="code" onchange="window.top.location=frmControl.code.options[frmControl.code.selectedIndex].value" style="font-family:Arial, Tahoma">
            @foreach($country_leagues as $league)
               <option value="{{ route_vua_pha_luoi($league->alias , $league->id) }}" @if($league->id == $leagues->id) selected="" @endif>{{ $league->name }}</option>
            @endforeach
         </select>
      </div>
   </form>
   <div class="menu_trd">
      <a href="{{ route_kq_league($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Kết quả</a>
      <a href="{{ lich_thi_dau_5_vong($leagues->alias,$leagues->id) }}" class="kc_menu_trd">Lịch</a>
      <a class="kc_menu_trd" href="{{ routes_bangxephang($leagues->alias,$leagues->id) }}">BXH</a>  
      <a href="{{ base_url('ty-le-bong-da.html') }}" class="kc_menu_trd">Tỷ lệ</a>
      <a class="kc_menu_trd selected">VPL</a>
   </div>

   <h2 class="bg_h2">VUA PHÁ LƯỚI {{ strtoupper($leagues->name) }}</h2>
   <div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr bgcolor="#C83233" style="font-weight: bold;color: #FFFFFF;font-family:Tahoma,Verdana,Arial;" height="19px">
               <td class="bxh_gd_1" style="width: 10%"><b>XH</b></td>
               <td class="bxh_gd_2" style="width: 25%"><b>Cầu thủ</b></td>
               <td class="bxh_gd_2" style="width: 25%"><b>Đội bóng</b></td>
               <td class="bxh_gd_1" style="width: 15%"><b>Bàn thắng</b></td>
               <td class="bxh_gd_1" style="width: 15%"><b>Mở tỷ số</b></td>
               <td class="bxh_gd_1"><b>PEN</b></td>
            </tr>
            @if($top_scorers)
               @foreach($top_scorers as $key => $scorers)
                  @if(isset ($scorers->team->name))
                     <tr class="dong1">
                        <td class="bxh_gd_1" style="width: 10%">{{ ++$key }}</td>
                        <td class="bxh_gd_2" style="width: 12%">
                           <strong>{{ $scorers->name }}</strong>
                        </td>
                        <td class="bxh_gd_2" style="width: 13%">
                           {{ isset($scorers->team->name)?$scorers->team->name:"" }}
                        </td>
                        <td class="bxh_gd_1" style="width: 15%">{{ $scorers->goals }}</td>
                        <td class="bxh_gd_1" style="width: 15%">{{ $scorers->first_scorer }}</td>
                        <td class="bxh_gd_1" style="width: 10%">{{ $scorers->penalties }}</td>
                     </tr>
                     <tr>
                        <td colspan="10">
                           <div style="border-bottom: 1px solid #C1C1C1;"></div>
                        </td>
                     </tr>

                  @endif
               @endforeach
            @else
               <tr class="dong1">
                  <td class="bxh_gd_1" colspan="6" style="width: 10%">Chưa có thông tin vua phá lưới {{ strtoupper($leagues->name) }}</td>
               </tr>
            @endif
            <tr>
               <td colspan="10">
                  <h2 class="bg_h2">
                     Vua phá lưới các giải bóng đá {{ $country->name }}
                  </h2>
               </td>
            </tr>
            @foreach($country_leagues as $league)
               <tr>
                  <td colspan="10" style="line-height: 24px;padding-left: 10px;"><a href="{{ route_vua_pha_luoi($league->alias , $league->id) }}">Vua phá lưới {{ $league->name }}</a></td>
               </tr>
               <tr>
                  <td colspan="10">
                     <div style="border-bottom: 1px solid #C1C1C1;"></div>
                  </td>
               </tr>
            @endforeach
            
            
         </tbody>
      </table>
   </div>
   <div style="padding-top:4px; background-color:#e9ece4; text-align:left;">
      <h2 class="bg_h2">THÔNG TIN GIẢI {{ strtoupper($leagues->name) }}</h2>
      <div style="padding:4px; background-color:#fff; text-align:left;">
         <?php echo league_info($leagues); ?>
      </div>
   </div>
</div>
@endsection