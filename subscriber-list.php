<?php
ob_start();
session_start(); 
include('include/config.php');
include("include/functions.php");
validate_admin();

	
	if(isset($_POST["Importexl"]))
	{
		
		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;$d=0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
		//$name = $filesop[0];
		$email = $filesop[4];
		if($c!=0)
		{
		$res = mysql_query("select * from tbl_newsletter where email='$email'");
		if(mysql_num_rows($res)==0){
		//$sql = mysql_query("INSERT INTO csv (name, email) VALUES ('$name','$email')");
		$sql = mysql_query("INSERT INTO tbl_newsletter (email, subscribe_date,status) VALUES ('$email',now(),1)");	
		$d++;
		}
		}
		$c++;
		}
		if($sql){
				$_SESSION['sess_msg'] = "You database has imported successfully. You have inserted ". $d ." recoreds";
			}else{
				$_SESSION['sess_msg'] = "Sorry! There is some problem. or Duplicate";
			}
	}

?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include("header.php"); ?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php include("menu.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
           <div class="row">
      	<div class="col-md-3"><h4>Manage Subscriber</h4></div>
      	<div class="col-md-5"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
			<form name="searchForm" method="post" action="client-list.php">
				<div class="col-md-2">
					<input type="file" name="file" required="" class="form-control" />
				</div>
				<div class="col-md-2">
					<input type="submit" name="Importexl" class="button" value="Import Excel" />
				</div>
			</form>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
		<form name="frm" method="post" action="subscriber-del.php" enctype="multipart/form-data">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Subscribe Date</th>
				  <th>Email</th>
       			  <th><input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" /></th>
                </tr>
                </thead>
                <tbody>
				<?php
				$i=1;
				$sql=$obj->query("select * from $tbl_newsletter where 1=1 and send_news=0 order by id asc",$debug=-1);
				while($line=$obj->fetchNextObject($sql)){?>
                <tr>
					<td><?php echo $i; ?></td>
					<td><?php echo date('d M Y H:i',strtotime($line->subscribe_date)); ?></td>
					<td> <?php echo stripslashes($line->email); ?></td>
					<td><input type="checkbox" name="ids[]" class="checkall" value="<?php echo $line->id;?>" /></td>
                </tr>
				<?php $i++; }?>
				
                </tbody>
				
                <tfoot>
                </tfoot>
				
              </table>
            </div>
				
            <!-- /.box-body -->
          </div>
		<div class="row">
	      	<div class="col-md-10"></div>
	      	<div class="col-md-2">
				<input type="hidden" name="what" value="what" />
				<input type="submit" name="Submit" value="Subscriber" class="button" onclick="return del_prompt(this.form,this.value)" />
				<input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" />
	      	</div>
	      	
	      </div>

			</form>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>


<script>
  
	function checkall(objForm)
    {
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox') 
		objForm.elements[i].checked=objForm.check_all.checked;
	}
   }
	function del_prompt(frmobj,comb)
		{
		//alert(comb);
			if(comb=='Delete'){
				if(confirm ("Are you sure you want to delete record(s)"))
				{
					frmobj.action = "subscriber-del.php";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "subscriber-del.php";
			frmobj.what.value="Deactivate";
			frmobj.submit();
		}
		else if(comb=='Subscriber'){
			frmobj.action = "subscriber-del.php";
			frmobj.what.value="Subscriber";
			frmobj.submit();
		}
		else if(comb=='Send Newsletter'){
			frmobj.action = "send-newsletter.php";
			frmobj.what.value="Send Newsletter";
			frmobj.submit();
		}
		
	}

</script>

</body>
</html>
