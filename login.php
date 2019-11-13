<?php
include("include/config.php");
include("include/functions.php");
$username=$obj->escapestring($_POST['username']);
$password=$obj->escapestring($_POST['password']);
if($_POST['logged'] == "yes"){
	$sql =$obj->query("select * from $tbl_admin where username='$username' and password='$password'",$debug=-1);
	$row=$obj->numRows($sql);
	if($row>0){
		$line=$obj->fetchNextObject($sql);
		$_SESSION['sess_admin_id']=$line->id;
		$_SESSION['sess_admin_username']=$line->username;
		$_SESSION['user_type']=$line->user_type;
		
		$ip = get_ip_address();
		$time = date('H:i:s');
		$obj->query("insert into $tbl_login_time set user_id='".$line->id."',login_time='$time',type='Login',ip='$ip'",$debug=-1); 

		if($_REQUEST['back']==''){
			header("location: welcome.php");
		}else{
			header("location:".$_REQUEST['back']);	
		}   	
	} else{
	
	$_SESSION['sess_msg'] = 'Invalid Username/Password';
	header("Location: index.php");
  }
}
?>