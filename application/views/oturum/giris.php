<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url("bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("bower_components/font-awesome/css/font-awesome.min.css"); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url("bower_components/Ionicons/css/ionicons.min.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("dist/css/AdminLTE.min.css"); ?>">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">

</head>
<body class="hold-transition login-page" style="background-image:url('<?php echo base_url("assets/img/bg4.png"); ?>'); background-size:50px;" >
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo base_url("assets/img/logo.bmp") ?>" alt="logo" style="width:70px;">
    <br>
    <span><b>Ders Programı Giriş</b></span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">
    <p class="login-box-msg bYazi">Oturum Açmak için Giriş Yapınız</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="kullanici" class="form-control bYazi" placeholder="Kullanıcı Adı" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="sifre" class="form-control bYazi" placeholder="Şifre" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <button type="submit" class="btn btn-primary btn-block btn-flat bYazi">Giriş Yap</button>
        </div>
        <!-- /.col -->
      </div>
      <br>
      <?php if(@$hata){ ?>
      <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 alert alert-danger" style="padding:10px;">
          <p style="text-align:center;">
              <?php echo $hata; ?>
              <br>
              Tekrar Deneyiniz.
            </p>
          </div>
      </div>
      <?php } ?>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script src="<?php echo base_url("bower_components/jquery/dist/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("bower_components/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("plugins/iCheck/icheck.min.js"); ?>"></script>    
</body>
</html>