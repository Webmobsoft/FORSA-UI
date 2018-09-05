<!DOCTYPE html>
<html lang="en">
<?php //echo $_SESSION['language'];  ?>
<head>
    <meta charset="UTF-8">
    <title>Instimatch Login Form</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>css-new/common.css">
    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>css-new/login_register.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>css-new/material.min.css">

<script src="<?php echo base_url() . "assets/"; ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . "assets/"; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() . "assets/"; ?>js/gen_validatorv4.js">
    </script>
    <?php include 'assets/js/lenderModals.php';?>

</head>

<body class="instibg">
    <!-- Wrapper for the Whole Application -->
    <div id="wrapper">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="instimatch-logo">
                            <img alt="Insimatch Logo" src="<?php echo base_url() . "assets/"; ?>images-new/instimatch-logo.jpg">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <ul class="in-lang text-right">
                            <li >
                            <a class="<?php echo ($_SESSION['language'] == 'german') ? 'selected' : ''; ?>" href="javascript:changeLanguage('german');">DE
              </a>
                            </li>
                            <li>
                            <a class="<?php echo ($_SESSION['language'] == 'english') ? 'selected' : ''; ?>" href="javascript:changeLanguage('english');">EN
              </a>
                            </li>
                           
                            <li class="in-header-user text-right">
                                <a href="#">
                                    <i class="material-icons whitebg"> supervisor_account </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- Login Page Content-->

        <div class="container" id="login">
            <section class="in-login">
                <div class="row">
                    <div class="col-sm-12 in-login-form">
                        <h2 class="text-left"><?php echo $this->lang->line('text_login'); ?></h2>
                        <?php if (isset($_GET["msg"])) { ?><div class="alert alert-success error_msg col-md-12 loginErrorContainer"><?php echo $this->lang->line('reg_success'); ?>
          </div> <?php } ?>
          <div class="alert alert-danger error_msg col-md-12 loginErrorContainer"style="display: none;"></div>
                        <div class="alert alert-danger error_msg col-md-12" id="" style="display: none;">
          </div>

                        <form class="login-form" id="loginForm" action="<?php echo "javascript:check_user();"; ?>" method="post" role="form">
                        <input type="hidden" name="token" value="<?=$this->config->item('csrf_token');?>">


                            <div class="form-group form-md-line-input has-error">
                                <div class="group input-group">
                                    <input type="text" id="username" name="username" autofocus>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label><?php echo $this->lang->line('text_usernameEmail'); ?></label>
                                    <span class="input-group-icon">
                      <i class="material-icons">account_circle</i>
                    </span>
                        </div>
                        <div style="width:100%;float:left;"> <span id='loginForm_username_errorloc' class="error_strings text-danger"></span>
                 </div>
                  </div>
                    
                            <div class="form-group form-md-line-input has-error">
                                <div class=" input-group">
                                    <input id="password" name="password" type="password">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label><?php echo $this->lang->line('text_password'); ?></label>
                                    <span class="input-group-icon">
                  
                    <i class="material-icons password_mask" >remove_red_eye </i>    
                    </span>
                      </div><br/>
                       <div style="width:100%;float:left;"><span id='loginForm_password_errorloc' class="error_strings text-danger"></span>
                            </div>
                            </div>

                            <div class="forgot-pass form-group form-md-line-input has-error">

                                <a id="forgot-btn" data-toggle="modal" data-target="#in-forgot-password"><?php echo $this->lang->line('ForgotPassword'); ?>?</a>

                            </div>
                            <!-- Modal -->
       

                            <div class="form-group form-md-line-input has-error">
                                <div class=" input-group">
                                    <span class="line"> <?php echo $this->lang->line('text_not_robot'); ?></span>
                                    <input id="cbx3" type="checkbox" class="cbx" />
                                    <label for="cbx3" class="lbl notrobot"> 
                </label>
                                </div><br/>
                                <div style="width:100%;float:left;">  <span id='loginForm_checkbox_errorloc' class="error_strings text-danger"></span>
                            </div>
                            </div>
                            <div class="login-margin"></div>
                            <button type="submit" class="button btn buttonBlue">
                  <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                  Enter <i class="material-icons">
                      keyboard_arrow_right
                    </i>
                </button>
                            <p class="text-center in-register-text"><?php echo $this->lang->line('donthaveaccount'); ?> &#9679;
                                <a id="reg" href="#"><?php echo $this->lang->line('createAccount'); ?></a>
                            </p>

                        </form>
                    </div>

                </div>
            </section>
        </div>
<!-- forgot password start -->


                     
                     <div class="modal fade" id="in-forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">

              <form method="post" action="javascript:forgot_password();" name="ForgotPasswordForm" id="ForgotPasswordForm"
                    role="form" >
                <input type="hidden" name="token" value="<?= $this->config->item('csrf_token'); ?>">

                <div class="modal-content">
                  <div class="error_msg1" id="error_msg1" style="color:red; padding-top:20px; padding-left:15px;"></div>

                  <div class="modal-header">


                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('text_forgotPassword'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body in-login">
                    <div class="form-group form-md-line-input has-error">
                      <div class="group input-group">
                      <input type="hidden" name="foronboard" id="foronboard" value="<?php if (isset($passreset)) {echo "Y";} else {
  echo "N";
}?>">
                        <input type="text" name="username" id="forg_username1">

                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $this->lang->line('text_userName'); ?></label>
                        <span class="input-group-icon">
                      <i class="material-icons">account_circle</i>
                    </span>

                      </div>
                      <span id='ForgotPasswordForm_username_errorloc' class="error_strings text-danger"></span><br>
                      
                    </div>

                    <div class="form-group form-md-line-input has-error">
                      <div class=" input-group">
                        <span class="line"> <?php echo $this->lang->line('text_not_robot'); ?>   </span>
                        <input id="cbx21" type="checkbox" class="cbx"/>

                        <label for="cbx21" class="lbl notrobot">
                        </label>
                      </div>
                      <br/>
                      <div style="width:100%;float:left;">  <span id='forgotForm_checkbox_errorloc' class="error_strings text-danger"></span>
                     </div>
                      <span id="msgstar" style="color: red;"></span>
                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" id="forgot_submit" class="btn btn-primary"><?php echo $this->lang->line('text_go'); ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>





