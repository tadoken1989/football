<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /*
    | -------------------------------------------------------------------------
    | URI ROUTING
    | -------------------------------------------------------------------------
    | This file lets you re-map URI requests to specific controller functions.
    |
    | Typically there is a one-to-one relationship between a URL string
    | and its corresponding controller class/method. The segments in a
    | URL normally follow this pattern:
    |
    |	example.com/class/method/id/
    |
    | In some instances, however, you may want to remap this relationship
    | so that a different class/function is called than the one
    | corresponding to the URL.
    |
    | Please see the user guide for complete details:
    |
    |	https://codeigniter.com/user_guide/general/routing.html
    |
    | -------------------------------------------------------------------------
    | RESERVED ROUTES
    | -------------------------------------------------------------------------
    |
    | There are three reserved routes:
    |
    |	$route['default_controller'] = 'welcome';
    |
    | This route indicates which controller class should be loaded if the
    | URI contains no data. In the above example, the "welcome" class
    | would be loaded.
    |
    |	$route['404_override'] = 'errors/page_missing';
    |
    | This route will tell the Router which controller/method to use if those
    | provided in the URL cannot be matched to a valid route.
    |
    |	$route['translate_uri_dashes'] = FALSE;
    |
    | This is not exactly a route, but allows you to automatically route
    | controller and method names that contain dashes. '-' isn't a valid
    | class or method name character, so it requires translation.
    | When you set this option to TRUE, it will replace ALL dashes in the
    | controller and method URI segments.
    |
    | Examples:	my-controller/index	-> my_controller/index
    |		my-controller/my-method	-> my_controller/my_method
    */



    $route['default_controller']   = 'Livescore/index';
    $route['404_override']         = '';
    $route['translate_uri_dashes'] = TRUE;

    $route['lich-thi-dau-bong-da.html']        = 'Fixture/index';
    $route['lich-thi-dau-([a-zA-Z0-9\-]+)-(:num).html']        = 'League/lichthidauthevong/$1/$2';

    $route['lich-thi-dau-ngay-(:any).html']        = 'Fixture/index/$1';


    $route['ket-qua-bong-da.html']        = 'History/all';

    $route['ket-qua-ngay-(:any).html']        = 'History/all/$1';

    // link sopcast

    $route['link-sopcast-xem-bong-da-truc-tuyen.html']        = 'Sopcast/index';

    $route['link-sopcast-xem-bong-da-truc-tuyen-(:num).html']        = 'Sopcast/detail/$1';

    $route['lich-phat-song-bong-da.html']   = 'Television/index';

    
    //ket qua bong da theo vong
    $route['ket-qua-([a-zA-Z0-9\-]+)-(:num)-vong-(:num).html'] = 'League/ketquatheovong/$1/$2/$3';
    // league detail

    $route['ket-qua-([a-zA-Z0-9\-]+)-(:num).html'] = 'League/index/$1/$2';

    // ty le bong da

$route['ty-le-bong-da.html']        = 'Fixture/Fixture/tylebongda';
$route['ty-le-bong-da-truc-tuyen.html']        = 'Fixture/Fixture/get_data';


$route['ty-le-cac-tran-ngay-([a-zA-Z0-9\-]+)-(:num).html']        = 'Fixture/Fixture/tylebongdatheothu/$1/$2';
$route['ty-le-cac-tran-(:any).html']        = 'Fixture/Fixture/tylebongdatheongay/$1';

    // bảng xếp hạng bóng đá

    $route['bang-xep-hang-bong-da.html']        = 'Ratings/Ratings/index';

    //bang xep hang fifa 
    $route['bang-xep-hang-fifa-([a-zA-Z\-]+).html'] = 'Ratings/bxhFifa/$1';
    $route['bang-xep-hang-fifa-([a-zA-Z\-]+)-page-(:num).html'] = 'Ratings/bxhFifa/$1/$2';

    //bảng xếp hạng sân nhà
    $route['bang-xep-hang-san-nha-([a-zA-Z0-9\-]+)-(:num).html']        = 'Ratings/Ratings/bangXepHangSanNha/$1/$2';

    //bảng xếp hạng sân khách
    $route['bang-xep-hang-san-khach-([a-zA-Z0-9\-]+)-(:num).html']        = 'Ratings/Ratings/bangXepHangSanKhach/$1/$2';
    
    //detail bảng xếp hạng
    $route['bang-xep-hang-([a-zA-Z0-9\-]+)-(:num).html']        = 'Ratings/Ratings/detail/$1/$2';

    $route['vua-pha-luoi-([a-zA-Z0-9\-]+)-(:num).html']        = 'Ratings/Ratings/vuaphaluoi/$1/$2';

    
    // team detail

    $route['doi-([a-zA-Z0-9\-]+)-(:num).html']   = 'Team/detail/$1/$2';


    // route detail cap dau
//    s1.trang phong do
    $route['phong-do-([a-zA-Z0-9\-]+)-vs-([a-zA-Z0-9\-]+)-(:num)-(:num)-(:num).html'] = 'History/detail/$3/$4/$5';


    $route['phong-do-([a-zA-Z0-9\-]+)-vs-([a-zA-Z0-9\-]+)-(:num)-(:num).html'] = 'History/detailAlias/$3/$4/';

//    s2.trang truc tiep
    $route['truc-tiep-([a-zA-Z0-9\-]+)-vs-([a-zA-Z0-9\-]+)-(:num).html'] = 'History/live/$3';

    $route['truc-tiep-([a-zA-Z0-9\-]+)-vs-([a-zA-Z0-9\-]+)-(:num)-(:num).html'] = 'History/live/$4';

//    s3.trang ti le 1 cap dau
    $route['ty-le-([a-zA-Z0-9\-]+)-vs-([a-zA-Z0-9\-]+)-(:num).html'] = 'Odds/detail/$3';


// Trang Tip

    $route['tip-bong-da.html']   = 'Tip/index';
    $route['tip-live.html']   = 'Tip/live';


    $route['nhan-dinh-bong-da.html'] = 'Tip/ykcg';

    $route['du-doan-bong-da-cua-bao-chi.html'] = 'Tip/news';

    // livescore

    $route['ajax.html'] = 'Livescore/ajaxLoad';

    $route['live.html'] = 'Livescore/index';


    $route['Menu_Data.html'] = 'Livescore/menuData';

    $route['UnderOver_tmpl'] = 'Livescore/UnderOver_tmpl';

    $route['MorePop_tmpl.html'] = 'Livescore/MorePop_tmpl';


    $route['odds-live.html'] = 'Livescore/odds_live';


