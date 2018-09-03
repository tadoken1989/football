<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CRAWLER MANAGER</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo base_url('public/default/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('public/default/bootstrap/css/bootstrap-theme.min.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('public/default/css/app.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('public/default/plugins/toastr/toastr.min.css');?>" />

  <script>
    var MAIN_URL = '<?php echo base_url('');?>';
  </script>
</head>

<div class="container">
  <div class="col-xs-6 col-xs-offset-3">
    <h1 class="text-center">Login</h1>

    <?php if($message):?>
      <div class="alert alert-info" id="infoMessage"><?php echo $message;?></div>
    <?php endif;?>

    <?php echo form_open("auth/login");?>

    <div class="form-group">
      <?php $identity['class'] = 'form-control';?>
      <?php echo lang('login_identity_label', 'identity');?>
      <?php echo form_input($identity);?>
    </div>

    <div class="form-group">
      <?php $password['class'] = 'form-control';?>
      <?php echo lang('login_password_label', 'password');?>
      <?php echo form_input($password);?>
    </div>

    <div class="form-group">
      <?php echo form_submit(array('name' => 'submit', 'value' => 'ĐĂNG NHẬP', 'class' => 'btn btn-primary btn-block'));?>
    </div>

    <?php echo form_close();?>
  </div>
</div>