<!--  forgot password end  -->



          <div class="container gutter" id="register" >
  <form id="registerForm1" class="register-form1 " action="javascript:new_user();" method="post" role="form">
    <input type="hidden" name="token" value="<?= $this->config->item('csrf_token'); ?>">
    <input type="hidden" name="selectCategory" value="12">
  <div class="row row-eq-height eqwrap">

    <section class="in-register col-lg-4 col-md-4 col-sm-12">

    <!-- register form wrapper starts here -->
      <div class="in-register-form">

        <div style="width:100%;float:left;"><span id='reg_error_msg' class="error_strings text-danger"></span></div>

        <h2 class="text-left"><?php echo $this->lang->line('text_register'); ?></h2>

        
         
        <div class="alert alert-danger error_msg col-md-12" id="reg_error_msg" style="display: none;"></div>

          <div class="form-group form-md-line-input has-error">
            <div class="group input-group">

              <input autofocus="" type="text"name="NameofCompany" id="NameofCompany" value="<?php if (isset($customerDetails['Name_company'])) {echo $customerDetails['Name_company'];}?>"  autocomplete="off" />

              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <?php echo $this->lang->line('NameofCompany'); ?></label>
              <span class="input-group-icon">
                    <i class="material-icons">account_circle</i>
                  </span>

            </div>
            <div style="width:100%;float:left;">  <span id='registerForm_NameofCompany_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>

          <div class="form-group form-md-line-input has-error">
            <div class="group input-group">

              <input type="text"name="userStreet" id="userStreet" autocomplete="off" value="<?php if (isset($customerDetails['address'])) {echo $customerDetails['address'];}?>" autocomplete="off" />

              <span class="highlight"></span>
              <span class="bar"></span>
              <label>
                <span>  <?php echo $this->lang->line('street'); ?></span>

                <br/></label>
              <span class="input-group-icon">
                    <i class="material-icons">home</i>
                  </span>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_userStreet_errorloc'
                                                      class="error_strings text-danger"></span></div>

          </div>

          <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="userZIP" id="userZIP" autocomplete="off" value="<?php if (isset($customerDetails['Postcode'])) {echo $customerDetails['Postcode'];}?>"/>

              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span> <?php echo $this->lang->line('ZIP'); ?></span></label>


            </div>
            <div style="width:100%;float:left;"><span id='registerForm_userZIP_errorloc' class="error_strings text-danger">
                  </span></div>

          </div>


          <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text"  name="userCity" id="userCity" autocomplete="off" value="<?php if (isset($customerDetails['place'])) {echo $customerDetails['place'];}?>" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label><span><?php echo $this->lang->line('city'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_userCity_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>

          <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="owner_account" id="owner_account" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span> <?php echo $this->lang->line('ownerofaccount'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_owner_account_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>

           <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="bank" id="bank" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span> <?php echo $this->lang->line('bank'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_bank_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


        <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="iban" id="iban" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span>  <?php echo $this->lang->line('iban'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_iban_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>

           <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="biccode" id="biccode" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span>  <?php echo $this->lang->line('biccode'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_biccode_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


          <div class="form-group form-md-line-input">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select class="form-control input-register input-login"  id="sparesection1" name="sparesection1" />
                <option value="" selected=""><?php echo $this->lang->line('sparesection1'); ?></option>
                <option value="Bank" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Bank"){echo "selected";}?>>Bank</option>
              <option value="Unternehmen GmbH" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunale Unternehmen (GmbH)"){echo "selected";}?>>Kommunale Unternehmen (GmbH)</option>
              <option value="Unternehmen AöR KdöR" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunale Unternehmen (KdöR - AöR)"){echo "selected";}?>>Kommunale Unternehmen (KdöR - AöR)</option>   
              <option value="Kommunen" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunen"){echo "selected";}?>>Kommunen</option>
              </select>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_sparesection1_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>
          <div class="form-group form-md-line-input">
            <div class="group input-group">
              <select class="form-control input-register input-login" id="sparesection2" name="sparesection2" />
                <option value="">  <?php echo $this->lang->line('sparesection2'); ?> </option>
                <?php foreach($subClientgroups as $group){ ?>
                  <option value="<?php echo $group['category'];?>" <?php if (isset($customerDetails['category']) && $customerDetails['category'] ==  $group['category']){echo "selected";}?>><?php echo $group['category'];?></option>
                 <?php }?>
              </select>

            </div>
            <div style="width:100%;float:left;"><span id='registerForm_sparesection2_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


           <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text"  name="sparesection3" id="sparesection3" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span>  <?php echo $this->lang->line('sparesection3'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"> <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>



           <div class="form-group form-md-line-input has-error">
            <div class="group input-group">
              <input type="text" name="sparesection4" id="sparesection4" autocomplete="off" />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label> <span>  <?php echo $this->lang->line('sparesection4'); ?></span></label>

            </div>
            <div style="width:100%;float:left;"> <span id='registerForm_sparesection4_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


          <div class="login-margin"></div>
          <button id="next-reg-2" type="button" class="button btn buttonBlue " onclick="showstep2();">
            <div class="ripples buttonRipples d-inline-block align-middle">
              <span class="ripplesCircle"></span>
            </div>
            Next
            <i class="material-icons d-inline-block align-middle">
              keyboard_arrow_right
            </i>
          </button>



          <div class="form-circles text-center" id="form-circles-1">
            <a href="" class="dot active"></a>
            <a href="" class="dot"></a>

            <a href="" class="dot"></a>
          </div>
      </div>

      <!-- Register Form Wrapper ends here -->

    </section>


    <section id="step2-reg" class="in-register  col-lg-4 col-md-4 col-sm-12">
      <div class="in-register-form">

        <div id="gotostep1">
                <span>
                  <i class="material-icons">arrow_back</i>
                </span>
        </div>

        <div class="form-group form-md-line-input">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select class="form-control input-register input-login"  id="Prefex" name="Prefex" />
                <option value="" selected=""> <?php echo $this->lang->line('Prefex'); ?></option>
                <option value="<?php echo $this->lang->line('Mr.'); ?>" <?php if (isset($customerDetails['salutation']) && $customerDetails['salutation'] == "Herr") {echo "selected";}?>>
                    <?php echo $this->lang->line('Mr.'); ?>
                  </option>
                  <option value="<?php echo $this->lang->line('Mrs.'); ?>" <?php if (isset($customerDetails['salutation']) && $customerDetails['salutation'] == "Frau") {echo "selected";}?>>
                    <?php echo $this->lang->line('Mrs.'); ?>
                  </option>
                </select>

            </div>
            <div style="width:100%;float:left;"> <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>

        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="Title" id="Title" autocomplete="off" value="<?php if (isset($customerDetails['title'])) {echo $customerDetails['title'];}?>" />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('Title'); ?></label>
            

          </div>
          <div style="width:100%;float:left;"><span id='registerForm_Title_errorloc' class="error_strings text-danger">
                  </span></div>
        </div>

        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="fname" id="fname" autocomplete="off" value="<?php if (isset($customerDetails['first_name'])) {echo $customerDetails['first_name'];}?>" />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('FirstName'); ?></label>
           

          </div>
          <div style="width:100%;float:left;"><span id='registerForm_fname_errorloc' class="error_strings text-danger">
                  </span></div>
        </div>


        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text"  name="lname" id="lname"  autocomplete="off" value="<?php if (isset($customerDetails['Surname'])) {echo $customerDetails['Surname'];}?>" />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label> <?php echo $this->lang->line('LastName'); ?></label>
            

          </div>
          <div style="width:100%; float:left;"> <span id='registerForm_lname_errorloc' class="error_strings text-danger">
                  </span></div>
        </div>

        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="contactnumber" onkeyup="check_phone();" id="contactnumber" onkeyup="check_phone();"  autocomplete="off" value="<?php if (isset($customerDetails['contactnumber'])) {echo $customerDetails['contactnumber'];}?>" />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('ContactNumber'); ?></label>
            <span class="input-group-icon">
                    <i class="material-icons">phone</i>
                  </span>

          </div>
            <div style="width:100%;float:left;">
                  <span id='registerForm_contactnumber_errorloc' class="error_strings text-danger">
                  </span>
            </div>
            <div style="width:100%">
              <span id='checkphoneError' class="error_strings text-danger"></span>
              </div> 
          
        </div>
        <div class="clearfix">
              </div>
              <div class="clearfix">
              </div>


        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="email" name="email" id="email"
                   autocomplete="off"  />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('email'); ?></label>
            <span class="input-group-icon">
                    <i class="material-icons">email</i>
                  </span>

          </div>
          <div style="width:100%;">
                  <span class="email_error text-danger" id="email_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_email_errorloc' class="error_strings text-danger">
                  </span>
                </div>
        </div>

        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text"  name="userid" id="userid"  autocomplete="off" onkeyup="checkusername(this.value);" >
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('userid'); ?></label>
          </div>
          <div style="width:100%;">
            <span id='registerForm_userid_errorloc' class="error_strings text-danger">
                  </span>
                <span class="email_error text-danger" id="userid_error">
                  </span>
                </div>
            <div style="width:100%">
              <span id='registerForm_user_name_errorloc' class="error_strings text-danger"></span>
              </div> 
              <div style="width:100%">
              <span id='checkusernameError' class="error_strings text-danger"></span>
              </div>   
        </div>

        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="usersparesection1" id="usersparesection1"  autocomplete="off"/>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('usersparesection1'); ?></label>
          </div>

            <div style="width:100%;">
                  <span class="sparesection1_error text-danger" id="sparesection1_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_user_sparesection1_errorloc' class="error_strings text-danger">
                  </span>
            </div>
        </div>


        <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="usersparesection2" id="usersparesection1"  autocomplete="off"/>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('usersparesection2'); ?></label>
          </div>

            <div style="width:100%;">
                  <span class="sparesection2_error text-danger" id="sparesection2_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_user_sparesection2_errorloc' class="error_strings text-danger">
                  </span>
                </div>
        </div>

         <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text" name="usersparesection3" id="usersparesection3"  autocomplete="off"/>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><?php echo $this->lang->line('sparesection3'); ?></label>
          </div>

           <div style="width:100%;">
                  <span class="usersparesection3_error text-danger" id="sparesection3_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                  </span>
            </div>
        </div>

        <div class="login-margin"></div>
        <button type="button" class="button btn buttonBlue " id="next-reg-3">
          <div class="ripples buttonRipples d-inline-block align-middle">
            <span class="ripplesCircle"></span>
          </div>
          Next
          <i class="material-icons d-inline-block align-middle">
            keyboard_arrow_right
          </i>
        </button>

        <div class="form-circles text-center" id="form-circles-2">
          <a href="" class="dot active"></a>
          <a href="" class="dot active"></a>

          <a href="" class="dot"></a>
        </div>
      </div>

    </section>

    <section class="in-register col-lg-4 col-md-4 col-sm-12" id="step3-reg">
      <div class="in-register-form">

        <div id="gotostep2">
                <span>
                  <i class="material-icons">arrow_back</i>
                </span>
        </div>


        <div class=" form-md-line-input has-error">
      
        
               
            <p>
           
                    <?php echo $this->lang->line('promissoryNote'); ?>
                 <br/>
            <input type="checkbox" id="borrowercheck" class="cbx checkBoxUserType" name="UserType[]" value="borrower">
            <label for="borrowercheck" class="lbl"> 
               <?php echo $this->lang->line('userBorrower'); ?> </label>&nbsp;&nbsp;
           
            <input type="checkbox" id="lender" class="cbx checkBoxUserType" name="UserType[]" value="lender" />
            <label for="lender" class="lbl">
                  <?php echo $this->lang->line('userLender'); ?> </label>&nbsp;&nbsp;
             </p>
           

            <div style="width:100%;">
            <span id='registerForm_userTypeError_errorloc' class="error_strings text-danger">
                  </span>
                

        </div>
     


    <div style="display: none;" id="testing">

          <div class="form-group form-md-line-input">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select class="form-control input-register input-login"  id="Ratinga1" name="Ratinga1" />
                <option value="" selected=""> <?php echo $this->lang->line('Ratinga1'); ?></option>
                <option value="Moody’s">Moody’s</option>
                  <option value="S&P">S&P</option>
                  <option value="Fitch">Fitch</option>
                  <option value="ICV">ICV</option>
                  <option value="Creditreform">Creditreform</option>
                  <option value="EulerHermes">EulerHermes</option>
                </select>

            </div>
            <div style="width:100%;float:left;">   <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


      <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text"  name="ratesRatinga1" id="ratesRatinga1"  autocomplete="off"/>
            <span class="highlight"></span>
            <span class="bar"></span>
            
          </div>

           <div style="width:100%;">
                <span class="ratesRatinga1_error text-danger" id="ratesRatinga1_error">
                </span>
                </div>
                <div style="width:100%;">
                <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                </span>
            </div>
        </div>

          <div class="form-group form-md-line-input">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select class="form-control input-register input-login"  id="Ratinga2" name="Ratinga2" />
                <option value="" selected=""> <?php echo $this->lang->line('Ratinga2'); ?></option>
                <option value="Moody’s">Moody’s</option>
                  <option value="S&P">S&P</option>
                  <option value="Fitch">Fitch</option>
                  <option value="ICV">ICV</option>
                  <option value="Creditreform">Creditreform</option>
                  <option value="EulerHermes">EulerHermes</option>
                </select>

            </div>
            <div style="width:100%;float:left;">  <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


      <div class="form-group form-md-line-input has-error">
          <div class="group input-group">
            <input type="text"  name="ratesRatinga2" id="ratesRatinga2"  autocomplete="off"/>
            <span class="highlight"></span>
            <span class="bar"></span>
          </div>

           <div style="width:100%;">
                <span class="ratesRatinga2_error text-danger" id="ratesRatinga2_error">
                </span>
                </div>
                <div style="width:100%;">
                <span id='registerForm_ratesRatinga2_errorloc' class="error_strings text-danger">
                </span>
            </div>
        </div>


       <div class="form-group form-md-line-input">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select class="form-control input-register input-login"  id="Einlagen" name="Einlagen" />
                <option value="" selected=""> <?php echo $this->lang->line('Einlag'); ?></option>
                <option value="Einlagensicherung der privaten Banken">Einlagensicherung der privaten Banken</option>
                  <option value="Genossenschaftliche Einlagensicherung">Genossenschaftliche Einlagensicherung</option>
                  <option value="Sicherung DGSV">Sicherung DGSV</option>
                  <option value="Öffentliche Banken">Öffentliche Banken</option>
                  <option value="Sonstige Einlagensicherung">Sonstige Einlagensicherung</option>
                  <option value="Keine Einlagensicherung">Keine Einlagensicherung</option>
                </select>

            </div>
            <div style="width:100%;float:left;"> <span id='registerForm_Einlagen_errorloc' class="error_strings text-danger">
                  </span></div>
          </div>


    <div class="form-md-line-input has-error">
      
      
      <?php echo $this->lang->line('Preise'); ?>
               <br/>
          <p>
          
          <input id="Kommunen" type="checkbox"  class="cbx checkBoxUserType" name="accessclientgroup[]" value="Kommunen" />
          <label for="Kommunen" class="lbl"> 
                   <?php echo $this->lang->line('Kommunen'); ?> </label>&nbsp;&nbsp;
         
          <input id="Unternehmen" type="checkbox" class="cbx checkBoxUserType" name="accessclientgroup[]" value="Unternehmen GmbH" />
          <label for="Unternehmen" class="lbl">
                   <?php echo $this->lang->line('Unternehmen'); ?></label>&nbsp;&nbsp;

         <input id="Unternehmen1" type="checkbox" class="cbx checkBoxUserType" name="accessclientgroup[]" value="Unternehmen AöR KdöR" />
         <label for="Unternehmen1" class="lbl">
         <?php echo $this->lang->line('AoR'); ?></label>
           </p>
           <div style="width:100%;float:left;">
                  <span id='registerForm_access_errorloc' class="error_strings text-danger">
                  </span>
                </div>
          <div style="width:100%;"><span id='clientgroupError' class="error_strings text-danger"></span></div>

      </div>

    <div class="form-group1 form-md-line-input has-error">
        <input type="checkbox" name="PrivacyPolicy" value="Y" id="PrivacyPolicy">
           <label for="PrivacyPolicy" class="lbl"><a target="_blank" href="#">
                  <?php echo $this->lang->line('stimme'); ?>
                </a></label>
    </div>

       <div class="form-group1 form-md-line-input has-error">
       <input type="checkbox" name="ratings" value="Y" id="ratings">
       <label for="ratings" class="lbl">     <a target="_blank" href="#">
                  <?php echo $this->lang->line('dass'); ?>
                </a></label>
    </div>

       <div class="form-group1 form-md-line-input has-error">
       <input type="checkbox" class="cbx" name="information" value="Y" id="information">
       <label for="information" class="lbl">   <a target="_blank" href="#">
                  <?php echo $this->lang->line('unserem'); ?>
                </a>
        </label>
    </div>

    </div>    

            <p>

              <?php if ($_SESSION['language'] == "france") { ?>

              <input id="cbx4" type="checkbox" class="cbx" name="chkterms" value="Y">
              <label for="cbx4" class="lbl"> <a target="_blank"
                                                href="#"> <?php echo $this->lang->line('text_termcondition'); ?> </a>
              </label>
              <?php } elseif ($_SESSION['language'] == "german") { ?>
              <input id="cbx4" type="checkbox" class="cbx" name="chkterms" value="Y">
              <label for="cbx4" class="lbl">  <a target="_blank"
                                                 href="#"> <?php echo $this->lang->line('text_termcondition'); ?> </a>
              </label>
              <?php } else { ?>
              <input id="cbx4" type="checkbox" class="cbx" name="chkterms" value="Y">
              <label for="cbx4" class="lbl"> <a target="_blank"
                                                href="#"> <?php echo $this->lang->line('text_termcondition'); ?> </a>
              </label>

              <?php } ?>

            </p>
            <div style="width:100%;float:left;"><span id='registerForm_terms_errorloc'
                                                      class="error_strings text-danger"></span></div>
         

        <div class="login-margin"></div>

        <div class="loading" id="loading" style="display:none; text-align:center;"> Please Wait...</div>

        <button type="submit" class="button btn buttonBlue btnA" id="btncheck">
          <div class="ripples buttonRipples d-inline-block align-middle ">
            <span class="ripplesCircle"></span>
          </div>
          <?php echo $this->lang->line('text_register_submit'); ?>
          <i class="material-icons d-inline-block align-middle">
            keyboard_arrow_right
          </i>
        </button>



        <div class="form-circles text-center">
          <a href="" class="dot active"></a>
          <a href="" class="dot active"></a>

          <a href="" class="dot active"></a>
        </div>


      </div>

    </section>
   </div>
  </form>

</div>



<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->



    <script src="<?php echo base_url() . "assets/"; ?>js-new/index.js"></script>

    <script>

function check_phone() {

var str = $('#contactnumber').val();
if (str.match(/[a-z]/i)) {
  $('#checkphoneError').css('visibility', 'visible').html('Please Enter Valid Contact Number');
  $('#btncheck').attr("disabled", "disabled");
} else if (str.indexOf('-') != -1 || str.indexOf('(') != -1 || str.indexOf(')') != -1 || str.indexOf(' ') != -1 || str.indexOf('+') != -1 || str.match(/[0-9]/i)) {
  $('#btncheck').attr("disabled", false);
  $('#checkphoneError').css('visibility', 'hidden').html('');

} else {
  $('#checkphoneError').css('visibility', 'visible').html('Please Enter Valid Contact Number');
  $('#btncheck').attr("disabled", "disabled");
}
}


$(document).ready(function(){
    $("#register").css("display", "none");
    $("li a.selected").css("background-color", "#7e2cb8");
    $("#reg").click(function(){
        $("#login").hide();
        $("#register").show();
    });
  
});

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


<script type="text/javascript">
    var temp1 = "";
function lendersBanks(){
$.ajax({
url:"<?php echo base_url(); ?>instimatch/lendersLatestBanks",
method:"post",
cache:false,
success:function(htnlstr){
  if(temp1 != htnlstr){
    $("#lenderslatestBanks").html(htnlstr);
    $(".lendrequest").click(function(){
    var bankIds = $(this).attr("data-id");
    $("#lendrequestmodal").modal("show");
    $("#requestmessage").html("");
    bankId = 'bankId='+bankIds;
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/lenderRequestSend",
    method:"post",
    data:bankId,
    cache:false,
    success:function(htnlstr){
      // alert(htnlstr);
      // return
      $('#lendrequestmodal').modal({ keyboard: false,show: true});
      $('#lendermodaldialog').draggable({handle: "#lendermodalheadr"});
      $("#lendrequestbody").html(htnlstr);
      //$( "#datepicker").datepicker();
      $("#datepicker1").datepicker({
      dateFormat:'dd/mm/yy',
      minDate: 0,
      onSelect: function(dateText, inst) {
      var end_date = $(this).val();
      var start_date = $("#datepicker").val();
      var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
      //alert(dateDifference);
      $("#no_of_days").html(dateDifference);
      }
      });
      $("#datepicker").datepicker({
      dateFormat:'dd/mm/yy',
      minDate: 0,
      onSelect: function(dateText, inst) {
      var start_date = $(this).val();
      var end_date = $("#datepicker1").val();
      var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
      //alert(dateDifference);
      $("#no_of_days").html(dateDifference);
      }
      });
      $('.requestamount').on('blur', function() {
        var number1 = $(this).val();
        var number = parseFloat(number1).toFixed(2);
        var withCommas = Number(number).toLocaleString('eu');
        var amount = withCommas.replace(/,/g, ".");
        // alert(withCommas);
        // return false;
        if(amount.indexOf('.') !== -1)
          {
            $(this).val(amount);
          }else{
            $(this).val(number1);
          }
      });

      $("#sendRequest").click(function(){
        //$("#requestmessage").html("PLEASE WAIT RESPONSE");
         var lender_id = "<?php echo $_SESSION['user_id'];?>"; 
         var amount = $(".requestamount").val();
        // // n = parseFloat(n).toFixed(2);
        //  alert(n);
        // var withCommas = Number(n).toLocaleString('eu');
        // alert(withCommas);
        // var amount = withCommas.replace(/,/g, ".");
         var start_date = $("#datepicker").val();
         var end_date = $("#datepicker1").val();
         var no_of_days = $("#no_of_days").html();
         var payments = $("#payments").val();
         var interest = $("#interest").val();
        //  alert(n);
        //  return false;
         var data_to_send = 'lenderId='+lender_id+'&amount='+amount+'&start_date='+start_date+'&end_date='+end_date+'&no_of_days='+no_of_days+'&payments='+payments+'&borrowerId='+bankIds+'&interest='+interest;
        $.ajax({
        url:"<?php echo base_url(); ?>instimatch/updateRequestSend",
        method:"post",
        data:data_to_send,
        cache:false,
        success:function(htnlstr){
         
         $("#requestmessage").html("REQUEST SENT SUCCESFULLY. PLEASE WAIT FOR BORROWER’S RESPONSE.");
         //$('#requestmessage').delay(3000).fadeOut();
         $("#sendRequest").prop("disabled",true);                
         //setTimeout(function() {$('#lendrequestmodal').modal('hide');}, 4000);
          //alert(htnlstr);
        }
        });
        // alert(data_to_send);

      });
  
    }
    });

   

   //alert(bankId);
    });
  }
  temp1 = htnlstr;
}
});
}
setInterval("lendersBanks()", 1000);
    function checkusername(username)
    {
   // alert(username);
    var term = 'username='+username;
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/checkusername",
    data:term,
    method:"post",
    cache:false,
    success:function(htnlstr){
        
     if(htnlstr == 'false'){
      $("#checkusernameError").html("Please select another username.Its already taken");
      $("#btncheck").prop("disabled",true);
     }else{
      $("#checkusernameError").html("");
      $("#btncheck").prop("disabled",false);
     }
    }
    });
    }
