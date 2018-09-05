<style>
   .close {
    color: #000;
   }
    #NewUser {
        font-size: 21px;
        left: 8px;
        position: relative;
        text-decoration: underline;
    }
   .Text {
    text-align: center;
    width: 100%;
}
    .LoginImage {   
        width: 100% !important;
    }
    .register_model_header
    {
     padding: 15px 15px 0;
    }
   
    .mendatory
    {
        color:red;
    }
    .notification {
    font-size: 16px;
}
.modal-footer {
    border-top: medium none !important;
    padding: 0 26px 0 0;
    text-align: right;
}
.forgotPassswordBackBtn {
    font-size: 14px !important;
    padding: 5px 20px !important;
}
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/gen_validatorv4.js"></script>
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal" id="register_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog register_model_dialog" role="document">
        <div class="modal-content">
            <div class="modal-header register_model_header new_title">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hide_register_div()"><span aria-hidden="true">&times;</span></button>
                <h3 class="step_title2" style="margin-top: 0;"><?php echo $this->lang->line('text_register'); ?> <span class="notification">(<i class="mendatory">*</i> <?php echo $this->lang->line('text_fieldAreMandatory'); ?>)</span></h3>
            </div>
            <div class="modal-body">

                <div class="  " style=""> 
                    <!--<span class="cancelBtn"><img src="<?php echo base_url() . "assets/img/delete.png"; ?>"></span>-->
                    <div class="Register_page " id="register_page">
                        <form method="post"  action="javascript:add_user();" name="registerForm" id="registerForm" role="form">
                            <div id="step-1" class="row setup-content" style="display: block;">
                                <div class="col-xs-12 col-md-12" style="margin-bottom: 10px;margin-top: 10px;">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-xs-12 fail" style="color:red">
                                        </div>
                                     
                                        <div class="form-group">
                                             <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_companyName'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="company_name" id="company_name" >
                                                <span id='registerForm_company_name_errorloc' class="error_strings"  style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_firstName'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="fname" id="fname">
                                                <span id='registerForm_fname_errorloc' class="error_strings"  style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_lastName'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="lname" id="lname">
                                                <span id='registerForm_lname_errorloc' class="error_strings"  style="color:red"></span>
                                            </div>
                                          
                                             <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_contactNumber'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="contact_number" id="contact_number">
                                                <span id='registerForm_contact_number_errorloc' class="error_strings" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_email'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="email" id="email" onkeyup="checkEmail_status()"/>
                                                <span id='registerForm_email_errorloc' class="error_strings" style="color:red"></span>
                                                <span class="email_error" id="email_error" style="color:red"></span>
                                            </div>
                                          
                                           
                                              <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_userName'); ?></label>
                                                <input type="text" class="form-control" placeholder="" name="uname" id="user_name" onkeyup="checkuname_status()">
                                                <span id='registerForm_uname_errorloc' class="error_strings"  style="color:red"></span>
                                                <span class="uname_error" id="uname_error" style="color:red"></span>
                                            </div>
                                             <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_alternativeEmail'); ?></label>
                                                <input type="text" class="form-control" placeholder="" name="alternate_email" id="alternate_email"/>
                                                <span id='registerForm_alternate_email_errorloc' class="error_strings" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_userType'); ?></label>
                                                <!--<select name="user_type" id="user_type" class="form-control" onchange="checkService(this.value);"/>-->
                                                <select name="user_type" id="user_type" class="form-control"/>
                                                    <option value="borrower" checked><?php echo $this->lang->line('text_borrower'); ?></option>
                                                    <option value="lender"><?php echo $this->lang->line('text_lender'); ?></option>
                                                </select>
                                            </div>
                                                <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_displayName'); ?></label>
                                                <!--<select name="user_type" id="user_type" class="form-control" onchange="checkService(this.value);"/>-->
                                                <select name="annonymous_status" id="annonymous_status" class="form-control"/>
                                                    <option value="n" checked><?php echo $this->lang->line('text_yes'); ?></option>
                                                    <option value="y"> <?php echo $this->lang->line('text_anonymous'); ?> </option>
                                                </select>
                                            </div>
                                             <div class="col-md-6 fedafin_rating" id="fedafin_rating">
                                              
                                            </div>
                                            <div class="col-md-6 landerServiceType">
                                               
                                            </div>
                                                 <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_bankAccount'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="bank_account" id="bank_account"/>
                                                <span id='registerForm_bank_account_errorloc' class="error_strings" style="color:red"></span>
                                            </div>
                                             <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_ibanNumber'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="iban_number" id="iban_number"/>
                                                <span id='registerForm_iban_number_errorloc' class="error_strings" style="color:red"></span>
                                            </div>
                                             <div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_beneficiaryName'); ?><i class="mendatory"> *</i></label>
                                                <input type="text" class="form-control" placeholder="" name="beneficiary_name" id="beneficiary_name"/>
                                                <span id='registerForm_beneficiary_name_errorloc' class="error_strings" style="color:red"></span>
                                            </div>
											
											
											<div class="col-md-6">
                                                <label class="control-label"><?php echo $this->lang->line('text_preferredLanguage'); ?><i class="mendatory"> *</i></label>
                                                <select name="preferredLanguage" id="preferredLanguage" class="form-control">
												    <option value="DE"> DE </option>
                                                    <option value="FR"> FR </option>
													 <option value="EN"> EN </option>
                                                </select>
                                            </div>
