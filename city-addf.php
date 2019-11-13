<?php
session_start();
include("include/config.php");
include("include/functions.php"); 

 validate_admin();
  $s_id= $obj->escapestring($_POST['s_id']);
  $city=ucfirst($obj->escapestring($_POST['city']));
 if($_REQUEST['submitForm']=='yes'){
    
  if($_REQUEST['id']==''){
    $obj->query("insert into $tbl_city set s_id='$s_id',city='$city',status=1 ");
    $_SESSION['sess_msg']='Sector  added successfully';  
    
       }else{     
     $sql=" update $tbl_city set s_id='$s_id',city='$city' ";
     $sql.=" where id='".$_REQUEST['id']."'";
     $obj->query($sql);
     $_SESSION['sess_msg']='Sector updated successfully';   
        }
   header("location:city-list.php");
   exit();
  }      
     
     
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_city where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> City</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="city-list.php">View City</a></li>
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
                <label>State:</label>
                 <select name="s_id" id="s_id" class="form-control">
                   <?php $cityArr=$obj->query("select * from $tbl_state where status=1 ",$debug=-1);
                     while($resultCity=$obj->fetchNextObject($cityArr)){?>
                    <option value="<?php echo stripslashes($resultCity->id);?>" <?php if($result->s_id==$resultCity->id){?>selected<?php } ?>><?php echo stripslashes($resultCity->state);?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group">
                <label>City:</label>
                <input name="city" type="text" id="city"  value="<?php echo stripslashes($result->city);?>" class="required form-control" />
                <span id="SuccesMsg" style="color:red;"></span>
              </div>

            </div>
          </div>
       </div>
		<div class="box-footer">
		<input type="submit" name="submit" value="Submit" id="submitbtn" class="button" border="0"/>&nbsp;&nbsp;
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
        $("#area").blur(function(){
            $('#SuccesMsg').show();
            var area = $(this).val();
            var city_id = $("#city_id").val();
            $.ajax({
                type: "POST",
                url: "ajax/getLocationData.php",
                data:{'name':area,'action':'area','city_id':city_id},
                success: function(data){
                    if(data==1){
                        $('#SuccesMsg').html("This sector is already exist.");
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
