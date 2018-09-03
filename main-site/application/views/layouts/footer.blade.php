<!-- end col-center -->
<div class="menu_bottom" id="div_footer1">
    <ul>
        @foreach(back_link() as $wraper)
            <li><a target="_blank" title="{{ $wraper->name }}" href="{{ $wraper->url }}">{{ $wraper->name }}</a></li>
        @endforeach
    </ul>
    <div class="both"></div>
</div>


<div class="qc1" id="div_footer2">
    <div style="vertical-align: middle;margin-top: 0px;line-height: 20px;" class="fb-like"
         data-href="https://www.facebook.com/Bongda.wap.vn" data-layout="button_count" data-action="like"
         data-show-faces="true" data-share="false"></div>
    <div style="display: inline-table;">

    </div>
    <div style="clear:both;"></div>
</div>

<div class="qc" id="div_footer4">
    {{ load_configs('footer_description') }} | <b> <a href="{{ load_configs('google') }}" rel="publisher">Google+</a></b><br>
    {{ load_configs('footer_keywords') }}
    <p></p>
</div>
<div style="margin: 10px 0;" class="qc">
    <strong style="color: brown; ">LIÊN HỆ QUẢNG CÁO:</strong>
    <strong style="color: red;"> {{ load_configs('email_qc') }}</strong> - Hỗ trợ: {{ load_configs('phone_support') }}
</div>

<div class="qc" id="div_footer3">

    <a href="dieu-khoan-su-dung-dich-vu.html">Điều khoản sử dụng dịch vụ</a>
</div>
<div class="Danhmuc" id="div_footer5">
    <div style="border-bottom: 1px solid #C1C1C1;"></div>

    <div style="border-bottom: 1px solid #C1C1C1;"></div>
    <div class="Danhmuc_1">
        <a>Giải đấu:</a>
        <p>
            @foreach(loadFavoriteLeague() as $league)
                <a rel="nofollow" href="{{ route_kq_league($league->alias,$league->id) }}" title="Bóng đá {{ $league->name }}">{{ $league->name }}</a> |
            @endforeach
        </p>
    </div>
    <div style="border-bottom: 1px solid #C1C1C1;"></div>
    <div class="Danhmuc_1">
        <a>Khác:</a>
        <p>
            <a href="#" title="lich thi dau bong da hom nay" target="_blank">Lich thi dau bong da</a> -
            <a href="#" title="Kết quả bóng đá trực tuyến" target="_blank">Ket qua bong da truc tuyen</a> -
            <a href="#" title="ket qua bong da, kq bong da, kqbd" target="_blank">ket qua bong da</a> -
            <a href="#" title="xsmb, ket qua xo so mien bac, sxmb" target="_blank">XSMB</a> -
            <a href="#" title="Bói tình yêu" target="_blank">Boi tinh yeu</a> –
            <a href="#" target="_blank" title="lịch vạn niên 2017">lich van nien 2017</a> -
            <a href="#" target="_blank" title="lịch">lịch</a> -
            <a href="#" target="_blank" title="tử vi 2017">tu vi 2017</a> -
            <a href="#" target="_blank" title="xem bói">xem boi</a> -
            <a href="#" target="_blank" title="xem tử vi 2017">xem tu vi 2017</a> -
            <a href="#" title="nhận định bóng đá hôm nay" target="_blank">nhan dinh bong da</a> -
            <a href="#" title="Xem tuoi vo chong" target="_blank">xem tuoi vo chong</a>
        </p>
    </div>

    <style>
        .divOnTop {
            color: #FFFFFF;
            left: 0px;
            width: 100%;
            bottom: -7px;
            position: fixed;
            z-index: 100;
            opacity: 1;
            filter: alpha(opacity=75);
            -moz-opacity: 0.75;
        }
    </style>
</div>
