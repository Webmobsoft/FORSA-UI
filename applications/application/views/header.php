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



   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css-new/common.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css-new/dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css-new/material.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>


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
    <body class="instibg app-pg">
        <input id="base_url" type="hidden" value="<?php echo base_url(); ?>" />
        <script src="<?php echo base_url() . "assets/"; ?>js/common.js"></script>
        <?php include_once 'user-profile-pop-up.php';?>
        <!-- Navigation -->
        <div id="wrapper" class="wrapper-full">
        <header class="full-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <a id="navbar-toggle"><span class="align-middle input-group-icon menu"><i class="material-icons ">menu</i></span></a>
                        <div class="instimatch-logo">
                            <img alt="Insimatch Logo" src="<?php echo base_url(); ?>assets/images-new/instimatch-logo.jpg">
                        </div>
                    </div>
                    <?php
if ($_SESSION["user_type"] == 'lender') {
 $type = 'Lender';
 $company_name = $_SESSION['company_name'];
} else {
 $type = 'Borrower';
 $company_name = $_SESSION['company_name'];
}
?>
                    <div class="col-lg-8 col-md-8">
                        <ul class="in-lang text-right">
                            <li class="active lang-icon">
                                <a class="<?php echo ($_SESSION['language'] == 'german') ? 'selected' : ''; ?>" href="javascript:changeLanguage('german');">DE</a>
                            </li>
                          
                            <li class="lang-icon">
                                <a class="<?php echo ($_SESSION['language'] == 'english') ? 'selected' : ''; ?>" href="javascript:changeLanguage('english');">EN</a>
                            </li>
                            <li class="account-text">
                                <p>Account:</p>
                            </li>
                            <li class="account">
                                <div class="form-group form-md-line-input has-error">
                                    <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">

                                        <select class="mdl-selectfield__select" name="LogicRoom" id="logicroom"><span class="input-group-icon"><i class="material-icons">expand_more</i></span>
                                                    <option value="" disabled selected>LogicRoom</option>
                                                    <option value="logicroom1">1</option>
                                                    <option value="logicroom2">2</option>
                                                    <option value="logicroom3">3</option>
                                                    <option value="logicroom4">4</option>
                                            </select>
                                    </div>

                                </div>

                            </li>
                            <li>
                                <a href="#"><i class="material-icons icon-position">search</i></a>
                            </li>
                            <li>
                                <a href="#"><i class="material-icons icon-position">forum</i></a>
                            </li>
                            <li class="identity">
                                <a href="#" data-toggle="modal" data-target=".admin-modal"><i class="material-icons">perm_identity</i>
                                </a>
                            </li>
                            <li class="settings">
                                <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons icon-position">settings
                                </i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <a  title="Logout" href="<?php echo base_url(); ?>instimatch/logout"><i class="log-out-btn fa fa-power-off" aria-hidden="true"></i></a>
                               </div>

                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </header>
        </div>
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

 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://unpkg.com/popper.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
    <script src="<?php echo base_url(); ?>assets/js-new/index.js "></script>
    <script>
        var state = "expanded ";
        //Check if navbar is expanded or minimized and handle 
        $('#navbar-toggle').click(function() {
            if (state == "expanded ") {
                $('.sidebar').css('margin-left', '-182px');
                $("body").addClass("sidebar-mini ")
                if (document.documentElement.clientWidth < 991) {
                    $("html").addClass("nav-open")
                }
                state = "minimized ";
            } else {
                if (state == "minimized ") {
                    $('.sidebar').css('margin-left', '0px');
                    $("body ").removeClass("sidebar-mini ")
                    if (document.documentElement.clientWidth < 991) {
                        $("html").removeClass("nav-open")
                    }
                    state = "expanded ";
                }
            }
        })

$('.dashboard-left .link').on('click', function(){
    if ( $(this).hasClass('current') ) {
        $(this).removeClass('current');
    } else {
        $('.dashboard-left .link.current').removeClass('current');
        $(this).addClass('current');    
    }
});


        // if (document.documentElement.clientWidth < 900) {
        //     $('#navbar-toggle').click(function() {
        //         $("html").addClass("open-nav")
        //     })
        // }

function changeLanguage(language) {
    //alert('i am');
    $.ajax({
      url: "login/changeLanguage/" + language,
      method: "post",
      cache: false,
      success: function () {
        location.reload();
      }
    });

  }
    </script>

 
