++<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instimatch</title>
<!--// Stylesheets //-->
<link href="assets/css/style.css" rel="stylesheet" media="screen" />
<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- Wrapper Start -->
<div class="loginwrapper">
   
	<span class="circle"></span>
	<div class="loginone">
    	<header>
        	<a href="#"><img src="assets/images/logo.png" alt="" /></a>
            <p>Enter your credentials to login to your account</p>
        </header>
             <div id="error" class=""></div>
             <form name="login_form" action="javascript:check_admin();" id="login_form">
        	<div class="username">
        		<input type="text" class="form-control" name="uname" id="uname" placeholder="Enter your username" />
                <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="password">
            	<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter your password" />
                <i class="glyphicon glyphicon-lock"></i>
            </div>
<!--            <div class="custom-radio-checkbox">
                <input tabindex="1" type="checkbox" class="bluecheckradios">
                <label>Remember me</label>
            </div>
			<script>
				$(document).ready(function(){
				  $('.bluecheckradios').iCheck({
					checkboxClass: 'icheckbox_flat-blue',
					radioClass: 'iradio_flat-blue',
					increaseArea: '20%' // optional
				  });
				});  	
			</script>-->
<input type="submit" class="btn btn-primary style2" value="Sign In" onclick="check_admin()"/>
        </form>
        <footer>
        	<a href="forgot_password.php" class="forgot pull-left">I forgot my password</a>
            <!--<a href="#" class="register pull-right">Create account</a>-->
            <div class="clear"></div>
        </footer>
    </div>
</div>
<!-- Wrapper End -->
</body>
</html>
<script>
    function check_admin()
    {
          var data = $("#login_form").serialize();
         data += '&function=check_admin';
        // alert(data);
        $.ajax({
           url:"ajax_function.php",
           method:"post",
           data:data,
           cache:false,
           success:function(result)
           {
            
               
               if($.trim(result) == 'false')
               {
                 $("#error").addClass("alert alert-danger");
                   $("#error").html("Please enter correct Username and password");
               }
               else
               {

                   window.location.href="http://dev.instimatch.com/forsa/applications/admin/dashboard.php";
                   return false;

               }
           }
        });
        
    }
</script>
