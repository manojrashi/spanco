<?php
function currency($cur_id) {
	if($cur_id==1){
		return "$";
	}else if($cur_id==2){
		return "&euro;";
	}else if($cur_id==3){
		return "&pound;";
	}else if($cur_id==4){
		return "A$";
	}else if($cur_id==5){
		return "C$";
	}else if($cur_id==6){
		return "Rs";
	}
}

function getTotalCredit($pro_id) {
    $sql = $GLOBALS['obj']->query("select sum(credit_amount) as tot_Cr from tbl_credit where pro_id='" . $pro_id . "' and type='Cr' and status=1");
    $result = mysqli_fetch_assoc($sql);
    $Psql = $GLOBALS['obj']->query("select sum(credit_amount) as tot_PCr from tbl_credit where pro_id='" . $pro_id . "' and type='Dr' and status=1");
    $Presult = mysqli_fetch_assoc($Psql);
    return stripslashes($result['tot_Cr'] - $Presult['tot_PCr']);
}

function getTotalAmount($pro_id, $field,$type) {
    $sql = $GLOBALS['obj']->query("select sum($field) as tot_amt from tbl_credit where pro_id='" . $pro_id . "' and type='".$type."' and status=1");
    $result = mysqli_fetch_assoc($sql);
    return stripslashes($result['tot_amt']);
}

function getTotalTax($pro_id, $field) {
    $sql = $GLOBALS['obj']->query("select sum($field) as tot_amt from tbl_invoice where pro_id='" . $pro_id . "' and status=1");
    $result = mysqli_fetch_assoc($sql);
    return stripslashes($result['tot_amt']);
}

function getCategoryArray($cat_id, $array) {
    $array[] = $cat_id;
    $parent = getParent($cat_id);
    if ($parent != 0) {
        $array[] = $parent;
        return( getCategoryArray($parent, $array));
    } else {

        $array = array_unique($array);
        $array = array_reverse($array);
        return($array);
    }
}

function getMainParent($cat_id) {
    $arr = getCategoryArray($cat_id, $array = '');
    return ($arr[0]);
}

function getParent($pid) {
    $sql = $GLOBALS['obj']->query("select parent_id from  tbl_maincategory where id='$pid'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['parent_id']);
}

function getParentname($p_id) {
    $sql = $GLOBALS['obj']->query("select maincategory from  tbl_maincategory where id='$p_id'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['maincategory']);
}

function getgrandParent($p_id) {
    $sql = $GLOBALS['obj']->query("select maincategory from  tbl_maincategory where id='$p_id'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['maincategory']);
}

function CalculateOrderTime($order_date) {
    $order_time = '';
    $diff = abs(time() - strtotime($order_date));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / (60));
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
    if ($years > 0) {
        $order_time.=$years . " Years ";
    }
    if ($months > 0) {
        $order_time.=$months . " Months ";
    }
    if ($days > 0) {
        $order_time.=$days . " Days ";
    }
    if ($hours > 0) {
        $order_time.=$hours . " Hours ";
    }
    if ($minutes > 0) {
        $order_time.=$minutes . " Min ";
    }
    if ($seconds > 0) {
        $order_time.=$seconds . " Sec ";
    }

    $order_time.="  Ago ";
    return($order_time);
}

function generateCouponCode() {
    $chars = "ABCDEFGHJKLMNOPQRSRTUVWXYZ123456789";
    srand((double) microtime() * 1000000);
    $i = 0;
    $randno = '';

    while ($i < 6) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $randno = $randno . $tmp;
        $i++;
    }
    return strtoupper($randno);
}

function getYouTubeVideo($url) {
    $a = explode('v=', $url);
    $b = explode('&', $a[1]);
    return ("http://www.youtube.com/embed/" . $b[0]);
}

function generateSlug($name, $tbl, $id) {
    $newurl = str_replace(" - ", " ", $name);
    $newurl = str_replace("&", "", $newurl);
    $newurl = str_replace(",", " ", $newurl);
    $myurl = str_replace("--", "-", str_replace("%", "", str_replace(" ", "-", str_replace("-", " ", trim(str_replace("/", " ", str_replace(".", "", $newurl)))))));
    return $myurl = strtolower($myurl);
}

function buildURL($url) {
    $newurl = str_replace(" - ", " ", $url);
    $myurl = str_replace("--", "-", str_replace("%", "", str_replace(" ", "-", str_replace("-", " ", trim(str_replace("/", " ", str_replace(",", "", str_replace(".", "", $newurl))))))));
    return stripslashes(strtolower($myurl));
}

function parseInput($val) {
    return mysqli_real_escape_string(stripslashes($val));
}

function encryptPassword($val) {
    return sha1($val);
}

function getAdminEmail() {
    $sql = $GLOBALS['obj']->query("select email from tbl_admin  where id=1");
    $result = mysqli_fetch_assoc($sql);
    return ($result['email']);
}

function getFieldWhere($filed, $tbl, $where, $id) {
    $sql = $GLOBALS['obj']->query("select $filed as field from $tbl  where $where='" . $id . "'");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['field']));
}


function getUser($uid) {
    $sql = $GLOBALS['obj']->query("select uname from tbl_user  where id='" . $uid . "'");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes(ucfirst($result['uname'])));
}

