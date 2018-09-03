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
                            <th>Region</th>
                            <th>Create At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EnSureModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Nation Name</h4>
                </div>
                <div class="modal-body">
                    <p style="float: left">Nation name </p>
                    <input class="nation_name form-control"></input>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCancel">Cancel</button>
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
                    "url": "{{ base_url('/league/get-country') }}",
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
                    {data: 'name', name: 'name', class: 'nation_name_update'},
                    {data: 'region_name', name: 'region_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'state', name: 'state'},
                    {data: 'action', name: 'action'},
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

            $('#data-table').on('click', '.btn-edit',function () {
                var name = $(this).data('name');
                var id = $(this).data('id');
                var leagueName = $(this).closest('tr').find('.nation_name_update')
                $("#EnSureModal").modal();
                $('.nation_name').val(name)
                $('#EnSureModal').on('click', '#btnSave',function () {
                    $.ajax({
                        method: "post",
                        url: '/league/updateNation',
                        data: {'id': id, 'name' : $('.nation_name').val()},
                        success: function () {
                            $("#EnSureModal").hidden
                            leagueName.html($('.nation_name').val())
                        },
                    })
                })
            })
        });
    </script>
@endsection