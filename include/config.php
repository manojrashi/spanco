<?php  
ob_start();
@session_start();
error_reporting(0);
//error_reporting(E_ALL);
$hostname = 'localhost';

$username = 'root';
$password ='';
$db_name = 'pmsnew';

global $obj;
		
ini_set('date.timezone', 'Asia/Kolkata');
require_once("db.class.php");
require_once("variable.php");
$obj = new DB($hostname, $username, $password, $db_name); 
@define('SITE_URL',"http://localhost/pmsnew/");
@define('SITE_TITLE',"Xantatech");

//header('Content-Type: text/html; charset=iso-8859-1');
	
?>
