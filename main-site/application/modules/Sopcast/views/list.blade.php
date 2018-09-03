@extends('layouts.app')
@section('content')
    <div class="New_col-centre">

        <!--start-->
        <div class="drop">&nbsp;</div>
        <h2 class="bg_h2">CÁC TRẬN ĐẤU TRỰC TIẾP HÔM NAY</h2>

        <div class="xemtructiep">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tbody>
                    <tr class="xemtructiep_td">
                        <td class="xemtructiep_td_1">Giờ</td>
                        <td class="xemtructiep_td_2">Trận đấu</td>
                    </tr>
                    @if($link_sopcast)
                        @foreach($link_sopcast as $l => $sopcast)
                            <tr class="">
                                <td class="">{{ date('H:i d/m/Y',strtotime($sopcast->datetime)) }}</td>
                                <td class=""><a href="{{ base_url("link-sopcast-xem-bong-da-truc-tuyen-$sopcast->id_link.html") }}">{{ $sopcast->title }}</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <br />
            @if(!$link_sopcast)
            <div class="xemtructiep_nd_b">
                Chưa có link phát sóng trực tiếp.
            </div>
            @endif
        </div>
        <!--end-->


        <div id="ads_livetv">
            Website miễn phí cung cấp các giải pháp xem bóng đá trực tuyến, Link sopcast, Livestream, Youtube với tốc độ tốt nhất trên PC và Mobile
            Cập nhật link xem trực tiếp bóng đá các giải hàng đầu Châu Âu và thế giới như: Ngoại Hạng Anh, VĐQG Ý, VĐQG Tây Ban Nha, VĐQG Đức, Hạng nhất Pháp, Cúp C1, Euro, Worldcup…
            Lưu ý: Link xem bóng đá trực tuyến sẽ được cập nhật chính xác 30 phút trước khi trận đấu diễn ra". Xem bóng đá trực tuyến hỗ trợ tốt nhất trên PC, tuy nhiên bạn có thể xem bóng đá trực tiếp bằng mobile đối với các kênh phát trực tuyến qua youtube
        </div>

    </div>
@endsection