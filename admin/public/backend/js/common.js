/**
 * Created by ANH on 7/25/2017.
 */


var App = {
    initFlashMessage: function () {
        $("div.flash_message").not(".flash_important").delay(3000).slideUp();
    },
    initDatetime: function () {
        $('.birthday').datepicker({
            maxDate: new Date(),
            format : 'dd-mm-yyyy',
        });
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $(".datepicker").datepicker({
            format : 'dd-mm-yyyy',
        });
    },
    loadAvatar: function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image_review_avatar')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    },
    deleteModel: function () {
        $('#data-table').on('click', '.btn-active', function () {
            var $_this = $(this);
            swal({
                    title: "Bạn có chắc chắn ?",
                    text: "Bạn có chắc chắn rằng mình muốn thực hiện thao tác này.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Vâng, thực hiện ngay!",
                    cancelButtonText: "Không, huỷ !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        if ($_this.data('id')) {
                            $.ajax({
                                method: "post",
                                url: '/ajax/active',
                                data: {'id': $_this.data('id'), 'model': $_this.data('model'),'status': $_this.data('status')},
                                beforeSend: function () {
                                    swal.close();
                                    $('.loading').show();
                                },
                                success: function (data) {
                                    var res = $.parseJSON(data);
                                    $('.loading').fadeOut();
                                    if(res.status == 200){
                                        swal("Thành công", "Thao tác bạn vừa thực hiện thành công", "success");
                                        var $span = $('span#status-'+$_this.data("id"));
                                        $_this.attr('data-status',res.state);
                                        if (res.state == 1) {
                                            $span.removeClass('label-success');
                                            $span.addClass('label-waring');
                                            $span.html('<i class="fa fa-check-square-o"></i> lock');
                                            $_this.removeClass('btn-danger');
                                            $_this.addClass('btn-warning');
                                            $_this.html('<i class="fa fa-check-square-o"></i> Active');
                                        } else {
                                            $span.removeClass('label-waring');
                                            $span.addClass('label-success');
                                            $span.html('<i class="fa fa-check"></i> active');
                                            $_this.removeClass('btn-warning');
                                            $_this.addClass('btn-danger');
                                            $_this.html('<i class="fa fa-trash"></i> Lock');
                                        }
                                    }else {
                                        swal("Thất bại", "Hệ thống xảy ra lỗi,vui lòng liên hệ admin", "error");
                                    }
                                },
                                error: function () {
                                    $('.loading').fadeOut();
                                    swal("Thất bại", "Hệ thống xảy ra lỗi,vui lòng liên hệ admin", "error");

                                }
                            });
                        }
                    } else {
                        swal.close();
                    }
                });
        })
    },
    multiSelect :function () {
        $('.multiselect-ui').multiselect({
            enableFiltering: true,
            filterBehavior: 'text',
            filterPlaceholder: 'Search for something...'
        });
    }
}

$(document).ready(function () {
    App.multiSelect();
    App.deleteModel();
    App.initFlashMessage();
    App.initDatetime();
});

