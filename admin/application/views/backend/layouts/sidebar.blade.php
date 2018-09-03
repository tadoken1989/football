<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="/" class="site_title"><i class="fa fa-paw"></i> <span></span>Admin Manager</a>
    </div>
    <div class="clearfix"></div>
    {{--<!-- menu profile quick info -->--}}
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="<?php echo base_url('/public/backend/images/picture.jpg') ?>" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>Admin</h2>
        </div>
    </div>
    {{--<!-- /menu profile quick info -->--}}
    <br/>
    {{--<!-- sidebar menu -->--}}
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/') }}">Dashboard</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Crawler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/crawler/get-all-leagues') }}">Leagues</a></li>
                        <li><a href="{{ base_url('/crawler/get-team-info') }}">Lấy đội bóng </a></li>
                        <li><a href="{{ base_url('/crawler/get-standing-info') }}">Lấy BXH </a></li>
                        <li><a href="{{ base_url('/crawler/get-historic') }}">Lấy kết quả toàn giải</a></li>
                        <li><a href="{{ base_url('/crawler/get-historic-by-date') }}">Lấy kết quả theo ngày</a></li>
                        <li><a href="{{ base_url('/crawler/get-fixture-info') }}">Lấy lịch thi đấu </a></li>
                        <li><a href="{{ base_url('/crawler/get-top-scorers') }}">Lấy vua phá lưới </a></li>
                        <li><a href="{{ base_url('/crawler/get-player-of-team') }}">Lấy cầu thủ của đội </a></li>
                        <li><a href="{{ base_url('/crawler/get-player-of-league') }}">Lấy cầu thủ của giải </a></li>
                        <li><a href="{{ base_url('/crawler/get-all-groups') }}">Lấy thông tin bảng đấu </a></li>
                        <li><a href="{{ base_url('/crawler/get-odds-by-match') }}">Lấy tỉ lệ</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-life-ring"></i> Quản lý đội bóng <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/team') }}"> Quản lý đội bóng</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-tachometer"></i> Quản lý giải đấu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/league') }}">  Quản lý giải đấu</a></li>
                        <li><a href="{{ base_url('/league/list-season') }}">  Quản lý mùa giải</a></li>
                        <li><a href="{{ base_url('/league/list-country') }}">  Quản lý quốc gia</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Quản lý link sopcast <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/link') }}"> Quản lý link sopcast</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Quản lý lịch phát sóng <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/television') }}">  Quản lý lịch phát sóng</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Quản lý Tip <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/tip') }}">  Quản lý Tip</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-tasks"></i> Cấu hình site <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ base_url('/setting') }}"> Cấu hình site</a></li>
                        <li><a href="{{ base_url('/setting/back-link') }}"> Backlink</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>