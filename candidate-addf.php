<?php
include("include/config.php");
include("include/functions.php"); 
include("include/simpleimage.php");
 validate_admin();
  
if($_REQUEST['submitForm']=='yes'){
    $fname=$obj->escapestring($_POST['fname']);
    $mname=$obj->escapestring($_POST['mname']);
    $lname=$obj->escapestring($_POST['lname']);
    $email=$obj->escapestring($_POST['email']);
    $contactno=$obj->escapestring($_POST['contactno']);
    $vacancy_id=$obj->escapestring($_POST['vacancy_id']);
    $doa=$_POST['doa'];
    $pdesc=$obj->escapestring($_POST['pdesc']);

  if($_FILES['resume']['size']>0 && $_FILES['resume']['error']==''){
      $img=time().substr($_FILES['resume']['name'],-5);
      move_uploaded_file($_FILES['resume']['tmp_name'],"upload_images/resume/".$img);
    }
  if($_REQUEST['id']==''){
    $obj->query("insert into  $tbl_candidate set fname='$fname',mname='$mname',lname='$lname',email='$email',contactno='$contactno',vacancy_id='$vacancy_id',doa='$doa',pdesc='$pdesc',resume='$img'");
    $_SESSION['sess_msg']='Candidate added sucessfully';
  } else {
   $sql = "update $tbl_candidate set fname='$fname',mname='$mname',lname='$lname',email='$email',contactno='$contactno',vacancy_id='$vacancy_id',doa='$doa',pdesc='$pdesc'";

   if($img){
      $query=$obj->query("select * from $tbl_candidate where id=".$_REQUEST['id']);
      $resultImage=$obj->fetchNextObject($query);
      @unlink("upload_images/resume/".$resultImage->resume);
      $sql.=" ,resume='$img' ";
    }
    $sql.=" where id=".$_REQUEST['id'];
   // echo $sql; die;
    $obj->query($sql);
 
    $_SESSION['sess_msg']='Candidate updated sucessfully';
}
header("location:candidate-list.php");
}      
     
if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_candidate where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Candidate</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="candidate-list.php">View Candidate List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
      <form name="frm" id="candidatefrm" method="POST" enctype="multipart/form-data" action="">
      <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>First Name</label>
               <input type="text" name="fname" class="required form-control" value="<?php echo stripcslashes($result->fname); ?>">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Middle Name</label>
               <input type="text" name="mname" class="form-control" value="<?php echo stripcslashes($result->mname); ?>">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Last Name</label>
               <input type="text" name="lname" class="form-control" value="<?php echo stripcslashes($result->lname); ?>">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
               <input type="text" name="email" class="required email form-control" value="<?php echo stripcslashes($result->email); ?>">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Contact No</label>
               <input type="text" name="contactno" class="required form-control" value="<?php echo stripcslashes($result->contactno); ?>">
            </div>
           </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Vacancy Name</label>
				        <select name="vacancy_id" class="required form-control select2">
                <option value="">Select Job Title</option>
                <?php
                $jobSql = $obj->query("select * from $tbl_vacancies where status=1");
                while ($JobResult = $obj->fetchNextObject($jobSql)) {?>
                   <option value="<?php echo stripcslashes($JobResult->id); ?>" <?php if($JobResult->id==$result->vacancy_id){?> selected <?php } ?>><?php echo strtoupper(stripcslashes($JobResult->vacancies_name)); ?></option>
                <?php } ?>
                
                </select>
            </div>
           </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Resume</label>
               <input type="file" name="resume" class="form-control" /><br/>
                     <?php if(is_file("upload_images/resume/".$result->resume)){?>
                      <a href="<?php echo "upload_images/resume/".$result->resume; ?>" download=""><img src="images/word.png" height="50px" width="50px"></a>
                     <?php } ?> 
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Date of Application</label>
               <input type="text" name="doa" id="doa" class="required form-control" value="<?php echo stripcslashes($result->doa); ?>"> 
            </div>
           </div>

           <div class="col-md-12">
              <div class="form-group">
                <label>Comment</label>
                <textarea class="required form-control" rows="5" name="pdesc"><?php echo stripcslashes($result->pdesc); ?></textarea>
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
   $("#candidatefrm").validate();
})
</script>
<link rel="stylesheet" href="calender/css/jquery-ui.css">
  <script src="calender/js/jquery-ui.js"></script>
  <script>
    $(function() {
        $( "#doa" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+1?>',
        minDate: 0,
        MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });
    });
    </script>
</body>
</html>