//     var tempering = '';
//     function getlatestdata(){
//       var customerId = "<?php echo $_GET['customerid']; ?>";
//       var term = 'customerid='+customerId;
//   $.ajax({
//     url:"<?php echo base_url(); ?>instimatch/getlatestdataviewuser",
//     data:term,
//     method:"post",
//     cache:false,
//     success:function(htnlstr){
//       if(tempering != htnlstr){
//       $("#bank_Interest").html(htnlstr);
//       tempering = htnlstr;
//       }
//       $(".sorting").click(function(){
//         var sorting_of = $(this).attr("data-id");
//         $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
//         var view = 'sort='+sorting_of+'&customerid='+customerId;
//         // alert(view);
//         // return false;
//         $.ajax({
//         url:"<?php echo base_url(); ?>instimatch/getCustomerSorted",
//         method:"post",
//         data : view,
//         cache:false,
//         success:function(htnlstr){
//           // alert(htnlstr);
//           // return false;
//         $("#bank_Interest").html(htnlstr);
//         $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
//         }
//         });
//         // $.ajax({
//         // url:"<?php //echo base_url(); ?>instimatch/getblanksortedData",
//         // method:"post",
//         // cache:false,
//         // success:function(htnlstr1){
//         // $("#bank_Interest1").html(htnlstr1);
//         // $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
//         // }
//         // });
//       });

