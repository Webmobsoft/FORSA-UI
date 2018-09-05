<?php include_once 'config.php';?>
  <?php 
        @session_start();
       $base_url = $base_url."applications/admin/"; 
    ?>

<!DOCTYPE HTML>
<html>
<head>

<title>Instimatch</title>
<!--// Stylesheets //-->
<link href="assets/css/style.css" rel="stylesheet" media="screen" />
<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!--// Javascript //-->





<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.accordion.js"></script>
<script type="text/javascript" src="assets/js/jquery.custom-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/selectnav.min.js"></script>

<script type="text/javascript" src="assets/js/gen_validatorv4.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<style>
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857;
    color: #333;
    background-image: url("../img/insti_Backblack.jpg");
    background-position: fixed;
}
#request-accept,#request-decline,#closing{
    background-color: #23527c;
	border: #23527c;
	border-radius: 0px;
	font-size: 15px;
	margin: 0px 15px 0px 0px;
    margin-top: 10px;
    float: left;
}
</style>
<?php
 if( $_SESSION['privilege'] == "1"  )
{
	echo "<style>.hideMyDiv{display:none !important;}</style>";
}
else
{
	echo "<style>.hideMyDiv{display:block;}</style>";
}

	?>
	
</head>

<body>



 



      <script src="assets/js/jquery-1.10.2.min.js"></script>

<div id="company_list" class="company_list"></div>
<script>
        function get_list()
        {
            //alert("hello");
            var data = 'function=get_list';
            $.ajax({
                url:"ajax_function.php",
                data:data,
                method:"post",
                cache:false,
                success:function(htmlstr)
                {
                    //alert(htmlstr);
                    $(".company_list").html(htmlstr);
                }
            });
        }
        function expand_company(id)
        {
         
              var data = 'id=' + id + '&function=expand_company';
            $.ajax({
                url:"ajax_function.php",
                data:data,
                method:"post",
                cache:false,
                success:function(htmlstr)
                {
                    $(".company_"+id).html(htmlstr);
                    //alert(htmlstr);
                    //$(".company_list").html(htmlstr);
                }
            });
        }
        function delete_company(id)
        {
            //alert(id);
              var data = 'id=' + id + '&function=delete_company';
            $.ajax({
                url:"ajax_function.php",
                data:data,
                method:"post",
                cache:false,
                success:function(htmlstr)
                {
                    $("#company_"+id).hide();
                    //alert(htmlstr);
                    //$(".company_list").html(htmlstr);
                }
            });
        }
        function delete_person(id)
        {
            //alert(id);
              var data = 'id=' + id + '&function=delete_person';
            $.ajax({
                url:"ajax_function.php",
                data:data,
                method:"post",
                cache:false,
                success:function(htmlstr)
                {
                    $("#person_"+id).hide();
                    //alert(htmlstr);
                    //$(".company_list").html(htmlstr);
                }
            });
        }
            </script>
