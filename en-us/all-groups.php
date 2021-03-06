<?php
require_once 'database/topfile.php';

?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<title>Groups | OneplaceSMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="ico.png">

<!-- Stylesheets -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/colors/turquoise.css" id="switch_style">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Javascripts --> 
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="js/jquery.nicescroll.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script> 
<script type="text/javascript" src="js/jquery.forms.js"></script><script type="text/javascript" src="js/parallax.min.js"></script>
<script type="text/javascript" src="js/switch.js"></script> 
<script type="text/javascript" src="js/custom.js"></script> 
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Header -->
<header>
  <!-- Navigation -->
  <div class="navbar yamm navbar-default" id="sticky">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="index.php" class="navbar-brand">         
        <!-- Logo -->
        <div id="logo"> <img id="default-logo" src="images/logo-2.png" alt="Starhotel" style="height:44px;"> </div>
        </a> </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
         <ul class="nav navbar-nav"> 

          <li> <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li > <a href="all-contacts.php"><i class="fa fa-book"></i> Contacts</a></li>

          <li class="active"> <a href="all-groups.php"><i class="fa fa-group"></i> Groups</a></li>
          
          <li> <a href="message-logs.php"><i class="fa fa-file-text-o"></i> Message Logs</a></li>

          <?php if($level==1){ ?>

          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated"><i class="fa fa-cogs"></i> Settings<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="manage-users.php">Manage Users</a></li>
              <li><a href="system-settings.php">System Settings</a></li>
              <li><a href="sms-settings.php">SMS Settings</a></li>
              <li><a href="admin-settings.php">Admin Settings</a></li>
              <li><a href="mail-settings.php">Mail Settings</a></li>
            </ul>
          </li>

          <?php }else{ ?> 

          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated"><i class="fa fa-cogs"></i> Settings<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="admin-settings.php">Profile Settings</a></li>
            </ul>
          </li>

          <?php } ?>

          <li> <a href="logout" style="color:brown;"><i class="fa fa-sign-out"></i> Logout</a></li>

        </ul>
      </div>
    </div>
  </div>
</header>

