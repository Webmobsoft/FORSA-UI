<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class instimatch extends CI_Controller
{
 public function __construct()
 {
  @session_start();
  parent::__construct();
  $this->load->helper('url');
  $_SESSION['type'] = "M";

  if (!isset($_SESSION['language'])) {
   $_SESSION['language'] = defaultLanguage;
  }

  $this->load->model('mlogin');
  $this->lang->load('borrowerHome', $_SESSION['language']);
  date_default_timezone_set('Europe/Zurich');
  $dateTime = date("Y-m-d H:i:s");
  $time = date('h:i', strtotime($dateTime));
 }

//Function for logout
 public function logout()
 {
  $userId = $_SESSION['user_id'];
  $loggedInArray = array("loginBrowser" => "", "login_flag" => "", "settledlenderview" => "");
  $this->mlogin->updateUserLoggedDetails($userId, $loggedInArray);
  $this->mlogin->logout($userId);

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
  {
   $currIpAdd = $_SERVER['HTTP_CLIENT_IP'];
  } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
  {
   $currIpAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
   $currIpAdd = $_SERVER['REMOTE_ADDR'];
  }

  $loggedOutDetails = $this->mlogin->insertLogOutDetails($userId, $currIpAdd);

  if (session_destroy()) {
   echo '<script>window.location.href="' . base_url() . '"</script>';
  }
 }

 public function lenderviewsection()
 {
  $lander_view = $this->mlogin->lenderviewsection();
 }
 public function kontaktelenderviewsection()
 {
  $lander_view = $this->mlogin->kontaktelenderviewsection();
 }

 //Function for get updated Borrowers with Rate of Interest
 public function getlatestdata()
 {
  $userId = $_SESSION['user_id'];
  $userDetails = $this->mlogin->getloginUserDetails($userId);
//   print_r($userDetails[0]['clientgroup']);
//   exit();
  $latestData = $this->mlogin->bankList($userDetails[0]['clientgroup']);
  $offborrowers = $userDetails[0]['offborrowers'];
  $lenderinterest = $this->mlogin->lenderbankInterests($userId,$offborrowers);
//   print_r($latestData);
//   exit();
  foreach ($latestData as $latest) {
   $clientUserId[] = $latest['userId'];
  }

  if (!empty($userDetails[0]['onborrowers']) && !empty($clientUserId)) {
   $str = ltrim($userDetails[0]['onborrowers'], ',');
   $onborrower = explode(',', $str);
   $merge_array = array_merge($clientUserId, $onborrower);
   $array_unique = array_unique($merge_array);
   $allactiveBanks = implode(',', $array_unique);

  } else if (empty($userDetails[0]['onborrowers']) && !empty($clientUserId)) {
   $allactiveBanks = implode(',', $clientUserId);
  } else if (!empty($userDetails[0]['onborrowers']) && empty($clientUserId)) {
   $allactiveBanks = ltrim($userDetails[0]['onborrowers'], ',');
  }
  $latestData2 = $this->mlogin->getothersbankList($allactiveBanks);
  $blankInterestdatss = $this->mlogin->getothersblankbankList($allactiveBanks);
  $latestData3 = array_merge($latestData2,$blankInterestdatss);
 
  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
  $offborrower = explode(',', $userDetails[0]['offborrowers']);
//   print_r($clientUserId);
//   exit();
  foreach ($latestData3 as $bankInterest) {
   if (!in_array($bankInterest['bank_id'], $offborrower) && in_array($bankInterest['bank_id'], $clientUserId) ) {
      echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '<span style="float:right;" data-id="'.$bankInterest['bank_id'].'" class="viewpdf"><i class="glyphicon glyphicon-info-sign"></i></span></td><td class='.(!empty($bankInterest['TN']) ? $bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['TN'] . '</td><td class='.( !empty($bankInterest['1week']) ? $bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['1week'] . '</td><td class='.( !empty($bankInterest['2weeks']) ? $bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.( !empty($bankInterest['3weeks']) ? $bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.( !empty($bankInterest['1month']) ? $bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.( !empty($bankInterest['2month']) ? $bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '': '').' id="">' . $bankInterest['2month'] . '</td><td class='.( !empty($bankInterest['3month']) ? $bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['3month'] . '</td><td class='.( !empty($bankInterest['4month']) ? $bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '': '').' id="">' . $bankInterest['4month'] . '</td><td class='.( !empty($bankInterest['5month']) ? $bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['5month'] . '</td><td class='.( !empty($bankInterest['6month']) ? $bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['6month'] . '</td><td class='.( !empty($bankInterest['7month']) ? $bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['7month'] . '</td><td  class='.(!empty($bankInterest['8month']) ? $bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['8month'] . '</td><td class='.(!empty($bankInterest['9month']) ? $bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['9month'] . '</td><td class='.( !empty($bankInterest['10month']) ? $bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['10month'] . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.(!empty($bankInterest['12month']) ? $bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '':'').' id="">' . $bankInterest['12month'] . '</td><td class='.(!empty($bankInterest['2year']) ? $bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '':'').' id="">' . $bankInterest['2year'] . '</td><td class='.(!empty($bankInterest['3year']) ? $bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '':'').' id="">' . $bankInterest['3year'] . '</td><td class='.( !empty($bankInterest['4year']) ? $bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['4year'] . '</td><td class='.(!empty($bankInterest['5year']) ? $bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '':'').' id="">' . $bankInterest['5year'] . '</td></tr>';
   }
  }
 }

 public function getCustomerSorted(){
      $userId = $_POST['customerid'];
      $sort = $_POST['sort'];
      $user_id = base64_decode($userId);
      $where = array("id" => $user_id);
      $userDetails = $this->mlogin->getCustomerInfoWhere($where);
      $latestData = $this->mlogin->CustomerbankList($userDetails['client_group'],$sort);
      $blanklatestData = $this->mlogin->CustomerBlankbankList($userDetails['client_group'],$sort);
      $bankData = array_merge($latestData,$blanklatestData);


      $offborrowers = explode(',', $userDetails['offBorrowers']);


      $lenderinterest = $this->mlogin->MaxbankList($userDetails['client_group']);

      echo '<thead><tr><th class="sorting" data-id="bank_id">BANKS LIST</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
  foreach ($bankData as $bankInterest) {
      if (!in_array($bankInterest['bank_id'], $offborrowers)){

      echo '<tr class="interest"><td>' . $bankInterest['company_name'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
      }    
}

 }

 public function getsortedData()
 {
      //  echo "sdfsd";
      //  exit();
      $userId = $_SESSION['user_id'];
      $userDetails = $this->mlogin->getloginUserDetails($userId);
      $offborrowers = explode(',', $userDetails[0]['offborrowers']);
      if(!empty($offborrowers)){
            $offborrower = $userDetails[0]['offborrowers'];
            $lenderinterest = $this->mlogin->lendersortedbankInterests($userId,$offborrower);
      }
      // print_r($lenderinterest);
      // exit();
     
      // print_r($lenderinterest);
      // exit();
       $sortedData = $this->mlogin->getsortedData($_POST['sort']);
      //  print_r($sortedData);
       $blanksortedData = $this->mlogin->getsortedblankData($_POST['sort']);
      //  print_r($blanksortedData);
      //  exit();
       $completeData = array_merge($sortedData,$blanksortedData);
       
       echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
       <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
       <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
       foreach ($completeData as $bankInterest) {
            if (!in_array($bankInterest['bank_id'], $offborrowers)){
               echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '<span style="float:right;" data-id="'.$bankInterest['bank_id'].'" class="viewpdf"><i class="glyphicon glyphicon-info-sign"></i></span></td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
            }
            }       
 }

 public function getallBanksortedData()
 {
      $userId = $_SESSION['user_id'];

      $bankData = $this->mlogin->getCompletesortedbanks($_POST['sort']);
      $blankInterestData = $this->mlogin->getBlanksInterestsortedBanks($_POST['sort']);
      // print_r($blankInterestData);
      // exit();
      $bankDatas = array_merge($bankData,$blankInterestData);
      $lenderinterest = $this->mlogin->lenderbankInterests($userId); 
      echo '<thead><tr><th class="banksorting" data-id="bank_id">ALL BANKS</th><th class="banksorting" data-id="TN">Tag</th><th class="banksorting" data-id="1week">1 W</th><th class="banksorting" data-id="2weeks">2 W</th><th class="banksorting" data-id="3weeks">3 W</th><th class="banksorting" data-id="1month">1 M</th><th class="banksorting" data-id="2month">2 M</th><th class="banksorting" data-id="3month">3 M</th><th class="banksorting" data-id="4month">4 M</th>
  <th class="banksorting" data-id="5month">5 M</th><th class="banksorting" data-id="6month">6 M</th><th class="banksorting" data-id="7month">7 M</th><th class="banksorting" data-id="8month">8 M</th><th class="banksorting" data-id="9month">9 M</th><th class="banksorting" data-id="10month">10 M</th><th class="banksorting" data-id="11month">11 M</th><th class="banksorting" data-id="12month">12 M</th><th class="banksorting" data-id="2year">2 Y</th>
  <th class="banksorting" data-id="3year">3 Y</th><th class="banksorting" data-id="4year">4 Y</th><th class="banksorting" data-id="5year">5 Y</th></tr></thead><tbody>';
      if(!empty($bankDatas)){
            foreach ($bankDatas as $bankInterest) {     
                  echo '<tr class="interest"><td class="company_na">' . $bankInterest['company_name'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
      }        
      }else{
            echo "No Banks Available";
      }       
 }
 
 public function uploadpdf()
 {
     
      
      $errors= array();
      $fileName = $_FILES['files']['name'];
      $filearray = explode(".",$fileName);
      $file_size =$_FILES['files']['size'];
      $file_tmp =$_FILES['files']['tmp_name'];
      $file_type=$_FILES['files']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['files']['name'])));
      $expensions= array("pdf");
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF";
      }

      $file_name = $filearray[0]."-".date("d M Y H:i:s").".pdf";
      
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"./assets/PDFFiles/".$file_name)){
            $pdf = $this->mlogin->updatePdf($file_name);
            echo "true";
 
         }else{
            echo "Some Error";
         }
         
      }else{
         print_r($errors);
      }
      exit();
 }

 public function getuserpdf()
 {
      $pdfs = $this->mlogin->getuserpdf();
      $pdf = explode(",",$pdfs['pdf_file']);
      if(!empty($pdf)){
      foreach($pdf as $pdffile){
            if(!empty($pdffile)){
                  echo '<div class="pdffile" data-id="'.$pdffile.'"><span><i class="fa fa-file-pdf-o" style="font-size:20px;color:red"></i></span> '.$pdffile.'</div><span data-id="'.$pdffile.'" class="glyphicon glyphicon-trash deletedpdf dlt-icon"></span>';
            }
      }
      }else{
            echo "There is NO pdf yet";
      }
     
      //print_r($pdf);

 }

 public function getborroweruserpdfs()
 {
      $userId = $_POST['borrower'];
      $pdfs = $this->mlogin->getborroweruserpdfs($userId);
      $pdf = explode(",",$pdfs['pdf_file']);

      echo '<table><tbody><tr><th>Name Unternehmen</th><td><input type="text" id="company_name1" class="form-control" value="'.$pdfs['company_name'].'"></td></tr>
      <tr><th>Strasse</th><td><input type="text" id="street" class="form-control" value="'.$pdfs['street'].'"></td></tr>
      <tr><th>Postleitzahl</th><td><input type="text" id="zip_code" class="form-control" value="'.$pdfs['zip_code'].'"></td></tr>
      <tr><th>Ort</th><td><input type="text" id="city" class="form-control" value="'.$pdfs['city'].'"></td></tr>
      </tbody></table>';
      if(!empty($pdf)){
      foreach($pdf as $pdffile){
            if(!empty($pdffile)){

                  echo '<div class="pdffile" data-id="'.$pdffile.'"><span><i class="fa fa-file-pdf-o" style="font-size:20px;color:red"></i></span> '.$pdffile.'</div>';
            }
      }
      }else{
            echo "There is NO pdf yet";
      }
     
      //print_r($pdf);

 }

 public function delupdatepdf()
 {
       
       $delpdfs = $this->mlogin->delupdatepdf($_POST['pdf']);
 }

 public function getallBankkontaktesortedData()
 {
       
      //$userId = $_SESSION['user_id'];

      $bankData = $this->mlogin->getCompletesortedbanks($_POST['sort']);
      $blankInterestData = $this->mlogin->getBlanksInterestsortedBanks($_POST['sort']);
      // print_r($blankInterestData);
      // exit();
      $bankDatas = array_merge($bankData,$blankInterestData);
      $lenderinterest = $this->mlogin->kontaktelenderbankInterests(); 
      echo '<thead><tr><th class="banksorting" data-id="bank_id">ALL BANKS</th><th class="banksorting" data-id="TN">Tag</th><th class="banksorting" data-id="1week">1 W</th><th class="banksorting" data-id="2weeks">2 W</th><th class="banksorting" data-id="3weeks">3 W</th><th class="banksorting" data-id="1month">1 M</th><th class="banksorting" data-id="2month">2 M</th><th class="banksorting" data-id="3month">3 M</th><th class="banksorting" data-id="4month">4 M</th>
  <th class="banksorting" data-id="5month">5 M</th><th class="banksorting" data-id="6month">6 M</th><th class="banksorting" data-id="7month">7 M</th><th class="banksorting" data-id="8month">8 M</th><th class="banksorting" data-id="9month">9 M</th><th class="banksorting" data-id="10month">10 M</th><th class="banksorting" data-id="11month">11 M</th><th class="banksorting" data-id="12month">12 M</th><th class="banksorting" data-id="2year">2 Y</th>
  <th class="banksorting" data-id="3year">3 Y</th><th class="banksorting" data-id="4year">4 Y</th><th class="banksorting" data-id="5year">5 Y</th></tr></thead><tbody>';
      if(!empty($bankDatas)){
            foreach ($bankDatas as $bankInterest) {     
                  echo '<tr class="interest"><td>' . $bankInterest['company_name'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
      }        
      }else{
            echo "No Banks Available";
      }       
 }



 public function getmaturitysortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getmaturitysortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }
 public function getmaturityborrowersortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getmaturityborrowersortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }


 public function getmaturitydescendingsortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getmaturitydescendingsortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }

 public function getmaturityborrowerdescendingsortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getmaturityborrowerdescendingsortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }



 public function gethistorymaturitysortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->gethistorymaturitysortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }

 public function getborrowerhistorymaturitysortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getborrowerhistorymaturitysortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }





 public function getdeschistorymaturitysortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getdeschistorymaturitysortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }

 public function getborrowerdeschistorymaturitysortedData()
 {
      $userId = $_SESSION['user_id'];
      // echo $_POST['sort'];
      // exit();
       $maturities = $this->mlogin->getborrowerdeschistorymaturitysortedData($userId,$_POST['sort']);
      //  print_r($maturities);
      //  exit();
       echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
       
      //  echo '<thead><tr><th class="sorting" data-id="bank_id">GESAMTÜBERSICHT</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
      //  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
      //  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
      //  foreach ($completeData as $bankInterest) {
      //       if (!in_array($bankInterest['bank_id'], $offborrowers)){
      //          echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td data-id="' . $bankInterest['bank_id'] . '" class="company_na">' . $bankInterest['company_name'] . '</td><td class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' .  $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' .$bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').'  id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month']  . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td  class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month']  . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month']  . '</td><td class='.(!empty($bankInterest['11month']) ? $bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '' : '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year']  . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year']  . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year']  . '</td></tr>';
      //       }
      //       }       
 }


 

 
 public function getblanksortedData()
 {
      $blankInterestData = $this->mlogin->getBlanksInterestBanks(); 
      echo '<thead></thead><tbody>';
      foreach ($blankInterestData as $bankInterest) {
               echo '<tr  class="interest bankrows" data-id="' . $bankInterest['bank_id'] . '"><td>' . $bankInterest['companyName'] . '</td><td  id="">' . $bankInterest['TN'] . '</td><td id="">' . $bankInterest['1week'] . '</td><td  id="">' . $bankInterest['2weeks'] . '</td><td  id="">' . $bankInterest['3weeks'] . '</td><td   id="">' . $bankInterest['1month'] . '</td><td  id="">' . $bankInterest['2month'] . '</td><td  id="">' . $bankInterest['3month'] . '</td><td  id="">' . $bankInterest['4month'] . '</td><td  id="">' . $bankInterest['5month'] . '</td><td  id="">' . $bankInterest['6month'] . '</td><td  id="">' . $bankInterest['7month'] . '</td><td   id="">' . $bankInterest['8month'] . '</td><td  id="">' . $bankInterest['9month'] . '</td><td  id="">' . $bankInterest['10month'] . '</td><td  id="">' . $bankInterest['11month'] . '</td><td  id="">' . $bankInterest['12month'] . '</td><td  id="">' . $bankInterest['2year'] . '</td><td  id="">' . $bankInterest['3year'] . '</td><td  id="">' . $bankInterest['4year'] . '</td><td  id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
           }
           
 }


 public function getAllBanksList(){
      $userId = $_SESSION['user_id'];
      $bankData = $this->mlogin->getCompletebanks();
      $blankInterestData = $this->mlogin->getBlanksInterestBanks();
      $bankDatas = array_merge($bankData,$blankInterestData);
      $lenderinterest = $this->mlogin->lenderbankInterests($userId);
      // print_r($bankDatas);
      // exit();
      echo '<thead><tr><th class="banksorting" data-id="bank_id">ALL BANKS</th><th class="banksorting" data-id="TN">Tag</th><th class="banksorting" data-id="1week">1 W</th><th class="banksorting" data-id="2weeks">2 W</th><th class="banksorting" data-id="3weeks">3 W</th><th class="banksorting" data-id="1month">1 M</th><th class="banksorting" data-id="2month">2 M</th><th class="banksorting" data-id="3month">3 M</th><th class="banksorting" data-id="4month">4 M</th>
  <th class="banksorting" data-id="5month">5 M</th><th class="banksorting" data-id="6month">6 M</th><th class="banksorting" data-id="7month">7 M</th><th class="banksorting" data-id="8month">8 M</th><th class="banksorting" data-id="9month">9 M</th><th class="banksorting" data-id="10month">10 M</th><th class="banksorting" data-id="11month">11 M</th><th class="banksorting" data-id="12month">12 M</th><th class="banksorting" data-id="2year">2 Y</th>
  <th class="banksorting" data-id="3year">3 Y</th><th class="banksorting" data-id="4year">4 Y</th><th class="banksorting" data-id="5year">5 Y</th></tr></thead><tbody>';

      // echo '<thead><tr><th class="banksorting" data-id="bank_id">ALL BANKS</th><th>Tag</th><th>1 W</th><th>2 W</th><th>3 W</th><th>1 M</th><th>2 M</th><th>3 M</th><th>4 M</th>
      // <th>5 M</th><th>6 M</th><th>7 M</th><th>8 M</th><th>9 M</th><th>10 M</th><th>11 M</th><th>12 M</th><th>2 Y</th>
      // <th>3 Y</th><th>4 Y</th><th>5 Y</th></tr></thead><tbody>';
      if(!empty($bankDatas)){
            foreach ($bankDatas as $bankInterest) {     
                  echo '<tr class="interest"><td class="company_na">' . $bankInterest['companyName'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
      }        
      }else{
            echo "No Banks Available";
      }
     // print_r($bankData);
      //exit();
 }

 public function getAllBanksForKontakte(){
      $bankData = $this->mlogin->getCompletebanks();
      $blankInterestData = $this->mlogin->getBlanksInterestBanks();
      $bankDatas = array_merge($bankData,$blankInterestData);

      $lenderinterest = $this->mlogin->kontaktelenderbankInterests();

      echo '<thead><tr><th class="banksorting" data-id="bank_id">ALL BANKS</th><th class="banksorting" data-id="TN">Tag</th><th class="banksorting" data-id="1week">1 W</th><th class="banksorting" data-id="2weeks">2 W</th><th class="banksorting" data-id="3weeks">3 W</th><th class="banksorting" data-id="1month">1 M</th><th class="banksorting" data-id="2month">2 M</th><th class="banksorting" data-id="3month">3 M</th><th class="banksorting" data-id="4month">4 M</th>
      <th class="banksorting" data-id="5month">5 M</th><th class="banksorting" data-id="6month">6 M</th><th class="banksorting" data-id="7month">7 M</th><th class="banksorting" data-id="8month">8 M</th><th class="banksorting" data-id="9month">9 M</th><th class="banksorting" data-id="10month">10 M</th><th class="banksorting" data-id="11month">11 M</th><th class="banksorting" data-id="12month">12 M</th><th class="banksorting" data-id="2year">2 Y</th>
      <th class="banksorting" data-id="3year">3 Y</th><th class="banksorting" data-id="4year">4 Y</th><th class="banksorting" data-id="5year">5 Y</th></tr></thead><tbody>';
          if(!empty($bankDatas)){
                foreach ($bankDatas as $bankInterest) {     
                      echo '<tr class="interest"><td>' . $bankInterest['companyName'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
          }        
          }else{
                echo "No Banks Available";
          }

 }
 public function userlogOutoneTime()
 {
      $loggedInArray = array("loginBrowser" => "", "login_flag" => "", "settledlenderview" => "");
      $this->mlogin->updateoneTimeUserLoggedDetails($loggedInArray);
      if(isset($_SESSION['user_id'])) {
            session_destroy();
            echo "true";
      }else{
            echo "false";
      }   
 }

 //Function for get Latest Borrowers with Rate of Interest For the Only View User 
 public function getlatestdataviewuser()
 {
  $userId = $_REQUEST['customerid'];
  $user_id = base64_decode($userId);
  $where = array("id" => $user_id);
  $userDetails = $this->mlogin->getCustomerInfoWhere($where);
  $nonblanklatestData = $this->mlogin->kontaktebankList($userDetails['client_group']);
  $blanklatestData = $this->mlogin->blankkontaktebankList($userDetails['client_group']);
  $latestData = array_merge($nonblanklatestData,$blanklatestData);
      // print_r($userDetails['offBorrowers']);
      // exit();
  $lenderinterest = $this->mlogin->MaxbankList($userDetails['client_group'],$userDetails['offBorrowers']);

  $offborrower = explode(',', $userDetails['offBorrowers']);
//   print_r($offborrower);
//   exit();

  echo '<thead><tr><th class="sorting" data-id="bank_id">BANKS LIST</th><th class="sorting" data-id="TN">Tag</th><th class="sorting" data-id="1week">1 W</th><th class="sorting" data-id="2weeks">2 W</th><th class="sorting" data-id="3weeks">3 W</th><th class="sorting" data-id="1month">1 M</th><th class="sorting" data-id="2month">2 M</th><th class="sorting" data-id="3month">3 M</th><th class="sorting" data-id="4month">4 M</th>
  <th class="sorting" data-id="5month">5 M</th><th class="sorting" data-id="6month">6 M</th><th class="sorting" data-id="7month">7 M</th><th class="sorting" data-id="8month">8 M</th><th class="sorting" data-id="9month">9 M</th><th class="sorting" data-id="10month">10 M</th><th class="sorting" data-id="11month">11 M</th><th class="sorting" data-id="12month">12 M</th><th class="sorting" data-id="2year">2 Y</th>
  <th class="sorting" data-id="3year">3 Y</th><th class="sorting" data-id="4year">4 Y</th><th class="sorting" data-id="5year">5 Y</th></tr></thead>';
  
  foreach ($latestData as $bankInterest) {
      if (!in_array($bankInterest['bank_id'], $offborrower)) {
      echo '<tr class="interest"><td>' . $bankInterest['company_name'] . '</td><td  class='.($bankInterest['TN'] == $lenderinterest['TN'] ? 'activeinterest': '').' id="">' . $bankInterest['TN'] . '</td><td class='.($bankInterest['1week'] == $lenderinterest['1week'] ? 'activeinterest': '').' id="">' . $bankInterest['1week'] . '</td><td class='.($bankInterest['2weeks'] == $lenderinterest['2weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['2weeks'] . '</td><td class='.($bankInterest['3weeks'] == $lenderinterest['3weeks'] ? 'activeinterest': '').' id="">' . $bankInterest['3weeks'] . '</td><td class='.($bankInterest['1month'] == $lenderinterest['1month'] ? 'activeinterest': '').' id="">' . $bankInterest['1month'] . '</td><td class='.($bankInterest['2month'] == $lenderinterest['2month'] ? 'activeinterest': '').' id="">' . $bankInterest['2month'] . '</td><td class='.($bankInterest['3month'] == $lenderinterest['3month'] ? 'activeinterest': '').' id="">' . $bankInterest['3month'] . '</td><td class='.($bankInterest['4month'] == $lenderinterest['4month'] ? 'activeinterest': '').' id="">' . $bankInterest['4month'] . '</td><td class='.($bankInterest['5month'] == $lenderinterest['5month'] ? 'activeinterest': '').' id="">' . $bankInterest['5month'] . '</td><td class='.($bankInterest['6month'] == $lenderinterest['6month'] ? 'activeinterest': '').' id="">' . $bankInterest['6month'] . '</td><td class='.($bankInterest['7month'] == $lenderinterest['7month'] ? 'activeinterest': '').' id="">' . $bankInterest['7month'] . '</td><td class='.($bankInterest['8month'] == $lenderinterest['8month'] ? 'activeinterest': '').' id="">' . $bankInterest['8month'] . '</td><td class='.($bankInterest['9month'] == $lenderinterest['9month'] ? 'activeinterest': '').' id="">' . $bankInterest['9month'] . '</td><td class='.($bankInterest['10month'] == $lenderinterest['10month'] ? 'activeinterest': '').' id="">' . $bankInterest['10month'] . '</td><td class='.($bankInterest['11month'] == $lenderinterest['11month'] ? 'activeinterest': '').' id="">' . $bankInterest['11month'] . '</td><td class='.($bankInterest['12month'] == $lenderinterest['12month'] ? 'activeinterest': '').' id="">' . $bankInterest['12month'] . '</td><td class='.($bankInterest['2year'] == $lenderinterest['2year'] ? 'activeinterest': '').' id="">' . $bankInterest['2year'] . '</td><td class='.($bankInterest['3year'] == $lenderinterest['3year'] ? 'activeinterest': '').' id="">' . $bankInterest['3year'] . '</td><td class='.($bankInterest['4year'] == $lenderinterest['4year'] ? 'activeinterest': '').' id="">' . $bankInterest['4year'] . '</td><td class='.($bankInterest['5year'] == $lenderinterest['5year'] ? 'activeinterest': '').' id="">' . $bankInterest['5year'] . '</td></tr></tbody>';
      }
}
//  echo '</tbody>';
 }

 public function checkusername()
 {
      $flag = $this->mlogin->checkusername();
      if(empty($flag)){
            echo 'true';
      }else{
            echo 'false';
      }
      
 }
 public function getAdminRequestResponse()
 {
       $borrowerId = $_SESSION['user_id'];
       $requestDetails = $this->mlogin->getAdminRequestResponse($borrowerId);
       $declinerequestDetails = $this->mlogin->getAdminRequestdeclineResponse($borrowerId);
       if(!empty($requestDetails)){
             foreach($requestDetails as $request){
                  $Details = $this->mlogin->lenderdetails($request['lenderId']);
                  
                   echo '<p class="request_response">'.$Details['company_name'].' HAS ACCEPTED YOUR DEAL. PLEASE CHECK YOUR E-MAIL FOR CONFIRMATION.</p>.
                   <input type="button" class="btn btn-info btn-lg adminacceptRequest" id="adminacceptReq" data-value="'.$request['id'].'" value="OK">';
             }

       }else if(!empty($declinerequestDetails)){
            foreach($declinerequestDetails as $decrequest){
                  $LendDetails = $this->mlogin->lenderdetails($decrequest['lenderId']);
                  echo '<p class="request_response">'.$LendDetails['company_name'].' HAS DECLINED YOUR REQUEST.</p><br>
                  <input type="button" class="btn btn-info btn-lg admindeclineRequest" id="admindecliReq" data-value="'.$decrequest['id'].'" value="OK">';
            }
       }else{
             echo 'false';
       }
       //print_r($requestDetails);
 }
 public function updateAdminAcceptResponse()
 {
      
      $admin_acceptance = $this->mlogin->updateAdminAcceptResponse($_POST['notificationId']);
 }

 public function updateAdminDeclineResponse()
 {
      
      $admin_acceptance = $this->mlogin->updateAdminDeclineResponse($_POST['notificationId']);
 }

 public function lendersettledview()
 {
  $lander_view = $this->mlogin->lendersettledview();
 }
 public function allBanksListupdate()
 {
  $all_banks_update = $this->mlogin->allBanksListupdate();
 }

 public function setviewtype()
 {
  $setviewtype = $this->mlogin->setviewtype();
 }

 public function addremoveborrower()
 {
  $setviewtype = $this->mlogin->addremoveborrower($_SESSION['user_id']);
  $this->mlogin->adOffborrower($_SESSION['user_id']);
 }
 public function addkontakteremoveborrower()
 {
  $userId = base64_decode($_POST['customerId']);
  $setviewtype = $this->mlogin->addkontakteremoveborrower($userId);
  $this->mlogin->adkontakteOffborrower($userId);
 }

 public function adOnborrower()
 {
  $this->mlogin->adOnborrower($_SESSION['user_id']);
 }

 public function adkontakteOnborrower()
 {
       $userId = base64_decode($_POST['customerId']);
  $this->mlogin->adkontakteOnborrower($userId);
 }


 public function updateaccessclient()
 {
  $bankInterest = $this->mlogin->updateaccessclient();
 }

 //Function For Login of Kontakte Users
 public function loginforonboard()
 {
  $uname = $_REQUEST['username'];
  $pwd = $_REQUEST['password'];
  $captcha = $_REQUEST['captcha'];
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->form_validation->set_rules('username', 'lang:userName', 'trim|required|xss_clean');
  $this->form_validation->set_rules('password', 'lang:email', 'trim|required|xss_clean');
  $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|xss_clean|numeric');

  if ($this->form_validation->run() == false) {
   echo validation_errors();
   exit();
  } else {
   $userData = $this->mlogin->getCustomerInfoWhere(array('email' => $uname, 'password' => $pwd, 'active' => 'Y'));
   if (!empty($userData)) {
     $pwInDatabase = $userData['password'];
     $hash = password_hash($pwInDatabase, PASSWORD_BCRYPT, ['cost' => 12]);
     if(password_verify(''.$pwd.'',$hash)) 
     {
      if (hash_equals($_SESSION[$this->config->item('csrf_token_name')], $_POST['token'])) {
       if ($captcha != $_SESSION['captcha']) {
        echo "wrongcaptcha";
        exit();
       } else {
        $login_user["response"] = $userData;
        $result = $this->mlogin->updateviewuserDetails($login_user["response"]);
        $this->mlogin->updatecustomers($login_user["response"]);
        $this->mlogin->onlyviewhasLoginStats($login_user["response"]['id']);
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
         $currIpAdd = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
         $currIpAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
         $currIpAdd = $_SERVER['REMOTE_ADDR'];
        }

        $_SESSION['randomFlagNumber'] = $randomFlagNumber = rand(00000, 99999);
        $insertLoggedDetails = $this->mlogin->insertviewonlyLoggedDetails($login_user["response"]['id'], $currIpAdd);
        /*------detect browser----*/
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
        }
        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
         $bname = 'Internet Explorer';
         $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
         $bname = 'Mozilla Firefox';
         $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
         $bname = 'Google Chrome';
         $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
         $bname = 'Apple Safari';
         $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
         $bname = 'Opera';
         $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
         $bname = 'Netscape';
         $ub = "Netscape";
        }
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
         ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
         // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
         //we will have two since we are not using 'other' argument yet
         //see if version is before or after the name
         if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
          $version = $matches['version'][0];
         } else {
          $version = $matches['version'][1];
         }
        } else {
         $version = $matches['version'][0];
        }
        if ($version == null || $version == "") {$version = "?";}
        $array = array(
         'userAgent' => $u_agent,
         'name' => $bname,
         'version' => $version,
         'platform' => $platform,
         'pattern' => $pattern,
        );
        echo "1";
       }
      } else {
       echo "securitybleach";
       exit();
      }
     } else {
      echo "false";
      exit();
     }
   } else {
    echo "false";
   }
  }
 }
 
 public function lendersLatestBanks()
 {
  $userId = $_SESSION['user_id'];
  $userDetails = $this->mlogin->getloginUserDetails($userId);
  $offBorrowe = $this->mlogin->getoffBorrowers($userId);
  $off = explode(",", $offBorrowe['offborrowers']);
  if (!empty($userDetails[0]['lenderselectedterm'])) {
   $lendersBank = $this->mlogin->lendersBank($userDetails[0]['lenderselectedterm']);

   foreach ($lendersBank as $bank) {
    if (!empty($bank['' . $userDetails[0]['lenderselectedterm'] . '']) && !in_array($bank['bank_id'],$off)) {
     $BankDetails['bankDetails'] = $this->mlogin->BankDetails($bank['bank_id']);
     $BankDetails['bankrate'] = $bank['' . $userDetails[0]['lenderselectedterm'] . ''];
     $BankDetailing[] = $BankDetails;
    }
   }
   $lenderTermBanks = $BankDetailing;
  }

  echo '<div style="margin:0px !important;padding: 0;float: left;width: 100%;" class="col-md-12">
        <button class="eur-Month"> EUR ' . $this->lang->line($userDetails[0]['lenderselectedterm']) . '</button>
        </div>';

  foreach ($lenderTermBanks as $banks) {
   echo '<div style="margin:0px !important;padding: 0;float: left;width: 100%;" class="co-md-12 margin-padd-remove"><table class="mytables" id="lendersBank"><tbody><tr><td><button class="btn-innfo"> INFO </button></td>
            <td>' . $banks['bankDetails']['company_name'] . '</td>
            <td>' . $banks['bankrate'] . '</td>
            <td><button id="lend-id" class="lendrequest" data-id = '.$banks['bankDetails']['id'].'> Lend </button> </td>
            </tr></tboady></table></div>';
  }
 }


 public function kontaktelendersLatestBanks()
 {
  $userId = base64_decode($_REQUEST['customerid']);
      $where = array("id" => $userId);
  $userDetails = $this->mlogin->getCustomerInfoWhere($where);
// print_r($userDetails);
// exit();
//   echo $userDetails['lenderselectedterm'];
//   exit();
//   $offBorrowe = $this->mlogin->getoffBorrowers($userId);
//   $off = explode(",", $offBorrowe['offborrowers']);
  if (!empty($userDetails['lenderselectedterm'])) {
   $lendersBank = $this->mlogin->lendersBank($userDetails['lenderselectedterm']);
//    print_r($lendersBank);
//    exit();

   foreach ($lendersBank as $bank) {
//     if (!empty($bank['' . $userDetails[0]['lenderselectedterm'] . '']) && !in_array($bank['bank_id'],$off)) {
     $BankDetails['bankDetails'] = $this->mlogin->BankDetails($bank['bank_id']);
     $BankDetails['bankrate'] = $bank['' . $userDetails['lenderselectedterm'] . ''];
     $BankDetailing[] = $BankDetails;
//     }
   }
   $lenderTermBanks = $BankDetailing;
  }

  echo '<div style="margin:0px !important;padding: 0;float: left;width: 100%;" class="col-md-12">
        <button class="eur-Month"> EUR ' . $this->lang->line($userDetails[0]['lenderselectedterm']) . '</button>
        </div>';

  foreach ($lenderTermBanks as $banks) {
   echo '<div style="margin:0px !important;padding: 0;float: left;width: 100%;" class="co-md-12 margin-padd-remove"><table class="mytables" id="lendersBank"><tbody><tr><td><button class="btn-innfo"> INFO </button></td>
            <td>' . $banks['bankDetails']['company_name'] . '</td>
            <td>' . $banks['bankrate'] . '</td>
            <td><button id="lend-id"  data-id = '.$banks['bankDetails']['id'].'> Lend </button> </td>
            </tr></tboady></table></div>';
  }
 }



 //Function for send request to Borrower by Lender
 public function lenderRequestSend()
 {
      $BankDetails = $this->mlogin->BankDetails($_POST['bankId']);
      $userId = $_SESSION['user_id'];
      $userDetails = $this->mlogin->getloginUserDetails($userId);
      echo '<table><tbody><tr><th>'.$this->lang->line('LENDER').'</th><td>'.$userDetails[0]['company_name'].'</td></tr>
      <tr><th>'.$this->lang->line('BORROWER').'</th><td>'.$BankDetails['company_name'].'</td></tr>
      <tr><th>'.$this->lang->line('AMOUNT').'</th><td><input type="text" id="amount" class="form-control requestamount"></td></tr>
      <tr><th>'.$this->lang->line('START-DATE').'</th><td><input type="text" id="datepicker" class="form-control"></td></tr>
      <tr><th>'.$this->lang->line('END-DATE').'</th><td><input type="text"  id="datepicker1" class="form-control"></td></tr>
      <tr><th>'.$this->lang->line('NR_OF_DAYS').'&nbsp&nbsp</th><td class="numberDays" id="no_of_days"></td></tr>
      <tr><th>'.$this->lang->line('INTEREST_CONVENTION').'</th><td><select class="form-control" id="interest" ><option value="act360">act/360</option></select></td></tr>
      <tr><th>'.$this->lang->line('PAYMENTS').'</th><td><select class="form-control" id="payments" >
      <option value="yearly payment">'.$this->lang->line('yearly_payment').'</option>
      <option value="semi anual">'.$this->lang->line('semi_anual').'</option>
      <option value="quarterly">'.$this->lang->line('quarterly').'</option>
      <option value="at maturity">'.$this->lang->line('at_maturity').'</option>
      </select></td></tr>
      <tr><td><input type="button" class="btn btn-info btn-lg" id="sendRequest" value="'.$this->lang->line('SEND').'"></td></tr>
      </tbody></table>';
      // print_r($BankDetails);

 }
 public function getUserDetails()
 {
      $userId = $_SESSION['user_id'];
      $BankDetails = $this->mlogin->BankDetails($userId);
      echo '<table><tbody><tr><th>Name Unternehmen</th><td><input type="text" id="company_name1" class="form-control" value="'.$BankDetails['company_name'].'"></td></tr>
      <tr><th>Strasse</th><td><input type="text" id="street" class="form-control" value="'.$BankDetails['street'].'"></td></tr>
      <tr><th>Postleitzahl</th><td><input type="text" id="zip_code" class="form-control" value="'.$BankDetails['zip_code'].'"></td></tr>
      <tr><th>Ort</th><td><input type="text" id="city" class="form-control" value="'.$BankDetails['city'].'"></td></tr>
      <tr><th>Kontoinhaber</th><td><input type="text" id="owner_account" class="form-control" value="'.$BankDetails['owner_account'].'"></td></tr>
      <tr><th>Bank</th><td><input type="text" id="bank" class="form-control" value="'.$BankDetails['bank'].'"></td></tr>
      <tr><th>IBAN Number</th><td><input type="text" id="iban_number" class="form-control" value="'.$BankDetails['iban_number'].'"></td></tr>
      <tr><th>BIC Code</th><td><input type="text" id="biccode" class="form-control" value="'.$BankDetails['biccode'].'"></td></tr>
      <tr><th>Anrede</th><td><input type="text" id="Prefex" class="form-control" value="'.$BankDetails['Prefex'].'"></td></tr>
      <tr><th>Titel</th><td><input type="text" id="Title" class="form-control" value="'.$BankDetails['Title'].'"></td></tr>
      <tr><th>Vorname</th><td><input type="text" id="fname" class="form-control" value="'.$BankDetails['fname'].'"></td></tr>
      <tr><th>Nachname</th><td><input type="text" id="lname" class="form-control" value="'.$BankDetails['lname'].'"></td></tr>
      <tr><th>Mail-Adresse</th><td><input type="text" id="email" class="form-control" value="'.$BankDetails['email'].'"></td></tr>
      <tr><th>Benutzertyp</th><td><input type="text" id="uname" class="form-control" value="'.$BankDetails['uname'].'"></td></tr>
      <tr><th>Telefonnummer</th><td><input type="text" id="contact_number" class="form-control" value="'.$BankDetails['contact_number'].'"></td></tr>
      <tr><th>Kundengruppe</th><td>
      <select class="form-control" id="clientgroup" name="clientgroup">
              <option value="Bank" '.($BankDetails['clientgroup'] == "Bank" ? "selected" : "").'>Bank</option>
              <option value="Unternehmen GmbH" '.($BankDetails['clientgroup'] == "Unternehmen GmbH" ? "selected" : "").'>Kommunale Unternehmen (GmbH)</option>
              <option value="Unternehmen AöR KdöR" '.($BankDetails['clientgroup'] == "Unternehmen AöR KdöR" ? "selected" : "").'>Kommunale Unternehmen (KdöR - AöR)</option>   
              <option value="Kommunen" '.($BankDetails['clientgroup'] == "Kommunen" ? "selected" : "").'>Kommunen</option>
              </select>
     
      
      </td></tr>
      </tbody></table>';
      
 }

 public function getKontakteUserDetails()
 {
      $userId = base64_decode($_REQUEST['customerid']);
      $where = array("id" => $userId);
      $BankDetails = $this->mlogin->getCustomerInfoWhere($where);
      echo '<table><tbody><tr><th>Name Unternehmen</th><td><input type="text" id="company_name1" class="form-control" value="'.$BankDetails['Name_company'].'"></td></tr>
      <tr><th>Strasse</th><td><input type="text" id="street" class="form-control" value="'.$BankDetails['address'].'"></td></tr>
   \  <tr><th>Ort</th><td><input type="text" id="city" class="form-control" value="'.$BankDetails['place'].'"></td></tr>
      <tr><th>Anrede</th><td><input type="text" id="Prefex" class="form-control" value="'.$BankDetails['salutation'].'"></td></tr>
      <tr><th>Titel</th><td><input type="text" id="Title" class="form-control" value="'.$BankDetails['title'].'"></td></tr>
      <tr><th>Vorname</th><td><input type="text" id="fname" class="form-control" value="'.$BankDetails['first_name'].'"></td></tr>
      <tr><th>Nachname</th><td><input type="text" id="lname" class="form-control" value="'.$BankDetails['Surname'].'"></td></tr>
      <tr><th>Mail-Adresse</th><td><input type="text" id="email" class="form-control" value="'.$BankDetails['email'].'"></td></tr>
      <tr><th>Telefonnummer</th><td><input type="text" id="contact_number" class="form-control" value="'.$BankDetails['contact_number'].'"></td></tr>
      <tr><th>Kundengruppe</th><td>
      <select class="form-control" id="clientgroup" name="clientgroup">
              <option value="Bank" '.($BankDetails['client_group'] == "Bank" ? "selected" : "").'>Bank</option>
              <option value="Unternehmen GmbH" '.($BankDetails['client_group'] == "Unternehmen GmbH" ? "selected" : "").'>Kommunale Unternehmen (GmbH)</option>
              <option value="Unternehmen AöR KdöR" '.($BankDetails['client_group'] == "Unternehmen AöR KdöR" ? "selected" : "").'>Kommunale Unternehmen (KdöR - AöR)</option>   
              <option value="Kommunen" '.($BankDetails['client_group'] == "Kommunen" ? "selected" : "").'>Kommunen</option>
              </select>
     
      
      </td></tr>
      </tbody></table>
      <div class="modal-footer">
      <input type="button" class="btn btn-info btn-lg" id="updateuser" value="UPDATE">
      
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>';
      
 }


 public function updateUserDetails()
 {
      $updateResponse = $this->mlogin->updateUserDetails();
 }
 public function updatekontakteUserDetails()
 {
      $updateResponse = $this->mlogin->updatekontakteUserDetails();
 }


 public function maturities()
 {
      $user_id = $_SESSION['user_id'];
      $maturities = $this->mlogin->maturities($user_id);
      echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      //echo '<thead><tr><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th>Lender</th><th>Borrower</th><th>Amount</th><th>Start Date</th><th>Maturity Date</th><th>Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody> <tfoot></tfoot>'; 
 }

 public function Borrowermaturities()
 {
      $user_id = $_SESSION['user_id'];
      $maturities = $this->mlogin->Borrowermaturities($user_id);
      // print_r($maturities);
      // exit();
      echo '<thead><tr><th class="maturitysorting" data-id="ticket_number">Ticket Number</th><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th class="maturitysorting" data-id="lenderId">Lender</th><th class="maturitysorting" data-id="borrowerId">Borrower</th><th class="maturitysorting" data-id="amount">Amount</th><th class="maturitysorting" data-id="start_date">Start Date</th><th class="maturitysorting" data-id="end_date">Maturity Date</th><th class="maturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      //echo '<thead><tr><th class="maturitysorting" data-id="complete_deal_date">Trading Date</th><th>Lender</th><th>Borrower</th><th>Amount</th><th>Start Date</th><th>Maturity Date</th><th>Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody> <tfoot></tfoot>'; 
 }

 public function historymaturities()
 {
      $user_id = $_SESSION['user_id'];
      $maturities = $this->mlogin->historymaturities($user_id);
      echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      //echo '<thead><tr><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th>Lender</th><th>Borrower</th><th>Amount</th><th>Start Date</th><th>Maturity Date</th><th>Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
 }
 public function Borrowerhistorymaturities()
 {
      $user_id = $_SESSION['user_id'];
      $maturities = $this->mlogin->Borrowerhistorymaturities($user_id);
      echo '<thead><tr><th class="historymaturitysorting" data-id="ticket_number">Ticket Number</th><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th class="historymaturitysorting" data-id="lenderId">Lender</th><th class="historymaturitysorting" data-id="borrowerId">Borrower</th><th class="historymaturitysorting" data-id="amount">Amount</th><th class="historymaturitysorting" data-id="start_date">Start Date</th><th class="historymaturitysorting" data-id="end_date">Maturity Date</th><th class="historymaturitysorting" data-id="interest_rate">Rate</th></tr></thead><tbody>';
      //echo '<thead><tr><th class="historymaturitysorting" data-id="complete_deal_date">Trading Date</th><th>Lender</th><th>Borrower</th><th>Amount</th><th>Start Date</th><th>Maturity Date</th><th>Rate</th></tr></thead><tbody>';
      foreach($maturities as $maturi){

            $lenderDetails = $this->mlogin->getloginUserDetails($maturi['lenderId']);
            $BankDetails = $this->mlogin->BankDetails($maturi['borrowerId']);
            echo '<tr><td>'.$maturi['ticket_number'].'</td><td>'.$maturi['complete_deal_date'].'</td><td>'.$lenderDetails[0]['company_name'].'</td><td>'.$BankDetails['company_name'].'</td><td>'.$maturi['amount'].'</td><td>'.$maturi['start_date'].'</td><td>'.$maturi['end_date'].'</td><td>'.$maturi['interest_rate'].'</td></tr>'; 
      }
      echo '</tbody>'; 
 }




 public function getAdminResponse()
 {
      $AdminResponse = $this->mlogin->getAdminResponse($_SESSION['user_id']);

      $AdminDeclineResponse = $this->mlogin->getAdminDeclineResponse($_SESSION['user_id']); 

      $BankDetails = $this->mlogin->BankDetails($AdminResponse[0]['borrowerId']);
      if(!empty($AdminResponse)){
            echo "<p class='request_response'>YOUR LENDING TO ".$BankDetails['company_name']." HAS BEEN PERFORMED SUCCESFULLY BY FORSA, PLEASE CHECK E-MAIL</p>";
            echo '<input type="button" class="btn btn-info btn-lg admin popupTextButton" data-value="accept" data-id="'.$AdminResponse[0]['id'].'"  id="sendRequest" value="OK">';

      }elseif(!empty( $AdminDeclineResponse)){
            $BanksDetails = $this->mlogin->BankDetails($AdminDeclineResponse[0]['borrowerId']);
            echo "<p class='request_response'>YOUR LENDING TO ".$BanksDetails['company_name']." HAS BEEN DECLINED BY FORSA</p>";
            echo '<input type="button" class="btn btn-info btn-lg admin popupTextButton" data-value="decline" data-id="'.$AdminDeclineResponse[0]['id'].'" id="sendRequest" value="OK">';
      }else{
            echo "false";
      }
      //print_r($AdminResponse);
       //sssecho "dfgdf";
 }

 public function updateAdminResponses()
 {


      $where = array("id" => $_POST['dataid']);
      $data = array("admin_response" => "Y");
      $this->mlogin->updateAdminResponses($where,$data);
       
 }

 public function Notifications()
 {
      $notification = $this->mlogin->Notifications(); 
//      print_r($Notifications);
//      exit();
      if(!empty($notification)){
            // foreach($Notifications as $notification){
                  $userDetails = $this->mlogin->getloginUserDetails($notification['lenderId']);
                  $BankDetails = $this->mlogin->BankDetails($notification['borrowerId']);
                  echo '<form class="notificationform"><table><tbody><tr><th>'.$this->lang->line('LENDER').'</th><td>'.$userDetails[0]['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('BORROWER').'</th><td>'.$BankDetails['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('AMOUNT').'</th><td>'.$notification['amount'].'</td></tr>
                  <tr><th>'.$this->lang->line('START-DATE').'</th><td>'.$notification['start_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('END-DATE').'</th><td>'.$notification['end_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('NR_OF_DAYS').'</th><td id="no_of_days">'.$notification['no_of_days'].'</td></tr>
                  <tr><th>INTEREST RATE</th><td><input type="text" class="intrestrate-'.$notification['id'].' form-control"></td></tr>
                  <tr><th>'.$this->lang->line('INTEREST_CONVENTION').'</th><td>'.$notification['interest'].'</td></tr>
                  <tr><th>'.$this->lang->line('PAYMENTS').'</th><td>'.$notification['payments'].'</td></tr>
                  <tr>
                  
                  </tr>
                  
                  </tbody></table></form>
                  <div class="text-center send-pop-btn">
                  <input type="button" id="sendborroreq" class="sendborrowerRequest btn btn-info btn-lg" data-id='.$notification['id'].' value="'.$this->lang->line('SEND').'"></div> ' ; 
                  // }
      }else{
            echo 'false';
      }

     
 }

 public function LenderNotification()
 {
      $LenderNotification = $this->mlogin->LenderNotification(); 
      if(!empty($LenderNotification)){
            foreach($LenderNotification as $Notifications){
                  $BankDetails = $this->mlogin->BankDetails($Notifications['borrowerId']);
                  $userId = $_SESSION['user_id'];
                  $userDetails = $this->mlogin->getloginUserDetails($userId);
                  echo '<table><tbody><tr><th>'.$this->lang->line('LENDER').'</th><td>'.$userDetails[0]['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('BORROWER').'</th><td>'.$BankDetails['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('AMOUNT').'</th><td>'.$Notifications['amount'].'</td></tr>
                  <tr><th>'.$this->lang->line('START-DATE').'</th><td>'.$Notifications['start_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('END-DATE').'</th><td>'.$Notifications['end_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('NR_OF_DAYS').'&nbsp&nbsp</th><td id="no_of_days">'.$Notifications['no_of_days'].'</td></tr>
                  <tr><th>'.$this->lang->line('INTEREST_CONVENTION').'</th><td>'.$Notifications['interest'].'</td></tr>
                  <tr><th>INTEREST RATE &nbsp&nbsp</th><td>'.$Notifications['interest_rate'].'</td></tr> 
                  <tr><th>'.$this->lang->line('PAYMENTS').'</th><td>'.$Notifications['payments'].'</td></tr>
                  
                  
                  </tbody></table>
                  <div class="row bottom-three-btn">
                  <div class="col-md-4">
                  <input type="button" id="request-accept" value="ACCEPT" data-value="accept" data-bank-name ="'.$BankDetails['company_name'].'"  class="btn btn-info btn-lg requestresponse" data-id="'.$Notifications['id'].'">
                 </div>
                 <div class="col-md-4"> 
                 <input type="button" id="request-decline" value="DECLINE" data-value="decline" class="btn btn-info btn-lg requestresponse" data-id="'.$Notifications['id'].'">
                 </div> 
                 <div class="col-md-4">
                 <input type="button" id="chat-with-forsa" value="FORSA, please contact me" data-value="chat_with_forsa" class="btn btn-info btn-lg requestresponse" data-id="'.$Notifications['id'].'"></div>
                 <div class="col-md-8">
                 <input type="button"  value="'.$this->lang->line('close').'" data-value="close"   id="closing" disabled="disabled" class="btn btn-info btn-lg requestresponse" data-id="'.$Notifications['id'].'"></div></div>
                  ';
            }
            //print_r($Notification);

      }else{
            echo 'false';
      }
      //print_r($LenderNotification);
 }

 public function ChatWithForsa()
 {
      $LenderNotification = $this->mlogin->ChatLenderNotification(); 
      if(!empty($LenderNotification)){
            foreach($LenderNotification as $Notifications){
                  $BankDetails = $this->mlogin->BankDetails($Notifications['borrowerId']);
                  $userId = $_SESSION['user_id'];
                  $userDetails = $this->mlogin->getloginUserDetails($userId);
                  echo '<table><tbody><tr><th>'.$this->lang->line('LENDER').'</th><td>'.$userDetails[0]['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('BORROWER').'</th><td>'.$BankDetails['company_name'].'</td></tr>
                  <tr><th>'.$this->lang->line('AMOUNT').'</th><td>'.$Notifications['amount'].'</td></tr>
                  <tr><th>'.$this->lang->line('START-DATE').'</th><td>'.$Notifications['start_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('END-DATE').'</th><td>'.$Notifications['end_date'].'</td></tr>
                  <tr><th>'.$this->lang->line('NR_OF_DAYS').'&nbsp&nbsp</th><td id="no_of_days">'.$Notifications['no_of_days'].'</td></tr>
                  <tr><th>'.$this->lang->line('INTEREST_CONVENTION').'</th><td>'.$Notifications['interest'].'</td></tr>
                  <tr><th>INTEREST RATE &nbsp&nbsp</th><td>'.$Notifications['interest_rate'].'</td></tr> 
                  <tr><th>'.$this->lang->line('PAYMENTS').'</th><td>'.$Notifications['payments'].'</td></tr>
                  <tr> <th> Description </th> <td> <textarea rows="4" cols="50" id = "chat_description" > </textarea> </td> </tr>
                  <tr>
                  <td><input type="button" id="request-send" value="SEND" data-value="chat_with_forsa" class="btn btn-info btn-lg requestresponse" data-id="'.$Notifications['id'].'"></td>
                  </tr>
                  
                  </tbody></table>';
            }
            //print_r($Notification);

      }else{
            echo 'false';
      }
 }

 public function UpdateChatDescription()
 {
      $this->mlogin->UpdateChatDescription();
 }

 public function EmailAcceptResponse()
 { 
      $Emaildata = $this->mlogin->getLenderBorrower($_POST['NotificationId']); 
      $lenderDetails = $this->mlogin->getloginUserDetails($Emaildata[0]['lenderId']); 
      $borrowerDetails = $this->mlogin->getloginUserDetails($Emaildata[0]['borrowerId']); 
      $amount = str_replace(".","",$Emaildata[0]['amount']);
      $no_days = $Emaildata[0]['no_of_days'];
      if($Emaildata[0]['interest_rate'] == "0" || $Emaildata[0]['interest_rate'] == "0.00"){
            $interest = $amount;
      }else{

            $interest = (float)$amount * (int)$no_days * (float)$Emaildata[0]['interest_rate']/(360*100);
      }
      $interest =  number_format((float)$interest, 2, '.', '');
      $interest = number_format($interest,2,".",",");

      $repayment_amount = (int)$amount + $interest;
      $repayment_amount = number_format($repayment_amount,2,".",".");
      // echo $repayment_amount."///";
      // $repayment_amount = number_format($repayment_amount,2,",",".");
      //  echo $repayment_amount;
      //  exit();
      //$repayment_amount = number_format($repayment_amount,2,",",".");

      $lenderComission = $lenderDetails[0]['commission'];
      $lcomission = (int)$lenderComission;
      $lcommission_calculation = (float)$amount * (int)$no_days * (int)$lcomission/360/100/100;
      $lcommission_calculation =  number_format((float)$lcommission_calculation, 2, '.', '');
      $borrowerComission = $borrowerDetails[0]['commission'];
      $bcomission = (int)$borrowerComission;
      $bcommission_calculation = (float)$amount * (int)$no_days * $bcomission/360/100/100;
      $bcommission_calculation =  number_format((float)$bcommission_calculation, 2, '.', '');
      $bcommission_calculation = number_format($bcommission_calculation,2,".",",");
      $lcommission_calculation = number_format($lcommission_calculation,2,".",",");
      $dealdate = date("d M Y");
      $dealtime = date("H:i:s A");
      $ticketIncre = $this->mlogin->TicketNumber($_POST['NotificationId']);
      $ticketyear = date("Y");
      $ticketNumber = $ticketyear.$ticketIncre."8202";

      $lendermessage = 'Good day,<br/><br/>';
      $lendermessage .= 'We like to confirm following trade: <br/><br/>';
      $lendermessage .= '<table border="0"><tbody>
      <tr><th><b>Tradedate</b></th><td>'. $dealdate.'</td></tr>
      <tr><th><b>Time</b></th><td>'.$dealtime.'</td></tr>
      <tr><th><b>Ticket Number</b></th><td>'.$ticketNumber.'</td></tr>
      <tr><th><b>Darlehensgeber</b></th><td>'.$lenderDetails[0]['company_name'].'</td></tr>
      <tr><th>LEI Number</th><td>'.$lenderDetails[0]['LEI_Nummber'].'</td></tr>
      <tr><th>Address</th><td>'.$lenderDetails[0]['city'].'</td></tr>
      <tr><th>Account Details</th><td>'.$lenderDetails[0]['owner_account'].'</td></tr>
      <tr><th>IBAN</th><td>'.$lenderDetails[0]['iban_number'].'</td></tr>
      <tr><th>BIC</th><td>'.$lenderDetails[0]['biccode'].'</td></tr>
      <tr><th><b>Darlehensnehmer</b></th><td>'.$borrowerDetails[0]['company_name'].'</td></tr>
      <tr><th>LEI Number</th><td>'.$borrowerDetails[0]['LEI_Nummber'].'</td></tr>
      <tr><th>Address</th><td>'.$borrowerDetails[0]['city'].'</td></tr>
      <tr><th>Account Details</th><td>'.$borrowerDetails[0]['owner_account'].'</td></tr>
      <tr><th>IBAN</th><td>'.$borrowerDetails[0]['iban_number'].'</td></tr>
      <tr><th>BIC</th><td>'.$borrowerDetails[0]['biccode'].'</td></tr>
      <tr><th>Amount</th><td>'.$Emaildata[0]['amount'].'</td></tr>
      <tr><th>Interest Rate</th><td>'.$Emaildata[0]['interest_rate'].'</td></tr>
      <tr><th>Interest Method</th><td>'.$Emaildata[0]['payments'].'</td></tr>
      <tr><th>Value Date</th><td>'.$Emaildata[0]['start_date'].'</td></tr>
      <tr><th>Maturity Date</th><td>'.$Emaildata[0]['end_date'].'</td></tr>
      <tr><th>Number of Days</th><td>'.$Emaildata[0]['no_of_days'].'</td></tr>
      <tr><th>Amount of Interest</th><td>'.$interest.'</td></tr>
      <tr><th>Amount of Payback</th><td>'.$repayment_amount.'</td></tr>
      <tr><th>Lender Brokerage</th><td>'.$lcommission_calculation.'</td></tr>
      </tbody></table><br><br>';
      $lendermessage .= 'Sie haben sich erfolgreich bei  FORSA-Plattform registriert.<br/>';
      $lendermessage .= 'Die Administration wird Ihre Registrierung pr&uuml;fen und Ihnen die Login Details per E-Mail zusenden.<br/><br/>';
      $lendermessage .= 'Herzlichen Dank<br/>';
      $lendermessage .= 'Freundliche Grüsse<br/><br/>';
      $lendermessage .= 'FORSA GmbH<br/>';
      $lendermessage .= 'Wiesbaden<br/>';
      $lendermessage .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';

       $list = array(''.$lenderDetails[0]['email'].'');
       $this->load->library('email');
       $this->email->set_mailtype("html");
       $this->email->from('admin@instimatch.ch', 'Instimatch');
       $this->email->to($list);
       $this->email->subject('FORSA || Deal Acceptance');
       $this->email->message($lendermessage);
       $this->email->send();

      $message = 'Good day,<br/><br/>';
      $message .= 'We like to confirm following trade: <br/><br/>';
      $message .= '<table border="0"><tbody>
      <tr><th><b>Tradedate</b></th><td>'. $dealdate.'</td></tr>
      <tr><th><b>Time</b></th><td>'.$dealtime.'</td></tr>
      <tr><th><b>Ticket Number</b></th><td>'.$ticketNumber.'</td></tr>
      <tr><th><b>Darlehensgeber</b></th><td>'.$lenderDetails[0]['company_name'].'</td></tr>
      <tr><th>LEI Number</th><td>'.$lenderDetails[0]['LEI_Nummber'].'</td></tr>
      <tr><th>Address</th><td>'.$lenderDetails[0]['city'].'</td></tr>
      <tr><th>Account Details</th><td>'.$lenderDetails[0]['owner_account'].'</td></tr>
      <tr><th>IBAN</th><td>'.$lenderDetails[0]['iban_number'].'</td></tr>
      <tr><th>BIC</th><td>'.$lenderDetails[0]['biccode'].'</td></tr>
      <tr><th><b>Darlehensnehmer</b></th><td>'.$borrowerDetails[0]['company_name'].'</td></tr>
      <tr><th>LEI Number</th><td>'.$borrowerDetails[0]['LEI_Nummber'].'</td></tr>
      <tr><th>Address</th><td>'.$borrowerDetails[0]['city'].'</td></tr>
      <tr><th>Account Details</th><td>'.$borrowerDetails[0]['owner_account'].'</td></tr>
      <tr><th>IBAN</th><td>'.$borrowerDetails[0]['iban_number'].'</td></tr>
      <tr><th>BIC</th><td>'.$borrowerDetails[0]['biccode'].'</td></tr>
      <tr><th>Amount</th><td>'.$Emaildata[0]['amount'].'</td></tr>
      <tr><th>Interest Rate</th><td>'.$Emaildata[0]['interest_rate'].'</td></tr>
      <tr><th>Interest Method</th><td>'.$Emaildata[0]['payments'].'</td></tr>
      <tr><th>Value Date</th><td>'.$Emaildata[0]['start_date'].'</td></tr>
      <tr><th>Maturity Date</th><td>'.$Emaildata[0]['end_date'].'</td></tr>
      <tr><th>Number of Days</th><td>'.$Emaildata[0]['no_of_days'].'</td></tr>
      <tr><th>Amount of Interest</th><td>'.$interest.'</td></tr>
      <tr><th>Amount of Payback</th><td>'.$repayment_amount.'</td></tr>
      <tr><th>Borrower Brokerage</th><td>'.$bcommission_calculation.'</td></tr>
      </tbody></table><br><br>';
      $message .= 'Sie haben sich erfolgreich bei  FORSA-Plattform registriert.<br/>';
      $message .= 'Die Administration wird Ihre Registrierung pr&uuml;fen und Ihnen die Login Details per E-Mail zusenden.<br/><br/>';
      $message .= 'Herzlichen Dank<br/>';
      $message .= 'Freundliche Grüsse<br/><br/>';
      $message .= 'FORSA GmbH<br/>';
      $message .= 'Wiesbaden<br/>';
      $message .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';
       $list = array(''.$borrowerDetails[0]['email'].'');
       $this->load->library('email');
       $this->email->set_mailtype("html");
       $this->email->from('admin@instimatch.ch', 'Instimatch');
       $this->email->to($list);
       $this->email->subject('FORSA || Deal Acceptance');
       $this->email->message($message);
       $this->email->send();

       $borrowerDetails = $this->mlogin->updateResponse($_POST['NotificationId'],$ticketNumber,$ticketIncre,$dealdate,$dealtime);
       $subject = "FORSA || Deal Acceptance";
       $date = date("Y-m-d H:i:s A");
       $this->mlogin->insertDealEmailDetails($Emaildata[0]['lenderId'],$subject,$message,$date);
 }

 public function AcceptedDeals()
 {
       $userId = $_SESSION['user_id'];
       $lenderDetails = $this->mlogin->getUser($userId); 
       if(!empty($lenderDetails))
       {
           $BorrowerDetails = $this->mlogin->getloginUserDetails($lenderDetails[0]['lenderId']);
           echo "<p class='request_response'> ".$BorrowerDetails[0]['company_name']." has accepted Deal. Please check your e-mail for confirmation.</p>";
           echo '<input type="button" id="request-accept" value="OK" data-value="accept" class="btn btn-info btn-lg acceptdeal" data-id="'.$lenderDetails[0]['lenderId'].'">';
       }
       else
       {
            echo 'false';
       }
       
       //print_r($BorrowerDetails[0]['uname']);
       //exit();
}

public function RequestAcceptNotification()
{
      $userId = $_SESSION['user_id'];
      $lenderDetails = $this->mlogin->getUser($userId);  

      if(!empty($lenderDetails))
       {
           echo "".$lenderDetails[0]['company_name']." has decline Deal.";
           echo '<input type="button" id="accept" value="OK" data-value="accept" class="btn btn-info btn-lg acceptdeal" data-id="'.$lenderDetails[0]['lenderId'].'">';
       }

       else
       {
            echo 'false';
       }
}
  
public function DeclinedDeals()
{
      $userId = $_SESSION['user_id'];
      // print_r($userId); exit();
      $lenderDetails = $this->mlogin->getDeclineUser($userId); 
      // print_r($lenderDetails); exit(); 
      if(!empty($lenderDetails))
      {
          $BorrowerDetails = $this->mlogin->getloginUserDetails($lenderDetails[0]['lenderId']);
          echo "<p class='request_response'>".$BorrowerDetails[0]['company_name']." has declined your request.</p>";
          echo '<input type="button" id="request-decline" value="OK" data-value="decline" class="btn btn-info btn-lg declinedeal" data-id="'.$lenderDetails[0]['lenderId'].'"/>';
      }

      else
      {
           echo 'false';
      }
}

      public function ChatDeals()
      {
            return $userId = $_SESSION['user_id'];
      }

 public function updateAcceptResponse()
 {
       
       $where = array("lenderId" => $_POST['userId'],"borrowerId" => $_SESSION['user_id']);
       $data = array("processed" => "Y");
       $this->mlogin->updateResponses($where,$data);
      
 }

 public function updateDeclineResponse()
 {
       
       $where = array("lenderId" => $_POST['userId'],"borrowerId" => $_SESSION['user_id']);
       $data = array("processed" => "Y");
       $this->mlogin->updateResponses($where,$data);
      
 }

 public function RequestResponse()
 {  
      $RequestResponse = $this->mlogin->RequestResponse(); 
      if(!empty($RequestResponse))
      {
            foreach($RequestResponse as $request)
            {
                  echo "".$request['lenderId']." has decline your request";
            }
      }     
 }

 public function updateNotificationResponse()
 {
      $updateNotificationResponse = $this->mlogin->updateNotificationResponse();
 }
 public function updateNotificationClose()
 {
      $updateNotificationClose = $this->mlogin->updateNotificationClose();
 }


 public function UpdateChatForsa()
 {
      $UpdateChatForsa = $this->mlogin->UpdateChatForsa();
 }

 public function updateborrowerRequest()
 {
      $updateborrowerRequest = $this->mlogin->updateborrowerRequest();
 }

 public function updateRequestSend()
 {
       //echo $_POST['lenderId'];
       $userDetails = $this->mlogin->updateRequestSend();
 }

 //Function for get Borrowers Rate of Interest
 public function LatestBanksInterest()
 {
  $userId = $_SESSION['user_id'];
  $lenderinterest = $this->mlogin->lenderbankInterests($userId);

  echo '<div class="mytables" id="lenderinterest">
        <div class="row">
        <div class="interest" data-value="TN" >' . $lenderinterest['TN'] . '</div>
        <div class="interest" data-value="1week" >' . $lenderinterest['1week'] . '</div>
        <div class="interest" data-value="2weeks" >' . $lenderinterest['2weeks'] . '</div>
        <div class="interest" data-value="3weeks" >' . $lenderinterest['3weeks'] . '</div>
        <div class="interest" data-value="1month" >' . $lenderinterest['1month'] . '</div>
        <div class="interest" data-value="2month" >' . $lenderinterest['2month'] . '</div>
        <div class="interest" data-value="3month" >' . $lenderinterest['3month'] . '</div>
        <div class="interest" data-value="4month" >' . $lenderinterest['4month'] . '</div>
        <div class="interest" data-value="5month" >' . $lenderinterest['5month'] . '</div>
        <div class="interest" data-value="6month" >' . $lenderinterest['6month'] . '</div>
        <div class="interest" data-value="7month" >' . $lenderinterest['7month'] . '</div>
        <div class="interest" data-value="8month" >' . $lenderinterest['8month'] . '</div>
        <div class="interest" data-value="9month" >' . $lenderinterest['9month'] . '</div>
        <div class="interest" data-value="10month" >' . $lenderinterest['10month'] . '</div>
        <div class="interest" data-value="11month" >' . $lenderinterest['11month'] . '</div>
        <div class="interest" data-value="12month" >' . $lenderinterest['12month'] . '</div>
        <div class="interest" data-value="2year" >' . $lenderinterest['2year'] . '</div>
        <div class="interest" data-value="3year" >' . $lenderinterest['3year'] . '</div>
        <div class="interest" data-value="4year" >' . $lenderinterest['4year'] . '</div>
        <div class="interest" data-value="5year" >' . $lenderinterest['5year'] . '</div></div>
        </div>';
 }

 public function KontakteLatestBanksInterest()
 {
  $userId = $_POST['customerid'];
  $lenderinterest = $this->mlogin->kontaktelenderbankInterests($userId);

  echo '<div class="mytables" id="lenderinterest">
        <div class="row">
        <div class="interest" data-value="TN" >' . $lenderinterest['TN'] . '</div>
        <div class="interest" data-value="1week" >' . $lenderinterest['1week'] . '</div>
        <div class="interest" data-value="2weeks" >' . $lenderinterest['2weeks'] . '</div>
        <div class="interest" data-value="3weeks" >' . $lenderinterest['3weeks'] . '</div>
        <div class="interest" data-value="1month" >' . $lenderinterest['1month'] . '</div>
        <div class="interest" data-value="2month" >' . $lenderinterest['2month'] . '</div>
        <div class="interest" data-value="3month" >' . $lenderinterest['3month'] . '</div>
        <div class="interest" data-value="4month" >' . $lenderinterest['4month'] . '</div>
        <div class="interest" data-value="5month" >' . $lenderinterest['5month'] . '</div>
        <div class="interest" data-value="6month" >' . $lenderinterest['6month'] . '</div>
        <div class="interest" data-value="7month" >' . $lenderinterest['7month'] . '</div>
        <div class="interest" data-value="8month" >' . $lenderinterest['8month'] . '</div>
        <div class="interest" data-value="9month" >' . $lenderinterest['9month'] . '</div>
        <div class="interest" data-value="10month" >' . $lenderinterest['10month'] . '</div>
        <div class="interest" data-value="11month" >' . $lenderinterest['11month'] . '</div>
        <div class="interest" data-value="12month" >' . $lenderinterest['12month'] . '</div>
        <div class="interest" data-value="2year" >' . $lenderinterest['2year'] . '</div>
        <div class="interest" data-value="3year" >' . $lenderinterest['3year'] . '</div>
        <div class="interest" data-value="4year" >' . $lenderinterest['4year'] . '</div>
        <div class="interest" data-value="5year" >' . $lenderinterest['5year'] . '</div></div>
        </div>';
 }

 public function AdminAcceptResponse()
 {
      $userDetails = $this->mlogin->AdminAcceptResponse();
 }

 public function interestsofbank()
 {
  $current_date = date("Y-m-d");
  $data = array('TN' => $_REQUEST['Tagesgeld'], '1week' => $_REQUEST['oneWoche'], '2weeks' => $_REQUEST['twoWoche'], '3weeks' => $_REQUEST['threeWoche'], '1month' => $_REQUEST['oneMonat'], '2month' => $_REQUEST['twoMonat'], '3month' => $_REQUEST['threeMonat'], '4month' => $_REQUEST['fourMonat'], '5month' => $_REQUEST['fiveMonat'], '6month' => $_REQUEST['sixMonat'], '7month' => $_REQUEST['sevenMonat'], '8month' => $_REQUEST['eightMonat'], '9month' => $_REQUEST['nineMonat'], '10month' => $_REQUEST['tenMonat'], '11month' => $_REQUEST['elevenMonat'], '12month' => $_REQUEST['twelevMonat'], '2year' => $_REQUEST['twoJahre'], '3year' => $_REQUEST['threeJahre'], '4year' => $_REQUEST['fourJahre'], '5year' => $_REQUEST['fiveJahre'], 'status' => 'Y', 'added_on' => $current_date, 'bank_id' => $_SESSION['user_id']);
  $where = array('bank_id' => $_SESSION['user_id']);
  $Interest = $this->mlogin->insertInterest($data, $where);
 }

 public function updatelenderstatus()
 {
  $status = $_REQUEST['status'];
  $bank_id = $_SESSION['user_id'];
  $lenderId = $_REQUEST['lenderId'];
  $updatestats = $this->mlogin->updatelenderstatus($status, $bank_id, $lenderId);
 }

 public function lendersBank()
 {
  $lendersBank = $this->mlogin->lendersBank($_REQUEST['term']);
  $this->mlogin->lenderTerm($_REQUEST['term'], $_SESSION['user_id']);
  $offBorrowers =  $this->mlogin->getoffBorrowers($_SESSION['user_id']);
  $off = explode(",",$offBorrowers['offborrowers']);
  $term = $_REQUEST['term'];

  foreach ($lendersBank as $bank) {
   if (!empty($bank['' . $term . '']) && !in_array($bank['bank_id'], $off)) {
    $bank = '<tbody><tr><td><button class="btn-innfo"> INFO </button></td><td>' . $bank['company_name'] . '</td><td>' . $bank['' . $term . ''] . '</td>
            <td> <button id="lend-id"> Lend </button> </td>
            </tr></tbody>';
    echo $bank;
   }
  }
 }
 public function kontaktelendersBank()
 {
      //  echo $_REQUEST['customerId'];
      //  exit();
   $lendersBank = $this->mlogin->kontaktelendersBank($_REQUEST['term']);
//    print_r($lendersBank);
//    exit();
   $this->mlogin->kontaktelenderTerm($_REQUEST['term'],  base64_decode($_REQUEST['customerId']));
   //exit();
//   $offBorrowers =  $this->mlogin->getoffBorrowers($_SESSION['user_id']);
//   $off = explode(",",$offBorrowers['offborrowers']);
//   $term = $_REQUEST['term'];

  foreach ($lendersBank as $bank) {
   //if (!empty($bank['' . $term . '']) && !in_array($bank['bank_id'], $off)) {
    $bank = '<tbody><tr><td><button class="btn-innfo"> INFO </button></td><td>' . $bank['company_name'] . '</td><td>' . $bank['' . $term . ''] . '</td>
            <td> <button id="lend-id"> Lend </button> </td>
            </tr></tbody>';
    echo $bank;
 
  }
 }

 public function updatedcheckbox()
 {
  $user = $_SESSION['user_id'];
  $userId = array();
  $userDetails = $this->mlogin->getloginUserDetails($user);
  $lendersBank = $this->mlogin->bankList($userDetails[0]['clientgroup']);
  foreach ($lendersBank as $lenders) {$userId[] = $lenders['userId'];}
  $offborrower = explode(',', $userDetails[0]['offborrowers']);
  $allBanks = $this->mlogin->allbankList($_SESSION['user_id']);
  echo '<table class="" id=""><thead><tr><th>Bank</th></tr></thead>';

  foreach ($allBanks as $bank) {
   echo '<tbody><tr class="" data-value=""><td><label class="container-box">' . $bank['company_name'] . '
      <input type="checkbox" class="lendercheck" data-value="' . $bank['userId'] . '"  data-id="' . $bank['userId'] . '" name="' . $bank['company_name'] . '"  <?php if (!in_array(' . $bank['userId'] . ', $offborrower) && in_array(' . $bank['userId'] . ',$userId) ) {echo "checked=checked";}?>>
      <span class="checkmark" ></span></label></td></tr></tbody>';
  }
 }

 public function unpublishInterest()
 {
  $data = array('status' => 'N');
  $where = array('bank_id' => $_SESSION['user_id']);
  $Unpublish = $this->mlogin->unpublish($data, $where);
 }

 //Function for login of all Users
 public function login()
 {
      $uname = $_REQUEST['username'];
      $pwd = $_REQUEST['password'];
   
    
       $userData = $this->mlogin->getUserInfoWherelogin(array('uname' => $uname,'pwd' => $pwd));  
       if (!empty($userData)) {
        $pwInDatabase = $userData['pwd'];
         if (password_verify(''.$pwd.'', $pwInDatabase)) {
          if (hash_equals($_SESSION[$this->config->item('csrf_token_name')], $_POST['token'])) {
          
            $login_user["response"] = $userData;
            $_SESSION['randomFlagNumber'] = $randomFlagNumber = rand(00000, 99999);
            $_SESSION['user_id'] = $login_user["response"]["id"];
            $_SESSION['user_type'] = $login_user["response"]["user_type"];
            $_SESSION['user_name'] = $login_user["response"]["fname"] . " " . $login_user["response"]["lname"];
            $login_user["response"]['id'] = $this->mlogin->hasLoginStats($_SESSION['user_id']);
    
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
            {
             $currIpAdd = $_SERVER['HTTP_CLIENT_IP'];
            } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
            {
             $currIpAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
             $currIpAdd = $_SERVER['REMOTE_ADDR'];
            }
    
            $insertLoggedDetails = $this->mlogin->insertLoggedDetails($_SESSION['user_id'], $currIpAdd);
    
            /*------detect browser----*/
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version = "";
    
            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
             $platform = 'linux';
            } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
             $platform = 'mac';
            } elseif (preg_match('/windows|win32/i', $u_agent)) {
             $platform = 'windows';
            }
    
            // Next get the name of the useragent yes seperately and for good reason
            if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
             $bname = 'Internet Explorer';
             $ub = "MSIE";
            } elseif (preg_match('/Firefox/i', $u_agent)) {
             $bname = 'Mozilla Firefox';
             $ub = "Firefox";
            } elseif (preg_match('/Chrome/i', $u_agent)) {
             $bname = 'Google Chrome';
             $ub = "Chrome";
            } elseif (preg_match('/Safari/i', $u_agent)) {
             $bname = 'Apple Safari';
             $ub = "Safari";
            } elseif (preg_match('/Opera/i', $u_agent)) {
             $bname = 'Opera';
             $ub = "Opera";
            } elseif (preg_match('/Netscape/i', $u_agent)) {
             $bname = 'Netscape';
             $ub = "Netscape";
            }
    
            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
             ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
             // we have no matching number just continue
            }
    
            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
             //we will have two since we are not using 'other' argument yet
             //see if version is before or after the name
             if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
              $version = $matches['version'][0];
             } else {
              $version = $matches['version'][1];
             }
            } else {
             $version = $matches['version'][0];
            }
            if ($version == null || $version == "") {$version = "?";}
            $array = array(
             'userAgent' => $u_agent,
             'name' => $bname,
             'version' => $version,
             'platform' => $platform,
             'pattern' => $pattern,
            );
            $yourbrowser = $array['name'];
            $loggedInArray = array("loginBrowser" => $yourbrowser, "login_flag" => $_SESSION['randomFlagNumber']);
            $this->mlogin->updateUserLoggedDetails($_SESSION['user_id'], $loggedInArray);
            echo "1";
      
          } else {
           echo "securitybleach";
           exit();
          }
         } else {
          echo "false";
         }
       } else {
        echo "false";
       }

  
 }
 public function login6()
 {
      
  $uname = $_REQUEST['username'];
  //$pwd = password_hash($_REQUEST['password']);
  echo $pwd = password_hash($_REQUEST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
  //$captcha = $_REQUEST['captcha'];
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->form_validation->set_rules('username', 'lang:userName', 'trim|required|xss_clean');
  $this->form_validation->set_rules('password', 'lang:email', 'trim|required|xss_clean');
 // $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|xss_clean|numeric');

  if ($this->form_validation->run() == false) {
       
   echo validation_errors();
   exit();
  } else {
      
   $userData = $this->mlogin->getUserInfoWherelogin($uname,$pwd); 
   echo 'hello'; 
  echo $pwInDatabase = $userData['password'];
   if (!empty($userData)) {
     
      if (hash_equals($_SESSION[$this->config->item('csrf_token_name')], $_POST['token'])) {
           
       
        $login_user["response"] = $userData;
        $_SESSION['randomFlagNumber'] = $randomFlagNumber = rand(00000, 99999);
        $_SESSION['user_id'] = $login_user["response"]["id"];
        $_SESSION['user_type'] = $login_user["response"]["user_type"];
        $_SESSION['user_name'] = $login_user["response"]["fname"] . " " . $login_user["response"]["lname"];
        $login_user["response"]['id'] = $this->mlogin->hasLoginStats($_SESSION['user_id']);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
           
         $currIpAdd = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
           
         $currIpAdd = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
           
         $currIpAdd = $_SERVER['REMOTE_ADDR'];
        }

        $insertLoggedDetails = $this->mlogin->insertLoggedDetails($_SESSION['user_id'], $currIpAdd);

       
        $loggedInArray = array("loginBrowser" => "", "login_flag" => $_SESSION['randomFlagNumber']);
        $this->mlogin->updateUserLoggedDetails($_SESSION['user_id'], $loggedInArray);
        echo "1";
       
      } else {
           
       echo "securitybleach";
       exit();
      }
    
   } else {
   
    echo "false";
   }
  }
 }
 
 public function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds')
 {
  $sets = array();
  if (strpos($available_sets, 'l') !== false) {
   $sets[] = 'abcdefghjkmnpqrstuvwxyz';
  }

  if (strpos($available_sets, 'u') !== false) {
   $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
  }

  if (strpos($available_sets, 'd') !== false) {
   $sets[] = '23456789';
  }

  if (strpos($available_sets, 's') !== false) {
   $sets[] = '!@#$%&*?';
  }

  $all = '';
  $password = '';
  foreach ($sets as $set) {
   $password .= $set[array_rand(str_split($set))];
   $all .= $set;
  }
  $all = str_split($all);
  for ($i = 0; $i < $length - count($sets); $i++) {
   $password .= $all[array_rand($all)];
  }

  $password = str_shuffle($password);
  if (!$add_dashes) {
   return $password;
  }

  $dash_len = floor(sqrt($length));
  $dash_str = '';
  while (strlen($password) > $dash_len) {
   $dash_str .= substr($password, 0, $dash_len) . '-';
   $password = substr($password, $dash_len);
  }
  $dash_str .= $password;
  return $dash_str;
 }

 public function forgot_password()
 {
       
  if (hash_equals($_SESSION[$this->config->item('csrf_token_name')], $_POST['token'])) {
        
    $username = $_REQUEST['username'];
  

    $userData = $this->mlogin->getUserInfoWherelogin2($username);
    if (empty($userData)) { echo "false";
 }else{
    $password = substr(md5(date('YidMHs') . rand()), rand(0, 20), 8);
    //$password = $this->generateStrongPassword();
    $result = $this->mlogin->forgot_password($username, $password);
    if ($result == false) {
     echo 'false';
    } else {
   
     $pref_lang = $userData['preferredLanguage'];
     $this->load->library('email');
     $message = 'Guten Tag ' . $userData['fname'] . ' ' . $userData['lname'] . '<br/><br/>';
     $message .= 'Ihr neues Passwort ist : ' . $password . '<br/><br/>';
     $message .= 'Freundliche Gr&uuml;sse<br/><br/>';
     $message .= "Instimatch-Vicenda AG <br>";
     $message .= "Pfingstweidstrasse 3  <br>";
     $message .= "CH-8005 Z&uuml;rich  <br>";
     $message .= "+41 44  521 01 30 <br>";
     $message .= "admin@instimatch.ch";
     $this->email->set_mailtype("html");
     $this->email->subject("Forgot Password");
     $this->email->from("admin@instimatch.ch");
     $this->email->to($userData['email']);
     $this->email->message($message);
     $sent = $this->email->send(); 
     echo 'true';

    }
}
  } else {
   // Log this as a warning and keep an eye on these attempts
   echo "securitybleach";
   exit();
  }
 }

      public function UpdateContactForsa()
      {
      //      echo $_POST['NotificationId'].'<br>'; 
      //      echo $_POST['Notificationresponse'];
            echo $result = $this->mlogin->UpdateContactForsa();
      }

}
