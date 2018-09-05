<?php

// print_r($lendersBank);
//  exit();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; charset=iso-8859-1">
    <!--<meta charset="UTF-8">-->
   <title>FORSA Geld- und Kapitalmarkt GmbH</title>
    <!-- Bootstrap Core CSS -->
    <script src="<?php echo base_url(); ?>assets/js/jspdf.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jspdf.plugin.autotable.js"></script>
       
    <link href="<?php echo base_url() . "assets/"; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/"; ?>css/login_style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() . "assets/"; ?>css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() . "assets/"; ?>css/custom.css" rel="stylesheet" type="text/css"/>
	 <link href="<?php echo base_url() . "assets/"; ?>/css/dashboard.css" rel="stylesheet" type="text/css"/>
	<link href="http://www.forsa-gmbh.de/templates/forsa_portfolio_neu_ga_3/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <!-- jQuery -->
    
    <script src="<?php echo base_url() . "assets/"; ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . "assets/"; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() . "assets/"; ?>js/gen_validatorv4.js">
    </script>
    <style>
      select#category option:nth-child(11){
        display:none}

       
    </style>
    <style>
      .table-rows table thead th {
	border: 1px solid #ccc;
	text-align: center;
	padding: 9px 10px;
	background-color: #23527c;
	color: #fff;
}
.activebutton{
  background-color:green !important;
}
    </style>
  </head>
  <body>
    <!-- Navigation -->
    <?php include 'assets/js/lenderModals.php';?>
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="container-fluid">
        <div class="collapse lang-navbar-collapse" >
          <ul class="nav navbar-nav lang-navbar-right nav-language">
            <li>
              <a class="<?php echo ($_SESSION['language'] == 'german') ? 'selected' : ''; ?>" href="javascript:changeLanguage('german');">DE
              </a>
            </li>
            <li>
              <a class="<?php echo ($_SESSION['language'] == 'english') ? 'selected' : ''; ?>" href="javascript:changeLanguage('english');">EN
              </a>
            </li>
          </ul>
        </div>
        <!--/.navbar-collapse-->
      </div>
      <!--/.container-->
    </nav>
    <!--choose register type-->
    <div id="chooseRegisterType" class="modal fade in" role="dialog" style="display:none;margin-top:138px;">
      <div class=" col-lg-6 col-md-8 col-centered ab">
        <!-- Modal content-->
        <div class="row">
          <div class="modal-content bg-bluex">
            <div class="modal-header">
              <!-- <button type="button" class="close text-white" data-dismiss="modal" onclick="hideRegisterType()">&times;</button>-->
              <div class="col-md-12 col-xs-12">
                <img class="logox img img-responsive" src="<?php echo base_url() . "assets/"; ?>img/logo.png" alt=""/>
                <div class="modal-body">
                  <div class="form-group col-md-12 col-xs-12 top-buffer">
                    <button class="btn btn-default buttonx" type="button" data-toggle="modal"  onclick="selectRegisterType(1)" id="bankButton" style="width:100%;"> Bank
                    </button>
                  </div>
                  <div class="form-group col-md-12 col-xs-12 top-buffer">
                    <button class="btn btn-default buttonx" type="button" data-toggle="modal"  onclick="selectRegisterType(2)" id="nonbankButton" style="width:100%;">Non Bank
                    </button>
                  </div>
                  <a href="<?php echo base_url(); ?>" class=" forgotPassswordBackBtn bck-to-login  white2 btn-small bluebtn" data-toggle="modal">
                    Back to LOGIN
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->

    
    <div id="interest_table" class="table-rows col-lg-12" style="width:100%;margin-top:15px; display: none;">
    
    <div style="margin-top:0px;" class="row">
          <a href="<?php echo base_url() . "?customerid=" . base64_encode($customerid) . "&viewlogout=Y"; ?>" class="view_user_logout">Logout</a>
        </div>
        
    <div id="buttondiv" class="col-lg-12" >
    <button  class="btn btn-info btn-lg" id="view_all_price" style="">INDUVIDUELLE BANKENLISTE</button> 

          <input type="button" class="btn btn-info btn-lg" value="<?php echo $this->lang->line('best_price_button'); ?>" id="best_price_view" style="">
         <button  class="btn btn-info btn-lg" id="all_banks_price" style="">ALL BANKS</button>
         <button class="btn btn-info btn-lg"  id="Ansehen1">eigene Fälligkeitsliste</button>
         <button  class="btn btn-info btn-lg"  id="Ansehenund1">Vergangenheit getätigter Geschäfte</button>

         <div class="dropdown" style="">
  <button class="dropbtn">COCKPIT</button>
  <div class="dropdown-content header-drop">
   
     <button type="button" class="dropcockpit" id="eigene">Eigene Stammdatenverwaltung</button><br>
     <button type="button" class="dropcockpit" id="settings_start_page">Einstellen Startseite</button><br>
    <button type="button" class="dropcockpit" id="Ansehen">Ansehen und downloaden eigene Fälligkeitsliste</button><br>
    <button type="button" class="dropcockpit" id="Ansehenund">Ansehen und downloaden in der Vergangenheit getätigter Geschäfte</button><br>
    <button type="button" class="dropcockpit" id="ort">Ort wo eigenes Stammblatt hochgeladen wird</button><br>
   
  </div>
