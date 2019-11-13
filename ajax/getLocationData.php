<?php 
include("../../include/config.php");
include("../../include/functions.php"); 

$name=$_POST['name'];
$action=$_POST['action'];

if($action=='city' && $name!=""){
    $citySql = $obj->query("select id from $tbl_city where city='$name'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}

if($action=='area' && $name!=""){
    $city_id =$_POST['city_id'];
    $citySql = $obj->query("select id from $tbl_area where area='$name' and city_id='$city_id'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}

if($action=='society' && $name!=""){
    $city_id =$_POST['city_id'];
    $area_id =$_POST['area_id'];
    $citySql = $obj->query("select id from $tbl_society where society='$name' and city_id='$city_id' and area_id='$area_id'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}

if($action=='unit' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_unit where name='$name'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}

if($action=='rack' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_rack where name='$name'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='groupname' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_usergroup where groupname='$name'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='groupval' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_usergroup where groupval='$name'");
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='state' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_franchise_state where state='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='frcity' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_franchise_city where city='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}

if($action=='department' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_rolecategory where role='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='destination' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_rolesubcategory where role='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='jobcategory' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_jobcategory where cat_name='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
if($action=='warehousecode' && $name!=""){
    $name =$_POST['name'];
    $citySql = $obj->query("select id from $tbl_warehouse where code='$name'",$debug=-1); //die;
    if($obj->numRows($citySql)>0){
        echo "1";
    }else{
        echo "0";
    }
}
?>



