<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sila | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/square/blue.css">
  <!-- Icon -->
  <link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/logo_telkom_2.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .head-bg {
      background: #000;
      position: relative;
      padding: 10px;
      margin-bottom: 50px;
    }
    .head-bg-img {
      position: absolute;
      left: 0;
      top: 0;
      background: url(http://103.89.1.46:8082/assets/dist/img/telkom_identity.jpg);
      height: 100%;
      width: 100%;
      background-size: unset;
      opacity: 0.2;
      z-index: 1;
      background-position: center center;
    }
  </style>

</head>

  <div class="head-bg-img">
  </div>

  <body class="hold-transition login-page" style="height:0; background:#000">
    <div class="login-box" style="position:relative; z-index:1">
      <div class="login-logo">
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body" style="border-radius:30px">
      <img src="<?=base_url()?>assets/dist/img/logo_telkom.png" alt="Mountain View" style="width:100%;height:100%;">
        <p class="login-box-msg" style="margin-top: 20px"><b>Sign in to SILA<b></p>

        <?= $this->session->flashdata('message') ?>
        
        <form action="<?= base_url() ?>dashboard/Loginvalidate" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="txUsername" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="txPassword" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
          <a href="#">Lupa Password</a>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
