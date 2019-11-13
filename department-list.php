<?php
	session_start(); 
	include("include/config.php");
	include("include/functions.php"); 
	validate_admin();
?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>

<script src="js/jquery-2.2.3.min.js"></script>

<link rel="stylesheet" href="colorbox/colorbox.css" />
  <script src="colorbox/jquery.colorbox.js"></script>
 
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
      	<div class="col-md-3"><h4>Manage Department</h4></div>
      	<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
      	<div class="col-md-3"><p style="text-align:right">
      		<span><input type="button" name="add" value="Add Department"  class="button btn-success" onclick="location.href='department-addf.php'" /></span>	
      		</p>
      	</div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
		<form name="frm" method="post" action="department-del.php" enctype="multipart/form-data">
          <div class="box box-primary">
            <div class="box-body">
              <table id="company-grid" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>SNo.</th>
				<th>Department Name</th>
				<th>Status</th>
				<th>Action</th>
				  <th><!-- <input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" /> --></th>
                </tr>
                </thead>
                <tbody>
				<?php
				$i=1;
				$sql=$obj->query("select * from $tbl_department where 1=1 order by id desc limit 0,50",$debug=-1);
				while($line=$obj->fetchNextObject($sql)){?>
                <tr bgcolor="<?php echo $bgcolor;?>">
					<td><?php echo $i; ?></td>
					<td><?php echo strtoupper(stripslashes($line->department));?></td>
					<td align="center">
					<label class="switch">
						<input type="checkbox" class="chkstatus" value="<?php echo $line->id;?>" <?php echo ($line->status=="1")?'checked':'' ?>  data-one="<?php echo $tbl_department?>">
						<div class="slider round"></div>
						</label>
					</td>
					<td>
						<a href="department-addf.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="edit"><i class="fa fa-pencil"></i></a> 
					</td>
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
			<div class="col-md-9"></div>
			<div class="col-md-3" align="right">
				<input type="hidden" name="what" value="what" />
				<input type="submit" name="Submit" value="Activate" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
				<input type="submit" name="Submit" value="Deactivate" class="button btn-warning" onclick="return del_prompt(this.form,this.value)" />
				<!-- <input type="submit" name="Submit" value="Delete" class="button btn-danger" onclick="return del_prompt(this.form,this.value)" /> -->
			</div></div>
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
<!--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->
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
$(document).ready(function() {
    $('#company-grid').DataTable( {
        "deferRender": true
    } );
} );

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
					frmobj.action = "department-del.php";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "department-del.php";
			frmobj.what.value="Deactivate";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "department-del.php";
			frmobj.what.value="Activate";
			frmobj.submit();
		}
		
		
	}
</script>
<script src="js/change-status.js"></script> 
</body>
</html>
