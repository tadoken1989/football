@extends('backend.layouts.app')
@section('content')

<div class="container">
    <?php echo form_open("auth/change_password");?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                @if(isset($message) && $message)
                <div class="alert alert-info" role="alert">{{ $message }}</div>
                @endif

                <div class="panel">
                    <div class="panel-primary">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Mật khẩu cũ :</label>
                                <?php echo form_input($old_password);?>
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu mới :</label>
                                <?php echo form_input($new_password);?>
                            </div>

                            <div class="form-group">
                                <label>Xác nhận mật khẩu :</label>
                                <?php echo form_input($new_password_confirm);?>
                            </div>

                            <div class="form-group">
                                <?php echo form_input($user_id);?>
                                <button class="btn btn-success btn-block" type="submit">XÁC NHẬN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.row -->
    <?php echo form_close();?>

</div>

@endsection