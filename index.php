<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Xantatech PMS | Administrator</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<script language="javascript" type="text/javascript" src="js/admin.js"></script>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    <img src="images/logo.png">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Administrator</p>
    <div class="col-md-12"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:16px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>

    <form name="loginform" id="loginform" method="post" action="login.php">
  <input type="hidden" name="logged" value="yes" />
      <div class="form-group has-feedback">
    <input name="username" type="text" value="" class="required form-control" id="username" Placeholder="User Name" />  
      </div>
      <div class="form-group has-feedback">
    <input  name="password" id="userpass" type="password" value="" class="required form-control" Placeholder="Password"/>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              &nbsp;
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <div class="col-xs-12">
          <p class="login-admin-msg">Please enter a valid username and password to gain access to the administration console.</p>
        </div>

        <!-- /.col -->
      </div>
    </form>
  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- iCheck -->

<script src="js/icheck.min.js"></script>
<script>
$(document).ready(function(){
  $("#loginform").validate();
  })
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


<style type="text/css">
.login-admin-msg{
      padding: 40px 5px 5px;
    text-align: center
}
.has-feedback {
    position: relative;
    margin-bottom: 30px;
}
body {
   
    font-weight: 400;
    overflow-x: hidden;
    overflow-y: hidden;
    background-image: url('images/bp2.jpg');
}  
</style>