//       //$("#bank_Interest").html(htnlstr);
//     }
//     });
// }
// $(document).ready(function(){
// setInterval("getlatestdata()", 1000);
// });
        $(document).ready(function(){
          $('#messageDiv').hide();
          $('#interest_table').hide();
        });
    </script>
    <script type="text/javascript">
      function loginforregister()
      {
        if($('#username').val() == ''){
          $('#loginForm_username_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterUserNameEmail'); ?>");
          return;
          }else{
          $('#loginForm_username_errorloc').text('');
          }
          if($('#password').val() == ''){
          $('#loginForm_password_errorloc').css('visibility', 'visible').html('<?php echo $this->lang->line('text_pleaseEnterPassword'); ?>');
          return;
          }else{
          $('#loginForm_password_errorloc').text('');
          }
          if($('#login_captcha').val() == ''){
          $('#form-captcha-error').show();
          $('#loginForm_captcha_errorloc').css('visibility', 'visible').html('<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>');
          return;
          }else{
          $('#loginForm_captcha_errorloc').text('');
          }
        var data_to_send = $('#loginForm').serialize();
        $.ajax({
          url: "<?php echo base_url(); ?>instimatch/loginforonboard",
          data: data_to_send,
          type: "post",
          cache: false,
          success: function(result) {
              if (result == 'false') {

              $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_pleaseEnterCorrectCrediantials'); ?>");

              }else if(result == 'wrongcaptcha') {

              $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");

              }else if(result == 'securitybleach') {

            $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_securitybleach'); ?>");
              setInterval(function(){ location.reload(); }, 3000);

              }else if(result == '1') {

              window.location.href = "<?php echo base_url() . "?customerid=" . base64_encode($customerid) . "&reg=" . base64_encode('Y') . ""; ?>";

              }
              else
              {
              $(".loginErrorContainer").show().html(result);
              }
          }
        }
              );
      }
    </script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
    jQuery('#borrowercheck').change(function() {
        if ($(this).prop('checked')) {
          $("#testing").css("display","block");
        // var $form = $('#registerForm');
        // var $PrivacyPolicy = $("#PrivacyPolicy");
        // var $ratings = $("#ratings");
        // var $information = $("#information");
        // $form.on('submit', function(e) {
        //   if(!$PrivacyPolicy.is(':checked') || !$ratings.is(':checked') || !$information.is(':checked')  ) {
        //     $("#all_error").show();
        //     e.preventDefault();
        //   }
        //   else{
        //     $("#all_error").hide("");
        //   }
        // });
        }
        else {
          $("#testing").css("display","none");
        }
    });
});

    </script>
    <?php
