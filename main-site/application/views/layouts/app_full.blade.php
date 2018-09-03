<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
    <title>{{ load_configs('site_title') }}</title>
    <meta name="description"
          content="{{ load_configs('site_description') }}">
    <meta name="keywords" content="{{ load_configs('site_keywords') }}">

    <link rel="alternate" href="{{ base_url() }}" hreflang="vi-vn">
    <meta property="og:url" itemprop="url" content="{{  base_url() }}">
    <meta property="og:title" content="{{ load_configs('site_title') }}">
    <meta property="og:description"
          content="{{ load_configs('site_description') }}">
    <meta name="news_keywords"
          content="{{ load_configs('site_keywords') }}">
    <meta name="author" content="bongda">
    <meta name="generator" content="{{ str_replace(['http://','https://','/'], "", base_url()) }}">
    <meta name="abstract" content="{{ str_replace(['http://','https://','/'], "", base_url()) }}">
    <meta name="copyright" content="{{  load_configs('footer_description') }}">
    <meta name="robots" content="index,follow,noodp">
    <meta http-equiv="REFRESH" content="1200">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="vi">
    <meta name="revisit-after" content="1 days">
    <meta name="google-site-verification" content="UUHTHF1xvF_kK9Axndmhlg8xVVICrBpF59L3C9YrwoU">
    <meta property="fb:pages" content="590672034304448">

    <meta property="og:type" content="website">
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN">
    <meta property="og:site_name" content="{{ load_configs('site_name') }}">
    <meta property="og:image" content="images/logo-bongdawap.png">
    <style>
        .op-ad {
            display: block;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }
    </style>
    <link rel="canonical" href="{{  base_url() }}"/>
    <link href="<?php echo base_url('public/default/css/style.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/default/css/style1.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/default/css/custom.css');?>" rel="stylesheet" type="text/css" />
    <link rel="icon" href="<?php echo base_url('public/default/images/favicon.ico');?>" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo base_url('public/default/js/jquery-1.7.1.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/default/js/function.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/default/js/func_new.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/default/js/livescore.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/default/js/custom.js');?>"></script>
    <style>
        _::-webkit-:not(:root:root), body, h1, h2 {
            margin: 0px;
            padding: 0px;
            line-height: 15px;
            font-size: 8px !important;
        }

        _::-webkit-:not(:root:root), .menubd_1b h2 {
            margin: 0px;
            padding: 0px;
            line-height: 10px;
            font-size: 8px !important;
        }

        _::-webkit-:not(:root:root), .menubd_1b a {
            font-size: 8px !important;
        }
    </style>
    @yield('extra-css')
    <link type="text/css" href="http://static.bongda.wap.vn/css/jquery.jscrollpane.css" rel="stylesheet" media="all">
</head>

<body>
<center>
    <span id="sound"></span>
    <div class="nen_bd">

        @include('layouts.header')

        @include('layouts.blocks.menu')

        @yield('content')
        <!-- end Col left -->
        <!-- start col center -->
        <div class="both"></div>

        @include('layouts.footer')
        <script type="text/javascript" src="{{ base_url('public/default/js/hidematch.js') }}"></script>
    </div>
</center>
</body>
<input type="hidden" name="url" value="{{ base_url() }}">
@yield('extra-js')
</html>