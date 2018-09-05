
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>FORSA</title>
            <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
				<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
             <script src="<?php echo base_url(); ?>assets/js/gen_validatorv4.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.js"></script>
        <!--login-->
        <script src="<?php echo base_url(); ?>assets/js/modernizr-2.6.2.min.js"></script>
        <!--********* Date picker  -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <script>
            function changeLanguage(language) {
                
                $.ajax({
                    url: "<?php echo base_url(); ?>login/changeLanguage/"+language,
                    method: "post",
                    cache: false,
                    success: function() {
                        location.reload();
                    }
                });
            }
            $(function() {
                $("#maturity").datepicker({
                    numberOfMonths: 1,
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() + 1);
                        $("#close_date").datepicker("option", "minDate", dt);
                    }
                });
                $("#close_date").datepicker({
                    numberOfMonths: 1,
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#maturity").datepicker("option", "maxDate", dt);
                    }
                });

                $("#valid_date").datepicker({
                    numberOfMonths: 1,
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#maturity").datepicker("option", "maxDate", dt);
                    }
                });
                $("#valid_date1").datepicker({
                    numberOfMonths: 1,
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#maturity").datepicker("option", "maxDate", dt);
                    }
                });

            });


        </script>
        <!--********* End Date picker  -->

    </head>
	<style>
	.logo_main {
    margin-left: 2%;
	padding-top: 20px;
}
	</style>
    <body class="loginh">
   
            <div class="container">
        <div class="lang_holder">
            <a class="<?php echo ($_SESSION['language'] == 'german' )? 'selected' : '' ;?>" href="javascript:changeLanguage('german');">DE</a>&nbsp;|			
            <a class="<?php echo ($_SESSION['language'] == 'english' )? 'selected' : '' ;?>" href="javascript:changeLanguage('english');">EN</a>
        </div>
	
		<div class="row login_main">
					<!--<div class="col-lg-5 col-md-5" ></div><div class="col-lg-2 col-md-2 logo_main"><a ><img src="<?php echo base_url();?>assets/img/logo.png" class="img-responsive"></a></div><div class="col-lg-4 col-md-4" ></div>-->
			<div class="col-lg-8 col-md-8 btn_holder">
<!--<a href="<?php echo base_url()."instimatch/logout";?>" id='modal-launcher' data-toggle="modal" data-target="#login-modal" class="btn btn-default loginbtn"> Logout</a><a data-toggle="modal" data-target="#signup"  href="#signup"" class="btn btn-default signup"><i class="fa fa-check-square-o fa-lg"></i> Signup</a></div>-->
		</div>
	