if (isset($showlogin)) {?>
      <script type="text/javascript">
        $(document).ready(function(){
          $("#loginForm").show();
        });
    </script>

    <?php }?>
    <?php
if (isset($passreset)) {
  ?>
        <script type="text/javascript">
        $(document).ready(function(){
          $("#loginForm").hide();
          $("#messageDiv").css("display", "block");
        });
    </script>


       <?php }
?>
       <?php
if (isset($showform)) {?>
<script type="text/javascript">
        $(document).ready(function(){
        $(".login-form").hide();
        $('#interest_table').show();
        $("#chooseRegisterType").hide();
        });
    </script>
      <?php }
?>

       <?php
if (isset($already)) {
  ?>
        <script type="text/javascript">
        $(document).ready(function(){
        $(".login-form").hide();
        $('#nonbankButton').trigger('click');

        });
    </script>
       <?php }?>

    <?php if (isset($register)) {?>
    <script type="text/javascript">
        $(document).ready(function(){
          $(".login-form").hide();
          $('#nonbankButton').trigger('click');
        });
    </script>
    <?php }?>

    <style>
      .red{
        border:1px solid red;
      }
    </style>
    <script>
      $(document).ready(function () {
        var $form = $('#registerForm');
        var $checkbox = $('#chkterms');
        var $PrivacyPolicy = $("#PrivacyPolicy");
        var $ratings = $("#ratings");
        var $information = $("#information");

        $form.on('submit', function(e) {
          if(!$checkbox.is(':checked')) {
            //$("#all_error").show();
            e.preventDefault();
          }
          else{
            $("#all_error").hide("");
          }
        });
      });

    </script>
    <script>
    /*  var registerFormValidator = new Validator("registerForm");
      registerFormValidator.EnableOnPageErrorDisplay();
      registerFormValidator.EnableMsgsTogether();
      registerFormValidator.addValidation("NameofCompany", "req", "<?php echo $this->lang->line('text_pleaseEnterCompanyName'); ?>");
      registerFormValidator.addValidation("userStreet", "req", "<?php echo $this->lang->line('text_pleaseEnterStreetName'); ?>");
      registerFormValidator.addValidation("userZIP", "req", "<?php echo $this->lang->line('text_pleaseEnterUserZIP'); ?>");
      registerFormValidator.addValidation("userCity", "req", "<?php echo $this->lang->line('text_pleaseEnterUserCity'); ?>");
      registerFormValidator.addValidation("owner_account", "req", "<?php echo $this->lang->line('text_pleaseEnterowner_account'); ?>");
      registerFormValidator.addValidation("bank", "req", "<?php echo $this->lang->line('text_pleaseEnterbank'); ?>");
      registerFormValidator.addValidation("iban", "req", "<?php echo $this->lang->line('text_pleaseEnterIBANNumber'); ?>");
      registerFormValidator.addValidation("biccode", "req", "<?php echo $this->lang->line('text_pleaseEnterbiccode'); ?>");
     
      registerFormValidator.addValidation("Prefex", "req", "<?php echo $this->lang->line('text_pleaseEnterPrefex'); ?>");
      registerFormValidator.addValidation("fname", "req", "<?php echo $this->lang->line('text_pleaseEnterFirstName'); ?>");
      registerFormValidator.addValidation("lname", "req", "<?php echo $this->lang->line('text_pleaseEnterLastName'); ?>");
     //registerFormValidator.addValidation("captcha", "req", "<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");
      registerFormValidator.addValidation("email", "req", "<?php echo $this->lang->line('text_pleaseEnteremail'); ?>");
      registerFormValidator.addValidation("userid", "req", "<?php echo $this->lang->line('text_pleaseuserid'); ?>");
      registerFormValidator.addValidation("contactnumber", "req", "<?php echo $this->lang->line('text_contactNumber'); ?>");
      registerFormValidator.addValidation("sparesection1", "req", "<?php echo $this->lang->line('text_sparesection1'); ?>");
      registerFormValidator.addValidation("sparesection2", "req", "<?php echo $this->lang->line('text_sparesection2'); ?>");
*/
      var frmvalidator = new Validator("loginForm");
      frmvalidator.EnableOnPageErrorDisplay();
      frmvalidator.EnableMsgsTogether();
      frmvalidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserName'); ?>");
      frmvalidator.addValidation("password", "req", "<?php echo $this->lang->line('text_pleaseEnterPassword'); ?>");
      frmvalidator.addValidation("captcha", "req", "<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");
      var forgotPasswordFormValidator = new Validator("ForgotPasswordForm");
      forgotPasswordFormValidator.EnableOnPageErrorDisplay();
      forgotPasswordFormValidator.EnableMsgsTogether();
      forgotPasswordFormValidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserName'); ?>");

      function check_user() {
          if($('#username').val() == ''){
          $('#loginForm_username_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterUserName'); ?>");
          return;
          }else{
          $('#loginForm_username_errorloc').text('');
          }
          if($('#password').val() == ''){
          $('#loginForm_password_errorloc').css('visibility', 'visible').html('<?php echo $this->lang->line('text_pleaseEnterPassword'); ?>');
          return;
          }else{
          $('#loginForm_password_errorloc').text('');
          }

        if($("#cbx3").prop('checked') == false){
            $('#loginForm_checkbox_errorloc').css('visibility', 'visible').html('<?php echo $this->lang->line('text_login_check'); ?>');
          return;
        }else{
            $('#loginForm_checkbox_errorloc').text('');
        }
         /* if($('#login_captcha').val() == ''){
          $('#form-captcha-error').show();
          $('#loginForm_captcha_errorloc').css('visibility', 'visible').html('<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>');
          return;
          }else{
          $('#loginForm_captcha_errorloc').text('');
          }
          */
        var data_to_send = $('#loginForm').serialize();

        $.ajax({
            
          url: "<?php echo base_url(); ?>instimatch/login",
          data: data_to_send,
          type: "post",
          cache: false,
          success: function(result) {
            
              if (result == 'false') {

              $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_pleaseEnterCorrectCrediantials'); ?>");

              }else if(result == 'securitybleach') {

              $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_securitybleach'); ?>");
              setInterval(function(){ location.reload(); }, 3000);

              }else if(result == '1') {

              window.location.href = "<?php echo base_url(); ?>";

              }
              else
              {
              $(".loginErrorContainer").show().html(result);
              }
          }
        }
              );
      }
      function chooseType()
      {
        $("#chooseRegisterType").show();
        $(".login-form").hide();
      }
      function hideRegisterType()
      {
        $("#chooseRegisterType").hide();
        $(".login-form").show();
      }
      function selectRegisterType(id)
      {
        if(id == "1")
        {
          $("#switfNumberChf").click();
          $(".bankField").show();
          $(".nonBankField").hide();
          $("#userCategory").hide();
          $("#selectCategory").html("<option value='1' selected>Bank</option>");
          $("#company_name").attr("placeholder", "<?php echo $this->lang->line('bankName'); ?> *");
        }
        if(id == "2")
        {
          $("#company_name").attr("placeholder", "<?php echo $this->lang->line('text_companyName2'); ?> *");
          $("#selcetIban").click();
          $(".bankField").hide();
          $(".nonBankField").show();
          $("#userCategory").show();
          $.ajax({
            url: "<?php echo base_url() . "register/getAllCategoies"; ?>",
            type : "post",
            cache : false ,
            success: function(result)
            {
            $("#selectCategory").html(result);
          }
                 }
                );
        }
        $("#registerForm-").show();
        $("#chooseRegisterType").hide();
      }
      function hideRegisterForm()
      {
        $("#registerForm-").hide();
        $("#chooseRegisterType").show();
      }
      function show_register() {
        $.ajax({
          url: "<?php echo base_url() . "instimatch/getServiceType"; ?>",
          type: "post",
          cache: false,
          success: function(result) {
          $(".landerServiceType").html(result);
          registerFormValidator.addValidation("category", "req", "<?php echo $this->lang->line('text_pleaseSelectCategory'); ?>");
        }
               }
              );
        $.ajax({
          url: "<?php echo base_url() . "instimatch/fedafinRating"; ?>",
          type: "post",
          cache: false,
          success: function(result) {
          $(".fedafin_rating").html(result);
        }
               }
              );
      }
      function checkEmail_status1() {
        $(".email_error").html("");
        var email = $("#email").val();
        if(email != '') {
          var data_to_send = 'email=' + email;
          $.ajax({
            url:"<?php echo base_url() . "register/checkEmail_status" ?>",
            method:"post",
            data:data_to_send,
            cache:false,
            success:function(result) {
            if(result == '1') {
            $(".email_error").text("<?php echo $this->lang->line('text_emailIdAlreadyExistPleaseenterCorrectId'); ?>");
          }
                 else {
                 $(".email_error").text("");
        }
      }
      }
      );
      }
      }
      function checkuname_status() {
        $(".uname_error1").hide();
        var uname = $("#user_name").val();
        if(uname != '') {
          var data_to_send = 'uname=' + uname + '&function=checkuname_status';
          $.ajax({
            url:"<?php echo base_url() . "register/checkuname_status" ?>",
            method:"post",
            data:data_to_send,
            cache:false,
            success:function(result) {
            if(result == '1') {
            $(".uname_error1").show();
          }
                 else {
                 $(".uname_error1").hide();
        }
      }
      }
      );
      }
      }

