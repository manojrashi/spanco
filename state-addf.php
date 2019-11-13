<?php
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();

  $state=$obj->escapestring($_POST['state']);
  if($_REQUEST['submitForm']=='yes'){
  if($_REQUEST['id']==''){
	  $obj->query("insert into $tbl_state set state='$state',status=1 ");
	  $_SESSION['sess_msg']='State added sucessfully';  
	  
       }else{ 
	  $obj->query("update $tbl_state set state='$state' where id=".$_REQUEST['id']);
	  $_SESSION['sess_msg']='State updated sucessfully';   
        }
   header("location:state-list.php");
   exit();
  }      
	   
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_state where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> State</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="state-list.php">View State List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
				          <input type="text" name="state" id="state" value="<?php echo stripslashes($result->state); ?>" class="required form-control">
				          <span id="SuccesMsg" style="color:red;"></span>
              </div>
            </div>
          </div>
       </div>
		<div class="box-footer">
		<input type="submit" name="submit" id="submitbtn" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
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
<script>
    $(document).ready(function(){
        $("#frm").validate();
        $("#city").change(function(){
            $('#SuccesMsg').show();
            var city = $(this).val();
            $.ajax({
                type: "POST",
                url: "ajax/getLocationData.php",
                data:{'name':city,'action':'city'},
                success: function(data){
                    if(data==1){
                        $('#SuccesMsg').html("This city is already exist.");
                        $("#submitbtn").attr('disabled',true);
                    }else{
                        $('#SuccesMsg').hide();
                        $("#submitbtn").attr('disabled',false);
                    }
                }
            });
        })
    })
</script>
</body>
</html>