<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<div class="container">
  <div class="row"> 
    <section class="room-slider standard-slider mt50">

      <div class="col-sm-12 col-md-8">
        <?php
        if($group_permit ==1)
        {
          $cgroups = $db->query("SELECT * FROM `sms_groups` order by id DESC");
            if($cgroups->num_rows==0)
            {
        ?>
          <div style="border:1px dotted orange; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:orange; ">You have no groups. Click on + sign on the right to add</font>
              <a href="#" data-toggle="modal" data-target="#addgroup" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
          </div>
          <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
            <?php
            }else{
            ?>
            <div style="border:1px dotted #dcdcdc; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:#dcdcdc; "><?php echo $cgroups->num_rows; ?> Groups</font>
              <a href="#" data-toggle="modal" data-target="#addgroup" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
            </div>
            <table class="table table-striped mt20">
              <tbody>
                <tr style="background-color:#00ccff; color:white;">
                  <th>Group Name</th>
                  <th>Added By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
            <?php
              while($cdata = $cgroups->fetch_array()){
                $gid                = $cdata['id'];
                $group_name         = $cdata['group_name'];
                $date               = $cdata['date'];
                $added_by           = $cdata['created_by'];
            ?>
                <tr>
                  <td><a href="view-group.php?groupName=<?php echo $group_name; ?>&&groupId=<?php echo $gid; ?>"><?php echo $group_name; ?></a></td>
                  <td><?php echo $added_by; ?></td>
                  <td><?php echo $date; ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#edit<?php echo $gid; ?>" title="Edit" ><i style="color:#00ccff;" class="fa fa-pencil"></i></a> 
            <?php if($group_msg ==1){ ?>
                    <a href="#" data-toggle="modal" data-target="#sendgroupmessage<?php echo $gid; ?>" title="Quick Group Message"><i style="color:green;" class="fa fa-paper-plane"></i></a>
                    <a href="#" data-toggle="modal" data-target="#sendairtime<?php echo $gid; ?>" title="Send Airtime to Group Members"><i style="" class="fa fa-money"></i></a>
            <?php } ?>
            <?php if($remove_group_contact ==1){ ?>
                    <a href="#" data-toggle="modal" data-target="#delete<?php echo $gid; ?>" title="Remove"><i style="color:brown;" class="fa fa-remove"></i></a> 
            <?php } ?>
                  </td>
                </tr>
            <!--#----------------------------------------------------------
              EDIT MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="edit<?php echo $gid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?php echo $group_name; ?></h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="cname" accesskey="E">Group Name</label>
                        <input name="cname" type="text" id="gname<?php echo $gid; ?>" class="form-control" value="<?php echo $group_name; ?>" />
                    </div>
                    <div id="gresp<?php echo $gid; ?>"></div>
                  </div>
                  <div class="modal-footer" id="footgedit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" value="<?php echo $gid; ?>" type="button" id="gclick<?php echo $gid; ?>" class="btn btn-primary">Update </a>
                  </div>
                </div>
              </div>
            </div>

            <!--#----------------------------------------------------------
              SEND INLINE MESSAGE MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="sendgroupmessage<?php echo $gid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">SMS Group <?php echo $group_name; ?></h4>
                  </div>
                  <div class="modal-body">
                    <?php if($group_msg ==1){ ?>
                    <div class="form-group">
                        <label for="phonenumber" accesskey="E">Message</label>
                        <textarea name="message" id="groupmsg<?php echo $gid; ?>" class="form-control" placeholder="Please enter message"></textarea>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group">
                       <p style="color:orange;">You dont have permission to send group messages</p>
                    </div>
                    <?php } ?>
                    <div id="grouptextresp<?php echo $gid; ?>"></div>
                  </div>
                  <div class="modal-footer" id="grmessage">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" type="button" value="<?php echo $gid; ?>" id="sendgroupmsg<?php echo $gid; ?>" class="btn btn-primary">Send Message</a>
                  </div>
                </div>
              </div>
            </div>

             <!--#----------------------------------------------------------
              SEND INLINE MESSAGE MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="delete<?php echo $gid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete <?php echo $group_name; ?></h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete <?php echo $group_name; ?> ? <br>
                    <p style="color:orange;"> Deleting will remove all group users</p>                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                    <a href="database/delete-group.php?groupreference=<?php echo $gid; ?>" type="button" id="sendopenmessage" class="btn btn-danger">Yes, Delete</a>
                  </div>
                </div>
              </div>
            </div>
            <!--#----------------------------------------------------------
              SEND AIRTIME MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="sendairtime<?php echo $gid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Send airtime to all <strong><?php echo $group_name; ?></strong> group members</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                              <label for="airtimeamount" accesskey="E">Airtime Amount</label>
                              <input name="airtimegroupid" type="hidden" id="airtimegroupid<?php echo $gid; ?>" class="form-control" value="<?php echo $gid; ?>" />
                              <input name="airtimeamount" type="text" id="airtimeamount<?php echo $gid; ?>" class="form-control" value="" placeholder="Airtime Amount" />
                        </div>
                        <div id="airtimemessagetext<?php echo $gid; ?>"></div>
                  </div>
                  <div class="modal-footer sendgroupairtime">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" value="<?php echo $gid; ?>" type="button" id="sendairtimebtn<?php echo $gid; ?>" class="btn btn-primary sendgroupairtimebtn">Send Airtime </a>
                  </div>
                </div>
              </div>
            </div>


            <?php } } ?>
            
              </tbody>
            </table>
            <?php 
            }else if($group_permit ==2){ 
            ?>
          <div style="border:1px dotted brown; padding:15px; border-radius:1px; text-align:center;">
              <font style="font-size:22px; color:brown; "><i class="fa fa-lock"></i> Sorry, this page is restricted</font>
            </div>
            <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
        <?php
        } 
        ?>
            
      </div>
    </section>
    
    <!-- side -->
    <?php include_once 'side.php'; ?>
    
  </div>
</div>



<!-- Footer -->
<footer>
 
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> &copy; 2015 Oneplace Technologies LTD All Rights Reserved </div>
      </div>
    </div>
  </div>
</footer>

<!-- Modal -->
<div class="modal fade mt100" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Group</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="cname" accesskey="E">Group Name</label>
            <input name="cname" type="text" id="newgroupname" value="" class="form-control" placeholder="Please enter contact name" />
        </div>
        <div id="newgroupresp"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="groupclick" class="btn btn-primary">Add Group</button>
      </div>
    </div>
  </div>
</div>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>

</html>