</div>  


    </div>

    <input type="button" id="EINSTELLUNGEN" value="EINSTELLUNGEN" class="btn btn-info btn-lg">
    <div id="companies">
   <button  class="btn btn-info btn-lg" id="BANKENAUSWAHL" style="display:none;">BANKENAUSWAHL</button>
   <div id="company_name" class="table-rows col-lg-12" style="display:none;">
      <table class="" id="">
         <thead>
            <tr>
               <th>Bank</th>
            </tr>
         </thead>
         <tbody class="company-name-data">
            <?php
            // print_r($lendersBank);
            // exit();
               $offborrower = explode(',', $offBorrowers);
               foreach ($lendersBank as $lenders) {
                $userId[] = $lenders['userId'];
               }
               $onBorrowers = explode(',', $onborrowers);
               if (!empty($onBorrowers) && !empty($userId)) {
                $allactiveBorrowers = array_merge($userId, $onBorrowers);
                $alluniqueactiveBorrowers = array_unique($allactiveBorrowers);
               } else {
                $alluniqueactiveBorrowers = array();
               }

               foreach ($allBanks as $bank) {
                ?>
            <tr class="" data-value="">
               <td><label class="container-box"><?php echo $bank['company_name']; ?>
                  <input type="checkbox" class="lendercheck" data-value="<?php echo $bank['userId']; ?>"  data-id="<?php echo $bank['userId']; ?>" name="<?php echo $bank['company_name']; ?>"  <?php if (!in_array($bank['userId'], $offborrower) && in_array($bank['userId'], $alluniqueactiveBorrowers)) {echo "checked=checked";}?>>
                  <span class="checkmark" ></span>
                  </label>
               </td>
            </tr>
            <?php }?>
         </tbody>
      </table>
   </div>
   </div>
   
    <div class="container-fluid" id="best_price_view1"  style="display:none;">
<div style="margin-top: 15px;" class="row">
<div class="" id="">
<div id="BanksInterest" class="" style="width:100%;margin-top:15px;" >
<div class="col-lg-4 " id="interestheading">

      <div class="col-md-8 margin-padd-remove">
      <div class="interest" data-value="TN" ><?php echo $this->lang->line('TN'); ?> </div>
      <div class="interest" data-value="1week"><?php echo $this->lang->line('1week'); ?></div>
      <div class="interest" data-value="2weeks"><?php echo $this->lang->line('2week'); ?></div>
      <div class="interest" data-value="3weeks"><?php echo $this->lang->line('3week'); ?></div>
      <div class="interest" data-value="1month"><?php echo $this->lang->line('1month'); ?></div>
      <div class="interest" data-value="2month"><?php echo $this->lang->line('2month'); ?></div>
      <div class="interest" data-value="3month"><?php echo $this->lang->line('3month'); ?></div>
      <div class="interest" data-value="4month"><?php echo $this->lang->line('4month'); ?></div>
      <div class="interest" data-value="5month"><?php echo $this->lang->line('5month'); ?></div>
      <div class="interest" data-value="6month"><?php echo $this->lang->line('6month'); ?></div>
      <div class="interest" data-value="7month"><?php echo $this->lang->line('7month'); ?></div>
      <div class="interest" data-value="8month"><?php echo $this->lang->line('8month'); ?></div>
      <div class="interest" data-value="9month"><?php echo $this->lang->line('9month'); ?></div>
      <div class="interest" data-value="10month"><?php echo $this->lang->line('10month'); ?></div>
      <div class="interest" data-value="11month"><?php echo $this->lang->line('11month'); ?></div>
      <div class="interest" data-value="12month"><?php echo $this->lang->line('12month'); ?></div>
      <div class="interest" data-value="2year"><?php echo $this->lang->line('2year'); ?></div>
      <div class="interest" data-value="3year"><?php echo $this->lang->line('3year'); ?></div>
      <div class="interest" data-value="4year"><?php echo $this->lang->line('4year'); ?></div>
      <div class="interest" data-value="5year"><?php echo $this->lang->line('5year'); ?></div>
      </div>
      <div class="col-md-4 margin-padd-remove" id="interestdata"></div>
 </div>
      <div style="margin-top:0px;" class="col-lg-8 " id="lenderslatestBanks"></div>