<!--                                               <div class="col-md-12">
                                                <label class="control-label">Company Name</label>
                                                <input type="text" class="form-control" placeholder="" name="company_name" id="company_name">
                                                <span id='registerForm_company_name_errorloc' class="error_strings"  style="color:red"></span>
                                            </div>  -->


                                        </div>
                                        <div class="col-md-12">  
                                             <!--<span class="NewUser" id="NewUser"><a href="<?php // echo base_url()."c_login";  ?>">Back to login</a></span>-->
                                            
                                            <span class="all_error" id="all_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                <button type="submit" class="btn btn-primary nextBtn  pull-right bluebtn" style="padding: 5px 30px;margin-top: 0px;"><?php echo $this->lang->line('text_register'); ?></button>
            </div>
                        </form>
                         <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
        //You should create the validator only after the definition of the HTML form
                var frmvalidator = new Validator("registerForm");
                frmvalidator.EnableOnPageErrorDisplay();
                frmvalidator.EnableMsgsTogether();
                frmvalidator.addValidation("company_name", "req", "<?php echo $this->lang->line('text_pleaseEnterCompanyName'); ?>");
                frmvalidator.addValidation("fname", "req", "<?php echo $this->lang->line('text_pleaseEnterFirstName'); ?>");
                frmvalidator.addValidation("lname", "req", "<?php echo $this->lang->line('text_pleaseEnterLastName'); ?>");
                frmvalidator.addValidation("uname", "req", "<?php echo $this->lang->line('text_pleaseEnterUsername'); ?>");
                frmvalidator.addValidation("email", "req", "<?php echo $this->lang->line('text_pleaseEnteremail'); ?>");
                frmvalidator.addValidation("email", "email", "<?php echo $this->lang->line('text_pleaseEnterCorrectEmailId'); ?>");
                frmvalidator.addValidation("contact_number", "req", "<?php echo $this->lang->line('text_pleaseEnterContactNumber'); ?>");
                frmvalidator.addValidation("bank_account", "req", "<?php echo $this->lang->line('text_pleaseEnterAccountNumber'); ?>");
                frmvalidator.addValidation("iban_number", "req", "<?php echo $this->lang->line('text_pleaseEnterIBANNumber'); ?>");
                frmvalidator.addValidation("beneficiary_name", "req", "<?php echo $this->lang->line('text_pleaseEnterBeneficiaryName'); ?>");
                //frmvalidator.addValidation("fedafin_rating", "req", "<?php echo $this->lang->line('text_pleaseSelectFedafinRating'); ?>");
                frmvalidator.addValidation("lender_category", "req", "<?php echo $this->lang->line('text_pleaseSelectCategory'); ?>");
                //frmvalidator.addValidation("contact_number", "num", "Please enter Number only");
        //]]>

</script>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


<div class="secform_holder col-md-12 sf_2 sf_22" > 

 <img class="LoginImage login_logo" src="<?php echo base_url(); ?>assets/img/logo_2.png" class="img-responsive">	
		<h2 class="login_page_text"><i>INSTIMATCH</i></h2>
    <form method="post"  action="javascript:check_user();" class="form " name="loginForm" id="loginForm" role="form">
        <div id="step-1" class="row setup-content" style="display: block;">
            <div class="col-xs-12 col-md-12" style="margin-bottom: 10px;margin-top: 10px;">
                <div class="col-md-12 top-buffer ">
                    <div class="alert alert-success col-md-12 " <?php echo (isset($success))? '' : 'style="display: none;"';  ?>>
                        <?php
                        if (isset($success)) {
                            echo $success;
                            unset($success);
                        }
                        ?>
                    </div>
           
                 
                    <div class="form-group col-md-6">
                        <div class="alert alert-danger error_msg col-md-12" id="error_msg" style="display: none;"></div>
                       
