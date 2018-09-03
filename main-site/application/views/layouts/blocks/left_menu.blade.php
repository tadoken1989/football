<div class="New_col-left">
    <div class="bg_New_col-left">

        <div class="list_New_col-left">
            <div class="list_title_New_col-left">
                GIẢI ĐẤU YÊU THÍCH
            </div>
            <div class="list_menu_New_col-left">
                <ul>
                    @foreach(loadFavoriteLeague() as $league)
                        <li><a href="{{ route_kq_league($league->alias,$league->id) }}">{{ $league->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <script type="text/javascript" src="http://static.bongda.wap.vn/js/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="http://static.bongda.wap.vn/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="http://static.bongda.wap.vn/js/mwheelIntent.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".scroll-pane").jScrollPane({
                    showArrows: !0,
                    animateScroll: true,
                    autoReinitialise: true
                });
            });
        </script>
        <style>
            /* Styles specific to this particular page */
            .scroll-pane {
                width: 100%;
                height: 300px;
                overflow: auto;
            }
        </style>
        <div class="list_New_col-left" id="league-other">
            <div class="list_title_New_col-left">
                CÁC GIẢI ĐẤU KHÁC
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    var menu_ul = $('.countries > li > ul'),
                        menu_a = $('.countries > li > a');
                    menu_ul.hide();
                    /*menu_a.first().addClass('active').next().slideDown('normal');*/

                    menu_a.click(function (e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                        } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true, true).slideUp('normal');
                        }
                    });

                });
            </script>

            <div class="list_menu_New_col-left scroll-pane jspScrollable" tabindex="0"
                 style="overflow: hidden; padding: 0px; width: 178px;">
                <ul class="countries">
                    @if(loadMenuLeft())
                        @foreach(loadMenuLeft() as $country)
                            <li>
                                <a href="#">{{ $country->name }}</a>
                                <ul class="leagues" style="display: none;">
                                    @if(isset($country->leagues))
                                        @foreach($country->leagues as $league)
                                            <li>
                                                <a href="{{ route_kq_league($league->alias,$league->id) }}">{{ $league->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div style="clear: both;"></div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>