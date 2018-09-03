@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-6">
                        <h2>
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        @include('backend.layouts.filter_date')
                    </div>
                    <br>
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Date</th>
                            <th>Round</th>
                            <th>Location</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>League</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: true,
                        pageLength: 50,
                        search: true,
                        ajax: {
                            "url": "{{ base_url('/fixture/getData') }}",
                            "contentType": "application/json",
                            "type": "GET",
                            "data": function (d) {
                                d.date_from = $("#datepicker_from").val();
                                d.date_to = $("#datepicker_to").val();
                                return d;
                            }
                        },
                        columns: [
                            {data: 'fixture_matches_id', name: 'fixture_matches_id'},
                            {data: 'date', name: 'date'},
                            {data: 'round', name: 'round'},
                            {data: 'location', name: 'location'},
                            {data: 'home_team', name: 'home_team'},
                            {data: 'away_team', name: 'away_team'},
                            {data: 'league', name: 'league'},
                        ]
                    });
            $("#datepicker_from").datepicker({  maxDate: new Date()});
            $("#datepicker_to").datepicker({  maxDate: new Date()});
            $(document).on('click', '#filter_submit', function () {
                var min = $('#datepicker_from').datepicker("getDate");
                var max = $('#datepicker_to').datepicker("getDate");
                if(min == '' && max == ''){
                    swal("Cảnh báo", "Bạn chưa chọn bất kì ngày nào !", "error");
                }
                else if (min > max) {
                    swal("Cảnh báo", "Bạn vừa chọn ngày kết thúc nhỏ hơn ngày bắt đầu ", "error");
                } else {
                    $('.loading').show();
                    table.draw();
                    setTimeout(function(){   $('.loading').fadeOut();  }, 1000);
                }
            });
        });
    </script>
@endsection