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
                    <br>
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Is_Current</th>
                            <th>Create At</th>
                            <th>Status</th>
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
                ajax: {
                    "url": "{{ base_url('/league/get-season') }}",
                    "contentType": "application/json",
                    "type": "GET",
                    "data": function (d) {
                        d.date_from = $("#datepicker_from").val();
                        d.date_to = $("#datepicker_to").val();
                        return d;
                    }
                },
                columns: [
                    {data: 'no', name: 'no'},
                    {data: 'season_name', name: 'season_name'},
                    {data: 'season_code', name: 'season_code'},
                    {data: 'is_current', name: 'is_current'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'state', name: 'state'},
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