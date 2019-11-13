<?php
ob_start();
session_start(); 
include("include/config.php");
include("include/functions.php");
validate_admin();


if($_POST['submitForm']=="yes"){
  $email=$obj->escapestring($_POST['email']);

  $obj->query("update $tbl_admin set email='$email' where id=".$_SESSION['sess_admin_id'],$debug=-1);
  $_SESSION['sess_msg']='Email updated sucessfully';
}


if($_SESSION['sess_admin_id']){
  $sql=$obj->query("select * from $tbl_admin where id=".$_SESSION['sess_admin_id'],$debug=-1);
  $result=$obj->fetchNextObject($sql);   
} 
?>

<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("header.php"); ?>
   <?php include("menu.php"); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Change Email</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email:</label>
				        <input name="email" type="text" id="email" size="36"  value="<?php echo stripslashes($result->email);?>" class="required email" />
              </div>
             
			  </div>

          </div>
       </div>
		<div class="box-footer">
		<input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
		<input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
		</div>
		</form>
      </div>
    </section>
  </div>
  <?php include("footer.php"); ?>
  <div class="control-sidebar-bg"></div>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" language="javascript">
      $(document).ready(function(){
        $("#frm").validate();
      })
    </script>
</body>
</html>
