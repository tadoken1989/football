@extends('layouts.app')
@section('content')

<div class="New_col-centre">
   <div class="menu_bxh_qg">
      <a class="kc_menu_trd chumenu_ketqua selected">BXH Bóng đá</a>
      <a href="{{ base_url('bang-xep-hang-fifa-nam.html') }}" class="kc_menu_trd chumenu_ketqua">BXH FIFA Nam</a>
      <a href="{{ base_url('bang-xep-hang-fifa-nu.html') }}" class="kc_menu_trd chumenu_ketqua">BXH FIFA Nữ</a>
   </div>
   <!--start-->
   <div class="drop">&nbsp;</div>
   <div style="background-color:#e9ece4; text-align:left;">
      <h2 class="bg_h2">BẢNG XẾP HẠNG BÓNG ĐÁ GIẢI CHÍNH</h2>
      <div class="new_BXH">
         <div class="new_BXH_hot">
            <ul>
               @foreach(loadFavoriteLeague() as $league)
                 <li><a href="{{ routes_bangxephang($league->alias,$league->id) }}">Bảng xếp hạng {{ $league->name }}</a></li>
               @endforeach
            </ul>
         </div>
         <div class="dropBXH">&nbsp;</div>
         
         <h2 class="bg_h2">BẢNG XẾP HẠNG BÓNG ĐÁ</h2>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-left: solid 1px #CCC;">
            <tbody>
               
               @if($arrayLeague)
                  @foreach($arrayLeague as $key => $rg)
                     <tr>
                        <td colspan="2">
                           <div class="new_BXH_td">
                              {{ $key }}
                           </div>
                        </td>
                     </tr>
                     @if(isset($rg) && count($rg) > 0)
                        <?php $i = 1; ?>
                        @foreach($rg as $ct => $val)
                           @if($val && count($val) > 0)
                              <tr>
                                 @foreach($val as $league)
                                    <td class="danh_sach_bxh border_right">
                                       <a href="{{ routes_bangxephang($league->alias,$league->id) }}" class="chu_new_BXH_today">
                                       <span class="flagsp flagsp" title="{{ $league->name }}"></span>
                                       {{ $league->name }}
                                       </a>
                                    </td>
                                 @endforeach
                              </tr>
                           @endif
                           <?php $i++; ?>
                        @endforeach
                     @else
                        <tr>
                           <td colspan="2" class="danh_sach_bxh border_right">Chưa có giải đấu</td>
                        </tr>
                     @endif
                  @endforeach
               @endif
            </tbody>
         </table>
      </div>
   </div>
   <br>
</div>
@endsection