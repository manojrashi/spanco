<?php 
include('../include/config.php');
include("../include/functions.php");
$state_id   = $_REQUEST['state_id'];
$sql=$obj->query("select * from  $tbl_city where s_id='".$state_id."'",$debug=-1); ?>
<?php  while($line=$obj->fetchNextObject($sql)){?>
<option value="<?php echo $line->id; ?>"><?php echo $line->city; ?></option>
<?php }?>
<option value="0">All</option>
		