function getContent($title) {
    $sql = $GLOBALS['obj']->query("select * from tbl_content where title='$title' ");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['content']));
}

function getField($filed, $table, $id) {

    $sql = $GLOBALS['obj']->query("select $filed as field from $table where id='$id' ");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['field']));
}

function clearCache() {
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
}

function redirect($url) {
    header("location:$url");
    exit();
}

function validateAdminSession() {
    if (trim($_SESSION["sess_admin_id"]) == "" && trim($_SESSION["sess_admin_logged"]) != "true") {
        $_SESSION["sess_msg"] = "Session is expire. Please login again to continue";
        redirect("login.php");
    }
}

function showSessionMsg() {
    if (trim($_SESSION["sess_msg"])) {
        echo $_SESSION["sess_msg"];
        $_SESSION["sess_msg"] = "";
    }
}

function validate_user() {
    if ($_SESSION['sess_uid'] == '') {
        ms_redirect("index.php?back=$_SERVER[REQUEST_URI]");
    }
}

function validate_admin() {
    if ($_SESSION['sess_admin_id'] == '') {
        ms_redirect("index.php?back=$_SERVER[REQUEST_URI]");
    }
}

function ms_redirect($file, $exit = true, $sess_msg = '') {
    header("Location: $file");
    exit();
}

function sort_arrows($column) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><IMG SRC="images/white_up.gif" BORDER="0"></A> <A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><IMG SRC="images/white_down.gif" BORDER="0"></A>';
}

function sort_arrows1($column) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><IMG SRC="admin/images/white_up.gif" BORDER="0"></A> <A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><IMG SRC="admin/images/white_down.gif" BORDER="0"></A>';
}

function sort_arrows_front($column, $heading) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><img src="images/sort_up.gif" alt="Sort Up" border="0" title="Sort Up"></A>&nbsp;' . $heading . '&nbsp;<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><img src="images/sort_down.gif" alt="Sort Down" border="0" title="Sort Down"></A>';
}

function sort_arrows_front1($column, $heading) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><img src="admin/images/sort_up.gif" alt="Sort Up" border="0" title="Sort Up"></A>&nbsp;' . $heading . '&nbsp;<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><img src="admin/images/sort_down.gif" alt="Sort Down" border="0" title="Sort Down"></A>';
}

function get_qry_str($over_write_key = array(), $over_write_value = array()) {
    global $_GET;
    $m = $_GET;
    if (is_array($over_write_key)) {
        $i = 0;
        foreach ($over_write_key as $key) {
            $m[$key] = $over_write_value[$i];
            $i++;
        }
    } else {
        $m[$over_write_key] = $over_write_value;
    }
    $qry_str = qry_str($m);
    return $qry_str;
}

function qry_str($arr, $skip = '') {
    $s = "?";
    $i = 0;
    foreach ($arr as $key => $value) {
        if ($key != $skip) {
            if (is_array($value)) {
                foreach ($value as $value2) {
                    if ($i == 0) {
                        $s .= "$key%5B%5D=$value2";
                        $i = 1;
                    } else {
                        $s .= "&$key%5B%5D=$value2";
                    }
                }
            } else {
                if ($i == 0) {
                    $s .= "$key=$value";
                    $i = 1;
                } else {
                    $s .= "&$key=$value";
                }
            }
        }
    }
    return $s;
}


function get_ip_address() {
// check for shared internet/ISP IP
if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
return $_SERVER['HTTP_CLIENT_IP'];
}

// check for IPs passing through proxies
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
// check if multiple ips exist in var
if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
foreach ($iplist as $ip) {
if (validate_ip($ip))
return $ip;
}
} else {
if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
return $_SERVER['HTTP_X_FORWARDED_FOR'];
}
}
if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
return $_SERVER['HTTP_X_FORWARDED'];
if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
return $_SERVER['HTTP_FORWARDED_FOR'];
if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
return $_SERVER['HTTP_FORWARDED'];

// return unreliable ip since all else failed
return $_SERVER['REMOTE_ADDR'];
}
/**
* Ensures an ip address is both a valid IP and does not fall within
* a private network range.
*/
function validate_ip($ip) {
if (strtolower($ip) === 'unknown')
return false;

// generate ipv4 network address
$ip = ip2long($ip);

// if the ip is set and not equivalent to 255.255.255.255
if ($ip !== false && $ip !== -1) {
// make sure to get unsigned long representation of ip
// due to discrepancies between 32 and 64 bit OSes and
// signed numbers (ints default to signed in PHP)
$ip = sprintf('%u', $ip);
// do private network range checking
if ($ip >= 0 && $ip <= 50331647) return false; if ($ip >= 167772160 && $ip <= 184549375) return false; if ($ip >= 2130706432 && $ip <= 2147483647) return false; if ($ip >= 2851995648 && $ip <= 2852061183) return false; if ($ip >= 2886729728 && $ip <= 2887778303) return false; if ($ip >= 3221225984 && $ip <= 3221226239) return false; if ($ip >= 3232235520 && $ip <= 3232301055) return false; if ($ip >= 4294967040) return false;
}
return true;
}

?>