<div id="notificationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Lender Request</h4>
        <div id="requestmessage1"></div>
      </div>
      <div class="modal-body" id="notificationbody">
        
      </div>
      
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>
            <script>
            var tempvar = "";
            function getRequests(){
                var data = 'function=getRequests';
                $.ajax({
                url:"ajax_function.php",
                method:"post",
                data:data,
                cache:false,
                success:function(htmlstr)
                {
                    // alert(htmlstr);
                    // return false;
                    if(htmlstr != tempvar){
                    $("#notificationModal").modal("show");
                    $("#notificationbody").html(htmlstr);
                    $(".okresponse").click(function(){
                        var NotificationId = $(this).attr("data-id");
                        var Id = $(this).attr("data-value");
                        var lenderName = $(this).attr("data-lender");
                        var borroerName = $(this).attr("data-borrower");
                        var data_to_send = 'Ids=' + Id +'&notificationId='+NotificationId+'&function=updateAdminView';
                        // alert(data_to_send);
                        // return false;
                        $.ajax({
                            url:"ajax_function.php",
                            method:"post",
                            data:data_to_send,
                            cache:false,
                            success:function(htlstr)
                            {
                                // alert(htlstr);
                                // return false;
                                $(".declineresponse").prop("disabled","true");
                                $(".okresponse").prop("disabled","true");
                                $(".closes").prop("disabled",false);
                                $("#requestmessage1").html("YOU HAVE SUCCESFULLY ACCEPTED THE LENDING OF "+ lenderName + " TO "+ borroerName +". CHECK E-MAIL FOR CONFIRMATION");
                            //    return false;
                                //setTimeout(function(){$('#notificationModal').modal('hide');}, 10000);
                                //$("#notificationModal").modal("hide");
                               // alert(htlstr); 
                               
                            }
                        });
                    });
                    $(".declineresponse").click(function(){
                        var Id = $(this).attr("data-value");
                        var lenderName = $(this).attr("data-lender");
                        var borroerName = $(this).attr("data-borrower");
                        var data_to_send = 'Ids=' + Id + '&function=updateAdminDeclineView';
                        $.ajax({
                            url:"ajax_function.php",
                            method:"post",
                            data:data_to_send,
                            cache:false,
                            success:function(htlstr)
                            {
                                // alert(htlstr);
                                // return false;
                                $(".declineresponse").prop("disabled","true");
                                $(".okresponse").prop("disabled","true");
                                $(".closes").prop("disabled",false);
                                //$('#notificationModal').delay(10000).fadeOut();
                                $("#requestmessage1").html("YOU HAVE DECLINED THE LENDING OF "+ lenderName + " TO "+ borroerName +".");
                                //setTimeout(function(){$('#notificationModal').modal('hide');}, 10000);
                                //$("#notificationModal").modal("hide");
                                
                                
                                //$("#notificationModal").modal("hide");
                               
                               
                            }
                        });
                       // alert(Id);
                    });
                    $(".closes").click(function(){
                        var Id = $(this).attr("data-value");
                        var lenderName = $(this).attr("data-lender");
                        var borroerName = $(this).attr("data-borrower");
                        var data_to_send = 'Ids=' + Id + '&function=updateAdminClose';
                        $.ajax({
                            url:"ajax_function.php",
                            method:"post",
                            data:data_to_send,
                            cache:false,
                            success:function(htlstr)
                            {
                                $('#notificationModal').modal('hide');
                               
                               
                            }
                        });
                       // alert(Id);
                    });


                    }

                    //var json = $.parseJSON(htmlstr);
                    
                    //var json = $.parseJSON(htmlstr);
                   // alert(htmlstr);
                    //alert(htmlstr);
                }
            });
            }

            function get_borrower_accept_response()
            {
                var data_to_send = 'function=get_borrower_response';
                $.ajax({
                url:"ajax_function.php",
                method:"post",
                data:data_to_send,
                cache:false,
                success:function(htlstr)
                {
                    
                    if(htlstr != 'false'){
                        $("#requestmessage1").html("");
                    $("#notificationModal").modal("show");
                    $("#notificationbody").html(htlstr);
                    $(".acceptresponsedeal").click(function(){
                        var Id = $(this).attr("data-value");
                        var data_to_send = 'Ids=' + Id + '&function=updateacceptresponsedeal';
                        $.ajax({
                            url:"ajax_function.php",
                            method:"post",
                            data:data_to_send,
                            cache:false,
                            success:function(htlstr)
                            {
                                $("#notificationModal").modal("hide");
                               
                            }
                        });

                        //alert(datavalue);

                    });

                    }
                    
                }
                });
                
            }

            function get_borrower_decline_response()
            {
                var data_to_send = 'function=get_borrower_decline_response';
                $.ajax({
                url:"ajax_function.php",
                method:"post",
                data:data_to_send,
                cache:false,
                success:function(htlstr)
                {
                    if(htlstr != 'false'){
                        $("#requestmessage1").html("");
                    $("#notificationModal").modal("show");
                    $("#notificationbody").html(htlstr);
                    $(".declineresponsedeal").click(function(){
                        var Id = $(this).attr("data-value");
                        var data_to_send = 'Ids=' + Id + '&function=updatedeclineresponsedeal';
                        $.ajax({
                            url:"ajax_function.php",
                            method:"post",
                            data:data_to_send,
                            cache:false,
                            success:function(htlstr)
                            {
                                $("#notificationModal").modal("hide");
                               
                            }
                        });

                        //alert(datavalue);

                    });

                    }
                    
                }
                });
                
            }

            $(document).ready(function(){
                setInterval("getRequests()", 1000);
            });

            function logoutUser()
            {
                var data_to_send = 'function=logoutUser';
                $.ajax({
                url:"ajax_function.php",
                method:"post",
                data:data_to_send,
                cache:false,
                success:function(htlstr)
                {
                   
                    
                }
                });
            }
            function hasOneDayPassed(){
            var date = new Date().toLocaleDateString();

            if( localStorage.yourapp_date == date ) 
            return false;

            localStorage.yourapp_date = date;
            return true;
            }
           
            if( hasOneDayPassed()){
                logoutUser();
            }
            // </script>

