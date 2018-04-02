<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>AdminLTE 2 | Log in</title>
          <!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <!-- Bootstrap 3.3.6 -->
          <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
          <!-- Font Awesome -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
          <!-- Ionicons -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.11/dist/css/AdminLTE.min.css">
          <!-- iCheck -->
          <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.11/plugins/iCheck/square/blue.css">

          <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
          <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Display Informasi</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Form Login Page</p>
                <form action="<?php echo base_url() ?>auth/login" method="post">
                  <div class="form-group has-feedback">
                    <input type="username" class="form-control" placeholder="Email" name="username" id="username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <p class='text-red center'><?php echo $this->session->flashdata("message"); ?><p> 
                    </div>
                    <div class="col-xs-8">
                      <div class="checkbox icheck">
                        <label>
                          <input type="checkbox" name='remember_me'> Remember Me
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

       <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
             function cekLogin() {
                var username = $("#username").val();
                var password = $("#password").val();
                  if(username=='') {
                    bootbox.alert("USERNAME TIDAK BOLEH KOSONG");
                    $("#username").focus();
                    return false;
                  }
                  if (password=='') {
                    bootbox.alert("PASSWORD TIDAK BOLEH KOSONG");
                    $("#username").focus();
                    return false;
                  }
            } 
        </script>
    </body>
</html>