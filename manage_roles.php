<?php
include("include/config.php");
include("include/functions.php"); 
include("include/simpleimage.php");
validate_admin();
if($_REQUEST['roles']!=''){
  $roles=implode(",",$_REQUEST['roles']);  
}

if($_REQUEST['submitForm']=='yes'){
  $obj->query("update $tbl_admin set roles='$roles' where  id='".$_REQUEST['id']."' ");
  $_SESSION['sess_msg']='Roles updated successfully';
  header("location:employee-list.php");
  exit();
}      

if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_admin where id=".$_REQUEST['id']);
  $result=$obj->fetchNextObject($sql);
}   $empRolesArr='';
if($result->roles!=''){
  $empRoles=$result->roles; 
  $empRolesArr=explode(",",$empRoles);  
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
        <h1>Manage Roles for <?php echo getField('full_name',$tbl_admin,$_REQUEST['id']); ?></h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="employee-list.php">Back</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-default">
          <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Lead</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="1" <?php if($empRolesArr!='' && in_array(1,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Lead</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Sale</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="2" <?php if($empRolesArr!='' && in_array(2,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Sale</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="3" <?php if($empRolesArr!='' && in_array(3,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Dead Lead</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="4" <?php if($empRolesArr!='' && in_array(4,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Field Meeting</label>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Analysis</h4>
                </div>
                <div class="col-md-6">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Project</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="5" <?php if($empRolesArr!='' && in_array(5,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Analysis</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="6" <?php if($empRolesArr!='' && in_array(6,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Project</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Content</h4>
                </div>
                <div class="col-md-6">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Invoice</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="7" <?php if($empRolesArr!='' && in_array(7,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Content</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="8" <?php if($empRolesArr!='' && in_array(8,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Invoice</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Master</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="9" <?php if($empRolesArr!='' && in_array(9,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Client</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="10" <?php if($empRolesArr!='' && in_array(10,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Company</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="11" <?php if($empRolesArr!='' && in_array(11,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Department</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="12" <?php if($empRolesArr!='' && in_array(12,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Change Email</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Recruitment
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input  type="checkbox" name="roles[]" value="13" <?php if($empRolesArr!='' && in_array(13,$empRolesArr)){?>checked<?php } ?> />
                      <label>Manage Job Title</label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input  type="checkbox" name="roles[]" value="14" <?php if($empRolesArr!='' && in_array(14,$empRolesArr)){?>checked<?php } ?> />
                      <label>Manage Vacancies List</label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input  type="checkbox" name="roles[]" value="15" <?php if($empRolesArr!='' && in_array(15,$empRolesArr)){?>checked<?php } ?> />
                      <label>Manage Candidate List</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Leave
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input  type="checkbox" name="roles[]" value="16" <?php if($empRolesArr!='' && in_array(16,$empRolesArr)){?>checked<?php } ?> />
                        <label>Manage Leave</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input  type="checkbox" name="roles[]" value="17" <?php if($empRolesArr!='' && in_array(17,$empRolesArr)){?>checked<?php } ?> />
                        <label>Manage Entitlement</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage HR
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input  type="checkbox" name="roles[]" value="18" <?php if($empRolesArr!='' && in_array(18,$empRolesArr)){?>checked<?php } ?> />
                          <label>Manage Employee</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input  type="checkbox" name="roles[]" value="19" <?php if($empRolesArr!='' && in_array(19,$empRolesArr)){?>checked<?php } ?> />
                          <label>Manage Leave Type</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input  type="checkbox" name="roles[]" value="20" <?php if($empRolesArr!='' && in_array(20,$empRolesArr)){?>checked<?php } ?> />
                          <label>Manage Leave Period</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input  type="checkbox" name="roles[]" value="21" <?php if($empRolesArr!='' && in_array(21,$empRolesArr)){?>checked<?php } ?> />
                          <label>Manage Holiday List</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input  type="checkbox" name="roles[]" value="22" <?php if($empRolesArr!='' && in_array(22,$empRolesArr)){?>checked<?php } ?> />
                          <label>Manage Time Management</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Report
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <input  type="checkbox" name="roles[]" value="23" <?php if($empRolesArr!='' && in_array(23,$empRolesArr)){?>checked<?php } ?> />
                            <label>Manage Report</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h4 style="color: #3c8dbc; font-size: 16px; font-weight: bold;">Manage Newsletter
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <input  type="checkbox" name="roles[]" value="24" <?php if($empRolesArr!='' && in_array(24,$empRolesArr)){?>checked<?php } ?> />
                              <label>Manage Newsletter Subscriber</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <input  type="checkbox" name="roles[]" value="25" <?php if($empRolesArr!='' && in_array(25,$empRolesArr)){?>checked<?php } ?> />
                              <label>Manage Newsletter Templates</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <input  type="checkbox" name="roles[]" value="25" <?php if($empRolesArr!='' && in_array(26,$empRolesArr)){?>checked<?php } ?> />
                              <label>Manage Send Newsletter</label>
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
            </body>
            </html>
