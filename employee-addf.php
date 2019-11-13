<?php
include("include/config.php");
include("include/functions.php"); 
 validate_admin();
  $state_id=$obj->escapestring($_POST['state_id']);
  $city_id=implode(',',$_POST['city_id']);
  $empname=$obj->escapestring($_POST['empname']);
  $email=$obj->escapestring($_POST['email']);
  $mobile=$obj->escapestring($_POST['mobile']);
  $department_id=$obj->escapestring($_POST['department_id']);
  $username=$obj->escapestring($_POST['username']);
  $pass=$obj->escapestring($_POST['pass']);
 
  if($_REQUEST['submitForm']=='yes'){

  if($_REQUEST['id']==''){
    $obj->query("insert into $tbl_user set state_id='$state_id',city_id='$city_id',empname='$empname',email='$email',mobile='$mobile',department_id='$department_id',username='$username',pass='".md5($pass)."'");
    $_SESSION['sess_msg']='Manager  added sucessfully';
  } else {
    $sql="update $tbl_user state_id='$state_id',city_id='$city_id',empname='$empname',email='$email',mobile='$mobile',department_id='$department_id', where id=".$_REQUEST['id'];
    $obj->query($sql);
    $_SESSION['sess_msg']='Manager updated sucessfully';
}
header("location:employee-list.php");
}      
     
     
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_user where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Manager</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="employee-list.php">View Manager List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
      <form name="frm" id="departmentfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
      <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label>State</label>
                <select name="state_id" id="state_id" class="form-control select2">
                  <option value="">Select State</option>
                  <?php
                  $stateSql = $obj->query("select * from $tbl_state where status=1");
                  while($stateResult = $obj->fetchNextObject($stateSql)){?>
                    <option value="<?php echo $stateResult->id; ?>" <?php if($result->state_id==$stateResult->id){?> selected <?php } ?>><?php echo $stateResult->state; ?></option>
                  <?php }?>
                </select>
               </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>City</label>
                <select name="city_id[]" id="city_id" class="form-control select2" multiple="">
                  <?php
                  $citySql = $obj->query("select * from $tbl_city where status=1");
                  while($cityResult = $obj->fetchNextObject($citySql)){?>
                    <option value="<?php echo $cityResult->id; ?>"><?php echo $cityResult->city; ?></option>
                  <?php }?>
                </select>
               </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Employee Name</label>
				       <input name="empname" type="text" id="empname" class="required form-control" value="<?php echo stripslashes($result->empname);?>" style="text-transform: uppercase;"/></div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
               <input name="email" type="text" id="email" class="required form-control" value="<?php echo stripslashes($result->email);?>" style="text-transform: uppercase;"/></div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Mobile</label>
               <input name="mobile" type="text" id="mobile" class="required form-control" value="<?php echo stripslashes($result->mobile);?>" style="text-transform: uppercase;"/></div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Department</label>
               <select name="department_id" id="department_id" class="form-control select2">
                  <option value="">Select State</option>
                  <?php
                  $dSql = $obj->query("select * from $tbl_department where status=1");
                  while($dResult = $obj->fetchNextObject($dSql)){?>
                    <option value="<?php echo $dResult->id; ?>" <?php if($result->department_id==$stateResult->id){?> selected <?php } ?>><?php echo $dResult->department; ?></option>
                  <?php }?>
                </select>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Address</label>
              <textarea name="address" class="form-control"><?php echo stripslashes($result->address);?></textarea>
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>User Name</label>
               <input name="username" type="text" id="username" class="required form-control" value="<?php echo stripslashes($result->username);?>" style="text-transform: uppercase;"/></div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
               <input name="pass" type="password" id="pass" class="required form-control" value="<?php echo stripslashes($result->pass);?>" style="text-transform: uppercase;"/></div>
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
<script src="js/select2.full.min.js"></script>
<script type="text/javascript" language="javascript">
   $(".select2").select2();
$(document).ready(function(){
   $("#departmentfrm").validate();

    $("#state_id").change(function(){
    var state_id=$(this).val();
    
  $.ajax({
    url:"ajax/get_city.php",
    data:{state_id:state_id},
    beforeSend:function(){
    $("#area_id").html('<option value="">Select City</option>');
    },
    success:function(data){
    $("#city_id").html(data);
    }
  })
 
  })

})
</script>
</body>
</html>