</div>
</div>
</div>
</div>
<div id="all_interest_table" class="table-rows col-lg-12" style="display:none;">
      <table class="mytables" id="all_banks_interest">
      </table>
   </div>
   <div id="maturity_table" class="table-rows col-lg-12" style="display:none">
      <input type="button" id="export_pdf" value="Export PDF" class="btn btn-info btn-lg">
      <input type="button" id="export_excel" value="Export Excel" class="btn btn-info btn-lg">
      <table id="maturityTableData" class="mytables" >
      </table>
   </div>
   <div id="history_maturity_table" class="table-rows col-lg-12" style="display:none">
      <input type="button" id="historyexport_pdf" value="Export PDF" class="btn btn-info btn-lg">
      <input type="button" id="historyexport_excel" value="Export Excel" class="btn btn-info btn-lg">
      <table id="historymaturityTableData" class="mytables" >
      </table>
   </div>
    <table class="mytables brrow-tabs" id="bank_Interest"></table>
        <div style="margin-top:15px;" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
          <a href="<?php echo base_url() . "?customersid=" . base64_encode($customerid) . "&shows=Y"; ?>" class="become-trading"><?php echo $this->lang->line('become_trading_client'); ?></a>
        </div>
        </div>
    <div id="registerForm-" class="modal fade in" role="dialog" style="display:none;overflow-y:scroll;">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content bg-blue">
          <form id="registerForm" class="form-inline" action="javascript:add_user();" method="post" role="form">
            <input type="hidden" name="token" value="<?=$this->config->item('csrf_token');?>">
            <div class="modal-header modal-header-info">
              <button type="button" class="close closex text-white" data-dismiss="modal" onclick="hideRegisterForm()" style="color:#fff;">&times;
              </button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('text_register'); ?>
                <span class="">(
                  <i class="text-danger">*
                  </i>
                  <?php echo $this->lang->line('text_fieldAreMandatory'); ?>)
                </span>
              </h4>
            </div>
            <div class="modal-body bg-blue">
              <div class="alert alert-danger error_msg col-md-12" id="reg_error_msg" style="display: none;"></div>
              <input type="hidden" id="sendEmail" name="sendEmail" value="<?php if (isset($regist)) {echo "N";} else {echo "Y";}?>">
              <input type="hidden" name="customerId" value="<?php if (isset($regist)) {echo $customerid;} else {echo "Y";}?>">
              <!-- <input type="hidden" name="client_sub_group" value="<?php //if (isset(c['category'])) {echo $customerDetails['category'];}?>"> -->
              <!-- <input type="hidden" name="lenderclient_group" value="<?php //if (isset($customerDetails['client_group'])) {echo $customerDetails['client_group'];}?>"> -->
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('NameofCompany'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login" name="NameofCompany" id="NameofCompany" value="<?php if (isset($customerDetails['Name_company'])) {echo $customerDetails['Name_company'];}?>"  autocomplete="off" >
                <div style="width:100%;float:left;">
                  <span id='registerForm_NameofCompany_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('street'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login" name="userStreet" id="userStreet" autocomplete="off" value="<?php if (isset($customerDetails['address'])) {echo $customerDetails['address'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_userStreet_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('ZIP'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="userZIP" id="userZIP" autocomplete="off" value="<?php if (isset($customerDetails['Postcode'])) {echo $customerDetails['Postcode'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_userZIP_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('city'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="userCity" id="userCity" autocomplete="off" value="<?php if (isset($customerDetails['place'])) {echo $customerDetails['place'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_userCity_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('ownerofaccount'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="owner_account" id="owner_account" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_owner_account_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('bank'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="bank" id="bank" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_bank_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('iban'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="iban" id="iban" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_iban_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('biccode'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="biccode" id="biccode" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_biccode_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('sparesection1'); ?>
                  <i class="text-danger"> *</i>
                </label>
                <br/>
                
              <select class="form-control input-register input-login" id="sparesection1" name="sparesection1">
              <option value="Bank" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Bank"){echo "selected";}?>>Bank</option>
              <option value="Unternehmen GmbH" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunale Unternehmen (GmbH)"){echo "selected";}?>>Kommunale Unternehmen (GmbH)</option>
              <option value="Unternehmen AöR KdöR" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunale Unternehmen (KdöR - AöR)"){echo "selected";}?>>Kommunale Unternehmen (KdöR - AöR)</option>   
              <option value="Kommunen" <?php if (isset($customerDetails['client_group']) && $customerDetails['client_group'] == "Kommunen"){echo "selected";}?>>Kommunen</option>
              </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_sparesection1_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('sparesection2'); ?>
                  <i class="text-danger"> *</i>
                </label>
                <br/>
                
                <select class="form-control input-register input-login" id="sparesection2" name="sparesection2">
                <?php foreach($subClientgroups as $group){ ?>
                  <option value="<?php echo $group['category'];?>" <?php if (isset($customerDetails['category']) && $customerDetails['category'] ==  $group['category']){echo "selected";}?>><?php echo $group['category'];?></option>
                 <?php }?>
              </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_sparesection2_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('sparesection3'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="sparesection3" id="sparesection3" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer">
                <label class="control-label">
                  <?php echo $this->lang->line('sparesection4'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="sparesection4" id="sparesection1" autocomplete="off">
                <div style="width:100%;float:left;">
                  <span id='registerForm_sparesection4_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <hr style="color:black;">
              <div class="clearfix">
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('Prefex'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <select class="form-control input-register input-login" id="Prefex" name="Prefex">
                  <option value="">
                  </option>
                  <option value="<?php echo $this->lang->line('Mr.'); ?>" <?php if (isset($customerDetails['salutation']) && $customerDetails['salutation'] == "Herr") {echo "selected";}?>>
                    <?php echo $this->lang->line('Mr.'); ?>
                  </option>
                  <option value="<?php echo $this->lang->line('Mrs.'); ?>" <?php if (isset($customerDetails['salutation']) && $customerDetails['salutation'] == "Frau") {echo "selected";}?>>
                    <?php echo $this->lang->line('Mrs.'); ?>
                  </option>
                </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('Title'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="Title" id="Title" autocomplete="off" value="<?php if (isset($customerDetails['title'])) {echo $customerDetails['title'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_Title_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('FirstName'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="fname" id="fname" autocomplete="off" value="<?php if (isset($customerDetails['first_name'])) {echo $customerDetails['first_name'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_fname_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>



              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('LastName'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="lname" id="lname" style="padding: 0px 13px !important;" autocomplete="off" value="<?php if (isset($customerDetails['Surname'])) {echo $customerDetails['Surname'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_lname_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('ContactNumber'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="contactnumber" id="contactnumber" style="padding: 0px 13px !important;" autocomplete="off" value="<?php if (isset($customerDetails['contactnumber'])) {echo $customerDetails['contactnumber'];}?>">
                <div style="width:100%;float:left;">
                  <span id='registerForm_contactnumber_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>

              <div class="clearfix">
              </div>
              <div class="clearfix">
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('email'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="email" id="email" onkeyup="checkEmail_status()" autocomplete="off" value="<?php if (isset($customerDetails['email'])) {echo $customerDetails['email'];}?>"/>
                <div style="width:100%;">
                  <span class="email_error text-danger" id="email_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_email_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>

              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('userid'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="userid" id="userid"  autocomplete="off" onblur="checkusername(this.value);"/>
                <div style="width:100%;">
                  <span class="email_error text-danger" id="userid_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_userid_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div style="width:100%">
              <span id='checkusernameError' class="error_strings text-danger"></span>
              </div>

              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('usersparesection1'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="usersparesection1" id="usersparesection1"  autocomplete="off"/>
                <div style="width:100%;">
                  <span class="sparesection1_error text-danger" id="sparesection1_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_user_sparesection1_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('usersparesection2'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="usersparesection2" id="usersparesection1"  autocomplete="off"/>
                <div style="width:100%;">
                  <span class="sparesection2_error text-danger" id="sparesection2_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_user_sparesection2_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('sparesection3'); ?>
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="usersparesection3" id="usersparesection3"  autocomplete="off"/>
                <div style="width:100%;">
                  <span class="usersparesection3_error text-danger" id="sparesection3_error">
                  </span>
                </div>
                <div style="width:100%;">
                  <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
              <div class="clearfix">
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <div class="col-md-6" >
                  <label class="control-label">
                    <?php echo $this->lang->line('promissoryNote'); ?>
                  </label>
                  <br/>
                  <input type="checkbox" id="borrowercheck" class="checkBoxUserType" name="UserType[]" value="borrower" />&nbsp;
                  <?php echo $this->lang->line('userBorrower'); ?> &nbsp;&nbsp;

                  <input type="checkbox" class="checkBoxUserType" name="UserType[]" value="lender" />&nbsp;
                  <?php echo $this->lang->line('userLender'); ?> &nbsp;&nbsp;
                  <div style="width:100%;"><span id='userTypeError' class="error_strings text-danger"></span></div>
                </div>
              </div>

              <div style="display: none;" id="testing">
                <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('Ratinga1'); ?>
                </label>
                <br/>
                <select class="form-control input-register input-login" id="Ratinga1" name="Ratinga1">
                  <option value=""></option>
                  <option value="Moody’s">Moody’s</option>
                  <option value="S&P">S&P</option>
                  <option value="Fitch">Fitch</option>
                  <option value="ICV">ICV</option>
                  <option value="Creditreform">Creditreform</option>
                  <option value="EulerHermes">EulerHermes</option>
                </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


                <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="ratesRatinga1" id="ratesRatinga1"  autocomplete="off"/>
                <div style="width:100%;">
                <span class="ratesRatinga1_error text-danger" id="ratesRatinga1_error">
                </span>
                </div>
                <div style="width:100%;">
                <span id='registerForm_sparesection3_errorloc' class="error_strings text-danger">
                </span>
                </div>
                </div>


                <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('Ratinga2'); ?>
                </label>
                <br/>
                <select class="form-control input-register input-login" id="Ratinga2" name="Ratinga2">
                  <option value="">
                  </option>
                  <option value="Moody’s">Moody’s</option>
                  <option value="S&P">S&P</option>
                  <option value="Fitch">Fitch</option>
                  <option value="ICV">ICV</option>
                  <option value="Creditreform">Creditreform</option>
                  <option value="EulerHermes">EulerHermes</option>
                </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_Prefex_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                </label>
                <br/>
                <input type="text" class="form-control input-register input-login"  name="ratesRatinga2" id="ratesRatinga2"  autocomplete="off"/>
                <div style="width:100%;">
                <span class="ratesRatinga2_error text-danger" id="ratesRatinga2_error">
                </span>
                </div>
                <div style="width:100%;">
                <span id='registerForm_ratesRatinga2_errorloc' class="error_strings text-danger">
                </span>
                </div>
                </div>


                <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <label class="control-label">
                  <?php echo $this->lang->line('Einlag'); ?>
                  <i class="text-danger"> *
                  </i>
                </label>
                <br/>
                <select class="form-control input-register input-login" id="Einlagen" name="Einlagen">
                  <option value="">
                  </option>
                  <option value="Einlagensicherung der privaten Banken">Einlagensicherung der privaten Banken</option>
                  <option value="Genossenschaftliche Einlagensicherung">Genossenschaftliche Einlagensicherung</option>
                  <option value="Sicherung DGSV">Sicherung DGSV</option>
                  <option value="Öffentliche Banken">Öffentliche Banken</option>
                  <option value="Sonstige Einlagensicherung">Sonstige Einlagensicherung</option>
                  <option value="Keine Einlagensicherung">Keine Einlagensicherung</option>
                </select>
                <div style="width:100%;float:left;">
                  <span id='registerForm_Einlagen_errorloc' class="error_strings text-danger">
                  </span>
                </div>
              </div>
                  <div class="form-group col-md-12 col-xs-12 top-buffer ">
                  <div class="col-md-12" >
                  <label class="control-label">
                    <!-- Preise  werden  gezeigt Für Kundengruppe -->
                    <?php echo $this->lang->line('Preise'); ?>
                    <i class="text-danger"> *
                  </i>
                  </label>
                  <br/>
                  <input type="checkbox" class="" name="accessclientgroup[]" value="Kommunen" />&nbsp;
                   <?php echo $this->lang->line('Kommunen'); ?> &nbsp;&nbsp;
                  <input type="checkbox" class="" name="accessclientgroup[]" value="Unternehmen GmbH" />&nbsp;
                   <?php echo $this->lang->line('Unternehmen'); ?>&nbsp;&nbsp;
                   <input type="checkbox" class="" name="accessclientgroup[]" value="Unternehmen AöR KdöR" />&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('AoR'); ?>
                  <div style="width:100%;"><span id='clientgroupError' class="error_strings text-danger"></span></div>
                </div>
              </div>

              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <input type="checkbox" name="PrivacyPolicy" value="Y" id="PrivacyPolicy">
                <a target="_blank" href="#">
                  <?php echo $this->lang->line('stimme'); ?>
                </a>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <input type="checkbox" name="ratings" value="Y" id="ratings">
                <a target="_blank" href="#">
                  <?php echo $this->lang->line('dass'); ?>
                </a>
              </div>
              <div class="form-group col-md-12 col-xs-12 top-buffer ">
                <input type="checkbox" name="information" value="Y" id="information">
                <a target="_blank" href="#">
                  <?php echo $this->lang->line('unserem'); ?>
                </a>
              </div>
              </div>


              <div class="form-group col-md-12 col-xs-12 top-buffer ">
              <div style="padding: 0px !important;" class="col-md-6">
                  <div class="form-group  top-buffer register-captcha ">
                    <label class=" form-control input-lg input-login text-center" style=" width: 30% !important; font-size: 30px !important; padding: 2px; float:left;">
                      <?php echo $captcha; ?>
                    </label>
                    <input type="text" class="form-control input-lg input-login " style="width: 70% !important; font-size:16px !important; padding:6px !important;" placeholder="<?php echo $this->lang->line('captchaText'); ?>" name="captcha" id="captcha">
                    <span class="error_strings text-danger" id="registerForm_captcha_errorloc" style="margin-left: 0px; width: 250px !important;">
                    </span>
                  </div>
                </div></div>
              <div class="clearfix">
              </div>
              <div class="form-group col-md-6 col-xs-12 top-buffer ">
              </div>
              <div class="clearfix">
              </div>
              <div class="form-group col-md-6 col-xs-12 top-buffer ">
                <input type="checkbox" name="chkterms" value="Y" id="chkterms">
                <a target="_blank" href="#">
                  <?php echo $this->lang->line('text_termcondition'); ?>
                </a>
              </div>
              <div class="col-md-12">
                <div style="width:100%;float:left;display:none;" id="all_error">
                  <span class="all_error text-danger"  >
                    <?php echo $this->lang->line('text_pleaseCheckdata'); ?>
                  </span>
                </div>
              </div>
              <div class="clearfix">
              </div>
            </div>
            <div class="modal-footer bg-blue">
              <button type="submit" class="btn btn-default btnA" id="btncheck">
                <?php echo $this->lang->line('text_register_submit'); ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row top-buffer">
        <div class="col-lg-6 col-md-8 col-centered login-form">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <img class="logox img img-responsive" src="<?php echo base_url() . "assets/"; ?>img/logo.png" alt=""/>
            </div>
          </div>
          <div class="row">
            <div class="alert alert-success col-md-12 "
                 <?php echo (isset($success)) ? '' : 'style="display: none;"'; ?>>
            <?php if (isset($success)) {echo $success;unset($success);}?>
          </div>
          <?php
if ($_SESSION['language'] == 'german') {
  echo "<style>
#annonymous_status {
padding: 1px 80px !important;
}
#category {
//background: #404040 none repeat scroll 0 0 !important;
color: #fff !important;
padding: 6px 42px;
}
#lname {
padding: 10px 23px !important;
}
#user_type {
padding: 0 51px !important;
}</style>";
}
if ($_SESSION['language'] == 'france') {
  echo "<style>
#annonymous_status {
width:80% !important;
}
#user_type {
padding: 0 67px !important;
}
</style>";
}
?>
          <div class="alert alert-danger error_msg col-md-12 loginErrorContainer" id="" style="display: none;">
          </div>
          
          <form id="loginForm" class="form-inline" action="<?php if (!isset($alread)) {echo "javascript:check_user();";} else {echo "javascript:loginforregister();";}?>" method="post" role="form">
    <input type="hidden" name="token" value="<?=$this->config->item('csrf_token');?>">
    <div class="form-group col-md-12 col-xs-12 col-sm-12 ">
        <input id="username" name="username" type="text" placeholder="<?php echo $this->lang->line('text_usernameEmail'); ?>" value="<?php if (isset($customerDetails['email'])) {echo $customerDetails['email'];}?>" class="form-control input-lg input-login" autocomplete="off">
        <span style="margin-left: 54px;" id='loginForm_username_errorloc' class="error_strings text-danger"></span>
    </div>
    <div class="form-group col-md-12 col-xs-12 col-sm-12  ">
        <input id="password" name="password" type="password" placeholder="<?php echo $this->lang->line('text_password'); ?>" class="form-control input-lg input-login ">
        <span style="margin-left: 54px;" id='loginForm_password_errorloc' class="error_strings text-danger"></span>
    </div>
    <div class="form-group  col-md-12 col-xs-12 col-sm-12  input-with-captcha ">
        <div class="input-with-captcha-div " >
            <label class=" form-control input-with-captcha-label input-lg input-login text-center" >
                <?php echo $captcha; ?>
            </label>
            <input id="login_captcha" name="captcha" type="text" placeholder="<?php echo $this->lang->line('text_captchPlaceHolder'); ?>" style="width: 70% !important; float:left;" class="form-control input-lg input-login  " >
            <span  id='loginForm_captcha_errorloc' class="error_strings text-danger"></span>
        </div>
    </div>
    <div class="form-group col-md-12 col-xs-12 col-sm-12 top-buffer " id="form-captcha-error" style="display: none;">
    </div>
    <div class="col-md-12 col-xs-12 top-buffer text-center">
            <button class="txt-up btn btn-default btnA btnA-login " type="submit"><?php echo $this->lang->line('text_login'); ?> </button>
    </div>
    <div class="col-md-12 col-xs-12 top-buffer">
        <div class="row">
        <script type="text/javascript">
        $(document).ready(function () { console.log('');});
        function chooseType1()
        {
        $("#chooseRegisterType").hide();
        $('#nonbankButton').trigger('click');
        $(".login-form").hide();
        }
        </script>
<div class="col-md-12 top-buffer">
    <p class="dnt-hv" > <?php echo $this->lang->line('donthaveaccount'); ?>  <a onclick="chooseType1();" data-toggle="modal" class="crt-acount" href="#"><?php echo $this->lang->line('createAccount'); ?></a> <br> <a class="forgt-acount" href="#" onclick="javascript:$('#loginForm').hide();$('#ForgotPasswordForm').show();"><?php echo $this->lang->line('ForgotPassword'); ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
            <form method="post"  action="javascript:forgot_password();" name="ForgotPasswordForm" id="ForgotPasswordForm" role="form" style="display:none;">
                        <input type="hidden" name="token" value="<?=$this->config->item('csrf_token');?>">
              <div id="step-1" class="">
                    <div class="col-md-12 col-xs-12 text-success">
                      <?php
if (isset($success)) {
  echo $success;
}
?>
                    </div>
                    <div  class="form-group col-md-12 col-xs-12 col-sm-12 ">
                      <div class="error_msg1" id="error_msg1" style="color:red;"></div>
                      <br>
<label class="control-label ctrol-lbl"><?php echo $this->lang->line('text_forgotPassword'); ?></label>

<input type="hidden" name="foronboard" id="foronboard" value="<?php if (isset($passreset)) {echo "Y";} else {
  echo "N";
}?>">
<input type="text" class="form-control input-lg input-login" placeholder="<?php echo $this->lang->line('text_userName'); ?>" value="<?php if (isset($customerDetails['email'])) {echo $customerDetails['email'];}?>" name="username" id="forg_username">
<span id='ForgotPasswordForm_username_errorloc' class="error_strings text-danger" ></span></div>
<div  class="form-group col-md-12 col-xs-12 col-sm-12 ">
<div class="input-with-captcha-div ">
<label  class=" forgot-pas-label form-control input-lg input-login text-center" >
    <?php echo $captcha; ?>
</label>
<input id="forgot_captcha" name="captcha" type="text" placeholder="<?php echo $this->lang->line('text_captchPlaceHolder'); ?>"  class="form-control input-lg input-login " >
<span style="width: 250px !important;" id='ForgotPasswordForm_captcha_errorloc' class="error_strings text-danger"></span>
</div>
</div>
<div class="col-md-12 col-xs-12 top-buffer text-center">
<button type="submit" id="forgot_submit" class="txt-up btn btn-default btnA btnA-login " onclick ="checkTerms()"><?php echo $this->lang->line('text_go'); ?></button>
</div>
<div class="col-md-12 top-buffer">
<a href="<?php echo base_url(); ?>" class=" forgotPassswordBackBtn bck-to-login  white2 btn-small bluebtn" data-toggle="modal" >
  <?php echo $this->lang->line('text_back'); ?></a>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
    </div>
	<div class="row" id="messageDiv" style="display: none;">
<div class="col-lg-6 col-md-8 col-centered login-form">
<div id="MessageForm">
 <img class="logox img img-responsive" src="http://instimatch.com/forsa/applications/assets/img/logo.png" alt="">
  <div class="form-group">
<P>Vielen Dank für die Anmeldung auf der FORSA-Plattform.</P>
<P>Bitte prüfen Sie Ihre E-Mail mit den login daten – Einloggen und Sie sind
driekt verbunden mit dem Markt!</P>
<P> Ihr FORSA-Team.</P>
<div class="">
<button style=" background-color:#054b8a; border:2px solid #054b8a;border-radius: 0px;width: 45%; color:#fff;" type="button" class=" btn btn-default">Ok</button>
        <button style=" background-color:#054b8a; border:2px solid #054b8a;border-radius: 0px;width: 45%; color:#fff;" type="button" class="pull-right btn btn-default">Close</button>
      </div>
</div>
</div>
</div>
      </div>
    <input id="base_url" type="hidden" value="<?php echo base_url(); ?>" />
    <script src="<?php echo base_url() . "assets/"; ?>js/common.js">
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
      var registerFormValidator = new Validator("registerForm");
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
      registerFormValidator.addValidation("fname", "req", "<?php echo $this->lang->line('text_pleaseEnterFirstName'); ?>");
      registerFormValidator.addValidation("lname", "req", "<?php echo $this->lang->line('text_pleaseEnterLastName'); ?>");
      registerFormValidator.addValidation("Prefex", "req", "<?php echo $this->lang->line('text_pleaseEnterPrefex'); ?>");
      registerFormValidator.addValidation("captcha", "req", "<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");
      registerFormValidator.addValidation("email", "req", "<?php echo $this->lang->line('text_pleaseEnteremail'); ?>");
      registerFormValidator.addValidation("userid", "req", "<?php echo $this->lang->line('text_pleaseuserid'); ?>");
      registerFormValidator.addValidation("contactnumber", "req", "<?php echo $this->lang->line('text_contactNumber'); ?>");
      registerFormValidator.addValidation("sparesection1", "req", "<?php echo $this->lang->line('text_sparesection1'); ?>");
      registerFormValidator.addValidation("sparesection2", "req", "<?php echo $this->lang->line('text_sparesection2'); ?>");

      var frmvalidator = new Validator("loginForm");
      frmvalidator.EnableOnPageErrorDisplay();
      frmvalidator.EnableMsgsTogether();
      frmvalidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserNameEmail'); ?>");
      frmvalidator.addValidation("password", "req", "<?php echo $this->lang->line('text_pleaseEnterPassword'); ?>");
      frmvalidator.addValidation("captcha", "req", "<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");
      var forgotPasswordFormValidator = new Validator("ForgotPasswordForm");
      forgotPasswordFormValidator.EnableOnPageErrorDisplay();
      forgotPasswordFormValidator.EnableMsgsTogether();
      forgotPasswordFormValidator.addValidation("username", "req", "<?php echo $this->lang->line('text_pleaseEnterUserNameEmail'); ?>");

      function check_user() {
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
          url: "<?php echo base_url(); ?>instimatch/login",
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
      function add_user(){

        if ($(".checkBoxUserType:checked").length>0)
        {
          $("#userTypeError").html("").hide();
          var uname_error = $(".uname_error").text();
          var email_error = $(".email_error").text();


            var data_to_send = $('#registerForm').serialize();
            // alert(data_to_send);
            // return false;

            $.ajax({
              url:"<?php echo base_url() . "register/new_user"; ?>",
              data:data_to_send,
              type:"post",
              cache:false,
              success:function(result){
                // alert(result);
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
        var data_to_send = $('#ForgotPasswordForm').serialize();
        $.ajax({
          url: "<?php echo base_url(); ?>instimatch/forgot_password",
          data: data_to_send,
          type: "post",
          cache: false,
          success: function(result) {
            // alert(result);
            // return false;


            if (result == 'false') {

            $("#error_msg1").html("wrong username");

            }else if(result == 'wrongcaptcha') {
            $("#error_msg1").html("<?php echo $this->lang->line('text_pleaseEnterCorrectCaptcha'); ?>");

            }else if(result == 'securitybleach') {

            $(".loginErrorContainer").show().html("<?php echo $this->lang->line('text_securitybleach'); ?>");
            setInterval(function(){ location.reload(); }, 3000);

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
    <?php include 'assets/js/kontakteuserjs.php';?>
  </body>
</html>