<!--                        <label class="control-label"><?php echo $this->lang->line('text_usernameEmail'); ?></label>-->
                        <input type="text" class="form-control input_text" placeholder="<?php echo $this->lang->line('text_usernameEmail'); ?>" name="username" id="username">
                         <span id='loginForm_username_errorloc' class="error_strings" style="color:red"></span>
<!--                        <label class="control-label"><?php echo $this->lang->line('text_password'); ?></label>-->
</div> <div class="form-group col-md-6">
                        <input type="password" class="form-control input_text" placeholder="<?php echo $this->lang->line('text_password'); ?>" name="password" id="password">
                          <span id='loginForm_password_errorloc' class="error_strings" style="color:red"></span>
                    </div>
                                    <!--<span class="NewUser" id="NewUser"><a href="<?php //echo base_url()."register";  ?>">New Account</a></span>-->
                   
                    <!--<span class="NewUser" id="NewUser"><a onclick="show_register();" style="cursor:pointer;">New Account</a></span>-->
                  <button type="submit" class=" white22 pull-right m_loginBtnLink" style="padding: 5px 8px;font-size: 14px !important;"><?php echo $this->lang->line('text_login'); ?> > </button>
                  <!--   <a  class="white22 pull-right login_account_1" ><?php echo $this->lang->line('text_login'); ?> ></a>-->
                   <!-- <p class=" white22 pull-right">Login > </p>-->

<div class="clearfix"></div>
<div style="margin-top: 10%;" class="clear-both"></div>
<!--  <button type="button" class="white  pull-left " data-toggle="modal" onclick="show_register();" style="margin-left: 25% ! important;">

    <?php echo $this->lang->line('text_newAccount'); ?>
</button> -->
	 <button type="button" class="pull-left new_account_1 m_loginBtnLink " data-toggle="modal" onclick="show_register();" >
    <?php echo $this->lang->line('text_newAccount'); ?> >
</button>

    <!--  <p class="white_1 new_account_1"> New Account > </p>  -->                  
              
                
                 <div class="form-group" style="text-align: right; width: 160px; float:right;">
			<a  class="ForgotPasswordAnchor forget_pswrd" id="ForgotPasswordAnchor" ><?php echo $this->lang->line('text_forgotPassword'); ?> ? > </a>	    
</div></div>

            </div>
        </div>

    </form>
             <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
        //You should create the validator only after the definition of the HTML form
                var frmvalidator = new Validator("loginForm");
                frmvalidator.EnableOnPageErrorDisplay();
                frmvalidator.EnableMsgsTogether();
                frmvalidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserNameEmail'); ?>");
                frmvalidator.addValidation("password", "req", "<?php echo $this->lang->line('text_pleaseEnterPassword'); ?>");
               
        //]]>

