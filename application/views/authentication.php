<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GPL| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.4.0 -->
	<!-- <link rel="stylesheet" href="<?=base_url()?>resources/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url()?>resources/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>resources/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>resources/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>resources/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>GPL </b>LOGIN PAGE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start entering score</p>

    <form action="<?=site_url('login');?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				<small class=" <?php if(form_error('email') != null){echo "text-danger";} ?>" id="emailError"><?php if(form_error('email') != null){ echo form_error('email'); } else { echo "Tip: example@example.com"; }?></small>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				<small class="custom-control <?php if(form_error('password') != null){echo "text-danger";} ?>" id="passwordError" ><?php if(form_error('password') != null){ echo form_error('password'); } else { echo "Tip: enter valid password"; }?></small>
      </div>
      <div class="row">
        <div class=" col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<div class="custom-link col-xs-12">
							<?php if(isset($error))
							{
								echo "<small class='text-danger'>$error !</small>";
							} 	
							?>
						</div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery 3 -->
<script src="<?=base_url()?>resources/js/jquery.min.js"></script>
<!-- Bootstrap 3.4.1 -->
<script src="<?=base_url()?>resources/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>resources/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
