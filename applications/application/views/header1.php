<?php
if (!isset($_SESSION['user_id'])) {
 echo '<script>window.location.href="' . base_url() . '"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		    <!-- <link href="https://www.instimatch.com/applications/assets/img/favicon.ico" rel="shortcut icon"> -->
        <title>FORSA Geld-und Kapitalmarkt Gmbh</title>
        <!-- Bootstrap Core CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <!-- <link href="<?php //echo base_url(); ?>assets/css/tester.css" rel="stylesheet"/> -->
        <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/css/tester.css"> -->
        <!-- <link href="<?php //echo base_url(); ?>assets/css/market.css" rel="stylesheet" type="text/css" /> -->
        <!-- Custom Fonts -->
        
        <link href="<?php echo base_url(); ?>assets/helpers/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/theme.default.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- <link href="<?php //echo base_url(); ?>assets/css/custom1.css" rel="stylesheet" type="text/css"/> -->
        <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/helpers/datatables/dataTables.bootstrap.css"> -->
        <!-- jQuery -->
        <script src="<?php echo base_url() . "assets/"; ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jspdf.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jspdf.plugin.autotable.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . "assets/"; ?>js/bootstrap.min.js"></script>
        <!-- <script src="<?php //echo base_url() . "assets/"; ?>js/jquery.tablesorter.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?php //echo base_url() . "assets/"; ?>js/gen_validatorv4.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/jquery.timepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <?php
// if ($_SESSION['user_type'] == 'borrower') {
//  $msgPreFix = $this->lang->line('text_youHaveAcceptedOfferFor');
// } else {
//  $msgPreFix = $this->lang->line('text_yourOfferHasBeenAcceptedOfferFor');
// }
?>
        <?php include_once 'header-script.php'; ?>
        
<style>
.mmtext
{
font-size   : 14px !important;
font-weight : bold;
}
.smallcrt {
position: relative;
top: -8px;
font-size: 19px;
}
.navbar-brand {
padding: 0 15px;
}

.container {
width: 100%;
}

.btnWM {
background: #00bff3 !important;
/ Old browsers / background: -moz-linear-gradient(left, #46ed6b 0%, #1d7d32 100%);
/ FF3.6-15 / background: -webkit-linear-gradient(top, #46ed6b 0%,#1d7d32 100%);
/ Chrome10-25,Safari5.1-6 / background: linear-gradient(to bottom, #46ed6b 0%,#1d7d32 100%);
/ W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ /: ;
}
.marketplaceAcc
{
border: 1px solid #202020 !important ;
}
.dropbtn {
//background-color: #4CAF50;
color: white;
padding: 16px;
font-size: 16px;
border: none;
cursor: pointer;
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown1 {
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1; cursor:pointer !important;}

.dropdown:hover .dropdown-content {
display: block;
}

.dropdown:hover .dropbtn {
background-color: #3e8e41;
}
</style>
    </head>
    <body>
        <input id="base_url" type="hidden" value="<?php echo base_url(); ?>" />
        <script src="<?php echo base_url() . "assets/"; ?>js/common.js"></script>
        <?php include_once 'user-profile-pop-up.php';?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top nav-custome" role="navigation">
            <div class="container-fluid">
                <div class="col-md-12 col-sm-12">
                <?php
if ($_SESSION["user_type"] == 'lender') {
 $type = 'Lender';
 $company_name = $_SESSION['company_name'];
} else {
 $type = 'Borrower';
 $company_name = $_SESSION['company_name'];
}
?>
					<span class="date-view"><?php echo date("d.m.Y"); ?> - <?php echo date("H:i:s"); ?> </span>
                     <ul class="nav navbar-nav navbar-right nav-language ">
                        <li class="language-name" ><a class="<?php echo ($_SESSION['language'] == 'german') ? 'selected' : ''; ?>" href="javascript:changeLanguage('german');">DE</a></li>
                        <li class="language-name"><a class="<?php echo ($_SESSION['language'] == 'english') ? 'selected' : ''; ?>" href="javascript:changeLanguage('english');">EN</a></li>
                    </ul>
                </div>

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo">
                        <a class="" href="<?php echo base_url(); ?>"><img class="pull-left"  src="<?php echo base_url(); ?>assets/img/logo.png" alt=""/></a>
                    </div>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="col-md-7 col-sm-12 ">
                    <?php $privilege = $privilege[0]['privilege'];
                          $explodePrevilege = explode(",", $privilege);
                               if ($_SESSION['user_type'] == "both") {?>
                                     <div class="dropdown">
                                        <button class="  btn-market-place <?php if ($_SESSION['openTab'] == "M") {echo "btnWM";}?>" id="checkedType"><?php echo "Darlehensnehmer"; ?></button>
                                        <div class="dropdown-content">
                                        <a href="javascript:setUserType('borrower');" style="<?php if ($_SESSION['user_type'] == "borrower") {echo 'background-color: #f1f1f1;cursor:default; ';}?>" class="convert"><?php echo $this->lang->line('borrower'); ?></a>
                                        <a href="javascript:setUserType('lender');"  style="<?php if ($_SESSION['user_type'] == "lender") {echo 'background-color: #f1f1f1;cursor:default; ';}?>" class="convert"><?php echo $this->lang->line('lender'); ?></a>
                                    </div>
                                   </div>
                                <?php }?>
                             <?php if ($_SESSION['user_type'] == 'borrower') {?>
                              <div class="btn btn-primary btnW btn-market-place marketplaceAcc mmtext"><?php echo $this->lang->line('borrower'); ?></div>
                             <?php }?>
                            <?php if ($_SESSION['user_type'] == 'lender') {?>
                               <div class="btn btn-primary btnW btn-market-place marketplaceAcc mmtext"><?php echo $this->lang->line('lender'); ?></div>
                             <?php }?>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right nav-icon">
						<?php if ($_SESSION['type'] == "M") {?>

                        <li class="dropdown notificationHolder">

                            <a title="Notifications" href="<?php echo base_url(); ?>instimatch/notificationHistory" data-toggle="dropdown" class="dropdown-toggle headerCustomLink headerNotificationLink"><img src="<?php echo base_url(); ?>assets/img/noti.png" alt=""/><span class="headerNotifications badge-danger"><span></span></span></a>

                            <ul class="dropdown-menu" id="menu1">

                                <li><a href="#" class="color-black"><?php echo $this->lang->line('text_thereIsNoNotificationFound'); ?></a></li>

                                <li class="divider"></li>

                                <li class="notificationFooter">

                                    <a class="text-center" href="<?php echo base_url(); ?>instimatch/notificationHistory"><?php echo $this->lang->line('text_seeAll'); ?></a>

                                </li>

                           </ul>

                        </li>

						<?php }?>

                  <?php if ($_SESSION['type'] == "MM") {?>

                        <li class="dropdown notificationHolderMM">

                            <a title="MM Notifications" href="<?php echo base_url(); ?>user_marketmarketplace/notificationHistory" data-toggle="dropdown" class="dropdown-toggle headerCustomLink headerNotificationLink"><img src="<?php echo base_url(); ?>assets/img/noti.png" alt=""/><span class="headerNotificationsMM badge-danger badge" style="display:none;"><span></span></span></a>
                        </li>

						<?php }?>
                        <script type="text/javascript">

                            function GetupdateUserData() {
                                $.ajax({
                                    url: "<?php echo base_url() . "register"; ?>",
                                    method: "post",
                                    cache: false,
                                    success: function (htmlresult) {
                                        $("#UserForm").html(htmlresult);
                                        $("#UserData").modal('show');
                                        $("#LanderUserData").show();
                                    }
                                });
                            }
                            function checkOldPwd()
                            {
                            var password = $("#password").val();
                            $("#change_password_pwd_errorloc").text("");
                            if (password != '')
                            {
                            var data_to_send = 'password=' + password;
                            $.ajax({
                            url: "<?php echo base_url() . "register/checkOldPwd" ?>",
                            method: "post",
                            data: data_to_send,
                            cache: false,
                            success: function (result)
                            {
                                // alert(result);
                                // return false;
                            
                            if (result == '1') {
                            $(".password_error").text("");
                            $("#btn_update").prop('disabled', false);
                            }
                            else {
                            $(".password_error").text("<?php echo $this->lang->line('text_passwordDoesNotMatch'); ?>");
                            $("#btn_update").prop('disabled', true);
                            }
                            }

                            });
                            }
                            }
                        </script>
                            <li>
                            <a title="Profil aktualisieren" class="cursorPointer" onclick="GetupdateUserData();"> <i class="log-out-btn fa fa-user" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a  title="Logout" href="<?php echo base_url(); ?>instimatch/logout"><i class="log-out-btn fa fa-power-off" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- Notification Detail Start -->
        <!-- Modal -->
		<script>
		function printContent()
		{
		    	var restorepage = document.body.innerHTML;
	        var printcontent = document.getElementById('printablediv').innerHTML;
	        document.body.innerHTML = printcontent;
	        window.print();
	        document.body.innerHTML = restorepage;
		}
        function update_password() {
        $("#confirm_password_error").html("");
        var new_password = $("#new_pwd").val();
        var confirm_pwd = $("#confirm_pwd").val();
        var password_error = $("#password_error").text();
        if (confirm_pwd != '') {
            if (new_password == '') {
                $("#confirm_password_error").html("<?php echo $this->lang->line('text_pleaseEnterNewPasswordToContinue'); ?>");
            }
            else {
                if (new_password != confirm_pwd) {
                    $("#confirm_password_error").html("<?php echo $this->lang->line('text_confirmPasswordDoesNotMatchToNewPassword'); ?>");
                }
                else if (password_error != '') {
                    $("#password_error").text("<?php echo $this->lang->line('text_pleaseEnterOldPassword'); ?>");
                }
                else {
                    $("#confirm_password_error").html("");
                    var data_to_send = $("#change_password").serialize();


                    $.ajax({
                        url: "<?php echo base_url() . "register/update_password" ?>",
                        method: "post",
                        data: data_to_send,
                        cache: false,
                        success: function (result) {
                            // alert(result);
                            // return false;
                            $(".update_password_success").show().text("<?php echo $this->lang->line('text_passwordSuccessfullyUpdated'); ?>");
                            $("form#change_password").trigger('reset');
                        }
                    });
                }
            }
        }
    }
</script>
        <div class="modal fade notificationDataContainer" id="notificationDataContainer" tabindex="-1" role="dialog" >

            <div class="modal-dialog" role="document" style='width:66%;'>

                <div class="modal-content">

                    <div class="modal-header color-black">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>

                    <div class="modal-body color-black">

                        <!--Content is coming from ajax function notificationDetails() in header script-->

                    </div>

                </div>

            </div>

        </div>
<input type="hidden" name="requestsButtonId" id ="requestsButtonId" value="0"/>
        <!-- Notification Detail END -->
     <?php if (isset($_GET['omsg'])) {?>
      <div class="row col-lg-10 col-md-12 col-sm-12 requestAcceptedMarque" style="float:right">
       <marquee style="font-family:Book Antiqua; color: #000"  scrollamount="5"  id="requestsAccpt"><b><i><?php echo $_GET['omsg'] ?> </i></b></marquee>
      </div>
    <?php }?>
    <?php if (isset($_GET['rmsg'])) {?>
      <div class="row col-lg-10 col-md-12 col-sm-12 requestAcceptedOfferMarque" style="float:right">
       <marquee style="font-family:Book Antiqua; color: #000"  scrollamount="5"  ><b><i><?php echo $_GET['rmsg'] ?> </i></b></marquee>
      </div>
    <?php }?>