</script>
<form method="post"  action="javascript:forgot_password();" name="ForgotPasswordForm" id="ForgotPasswordForm" role="form" style="display:none;">
        <div id="step-1" class="row setup-content" style="display: block;">
            <div class="col-xs-12 col-md-12" style="margin-bottom: 10px;margin-top: 10px;">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-12 col-xs-12" style="color: green">
                        <?php
                        if (isset($success)) {
                            echo $success;
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                       
                       
						 <div class="Text">
                            <h6><?php echo $this->lang->line('text_forgotPassword'); ?></h6>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="error_msg1" id="error_msg1" style="color:red;"></div>
                        <br>
<!--                        <label class="control-label"><?php echo $this->lang->line('text_userName'); ?></label>-->
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('text_userName'); ?>" name="username" id="username">
                         <span id='ForgotPasswordForm_username_errorloc' class="error_strings" style="color:red"></span><br>
               <a href="<?php echo base_url(); ?>" class="forgotPassswordBackBtn btn btn-primary  white2 btn-small bluebtn" data-toggle="modal"  style="">
    <?php echo $this->lang->line('text_back'); ?></a>
       
<button type="submit" class="btn btn-primary nextBtn white3  pull-right bluebtn" style="padding: 5px 8px;font-size: 14px !important;"><?php echo $this->lang->line('text_go'); ?></button>

                </div>

            </div>
        </div>

    </form>
<script>
 var frmvalidator = new Validator("ForgotPasswordForm");
                frmvalidator.EnableOnPageErrorDisplay();
                frmvalidator.EnableMsgsTogether();
                frmvalidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserNameEmail'); ?>");

</script>
<script>
$("#ForgotPasswordAnchor").click(function(){

$("#loginForm").hide();
$("#ForgotPasswordForm").show();

});

</script>

</div>

<script>
    $(document).ready(function() {
       // $(".landerServiceType").hide();
        $("#user_name").prop("autocomplete","off");
        $("#email").prop("autocomplete","off");
    });
    function hide_register_div()
    {
        $("#register_div").hide();
    }
    function show_register()
    {
        $(".register").show();
        $("#register_div").show();
          $.ajax({
            url: "<?php echo base_url() . "instimatch/getServiceType"; ?>",
            type: "post",
            cache: false,
            success: function(result) {                
                $(".landerServiceType").html(result);
                frmvalidator.addValidation("category", "req", "<?php echo $this->lang->line('text_pleaseSelectCategory'); ?>");
            }
        });
         $.ajax({
            url: "<?php echo base_url() . "instimatch/fedafinRating"; ?>",
            type: "post",
            cache: false,
            success: function(result) {                
                $(".fedafin_rating").html(result);
                //frmvalidator.addValidation("fedafin_rating", "req", "<?php echo $this->lang->line('text_pleaseSelectFedafinRating'); ?>");
            }
        });
    }
    function check_user()
    {
        var data_to_send = $('#loginForm').serialize();

        $.ajax({
            url: "<?php echo base_url() . "instimatch/login"; ?>",
            data: data_to_send,
            type: "post",
            cache: false,
            success: function(result) {
                //  alert(result);
                if (result == 'false')
                {
                    $("#error_msg").show().html("<?php echo $this->lang->line('text_pleaseEnterCorrectCrediantials'); ?>");
                }
                else
                {
                    window.location.href = "<?php echo base_url();?>";
                }

            }
        });
    }
</script>
<script>
  function forgot_password(){
  var data_to_send = $('#ForgotPasswordForm').serialize();
  
        $.ajax({
            url: "<?php echo base_url();?>instimatch/forgot_password",
            data: data_to_send,
            type: "post",
            cache: false,
            success: function(result) {
                  alert(result);
                if (result == 'false')
                {
                    $("#error_msg1").html("wrong username");
                }
                else
                {
                    $("#error_msg1").css("color","green");
                    $("#error_msg1").html("<?php echo $this->lang->line('text_pleaseCheckYourEmailForNewPassword'); ?>");
                }

            }
        });

}

</script>

<!---   Register popup Script --------------->
<script>

    function checkEmail_status()
    {
        $(".email_error").html("");
        var email = $("#email").val();
        if(email != '')
        {
                var data_to_send = 'email=' + email;
                 //alert(data_to_send);
                $.ajax({
                    url:"<?php echo base_url()."register/checkEmail_status"?>",
                    method:"post",
                    data:data_to_send,
                    cache:false,
                    success:function(result)
                    {
                        if(result == '1')
                        {
                            $(".email_error").text("<?php echo $this->lang->line('text_emailIdAlreadyExistPleaseenterCorrectId'); ?>");

                        }
                        else
                        {
                            $(".email_error").text("");
                        }
                    }

                });
        }
    }
    function checkuname_status()
    {
         $(".uname_error").text("");
        var uname = $("#user_name").val();
        if(uname != '')
        {
             var data_to_send = 'uname=' + uname + '&function=checkuname_status';
       // alert(data_to_send);
        $.ajax({
            url:"<?php echo base_url()."register/checkuname_status"?>",
            method:"post",
            data:data_to_send,
            cache:false,
            success:function(result)
            {
                if(result == '1')
                {
                    $(".uname_error").text("<?php echo $this->lang->line('text_userNameAlreadyExistPleaseUseAnotherOne'); ?>");
                    
                }
                else
                {
                    $(".uname_error").text("");
                }
            }
            
        });
        }
  
    }
//    function checkService(val)
//    {
//        if(val == 'lender')
//        {
//               $(".landerServiceType").show();
//                $(".rating").hide();
//                 frmvalidator.addValidation("lender_category", "req", "Please select Category");
//        }
//        else
//        {
//             $(".landerServiceType").hide();
//              $(".rating").show();
//        }
//    }
function add_user()
{
    //alert("new user");
     var uname_error = $(".uname_error").text();
     var email_error = $(".email_error").text();
     if(uname_error == '' &&  email_error == '')
     {
            var data_to_send = $('#registerForm').serialize();
	
	 $.ajax({
			   url:"<?php echo base_url()."register/new_user";?>",
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
                               if(result > '0')
                               {
                                  window.location.href="<?php echo base_url()."register/login";?>";
                               }
                               else
                               {
                                   $(".fail").html("<?php echo $this->lang->line('text_pleaseTryAgain'); ?>");
                               }
			 $(".all_error").html("");
			   }
   });
     }
     else
     {
        $(".all_error").html("<?php echo $this->lang->line('text_pleaseCorrectTheValueToContinue'); ?>");
     }
	
}
</script>
<!---  End Register popup Script --------------->
