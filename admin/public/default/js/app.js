function init_form_ajax(target, callback_success, callback_error, callback_before){
    $(target).submit(function(e){
        e.preventDefault();
        var _this = $(this);

        callback_before && callback_before();

        $.ajax({
            type: _this.attr('method'),
            url: MAIN_URL + _this.attr('action'),
            contentType: false,
            processData: false,
            data: function(){
                return new FormData(_this.parent().children("form")[0]);
            }(),
            dataType: 'json',
            beforeSend: function(xhr){
                _this.block();
            },
            success: function(data){
                if(data.result) {
                    toastr.success(data.message);
                    callback_success && callback_success(data);
                } else {
                    toastr.error(data.message);
                    callback_error && callback_error(data);
                }
            },
            error:function (xhr, textStatus, thrownError){
                toastr.error(thrownError ,'Error ' + xhr.status);
            },
            complete: function(){
                _this.unblock();
            }
        });
    });
}

$(function(){
    $('.navbar-nav li a').click(function(){
        $('.navbar-nav li').removeClass('active');
        $(this).parent().addClass('active');
    });
});