/*     New User  */

function new_user() {
        if ($('#NameofCompany').val() == '') {
          $('#registerForm_NameofCompany_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterCompanyName'); ?>");

        } else {
          $('#registerForm_NameofCompany_errorloc').text('');
        }
        if ($('#userStreet').val() == '') {
          $('#registerForm_userStreet_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterStreetName'); ?>");

        } else {
          $('#registerForm_userStreet_errorloc').text('');
        }

        if ($('#userZIP').val() == '') {
          $('#registerForm_userZIP_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterUserZIP'); ?>");

        } else {
          $('#registerForm_userZIP_errorloc').text('');
        }

        if ($('#userCity').val() == '') {
          $('#registerForm_userCity_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterUserCity'); ?>");

        } else {
          $('#registerForm_userCity_errorloc').text('');
        }

        if ($('#owner_account').val() == '') {
          $('#registerForm_owner_account_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterowner_account'); ?>");

        } else {
          $('#registerForm_owner_account_errorloc').text('');
        }

        if ($('#bank').val() == '') {
          $('#registerForm_bank_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterbank'); ?>");

        } else {
          $('#registerForm_bank_errorloc').text('');
        }

        if ($('#iban').val() == '') {
          $('#registerForm_iban_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterIBANNumber'); ?>");

        } else {
          $('#registerForm_iban_errorloc').text('');
        }

        if ($('#biccode').val() == '') {
          $('#registerForm_biccode_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterbiccode'); ?>");

        } else {
          $('#registerForm_biccode_errorloc').text('');
        }

        if ($('#sparesection1').val() == '') {
          $('#registerForm_sparesection1_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_sparesection1'); ?>");

        } else {
          $('#registerForm_sparesection1_errorloc').text('');
        }

        if ($('#sparesection2').val() == '') {
          $('#registerForm_sparesection2_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_sparesection2'); ?>");

        } else {
          $('#registerForm_sparesection2_errorloc').text('');
        }

        if ($('#Prefex').val() == '') {
          $('#registerForm_Prefex_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterPrefex'); ?>");
        } else {
          $('#registerForm_Prefex_errorloc').text('');
        }

         if ($('#fname').val() == '') {
          $('#registerForm_fname_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterFirstName'); ?>");
        } else {
          $('#registerForm_fname_errorloc').text('');
        }


        if ($('#lname').val() == '') {
          $('#registerForm_lname_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterLastName'); ?>");
        } else {
          $('#registerForm_lname_errorloc').text('');
        }

         if ($('#contactnumber').val() == '') {
          $('#registerForm_contactnumber_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_contactNumber'); ?>");
        } else {
          $('#registerForm_contactnumber_errorloc').text('');
        }

          if ($('#email').val() == '') {
          $('#registerForm_email_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnteremail'); ?>");
        } else {
          $('#registerForm_email_errorloc').text('');
        }

             if ($('#userid').val() == '') {
          $('#registerForm_userid_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseuserid'); ?>");
       return;
        } else {
          $('#registerForm_userid_errorloc').text('');
        }

  if ($('#userid').val().length < 7 ) {
          $('#registerForm_user_name_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('lenght_userid'); ?>");
          return;
        } else {
          $('#registerForm_user_name_errorloc').text('');
        }
        if ($(".checkBoxUserType:checked").length>0)
        {
            if ($('#Einlagen').val() == '') {
                $('#registerForm_Einlagen_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('Einlagen_check'); ?>");
            } else {
                 $('#registerForm_Einlagen_errorloc').text('');
            }

            if ($("[name='accessclientgroup[]']:checked").length>0) {
                $('#registerForm_access_errorloc').text('');
            } else {
                $('#registerForm_access_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('accessclientgroup_check'); ?>");
            }
            $("#registerForm_userTypeError_errorloc").html("");  
        }else{
            $("#registerForm_userTypeError_errorloc").html("<?php echo $this->lang->line('selectUserType'); ?>");
        }


        if ($("#cbx4:checked").length > 0) {
          $("#registerForm_terms_errorloc").html("");

        }
        else {
          $('#registerForm_terms_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseCheckdata'); ?>");
          return;
        }

      
       

        if($('#NameofCompany').val() == '' || $('#userStreet').val() == '' || $('#owner_account').val() == '' ||
          $('#userZIP').val() == '' || $('#userCity').val() == '' || $('#bank').val() == '' ||
          $('#iban').val() == ''|| $('#biccode').val() == ''  ||  $('#sparesection1').val() == ''||  $('#sparesection2').val() == ''
          || $('#Prefex').val() == '' || $('#fname').val() == '' || $('#lname').val() == '' ||
          $('#contactnumber').val() == '' || $('#userid').val() == '' || $('#email').val() == '' 
        ){
          return;
        }

        var data_to_send = $('#registerForm1').serialize();
//alert(data_to_send);
         $.ajax({
              url:"<?php echo base_url() . "register/new_user"; ?>",
              data:data_to_send,
              type:"post",
              cache:false,
              success:function(result){
                 //alert(result);
                // return false;
                if(result == 'true')
                {
                window.location.href="<?php echo base_url() . "register/login?msg=success"; ?>";
               
                }
                else if(result == 'false')
                {
                $('#registerForm').animate({ scrollTop: 0 }, 'slow');
                $("#reg_error_msg").show().html("<?php echo $this->lang->line('text_pleaseTryAgain'); ?>");
                }
                else{
                $('#NameofCompany').focus();
                $('html,body').animate({ scrollTop: $("#registerForm").offset().top}, 1000);
                $("#reg_error_msg").show().html(result);
                }
          $(".all_error").html("");
        }
      }
      );
 
}









      function add_user(){
        alert('1');
        if ($(".checkBoxUserType:checked").length>0)
        {
          $("#userTypeError").html("").hide();
          var uname_error = $(".uname_error").text();
          var email_error = $(".email_error").text();


            var data_to_send = $('#registerForm').serialize();
             alert(data_to_send);
            // return false;

            $.ajax({
              url:"<?php echo base_url() . "register/new_user"; ?>",
              data:data_to_send,
              type:"post",
              cache:false,
              success:function(result){
                 alert(result);
                // return false;
                if(result == 'true')
                {
                $('#btncheck').attr("disabled", "disabled");
                <?php if (isset($already)) {?>
                  window.location.href="<?php echo base_url() . "register/login?passreset=Y"; ?>";
               <?php } else {?>
                window.location.href="<?php echo base_url() . "register/login?msg=success"; ?>";
                <?php }?>
                }else if(result == 'wrongcaptcha') {
                $("#registerForm_captcha_errorloc").html("<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");
                }else if(result == 'securitybleach') {
                $("#reg_error_msg").show().html("<?php echo $this->lang->line('text_securitybleach'); ?>");
                setInterval(function(){ location.reload(); }, 3000);
                }
                else if(result == 'false')
                {
                $('#registerForm').animate({ scrollTop: 0 }, 'slow');
                $("#reg_error_msg").show().html("<?php echo $this->lang->line('text_pleaseTryAgain'); ?>");
                }
                else{
                $('#NameofCompany').focus();
                $('html,body').animate({ scrollTop: $("#registerForm").offset().top}, 1000);
                $("#reg_error_msg").show().html(result);
                }
          $(".all_error").html("");
        }
      }
      );
      }
      else
      {
        $("#userTypeError").html("<?php echo $this->lang->line('selectUserType'); ?>");
      }
      }

      function forgot_password() {
        //  alert('aa');
        if ($('#forg_username1').val() == '') {
          $('#ForgotPasswordForm_username_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_pleaseEnterUserName'); ?>");
        } else {
          $('#ForgotPasswordForm_username_errorloc').text('');
        }

          if ($("#cbx21:checked").length > 0) {
          $("#forgotForm_checkbox_errorloc").html("");

        }
        else {
          $('#forgotForm_checkbox_errorloc').css('visibility', 'visible').html("<?php echo $this->lang->line('text_login_check'); ?>");
          return;
        }
        


        var data_to_send = $('#ForgotPasswordForm').serialize();
       // alert(data_to_send);
        $.ajax({
          url: "<?php echo base_url(); ?>instimatch/forgot_password",
          data: data_to_send,
          type: "post",
          cache: false,
          success: function(result) {
           //  alert(result);
            // return false;


            if (result == 'false') {

            $("#error_msg1").html("<?php echo $this->lang->line('text_wrong_username'); ?>");

            }else if(result == 'true') {
            $('#forgot_submit').attr("disabled", "disabled");
            $("#error_msg1").css("color","green");

            $("#error_msg1").html("<?php echo $this->lang->line('text_pleaseCheckYourEmailForNewPassword'); ?>");
            }
          }
        }
              );
      }
    </script>
    <script>
      // When the user clicks on div, open the popup
      function myFunction() {
        $("#myPopup").hide();
        $("span#myPopup1").hide();
        $("#myPopup").show();
        $("#popup").attr("onclick", "myFunction2()");
        $("#popup1").attr("onclick", "myFunction1()");
      }
      function myFunction2() {
        $("#popup").attr("onclick", "myFunction()");
        $("#popup1").attr("onclick", "myFunction1()");
        $("#myPopup").hide();
        $("span#myPopup1").hide();
        $("#myPopup").hide();
      }
    </script>
    <br>
    <script>
      // When the user clicks on div, open the popup
      function myFunction1() {
        $("span#myPopup1").hide();
        $("#myPopup").hide();
        $("#myPopup1").show();
        $("#popup1").attr("onclick", "myFunction3()");
      }
      function myFunction3() {
        $("#popup1").attr("onclick", "myFunction1()");
        $("#myPopup").hide();
        $("span#myPopup1").hide();
        $("#myPopup").hide();
      }
    </script>

<!--<script src="<?php //echo base_url() . "assets/"; ?>js/common.js">
    </script>-->
 <?php //include 'assets/js/kontakteuserjs.php';?>
</body>

</html>