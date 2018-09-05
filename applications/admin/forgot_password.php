<!DOCTYPE HTML>
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
             <form name="forgot_form" id="forgot_form" method="post" action="javascript:forgot_password();">
        	<div class="username">
        		<input type="text" class="form-control" required name="email" id="email" placeholder="Enter your email" />
                <i class="glyphicon glyphicon-user"></i>
            </div>
          
            <input type="submit" class="btn btn-primary style2" value="submit" />
        </form>
        <footer>
        	
            <a href="login.php" class="register pull-right">Back</a>
            <div class="clear"></div>
        </footer>
    </div>
</div>
<!-- Wrapper End -->
</body>
</html>
<script>
    function forgot_password()
    {
          var data = $("#forgot_form").serialize();
         data += '&function=forgot_password';
        // alert(data);
        $.ajax({
           url:"ajax_function.php",
           method:"post",
           data:data,
           cache:false,
           success:function(result)
           {
               alert(result);
               
               if(result == 'false')
               {
                 $("#error").addClass("alert alert-danger");
                   $("#error").html("Please enter correct email");
               }
               else
               {
                   $("#error").addClass("alert alert-success");
                   $("#error").html("Please check your email for new password");
               }
           }
        });
        
    }
</script>
