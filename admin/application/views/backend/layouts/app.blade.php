<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Manager</title>
    <link rel="stylesheet" href="/public/backend/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/backend/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/backend/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/public/backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
    <link rel="stylesheet" href="/public/backend/vendors/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/public/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/public/backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="/public/backend/build/css/custom.min.css">
    <link rel="stylesheet" href="/public/backend/sweetalert.css">
    <link rel="stylesheet" href="/public/backend/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/public/backend/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/public/backend/css/style.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<div class="container body">
    @include('backend.layouts.notices')
    <div class="main_container">
        <div class="col-md-3 left_col">
            @include('backend.layouts.sidebar')
        </div>
        <div class="top_nav">
            @include('backend.layouts.top_nav')
        </div>
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <footer>
            <div class="pull-right">
                Admin Manager by <a href="http://vdev.vn"> Anh Nguyen</a>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>

<script src="<?php echo base_url('public/backend/vendors/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('public/backend/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/fastclick/lib/fastclick.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/nprogress/nprogress.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/Chart.js/dist/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/vendors/validator/validator.js') ?>"></script>
<script src="<?php echo base_url('public/backend/sweetalert.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/bootstrap-tagsinput.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/bootstrap-multiselect.js') ?>"></script>
<script src="<?php echo base_url('public/backend/build/js/custom.min.js') ?>"></script>
<script src="<?php echo base_url('public/backend/js/common.js') ?>"></script>

@yield('extra-js')
</body>
</html>
