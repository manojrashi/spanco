<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
  

$emp_id=$_POST['emp_id'];
$leavetype=$_POST['leavetype'];  


 if ($_POST['emp_id']) {

     $sql=$obj->query("select entitlement from $tbl_entitlement where emp_id='".$emp_id."' and leave_type='".$leavetype."'",$debug=-1);
     $result = $obj->fetchNextObject($sql);
     if($result->entitlement==''){
     	echo 0;
     }else{
     echo $result->entitlement;
     }
  }


?>