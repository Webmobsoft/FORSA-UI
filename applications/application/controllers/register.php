<?php
if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

//Registration Controller
class register extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    @session_start();
    $this->load->helper('url');
    if (!isset($_SESSION['language'])) {
      $_SESSION['language'] = defaultLanguage;
    }
    $this->load->model("m_register");
    $this->load->model("mlogin");
    $this->lang->load('borrowerHome', $_SESSION['language']);
    $this->lang->load('form_validation', $_SESSION['language']);
  }

  public function index()
  {
    $this->load->model("m_register");
    $result = $this->m_register->get_user_detail();
    $result_data = '<!--update profile Start -->
    <!-- Modal -->
    <style>.hide {display:none;}</style>
    <input type="hidden" name="user_type_show" id="user_type_show" value="' . $result[0]['user_type'] . '">
    <div class="col-md-12 update_detail_success alert alert-success" style="display: none"></div>
    <div class="col-md-12 update_detail_error text-danger"></div>
        <div class="col-md-12 col-xs-12 fail text-danger"></div>
    <div class="error_msg" id="error_msg text-danger"></div>
    <form method="post"  action="javascript:update_user_detail();" name="UpdateregisterForm" id="UpdateregisterForm" role="form">
    <div class="h3 c-light-blue">' . $this->lang->line('text_editDetails') . '</div>
    <hr>           <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="form-group col-md-6">
    <label class="control-label">' . $this->lang->line('text_firstName') . '</label>
    <input id="fname" type="text" value="' . $result[0]['fname'] . '" name="fname" class="form-control" readonly>
    <span id="UpdateregisterForm_fname_errorloc" class="error_strings text-danger"></span>
    </div>
    <div class="form-group col-md-6">
    <label class="control-label">' . $this->lang->line('text_LastName') . '</label>
    <input id="lname" type="text" value="' . $result[0]['lname'] . '" name="lname" class="form-control" readonly>
    <span id="UpdateregisterForm_lname_errorloc" class="error_strings text-danger"></span>
    </div>
    <div class="form-group col-md-12">
    <label class="control-label">' . $this->lang->line('text_companys') . '</label>
    <input id="company_name" type="text" value="' . $result[0]['company_name'] . '" name="company_name" class="form-control" readonly>
    <span id="UpdateregisterForm_company_name_errorloc" class="error_strings text-danger"></span>
    </div>
    <div class="form-group col-md-12">
    <span class="all_error" id="all_error text-danger"></span>
    <button type="submit" class="btn btn-primary btn-lg pull-right" style="display:none;">' . $this->lang->line('text_update') . '</button>
    </div>
    </div>
    </div>
    </form>
    <div class="col-md-12 update_password_success alert alert-success" style="display: none;"></div>
    <form id="change_password" name="change_password" method="post" action ="javascript:update_password();">
    <div class="h3 c-light-blue">' . $this->lang->line('text_changePassword') . '</div>
    <hr>
    <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class=" col-md-6">
    <label class="control-label">' . $this->lang->line('text_oldPassword') . '</label>
    <input type="password" class="form-control" placeholder="" name="pwd" id="password" onblur="checkOldPwd();">
    <span id="change_password_pwd_errorloc" class="error_strings text-danger"></span>
    <span class="password_error text-danger" id="password_error"></span>
    </div>
    <div class=" col-md-6">
    <label class="control-label">' . $this->lang->line('text_newPassword') . '</label>
    <input type="password" class="form-control" placeholder="" name="new_pwd" id="new_pwd">
    <span id="change_password_new_pwd_errorloc" class="error_strings text-danger"></span>
    </div>
    <div class="col-md-12 top-buffer">
    <label class="control-label">' . $this->lang->line('text_confirmPassword') . '</label>
    <input type="password" class="form-control" placeholder="" name="confirm_pwd" id="confirm_pwd" >
    <span id="change_password_confirm_pwd_errorloc" class="text-danger error_strings"></span>
    <span class="confirm_password_error text-danger" id="confirm_password_error"></span>
    </div>
    <div class="col-md-12 top-buffer">
    <button type="submit" id="btn_update" style="display: none;" class="btn btn-primary confirt-mbtn">' . $this->lang->line('text_update') . '</button>
    </div>
    </div>
    </div>
    </form>';

    $result = $result_data . '<div class="row"> <div class="col-md-12 col-xs-12"> ';
    $resultBtn = $result . '
    <div class="col-md-12 top-buffer">
    <button type="submit" id="btn_update" class="btn btn-primary confirt-mbtn" onclick="update_password()">' . $this->lang->line('text_update') . '</button>
    </div>
    </div>
    </div>
    <!--update profile END -->
    <script language="JavaScript" type="text/javascript" xml:space="preserve">
    var frmvalidator = new Validator("UpdateregisterForm");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("fname", "req", "' . $this->lang->line('text_pleaseEnterFirstName') . '");
    frmvalidator.addValidation("lname", "req", "' . $this->lang->line('text_pleaseEnterLastName') . '");
    frmvalidator.addValidation("company_name", "req", "' . $this->lang->line('text_pleaseEnterCompanyName') . '");
    var frmvalidator = new Validator("change_password");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("password", "req", "' . $this->lang->line('text_pleaseEnterOldPassword') . '");
    frmvalidator.addValidation("new_pwd", "req", "' . $this->lang->line('text_pleaseEnterNewPassword') . '");
    frmvalidator.addValidation("confirm_pwd", "req", "' . $this->lang->line('text_pleaseEnterConfirmPassword') . '");
    $(document).ready(function() {                                     /*$("#btn_update").prop("disabled", true);*/
    });
    function show_register() {
    $(".register").show();
    }
    </script> ';

    echo $resultBtn;
  }

  //function for update user profile
  public function update_user_detail()
  {
    $this->load->model("m_register");
    $_SESSION['company_name'] = $_POST['company_name'];
    echo $result = $this->m_register->update_user_detail($_POST);
  }

  //function for change password
  public function update_password()
  {
    // echo "dfsdf";
    // exit();
    $this->load->model("m_register");
    echo $result = $this->m_register->update_password();
  }

  //function for check old password
  public function checkOldPwd()
  {
    $userId = $_SESSION['user_id'];
    $password =  $_POST['password'];
    $pwd = md5($password);
    $new_hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
    $userData = $this->mlogin->BankDetails($userId);
    $pwInDatabase = $userData['pwd'];
    if (password_verify(''.$password.'', $pwInDatabase)) {
      echo "1";
    }else{
      echo "0";
    }
    // exit();
    // $this->load->model("m_register");
    // echo $result = $this->m_register->checkOldPwd($password);
  }
  
  public function mail_setting()
  {
    $this->load->model("m_register");
    $user_id = $_SESSION['user_id'];
    $all =  $_POST['all'];
    $sect =  $_POST['sector'];
    $sector = implode(",", $sect);
    $mat =  $_POST['maturity'];
    $maturity = implode(",", $mat);
    $curr =  $_POST['currency'];
    $currency = implode(",", $curr);
    $result = $this->m_register->mail_setting($user_id);
    
    if (count($result) == 0) {
      $data = array('lender_id' => $user_id, 'want_all_email' => $all, 'sectors' => $sector, 'maturity' => $maturity,
        'currency' => $currency);
      echo $result = $this->m_register->insert_mail_setting($data);
    } else {
      $data = array('lender_id' => $user_id, 'want_all_email' => $all, 'sectors' => $sector, 'maturity' => $maturity,
        'currency' => $currency);
      echo $result = $this->m_register->update_mail_setting($data, $user_id);
    }
  }

  //Function for Registration of New User
  public function new_user()
  {
    if (hash_equals($_SESSION[$this->config->item('csrf_token_name')], $_POST['token'])) {
       
          if (count($_POST['UserType']) == 2) {
            
            $userType = "both";
          } else {
           
            $userType = implode(",", $_POST['UserType']);
          }

          $accessclientgroup = implode(',', $_POST['accessclientgroup']);
          $email = $_POST['email'];
          $user_name = $_POST['uname'];
          $pwd = substr(md5(date('YidMHs') . rand()), rand(0, 20), 8);
          $new_hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
          $user_array = array(
            "company_name" => $_POST['NameofCompany']
            , "street" => $_POST['userStreet']
            , "zip_code" => $_POST['userZIP']
            , "city" => $_POST['userCity']
            , "owner_account" => $_POST['owner_account']
            , "bank" => $_POST['bank']
            , "iban_number" => $_POST['iban']
            , "biccode" => $_POST['biccode']
            //, "clientgroup" => $_POST['sparesection1']
            //, "client_sub_group" => $_POST['sparesection2']
            , "LEI_Nummber" => $_POST['sparesection3']
            , "sparesection4" => $_POST['sparesection4']
            , "Prefex" => $_POST['Prefex']
            , "Title" => $_POST['Title']
            , "fname" => $_POST['fname']
            , "lname" => $_POST['lname']
            , "email" => $_POST['email']
            , "uname" => $_POST['userid']
            , "usersparesection1" => $_POST['usersparesection1']
            , "usersparesection2" => $_POST['usersparesection2']
            , "usersparesection3" => $_POST['usersparesection3']
            , "pwd" => $new_hashed_pwd
            , "user_type" => $userType
            // , "emailpassword" => $email_pwd
            , "access_given_clientgroup" => $accessclientgroup
            , "client_sub_group" => $_POST['sparesection2']
            , "clientgroup" => $_POST['sparesection1']
            , "Ratingagentur1" => $_POST['Ratinga1']
            , "ratesRatinga1" => $_POST['ratesRatinga1']
            , "Ratingagentur2" => $_POST['Ratinga2']
            , "ratesRatinga2" => $_POST['ratesRatinga2']
            , "Einlagen" => $_POST['Einlagen']
            , "termsconditions" => $_POST['chkterms']
            , "PrivacyPolicy" => $_POST['PrivacyPolicy']
            , "ratings" => $_POST['ratings']
            , "information" => $_POST['information']
            , "contact_number" => $_POST['contactnumber'],
          );
          // print_r($user_array);
          // exit();
          

          $result = $this->m_register->new_user($user_array);

          if ($result > 0) {
           
            if ($_POST['sendEmail'] == 'N') {  
              $message = 'Guten Tag ' . $_POST['Prefex'] . " " .  $_POST['fname'] . " " .  $_POST['lname'] . '<br/><br/>';
              $message .= 'Vielen Dank für Ihre Anmeldung bei der FORSA-Plattform<br/>';
              $message .= 'Sie können sich nun einloggen unter<br/>';
              $message .= '<a href="' . base_url() . '" target="_blank">' . base_url() . '</a><br/><br/>';
              $message .= 'Login: ' . $_POST['userid'] . '<br/>';
              $message .= 'Passwort: ' . $pwd . '<br/><br/>';
              $message .= 'Bitte ändern Sie Ihr Passwort bei der ersten Anmeldung.<br/><br/>';
              $message .= 'Herzlichen Dank<br/>';
              $message .= 'Freundliche Grüsse<br/><br/>';
              $message .= 'FORSA GmbH<br/>';
              $message .= 'Wiesbaden<br/>';
              $message .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';
              $this->load->library('email');
              $this->email->set_mailtype("html");
              $this->email->from('admin@instimatch.ch', 'Ihre Anmeldung FORSA');
              $this->email->to($_POST['email']);
              $this->email->subject('Ihre Anmeldung FORSA');
              $this->email->message($message);
              $this->email->send();
              $this->mlogin->updateonboardstatus($result);
              $this->mlogin->updaterateofInterest($result);

              $customerId = $_POST['customerId'];
              $this->m_register->updateonlyviewuserstats($customerId);
              $subject = "Ihre Anmeldung FORSA";
              $date = date("Y-m-d H:i:s A");
              $this->m_register->insertEmailDetails($customerId,$subject,$message,$date);
              echo 'true';
              
            } else {
              
              $message = 'Guten Tag ' .  $_POST['fname'] . " " .  $_POST['lname'] . '<br/><br/>';
              $message .= 'Sie haben sich erfolgreich bei  FORSA-Plattform registriert.<br/>';
              $message .= 'Die Administration wird Ihre Registrierung pr&uuml;fen und Ihnen die Login Details per E-Mail zusenden.<br/><br/>';
              $message .= 'Herzlichen Dank<br/>';
              $message .= 'Freundliche Grüsse<br/><br/>';
              $message .= 'FORSA GmbH<br/>';
              $message .= 'Wiesbaden<br/>';
              $message .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';
              $this->load->library('email');
              $this->email->set_mailtype("html");
              $this->email->from('admin@instimatch.ch', 'Ihre Anmeldung FORSA');
              $this->email->to($_POST['email']);
              $this->email->subject('Ihre Anmeldung FORSA');
              $this->email->message($message);
              $this->email->send();
              $subject = "Ihre Anmeldung FORSA";
              $date = date("Y-m-d H:i:s A");
              $this->m_register->insertonboardEmailDetails($result,$subject,$message,$date);
              echo 'true';
            }
          } else {
            echo 'false';
          }
      
        } else {
          echo "securitybleach";
        }
    
  }

  public function checkuname_status()
  {
    $uname =  $_POST['uname'];
    $this->load->model("m_register");
    echo $result = $this->m_register->checkuname_status($uname);
  }

  public function checkEmail_status()
  {
    $email =  $_POST['email'];
    $this->load->model("m_register");
    echo $result = $this->m_register->checkEmail_status($email);
  }

  public function login()
  {
    if ($_GET['msg'] == 'success') {
      redirect(base_url() . '?msg=success');
    } elseif ( $_GET['passreset'] == 'Y') {
      $customerId =  $_GET['customerId'];
      redirect(base_url() . '?passreset=Y&customer=' . $customerId . '');
    } else {
      redirect(base_url());
    }
  }

}
