@extends('layouts.app')
@section('content')
<div class="New_col-centre">
   <div class="menu_trd">
      <a href="{{ base_url('bang-xep-hang-bong-da.html') }}" class="kc_menu_trd">BXH Bóng đá</a>
      <a href="{{ base_url('bang-xep-hang-fifa-nam.html') }}" class="kc_menu_trd @if($gender == 1) selected @endif">BXH FIFA Nam</a>
      <a href="{{ base_url('bang-xep-hang-fifa-nu.html') }}" class="kc_menu_trd @if($gender == 0) selected @endif">BXH FIFA Nữ</a>
   </div>
   <!--start-->
   <div class="drop">&nbsp;</div>
   <h2 class="bg_h2">Bảng xếp hạng FIFA - Tháng 01 - 2015</h2>
   <div class="bxh_ct" style="display: none;">
      <a id="0" class="zone-color" href="bang-xep-hang-fifa.html">All</a> 
      | <a id="2" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,2);" href="javascript:void();">AFC</a> 
      | <a id="1" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,1);" href="javascript:void();">UEFA</a> 
      | <a id="5" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,5);" href="javascript:void();">CAF</a> 
      | <a id="6" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,6);" href="javascript:void();">OFC</a> 
      | <a id="4" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,4);" href="javascript:void();">CONCACAF</a> 
      | <a id="3" class="mauden" onclick="goToRankigTable('/bang-xep-hang/process-bxh.jsp',processState,201501,0,3);" href="javascript:void();">CONMEBOL</a>
   </div>
   <div id="bxh_fifa" class="bxh_td">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
         <tbody>
            <tr class="kc_bxh">
               <td class="bxh1">XH</td>
               <td class="bxh2">Quốc gia</td>
               <td class="bxh3">Điểm</td>
               <td class="bxh4"><b class="xanhlc">+<b></b>/</b><b class="do">-</b></td>
               <td class="bxh6"></td>
            </tr>
            <tr>
               <td colspan="5" class="docbxh"></td>
            </tr>
            @if($fifa)
            @foreach($fifa as $f => $val)
               <tr class="dong1 kc_bxh1">
                  <td class="bxh1">{{ ++$f }}.</td>
                  <td class="bxh2">
                     <span class="flagsp flagsp_{{ $val->image }}" title="{{ $val->country }}"> </span>
                     {{ $val->country }}
                  </td>
                  <td class="bxh3">{{ $val->point }}</td>
                  <td class="bxh4">
                     {{ $val->upto }}
                  </td>
                  <td class="bxh6">
                     <img src="http://static.bongda.wap.vn/images/mui-ten-{{ formatGif($val->upto) }}.gif" align="absmiddle">
                  </td>
               </tr>
            @endforeach
               <tr class="kc_bxh2">
                  <td colspan="5" class="bxh5">
                     @if($total_page > 1)
                        @for($i = 1; $i <= $total_page; $i++)
                           @if($perpage == $i)
                              <a class="stt-selected">{{ $i }}</a>
                           @else
                              <a href="{{ base_url("bang-xep-hang-fifa-nam-page-{$i}.html") }}">{{ $i }}</a>
                           @endif
                        @endfor
                     @endif
                  </td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>
   <!--end-->
</div>
@endsection