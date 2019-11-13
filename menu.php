 <?php
 // $uArr=$obj->query("select roles from $tbl_admin where id='".$_SESSION['sess_admin_id']."' ");
 // $rsU=$obj->fetchNextObject($uArr);
 // $myRols=explode(",",$rsU->roles);
 ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo ucfirst($_SESSION['sess_admin_username']); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="treeview <?php echo  (basename($_SERVER['SCRIPT_NAME'])=='state-list.php' || basename($_SERVER['SCRIPT_NAME'])=='state-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='city-list.php' || basename($_SERVER['SCRIPT_NAME'])=='city-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='department-list.php' || basename($_SERVER['SCRIPT_NAME'])=='department-addf.php')?'active' :'' ?>">
        <a href="javascript:void(0);">
          <i class="fa fa-tasks"></i> <span>Manage Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="state-list.php"><i class="fa fa-glyphicon glyphicon-th"></i>Manage State</a></li>
          <li class="active"><a href="city-list.php"><i class="fa fa-glyphicon glyphicon-th"></i>Manage City</a></li>
          <li class="active"><a href="department-list.php"><i class="fa fa-glyphicon glyphicon-th"></i>Manage Department</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo  (basename($_SERVER['SCRIPT_NAME'])=='employee-list.php' || basename($_SERVER['SCRIPT_NAME'])=='employee-addf.php')?'active' :'' ?>">
        <a href="javascript:void(0);">
          <i class="fa fa-tasks"></i> <span>Manage Employee</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
           <li class="active"><a href="employee-list.php"><i class="fa fa-glyphicon glyphicon-th"></i>Manage Employee</a></li>
        </ul>
      </li>

         <li class="treeview <?php echo (basename($_SERVER['SCRIPT_NAME'])=='subscriber-list.php' || basename($_SERVER['SCRIPT_NAME'])=='newsletter_template-list.php' || basename($_SERVER['SCRIPT_NAME'])=='newsletter_template-addf.php' || basename($_SERVER['SCRIPT_NAME'])=='send_newsletter.php')?'active' :'' ?>">
        <a href="javascript:void(0);">
          <i class="fa fa-newspaper-o"></i>
          <span>Manage NewsLetter</span>
        </a>
        <ul class="treeview-menu">
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='subscriber-list.php')?'active' :'' ?>"><a href="subscriber-list.php"><i class="fa fa-circle-o"></i>NewsLetter Subscribers</a></li>
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='newsletter_template-list.php' || basename($_SERVER['SCRIPT_NAME'])=='newsletter_template-addf.php')?'active' :'' ?>"><a href="newsletter_template-list.php"><i class="fa fa-circle-o"></i>NewsLetter Templates</a></li>
            <li class="<?php echo (basename($_SERVER['SCRIPT_NAME'])=='send_newsletter.php')?'active' :'' ?>"><a href="send_newsletter.php"><i class="fa fa-circle-o"></i>Send NewsLetter</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>