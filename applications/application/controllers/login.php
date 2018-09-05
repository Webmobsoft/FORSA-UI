<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

//Default controller of this application
class login extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  @session_start();
  $this->load->helper('url');
  
  if (!isset($_SESSION['language'])) {
   $_SESSION['language'] = "german";
  }

  $this->load->model("mlogin");
  $this->lang->load('borrowerHome', $_SESSION['language']);
 }

 public function index()
 {
  $captcha['captcha'] = rand(11111, 99999);

  $captcha['subClientgroups'] = $this->mlogin->getClientSubGroups();
  $msg = $_REQUEST['msg'];
  
  if (isset($_REQUEST['msg'])) {
   $captcha['success'] = $this->lang->line('reg_success');
   $_SESSION['language'] = 'german';
  }
  
  if (isset($_GET['customerid'])) {
   $customerid = base64_decode($_GET['customerid']);
   $captcha['customerDetails'] = $this->mlogin->getUserDetails($customerid);
   $captcha['alread'] = 'Y';
   $captcha['customerid'] = $customerid;
  }
  
  if (isset($_GET['wregister'])) {
   $_SESSION['language'] = 'german';
   $captcha['register'] = 'yes';
  }
  
  if (isset($_GET['wlogin'])) {
   $_SESSION['language'] = 'german';
  }
  
  if (isset($_GET['reg']) && isset($_GET['customerid'])) {
   $customerId = base64_decode($_GET['customerid']);
   $captcha['customerDetails'] = $this->mlogin->getUserDetails($customerId);
   if ($captcha['customerDetails']['view_only_user'] == "Y") {
    $captcha['customerDetails'] = $this->mlogin->getUserDetails($customerId);
    $captcha['bankList'] = $this->mlogin->bankList($captcha['customerDetails']['client_group']);
    // print_r($captcha['customerDetails']);
    // exit();
    $captcha['lendersBank'] = $this->mlogin->bankList($captcha['customerDetails']['client_group']);
    $captcha['allBanks'] = $this->mlogin->allbankList("0");
    // print_r($captcha['customerDetails']['offBorrowers']);
    // exit();
    $captcha['offBorrowers'] = $captcha['customerDetails']['offBorrowers'];

    $captcha['onborrowers'] = $captcha['customerDetails']['onborrowers'];
    // print_r($captcha['lendersBank']);
    // exit();
    $captcha['showform'] = 'Y';

   } else {
    $captcha['showlogin'] = 'Y';
   }
  }
  
  if (isset($_GET['customerid']) && isset($_GET['viewlogout'])) {
   $this->load->model('m_register');
   $customerId = base64_decode($_GET['customerid']);
   $this->m_register->updateonlyviewuserstats($customerId);
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $currIpAdd = $_SERVER['HTTP_CLIENT_IP'];
   } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $currIpAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
    $currIpAdd = $_SERVER['REMOTE_ADDR'];
   }

   $this->mlogin->viewuserlogout($customerId);
   $loggedOutDetails = $this->mlogin->insertviewuserLogOutDetails($customerId, $currIpAdd);
  }
  
  if (isset($_GET['customersid']) && isset($_GET['shows'])) {
   $captcha['already'] = 'Y';
   $customerId = base64_decode($_GET['customersid']);
   $captcha['customerDetails'] = $this->mlogin->getUserDetails($customerId);
   $captcha['regist'] = 'Y';
  
   $captcha['customerid'] = $customerId;
  }
  
  if (isset($_GET['passreset'])) {
   $captcha['passreset'] = 'Y';
  }
  
  $_SESSION['captcha'] = $captcha['captcha'];
  $_SESSION[$this->config->item('csrf_token_name')] = $this->config->item('csrf_token');
  
  if (!isset($_SESSION['user_type'])) {
   $this->load->view('v_login', $captcha);
  } else {
   $userId = $_SESSION['user_id'];
   $userDetails = $this->mlogin->getloginUserDetails($userId);
   if ($_SESSION['user_type'] == "lender" || $_SESSION['user_type'] == "both") {
    $result['lendersBank'] = $this->mlogin->bankList($userDetails[0]['clientgroup']);
    $result['allBanks'] = $this->mlogin->allbankList($_SESSION['user_id']);
    $result['offBorrowers'] = $userDetails[0]['offborrowers'];
    $result['onborrowers'] = $userDetails[0]['onborrowers'];
    $result['lenderTerm'] = $userDetails[0]['lenderselectedterm'];
    
    if (!empty($result['lenderTerm'])) {
     $lendersBank = $this->mlogin->lendersBank($result['lenderTerm']);
     
     foreach ($lendersBank as $bank) {
        if (!empty($bank['' . $result['lenderTerm'] . ''])) {
       $BankDetails['bankDetails'] = $this->mlogin->BankDetails($bank['bank_id']);
       $BankDetails['bankrate'] = $bank['' . $result['lenderTerm'] . ''];
       $BankDetailing[] = $BankDetails;
      }
     }

     $result['lenderTermBanks'] = $BankDetailing;
    }
   }

   $result['lenderviewsection'] = $userDetails[0]['lenderviewsection'];
   $result['settledlenderview'] = $userDetails[0]['settledlenderview'];
   $result['viewtype'] = $userDetails[0]['viewtype'];
   $result['clientGroup'] = $userDetails[0]['access_given_clientgroup'];
   $result['lenderlist'] = $this->mlogin->lendersList();
   $result['lenderinterest'] = $this->mlogin->lenderbankInterests($userId);
   $result['bankinterest'] = $this->mlogin->bankInterests($userId);
   $this->load->view('header', $result);
   $this->load->view('news', $result);
   $this->load->view('footer');
  }

 }

// function for change Language
 public function changeLanguage($language)
 {
  $_SESSION['language'] = $language;
 }
}
