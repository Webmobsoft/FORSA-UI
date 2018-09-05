<?php if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class mlogin extends CI_Model
{
 public function __construct()
 {  
  parent::__construct();
  $this->load->database();
  
 }

 public function lenderdetails($lenderId)
 {
  $this->db->select("id,city,fname,lname,email,zip_code,contact_number,street,biccode,company_name");
  $this->db->from("tbl_users");
  $this->db->where("user_type", "lender");
  $this->db->where("status", 'y');
  $this->db->where("id", $lenderId);
  $result = $this->db->get();
  return $result->row_array();
 }

 public function insertDealEmailDetails($customerId,$subject,$message,$date)
 {
     $data['to'] = $customerId;
     $data['subject'] = $subject;
     $data['message	'] = $message;
     $data['sent_at'] = $date;
     $this->db->insert("tbl_confirmation_email",$data);
 }
 public function getoffBorrowers($id)
 {
    $this->db->select("offborrowers");
    $this->db->from("tbl_users");
    $this->db->where("id", $id);
    $result = $this->db->get();
    return $result->row_array();

 }

 public function getLenderBorrower($NotificationId)
 {

    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("id", $NotificationId);
    $this->db->where("processed","N");
    $result = $this->db->get();
    return $result->result_array();

 }

 public function getClientSubGroups()
 {
    $this->db->select("category");
    $this->db->from("tbl_category");
    $this->db->where("active","Y");
    $result = $this->db->get();
    return $result->result_array();

 }

 public function lendersBank($term)
 {
  $sql = "SELECT i.bank_id,i.$term,u.id as userId,u.fname,u.lname,u.company_name FROM tbl_rate_of_interest as i JOIN tbl_users as u ON i.bank_id = u.id WHERE i.status='Y' AND i.$term != '' AND u.status='y' ORDER BY i.$term DESC, ABS(i.$term)";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }
 public function kontaktelendersBank($term)
 {
  $sql = "SELECT i.bank_id,i.$term,u.id as userId,u.fname,u.lname,u.company_name FROM tbl_rate_of_interest as i JOIN tbl_users as u ON i.bank_id = u.id WHERE i.status='Y' AND i.$term != '' AND u.status='y' ORDER BY i.$term DESC, ABS(i.$term)";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }

 public function getAdminRequestResponse($borrowerId)
 {
    $this->db->select("id,lenderId,borrowerId,amount,start_date,end_date,interest,interest_rate,no_of_days,payments");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $borrowerId);
    $this->db->where("processed","Y");
    $this->db->where("adminView","Y");
    $this->db->where("admin_accept_response","Y");
    $this->db->where("admin_decline_response","N");
    $this->db->where("admin_accept_process","N");
    $this->db->where("chat_with_forsa","Y");
    $result = $this->db->get();
    return $result->result_array();
   //echo $borrowerId;
 }
 public function getAdminRequestdeclineResponse($borrowerId)
 {
    $this->db->select("id,lenderId,borrowerId,amount,start_date,end_date,interest,interest_rate,no_of_days,payments");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $borrowerId);
    $this->db->where("processed","Y");
    $this->db->where("adminView","Y");
    $this->db->where("admin_accept_response","N");
    $this->db->where("admin_decline_response","Y");
    $this->db->where("admin_decline_process","N");
    $this->db->where("chat_with_forsa","Y");
    $result = $this->db->get();
    return $result->result_array();

 }
 public function getAdminResponse($lenderId)
 {
    $this->db->select("id,lenderId,borrowerId,amount,start_date,end_date,interest,interest_rate,no_of_days,payments");
    $this->db->from("tbl_lenders_request");
    $this->db->where("lenderId", $lenderId);
    $this->db->where("processed","Y");
    $this->db->where("adminView","Y");
    $this->db->where("admin_accept_response","Y");
    $this->db->where("admin_accept_process","N");
    $this->db->where("chat_with_forsa","Y");
    $this->db->where("admin_response","N");
    $result = $this->db->get();
    return $result->result_array();


 }
 public function updateAdminResponses($where,$data)
 {
     $this->db->update('tbl_lenders_request',$data,$where);

 }
 public function getAdminDeclineResponse($lenderId)
 {
    $this->db->select("id,lenderId,borrowerId,amount,start_date,end_date,interest,interest_rate,no_of_days,payments");
    $this->db->from("tbl_lenders_request");
    $this->db->where("lenderId", $lenderId);
    $this->db->where("processed","Y");
    $this->db->where("adminView","Y");
    $this->db->where("admin_decline_response","Y");
    $this->db->where("admin_decline_process","N");
    $this->db->where("chat_with_forsa","Y");
    $this->db->where("admin_response","N");
    $result = $this->db->get();
    return $result->result_array();


 }

 public function updateAdminAcceptResponse($id)
 {
    $data['admin_accept_process'] = "Y";
    $data['admin_client_deal_accepted'] = "Y";
    $where['id'] = $id;
    $this->db->update("tbl_lenders_request", $data, $where);

 }
 public function updateAdminDeclineResponse($id)
 {
    $data['admin_decline_process'] = "Y";
    $data['admin_client_deal_rejected'] = "Y";
    $where['id'] = $id;
    $this->db->update("tbl_lenders_request", $data, $where);

 }

 public function lenderTerm($term, $lender)
 {
  $data['lenderselectedterm'] = $term;
  $where['id'] = $lender;
  $this->db->update("tbl_users", $data, $where);
 }

 public function kontaktelenderTerm($term, $lender)
 {
  $data['lenderselectedterm'] = $term;
  $where['id'] = $lender;
  $this->db->update("tbl_customers", $data, $where);
//   echo $this->db->last_query();
//   exit();
 }



 public function updateborrowerRequest()
 {
     $data = array("borrowerstatus" => 'Y',"interest_rate" => $_REQUEST['interest_rate']);
     $where = array("id" => $_REQUEST['requestId']);
     $this->db->update('tbl_lenders_request',$data,$where);
 }
 public function TicketNumber(){
    $query = "SELECT ticketIncrementor FROM tbl_lenders_request WHERE accept = 'Y' OR admin_accept_response = 'Y' ORDER BY id DESC LIMIT 1;";
    $query = $this->db->query($query);
    $res = $query->result_array();
    if(!empty($res[0]['ticketIncrementor'])){
    $ticketIncre = $res[0]['ticketIncrementor'] + 1;
    $ticketIncre = str_pad($ticketIncre, 5, "0", STR_PAD_LEFT);  //00002
    }else{
        $ticketIncre = "00001";
    }
    return $ticketIncre;

 }

 public function updateResponse($NotificationId,$ticketNumber,$ticketIncre,$dealdate,$dealtime)
 {
    $data = array("ticket_number" => $ticketNumber,"ticketIncrementor" => $ticketIncre,"accept" => 'Y',"complete_deal_date" => $dealdate,"complete_deal_time" => $dealtime);
    $where = array("id" => $NotificationId);
    $this->db->update('tbl_lenders_request',$data,$where);
 }

 public function updateResponses($where,$data)
 {
     
     $this->db->update("tbl_lenders_request",$data,$where);
     //echo $this->db->last_query();

 }
 public function getUser($userId)
 {
   // $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'Y');
    $this->db->where("accept",'Y');
    $this->db->where("processed",'N');
    $result = $this->db->get();
    return $result->result_array();

 }

 public function getDeclineUser($userId)
 {
   // $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'Y');
    $this->db->where("decline",'Y');
    $this->db->where("processed",'N');
    $result = $this->db->get();
    return $result->result_array();

 }

 public function updatePdf($fileName)
 {
     $userId = $_SESSION['user_id'];
     $SQL = "UPDATE tbl_users SET pdf_file = CONCAT(pdf_file,',$fileName') WHERE id = $userId";
     $query = $this->db->query($SQL);
    //  echo $this->db->last_query();
    //  exit();

 }

 public function getuserpdf()
 {
    $userId = $_SESSION['user_id'];
    $this->db->select("pdf_file");
    $this->db->from("tbl_users");
    $this->db->where("id", $userId);
    $result = $this->db->get();
    return $result->row_array();

 }

 public function getborroweruserpdfs($userId)
 {
    
    $this->db->select("pdf_file,company_name,street,zip_code,city");
    $this->db->from("tbl_users");
    $this->db->where("id", $userId);
    $result = $this->db->get();
    return $result->row_array();

 }

 public function delupdatepdf($pdfName)
 {
    $userId = $_SESSION['user_id'];
    $SQL = "UPDATE tbl_users SET pdf_file = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', pdf_file, ','), ',$pdfName,', ',')) WHERE id = $userId";
    $query = $this->db->query($SQL);
    echo "true";


 }


 public function updateNotificationResponse()
 {
    $query = "SELECT ticketIncrementor FROM tbl_lenders_request WHERE (admin_decline_response = 'Y' OR decline = 'Y') ORDER BY id DESC LIMIT 1;";
    $query = $this->db->query($query);
    $res = $query->result_array();
    if(!empty($res[0]['ticketIncrementor'])){
    $ticketIncre = $res[0]['ticketIncrementor'] + 1;
    $ticket_number = str_pad($ticketIncre, 6, "0", STR_PAD_LEFT);  //00002
    }else{
        $ticket_number = "000001";
    }
    // echo $ticket_number;
    // exit();

    // $random = rand(10000,99999);
    $NotiId = $_POST['NotificationId'];
    $colum = $_POST['Notificationresponse'];

    // $ticket_number = "200".$random;
    // $data = array("ticket_number" => $ticket_number,"".$_POST['Notificationresponse']."" => "Y","ticketIncrementor" =>$ticket_number);
    // $where = array("id" => $_POST['NotificationId']);
    // print_r($data);
    // print_r($where);
    // exit();
    $SQL = "UPDATE tbl_lenders_request SET ticket_number = '$ticket_number', $colum ='Y',ticketIncrementor = '$ticket_number' WHERE id = $NotiId";
//    echo $SQL;
//    exit();
    $query = $this->db->query($SQL);
    //$this->db->update('tbl_lenders_request',$data,$where);
    // echo $this->db->last_query();
    // exit();
    //echo $_POST['NotificationId']; 
 }

 public function updateNotificationClose()
 {
    $data = array("deal_response" => "Y");
    $where = array("id" => $_POST['NotificationId']);
    $this->db->update('tbl_lenders_request',$data,$where);
    //echo $this->db->last_query();
    // exit();
    //echo $_POST['NotificationId']; 
 }



 public function UpdateChatForsa()
 {
    $data = array("".$_POST['Notificationresponse']."" => "Y","processed" => "Y");
    $where = array("id" => $_POST['NotificationId']);
    $this->db->update('tbl_lenders_request',$data,$where);
    // return $_POST['NotificationId'];
 }


 public function UpdateChatDescription()
 {
    $data = array("chat_with_forsa" => "Y","processed" => "Y","chat_description" => $_POST['chatdescription'] );
    $where = array("id" => $_POST['NotificationId']);
    $this->db->update('tbl_lenders_request',$data,$where);
    echo 'true';
 }

 public function RequestResponse()
 {
    $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'Y');
    $this->db->where("decline",'Y');
    $result = $this->db->get();
    return $result->result_array();


 }

 public function LenderNotification()
 {
    $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("lenderId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'Y');
    $this->db->where("accept",'N');
    $this->db->where("decline",'N');
    $this->db->where("chat_with_forsa",'N');
    $this->db->where("deal_response",'N');
    $result = $this->db->get();
    return $result->result_array();

 }

public function ChatLenderNotification()
 {
    $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("lenderId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'Y');
    $this->db->where("accept",'N');
    $this->db->where("decline",'N');
    $this->db->where("chat_with_forsa",'N');
    $result = $this->db->get();
    return $result->result_array();

 }

 public function BankDetails($bank_id)
 {
  $this->db->select("id,city,fname,lname,email,zip_code,contact_number,street,biccode,company_name,pwd,owner_account,bank,iban_number,Prefex,Title,uname,clientgroup");
  $this->db->from("tbl_users");
  $this->db->where("status", 'y');
  $this->db->where("id", $bank_id);
  $result = $this->db->get();
  return $result->row_array();
 }
 public function updateUserDetails()
 {
     $data['company_name'] = $_POST['company_name'];
     $data['street'] = $_POST['street'];
     $data['zip_code'] = $_POST['zip_code'];
     $data['city'] = $_POST['city'];
     $data['bank'] = $_POST['bank'];
     $data['iban_number'] = $_POST['iban_number'];
     $data['biccode'] = $_POST['biccode'];
     $data['Prefex'] = $_POST['Prefex'];
     $data['zip_code'] = $_POST['zip_code'];
     $data['Title'] = $_POST['Title'];
     $data['fname'] = $_POST['fname'];
     $data['lname'] = $_POST['lname'];
     $data['email'] = $_POST['email'];
    // $data['uname'] = $_POST['uname'];
     $data['contact_number'] = $_POST['contact_number'];
     $data['clientgroup'] = $_POST['clientgroup'];

     $where['id'] = $_SESSION['user_id'];

     $this->db->update("tbl_users",$data,$where);
     echo 'true';
 }
 public function updatekontakteUserDetails()
 {
     $data['Name_company'] = $_POST['company_name'];
     $data['address'] = $_POST['street'];
    //  $data['zip_code'] = $_POST['zip_code'];
      $data['place'] = $_POST['city'];
    //  $data['bank'] = $_POST['bank'];
    //  $data['iban_number'] = $_POST['iban_number'];
    //  $data['biccode'] = $_POST['biccode'];
     $data['salutation'] = $_POST['Prefex'];
    //  $data['zip_code'] = $_POST['zip_code'];
     $data['title'] = $_POST['Title'];
     $data['first_name'] = $_POST['fname'];
     $data['Surname'] = $_POST['lname'];
     $data['email'] = $_POST['email'];
    // $data['uname'] = $_POST['uname'];
     $data['contact_number'] = $_POST['contact_number'];
     $data['client_group'] = $_POST['clientgroup'];
     $where['id'] = base64_decode($_POST['customerid']);
    //  print_r($data);
    //  print_r($where);
     $this->db->update("tbl_customers",$data,$where);
    //  echo $this->db->last_query();
    //  exit();
     echo 'true';
 }

 public function checkusername()
 {
    $this->db->select("id");
    $this->db->from("tbl_users");
    $this->db->where("uname", $_POST['username']);
    //$this->db->where("status","Y");
    $result = $this->db->get();
    return $result->row_array();

 }

 public function allbankList($userId)
 {
  $this->db->select("id as userId,company_name");
  $this->db->from("tbl_users");
  $this->db->where("(user_type", 'borrower');
  $this->db->or_where("user_type = 'both')");
  $this->db->where("id !=", $userId);
  $this->db->where("status", 'y');
  $result = $this->db->get();
  return $result->result_array();
 }

 public function maturities($userId)
 {
    $date = date("d/m/Y");
    $query = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y' OR `admin_accept_response` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y')";
    $query = $this->db->query($query);
     $res = $query->result_array();
     return $res;     
 }
 public function Borrowermaturities($userId)
 {
    $date = date("d/m/Y");
    $query = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y' OR `admin_accept_response` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `borrowerId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y')";
    $query = $this->db->query($query);
     $res = $query->result_array();
     return $res;     
 }

 public function historymaturities($userId)
 {
    $date = date("d/m/Y");
    $query = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' ";
    $query = $this->db->query($query);
     $res = $query->result_array();
     return $res;     
 }
 public function Borrowerhistorymaturities($userId)
 {
    $date = date("d/m/Y");
    $query = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `borrowerId` = '$userId' ";
    $query = $this->db->query($query);
     $res = $query->result_array();
     return $res;     
 }

 public function getCompletebanks()
 {
     $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND (r.TN !=' ' OR r.1week != ' ' OR r.2weeks != ' ' OR r.3weeks != ' ' OR r.1month != ' ' OR r.2month != ' ' OR r.3month != ' ' OR r.4month != ' 'OR r.5month != ' ' OR r.6month != ' ' OR r.7month != ' '  OR r.8month != ' '  OR r.9month != ' ' OR r.10month != ' ' OR r.11month != ' ' OR r.12month != ' ' OR r.2year != ' ' OR r.3year != ' '  OR r.4year != ' ' OR r.5year != ' ') ORDER BY companyName";

    // $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both')";
     $query = $this->db->query($query);
     $res = $query->result_array();
    //  echo $this->db->last_query();
    //  exit();
     return $res;
    // $this->db->select("u.company_name as companyName,tbl_rate_of_interest.*");
    // $this->db->from("tbl_users as u");
    // $this->db->join("tbl_rate_of_interest","left","u.id = tbl_rate_of_interest.bank_id");
    // $this->db->where("u.status = y");
    // $result = $this->db->get();
    // echo $this->db->last_query();
    // exit();
 }
 public function getCompletesortedbanks($sort_by)
 {

    if($sort_by == "bank_id") {
        $query = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y'  order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0) , u.company_name ASC";

        //$query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND (r.TN !=' ' OR r.1week != ' ' OR r.2weeks != ' ' OR r.3weeks != ' ' OR r.1month != ' ' OR r.2month != ' ' OR r.3month != ' ' OR r.4month != ' 'OR r.5month != ' ' OR r.6month != ' ' OR r.7month != ' '  OR r.8month != ' '  OR r.9month != ' ' OR r.10month != ' ' OR r.11month != ' ' OR r.12month != ' ' OR r.2year != ' ' OR r.3year != ' '  OR r.4year != ' ' OR r.5year != ' ') ORDER BY u.company_name";

    }else{
        $query = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y' AND i.$sort_by != ''  order by i.$sort_by+0 DESC";
       // $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND r.$sort_by != '' ORDER BY r.$sort_by+0 DESC";

    }

    // $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both')";
     $query = $this->db->query($query);
     $res = $query->result_array();
    //  echo $this->db->last_query();
    //  exit();
     return $res;
    // $this->db->select("u.company_name as companyName,tbl_rate_of_interest.*");
    // $this->db->from("tbl_users as u");
    // $this->db->join("tbl_rate_of_interest","left","u.id = tbl_rate_of_interest.bank_id");
    // $this->db->where("u.status = y");
    // $result = $this->db->get();
    // echo $this->db->last_query();
    // exit();
 }

 public function getBlanksInterestBanks()
 {
    $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND r.TN = ' ' AND r.1week = ' ' AND r.2weeks = ' ' AND r.3weeks = ' ' AND r.1month = ' ' AND r.2month = ' ' AND r.3month = ' ' AND r.4month = ' ' AND r.5month = ' ' AND r.6month = ' ' AND r.7month = ' ' AND r.8month = ' ' AND r.9month = ' ' AND r.10month = ' ' AND r.11month = ' ' AND r.12month = ' ' AND r.2year = ' ' AND r.3year = ' ' AND r.4year = ' ' AND r.5year = ' '";

    // $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both')";
     $query = $this->db->query($query);
     $res = $query->result_array();
    //  echo $this->db->last_query();
    //  exit();
     return $res;
    // $this->db->select("u.company_name as companyName,tbl_rate_of_interest.*");
    // $this->db->from("tbl_users as u");
    // $this->db->join("tbl_rate_of_interest","left","u.id = tbl_rate_of_interest.bank_id");
    // $this->db->where("u.status = y");
    // $result = $this->db->get();
    // echo $this->db->last_query();
    // exit();
 }

 public function getBlanksInterestsortedBanks($sor_by)
 {
    $query = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join `tbl_users` as u ON i.bank_id = u.id WHERE i.status = 'Y' AND u.status ='y' AND i.$sor_by = '' order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0)";
    //$query = "SELECT u.company_name as companyName,i.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND i.$sort_by = '' order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0)";

    // $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both')";
     $query = $this->db->query($query);
     $res = $query->result_array();
    //  echo $this->db->last_query();
    //  exit();
     return $res;
    // $this->db->select("u.company_name as companyName,tbl_rate_of_interest.*");
    // $this->db->from("tbl_users as u");
    // $this->db->join("tbl_rate_of_interest","left","u.id = tbl_rate_of_interest.bank_id");
    // $this->db->where("u.status = y");
    // $result = $this->db->get();
    // echo $this->db->last_query();
    // exit();
 }

 public function getsortedData()
 {
    $sor_by = $_POST['sort'];
    if($sor_by == "bank_id")
    {
        $sql = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y'  order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0) , u.company_name ASC";
        //$sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_rate_of_interest` as i JOIN  `tbl_users` as u ON i.bank_id = u.id  WHERE  i.status = 'Y' AND u.status ='y' AND (i.TN !=' ' OR i.1week != ' ' OR i.2weeks != ' ' OR i.3weeks != ' ' OR i.1month != ' ' OR i.2month != ' ' OR i.3month != ' ' OR i.4month != ' 'OR i.5month != ' ' OR i.6month != ' ' OR i.7month != ' '  OR i.8month != ' '  OR i.9month != ' ' OR i.10month != ' ' OR i.11month != ' ' OR i.12month != ' ' OR i.2year != ' ' OR i.3year != ' '  OR i.4year != ' ' OR i.5year != ' ') ORDER BY u.company_name asc";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        // echo $this->db->last_query();
        // exit();
        return $res;

    }else{
         $sql = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y' AND i.$sor_by != ''  order by i.$sor_by+0 DESC";
        //exit();
        // echo $sql;
        // exit();
     //$sql = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y' order by i.$sor_by DESC";
     //$sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y' ORDER BY CASE WHEN i.$sor_by >= 0 THEN 0 ELSE 2 END, ABS(i.$sor_by)";
//exit();
        //$sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_rate_of_interest` as i JOIN  `tbl_users` as u ON i.bank_id = u.id  WHERE  i.status = 'Y' AND u.status ='y' AND (i.TN !=' ' OR i.1week != ' ' OR i.2weeks != ' ' OR i.3weeks != ' ' OR i.1month != ' ' OR i.2month != ' ' OR i.3month != ' ' OR i.4month != ' 'OR i.5month != ' ' OR i.6month != ' ' OR i.7month != ' '  OR i.8month != ' '  OR i.9month != ' ' OR i.10month != ' ' OR i.11month != ' ' OR i.12month != ' ' OR i.2year != ' ' OR i.3year != ' '  OR i.4year != ' ' OR i.5year != ' ') ORDER BY i.$sor_by desc";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
  
 }

 public function getmaturitysortedData($userId,$sor_by)
 {
    $date = date("d/m/Y");
    // echo $sor_by;
    // exit();
    if($sor_by == "lenderId" || $sor_by == "borrowerId"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY u.company_name DESC";
    }else if($sor_by == "interest_rate" || $sor_by == "amount"){

        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) DESC";
    }else{
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY i.$sor_by DESC";
    }
    
    //  echo $sql;
    //  exit();
    //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        // echo $this->db->last_query();
        // exit();
        return $res;
  }

  public function getmaturityborrowersortedData($userId,$sor_by)
 {
    $date = date("d/m/Y");
    // echo $sor_by;
    // exit();
    if($sor_by == "lenderId" || $sor_by == "borrowerId"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY u.company_name DESC";
    }else if($sor_by == "interest_rate" || $sor_by == "amount"){

        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) DESC";
    }else{
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY i.$sor_by DESC";
    }
    
    //  echo $sql;
    //  exit();
    //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        // echo $this->db->last_query();
        // exit();
        return $res;
  }


  public function getmaturitydescendingsortedData($userId,$sor_by)
  {
     $date = date("d/m/Y");
     // echo $sor_by;
     // exit();
     if($sor_by == "lenderId" || $sor_by == "borrowerId"){
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY u.company_name ASC";
     }else if($sor_by == "interest_rate" || $sor_by == "amount"){
 
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) ASC";
     }else{
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY i.$sor_by ASC";
     }
     
     //  echo $sql;
     //  exit();
     //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
         $query = $this->db->query($sql);
         $res = $query->result_array();
         // echo $this->db->last_query();
         // exit();
         return $res;
   }
   public function getmaturityborrowerdescendingsortedData($userId,$sor_by)
   {
      $date = date("d/m/Y");
      // echo $sor_by;
      // exit();
      if($sor_by == "lenderId" || $sor_by == "borrowerId"){
          $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY u.company_name ASC";
      }else if($sor_by == "interest_rate" || $sor_by == "amount"){
  
          $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) ASC";
      }else{
          $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' AND str_to_date(i.`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY i.$sor_by ASC";
      }
      
      //  echo $sql;
      //  exit();
      //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
          $query = $this->db->query($sql);
          $res = $query->result_array();
          // echo $this->db->last_query();
          // exit();
          return $res;
    }



  public function gethistorymaturitysortedData($userId,$sor_by)
 {
    $date = date("d/m/Y");
    // echo $sor_by;
    // exit();
    if($sor_by == "lenderId" || $sor_by == "borrowerId"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY u.company_name DESC";
    }else if($sor_by == "interest_rate" || $sor_by == "amount"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) DESC";
    }else{
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY i.$sor_by DESC";
    }
    
    //  echo $sql;
    //  exit();
    //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        // echo $this->db->last_query();
        // exit();
        return $res;
  }
  public function getborrowerhistorymaturitysortedData($userId,$sor_by)
 {
    $date = date("d/m/Y");
    // echo $sor_by;
    // exit();
    if($sor_by == "lenderId" || $sor_by == "borrowerId"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY u.company_name DESC";
    }else if($sor_by == "interest_rate" || $sor_by == "amount"){
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) DESC";
    }else{
        $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY i.$sor_by DESC";
    }
    
    //  echo $sql;
    //  exit();
    //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        // echo $this->db->last_query();
        // exit();
        return $res;
  }


  public function getdeschistorymaturitysortedData($userId,$sor_by)
  {
     $date = date("d/m/Y");
     // echo $sor_by;
     // exit();
     if($sor_by == "lenderId" || $sor_by == "borrowerId"){
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY u.company_name ASC";
     }else if($sor_by == "interest_rate" || $sor_by == "amount"){
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) ASC";
     }else{
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.lenderId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`lenderId` = '$userId' ORDER BY i.$sor_by ASC";
     }
     
     //  echo $sql;
     //  exit();
     //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
         $query = $this->db->query($sql);
         $res = $query->result_array();
         // echo $this->db->last_query();
         // exit();
         return $res;
   }
    
   public function getborrowerdeschistorymaturitysortedData($userId,$sor_by)
  {
     $date = date("d/m/Y");
     // echo $sor_by;
     // exit();
     if($sor_by == "lenderId" || $sor_by == "borrowerId"){
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY u.company_name ASC";
     }else if($sor_by == "interest_rate" || $sor_by == "amount"){
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY CAST(i.$sor_by AS SIGNED INTEGER) ASC";
     }else{
         $sql ="select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_lenders_request as i join  `tbl_users` as u ON i.borrowerId = u.id WHERE  (i.accept = 'Y' OR i.`admin_client_deal_accepted` = 'Y') AND i.`decline` = 'N' AND i.`admin_client_deal_rejected` = 'N' AND i.`borrowerId` = '$userId' ORDER BY i.$sor_by ASC";
     }
     
     //  echo $sql;
     //  exit();
     //     $sql = "SELECT * FROM (`tbl_lenders_request`) WHERE (accept = 'Y' OR `admin_client_deal_accepted` = 'Y') AND `decline` = 'N' AND `admin_client_deal_rejected` = 'N' AND `lenderId` = '$userId' AND str_to_date(`end_date`,'%d/%m/%Y') >= str_to_date('$date','%d/%m/%Y') ORDER BY $sor_by DESC";
         $query = $this->db->query($sql);
         $res = $query->result_array();
         // echo $this->db->last_query();
         // exit();
         return $res;
   }




 public function getsortedblankData()
 {

   $sor_by = $_POST['sort'];
   $sqlQuery = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join `tbl_users` as u ON i.bank_id = u.id WHERE i.status = 'Y' AND u.status ='y' AND i.$sor_by = '' order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0)";
   $query = $this->db->query($sqlQuery);
   $res = $query->result_array();
//    echo $this->db->last_query();
//    exit();
   return $res;
 
}


 


 public function lenderbankInterests($userId,$offborrowers)
 {
    //  echo $offborrowers;
    //  exit();
   // CAST(4 AS DECIMAL(4,3))

    $offborrower = trim($offborrowers,",");
    

    if(!empty($offborrower)){
    //     echo $offborrower;
    // exit();
  $query = "SELECT MAX(TN) as TN,MAX(1week) as 1week,MAX(2weeks) as 2weeks,MAX(3weeks) 3weeks,MAX(1month) as 1month,MAX(2month) as 2month,MAX(3month) as 3month,MAX(4month) as 4month,MAX(5month) as 5month,MAX(6month) as 6month,MAX(7month) as 7month,MAX(8month) as 8month,MAX(9month) as 9month,MAX(10month) as 10month,MAX(11month) as 11month,MAX(12month) as 12month,MAX(2year) as 2year,MAX(3year) as 3year,MAX(4year) as 4year,MAX(5year) as 5year FROM tbl_rate_of_interest JOIN tbl_users ON tbl_rate_of_interest.bank_id = tbl_users.id WHERE tbl_rate_of_interest.status = 'Y' AND tbl_users.status = 'y' AND  tbl_rate_of_interest.bank_id NOT IN($offborrower) AND  (NOT FIND_IN_SET($userId,tbl_rate_of_interest.off_lenders))";
    }else{
        // echo "Empty";
        // exit();
        $query = "SELECT MAX(TN) as TN,MAX(1week) as 1week,MAX(2weeks) as 2weeks,MAX(3weeks) 3weeks,MAX(1month) as 1month,MAX(2month) as 2month,MAX(3month) as 3month,MAX(4month) as 4month,MAX(5month) as 5month,MAX(6month) as 6month,MAX(7month) as 7month,MAX(8month) as 8month,MAX(9month) as 9month,MAX(10month) as 10month,MAX(11month) as 11month,MAX(12month) as 12month,MAX(2year) as 2year,MAX(3year) as 3year,MAX(4year) as 4year,MAX(5year) as 5year FROM tbl_rate_of_interest JOIN tbl_users ON tbl_rate_of_interest.bank_id = tbl_users.id WHERE tbl_rate_of_interest.status = 'Y' AND tbl_users.status = 'y' AND (NOT FIND_IN_SET($userId,tbl_rate_of_interest.off_lenders))";
    }
  $query = $this->db->query($query);
  $res = $query->result_array();
//   echo $this->db->last_query();
//   exit();
  return $res[0];
 }

 public function kontaktelenderbankInterests()
 {
   
      
        $query = "SELECT MAX(TN) as TN,MAX(1week) as 1week,MAX(2weeks) as 2weeks,MAX(3weeks) 3weeks,MAX(1month) as 1month,MAX(2month) as 2month,MAX(3month) as 3month,MAX(4month) as 4month,MAX(5month) as 5month,MAX(6month) as 6month,MAX(7month) as 7month,MAX(8month) as 8month,MAX(9month) as 9month,MAX(10month) as 10month,MAX(11month) as 11month,MAX(12month) as 12month,MAX(2year) as 2year,MAX(3year) as 3year,MAX(4year) as 4year,MAX(5year) as 5year FROM tbl_rate_of_interest JOIN tbl_users ON tbl_rate_of_interest.bank_id = tbl_users.id WHERE tbl_rate_of_interest.status = 'Y' AND tbl_users.status = 'y' ";
 
  $query = $this->db->query($query);
  $res = $query->result_array();
  return $res[0];
 }

 public function lendersortedbankInterests($userId,$offborrower)
 {
   $offborrowers = trim($offborrower,",");
//    echo $offborrowers;
//    exit();
//$query = "SELECT MAX(TN) as TN,MAX(1week) as 1week,MAX(2weeks) as 2weeks,MAX(3weeks) 3weeks,MAX(1month) as 1month,MAX(2month) as 2month,MAX(3month) as 3month,MAX(4month) as 4month,MAX(5month) as 5month,MAX(6month) as 6month,MAX(7month) as 7month,MAX(8month) as 8month,MAX(9month) as 9month,MAX(10month) as 10month,MAX(11month) as 11month,MAX(12month) as 12month,MAX(2year) as 2year,MAX(3year) as 3year,MAX(4year) as 4year,MAX(5year) as 5year,tbl_rate_of_interest.bank_id as bankId FROM tbl_rate_of_interest JOIN tbl_users ON tbl_rate_of_interest.bank_id = tbl_users.id WHERE tbl_rate_of_interest.status = 'Y' AND tbl_users.status = 'y' AND tbl_rate_of_interest.bank_id NOT IN('$offborrowers')";
  $query = "SELECT MAX(TN) as TN,MAX(1week) as 1week,MAX(2weeks) as 2weeks,MAX(3weeks) 3weeks,MAX(1month) as 1month,MAX(2month) as 2month,MAX(3month) as 3month,MAX(4month) as 4month,MAX(5month) as 5month,MAX(6month) as 6month,MAX(7month) as 7month,MAX(8month) as 8month,MAX(9month) as 9month,MAX(10month) as 10month,MAX(11month) as 11month,MAX(12month) as 12month,MAX(2year) as 2year,MAX(3year) as 3year,MAX(4year) as 4year,MAX(5year) as 5year,tbl_rate_of_interest.bank_id as bankId FROM tbl_rate_of_interest JOIN tbl_users ON tbl_rate_of_interest.bank_id = tbl_users.id WHERE tbl_rate_of_interest.status = 'Y' AND tbl_users.status = 'y' AND tbl_rate_of_interest.bank_id NOT IN('$offborrowers') AND (NOT FIND_IN_SET($userId,tbl_rate_of_interest.off_lenders))";
//   echo $query;
//   exit();
  $query = $this->db->query($query);
  $res = $query->result_array();
//   echo $this->db->last_query();
//   exit();
  return $res[0];
 }

 public function updatelenderstatus($status, $bank_id, $lenderId)
 {
  if ($status == "Y") {
   $SQL = "UPDATE tbl_rate_of_interest SET off_lenders = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', off_lenders, ','), ',$lenderId,', ',')) WHERE bank_id = $bank_id";
   $query = $this->db->query($SQL);
   echo "True";
  } else if ($status == "N") {
   $SQL = "UPDATE tbl_rate_of_interest SET off_lenders = CONCAT(off_lenders,',$lenderId') WHERE bank_id = $bank_id";
   $query = $this->db->query($SQL);
   echo "True";
  }
 }

 public function updateaccessclient()
 {
  $access_value = $_REQUEST['access_value'];
  $user_id = $_SESSION['user_id'];
  $status = $_REQUEST['status'];
  if ($status == "Y") {
   $SQL = "UPDATE tbl_users SET access_given_clientgroup = CONCAT(access_given_clientgroup,',$access_value') WHERE id = $user_id";
   $query = $this->db->query($SQL);
   echo "True";
  } else if ($status == "N") {
   $SQL = "UPDATE tbl_users SET access_given_clientgroup = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', access_given_clientgroup, ','), ',$access_value,', ',')) WHERE id = $user_id";
   $query = $this->db->query($SQL);
   echo "True";
  }
 }

 public function bankInterests($userId)
 {
  $this->db->select("*");
  $this->db->from("tbl_rate_of_interest");
  $this->db->where("bank_id", $userId);
  $result = $this->db->get();
  return $result->row_array();
 }

 public function lendersList()
 {
  $this->db->select("id,city,fname,lname");
  $this->db->from("tbl_users");
  $this->db->where("user_type", "lender");
  $this->db->where("status", 'y');
  $result = $this->db->get();
  return $result->result_array();
 }

 public function unpublish($data, $where)
 {
  $updateId = $this->db->update('tbl_rate_of_interest', $data, $where);
  if ($updateId > 0) {
   echo 'true';
  } else {
   echo 'false';
  }
 }

 public function insertInterest($data, $where)
 {
  $this->db->where('bank_id', $data['bank_id']);
  $q = $this->db->get('tbl_rate_of_interest');
  if ($q->num_rows() > 0) {
   $updateId = $this->db->update('tbl_rate_of_interest', $data, $where);
   if ($updateId > 0) {
    echo 'true';
   } else {
    echo 'false';
   }
  } else {
   $insertId = $this->db->insert('tbl_rate_of_interest', $data);
   if ($insertId > 0) {
    echo 'true';
   } else {
    echo 'false';
   }
  }
 }

 public function lenderviewsection()
 {
  $data = array('lenderviewsection' => $_REQUEST['settingValue']);
  $where = array('id' => $_SESSION['user_id']);
  $this->db->update('tbl_users', $data, $where);
  echo 'true';
 }
 public function kontaktelenderviewsection()
 {
  $data = array('lenderviewsection' => $_REQUEST['settingValue']);
  $where = array('id' => base64_decode($_REQUEST['customerid']));
  $this->db->update('tbl_customers', $data, $where);
  echo 'true';
 }

 public function lendersettledview()
 {
  $data = array('settledlenderview' => $_REQUEST['view']);
  $where = array('id' => $_SESSION['user_id']);
  $this->db->update('tbl_users', $data, $where);
  echo 'true';
 }
 
 public function allBanksListupdate()
 {
  $data = array('settledlenderview' => $_REQUEST['settingValue']);
  $where = array('id' => $_SESSION['user_id']);
  $this->db->update('tbl_users', $data, $where);
  echo 'true';
 }


 public function getBankInterest()
 {
  $this->db->select("*");
  $this->db->from("tbl_rate_of_interest");
  $this->db->where("bank_id", $_REQUEST['bankId']);
  $result = $this->db->get();
  return $result->row_array();
 }

 public function getBankName()
 {
  $this->db->select("company_name");
  $this->db->from("tbl_users");
  $this->db->where("id", $_REQUEST['borrowerId']);
  $result = $this->db->get();
  return $result->row_array();
 }

 public function hasLoginStats()
 {
  $query = null;
  $query = $this->db->get_where('tbl_user_status', array('user_id' => $_SESSION['user_id']));
  $row = $query->num_rows();
  if ($row == 0) {
   $addlogin = array('user_id' => $_SESSION['user_id'], 'is_logged' => 1);
   $this->db->set('last_login', 'now()', false)->insert("tbl_user_status", $addlogin);
  } else {
   $updatelogin = array('is_logged' => 1);
   $this->db->where("user_id", $_SESSION['user_id']);
   $this->db->set('last_login', 'now()', false)->update("tbl_user_status", $updatelogin);
  }
 }

 public function onlyviewhasLoginStats($userId)
 {
  $query = null;
  $query = $this->db->get_where('tbl_view_user_status', array('user_id' => $userId));
  $row = $query->num_rows();
  if ($row == 0) {
   $addlogin = array('user_id' => $userId, 'is_logged' => 1);
   $this->db->set('last_login', 'now()', false)->insert("tbl_view_user_status", $addlogin);
  } else {
   $updatelogin = array('is_logged' => 1);
   $this->db->where("user_id", $userId);
   $this->db->set('last_login', 'now()', false)->update("tbl_view_user_status", $updatelogin);
  }
 }

 public function insertLoggedDetails($userId, $currIpAdd)
 {
  $currTime = date("Y-m-d H:i:s");
  $dataValues = array("user_id" => $userId, "last_login" => $currTime, "ip_address" => $currIpAdd, "is_logged" => 'y');
  $this->db->insert("tbl_user_logged_status", $dataValues);
 }

 public function insertviewonlyLoggedDetails($userId, $currIpAdd)
 {
  $currTime = date("Y-m-d H:i:s");
  $dataValues = array("user_id" => $userId, "last_login" => $currTime, "ip_address" => $currIpAdd, "is_logged" => 'y');
  $this->db->insert("tbl_view_user_logged_status", $dataValues);
 }

 public function insertLogOutDetails($userId, $currIpAdd)
 {
  $currTime = date("Y-m-d H:i:s");
  $dataVal = array("user_id" => $userId, "last_logout" => $currTime, "ip_address" => $currIpAdd, "is_logged" => 'n');
  $this->db->insert("tbl_user_logged_status", $dataVal);
 }

 public function insertviewuserLogOutDetails($userId, $currIpAdd)
 {
  $currTime = date("Y-m-d H:i:s");
  $dataVal = array("user_id" => $userId, "last_logout" => $currTime, "ip_address" => $currIpAdd, "is_logged" => 'n');
  $this->db->insert("tbl_view_user_logged_status", $dataVal);
 }

 public function logout($userId)
 {
  $logout = array('is_logged' => 0);
  $this->db->where("user_id", $userId);
  $this->db->set('last_login', 'now()', false)->update("tbl_user_status", $logout);
 }

 public function viewuserlogout($userId)
 {
  $logout = array('is_logged' => 0);
  $this->db->where("user_id", $userId);
  $this->db->set('last_login', 'now()', false)->update("tbl_view_user_status", $logout);
 }

 public function getUserDetails($user_id)
 {
  $this->db->select("*");
  $this->db->from("tbl_customers");
  $this->db->where("id", $user_id);
  $result = $this->db->get();
  return $result->row_array();
 }

 public function login($uname, $pwd)
 {
  $pwd = md5($pwd);
  $this->db->select("*");
  $this->db->from("tbl_users");
  $this->db->where("pwd", $pwd);
  $this->db->where("uname", $uname);
  $this->db->where("status", 'y');
  $result = $this->db->get();
  if ($result->num_rows() > 0) {
   return $result->row_array();
  } else {
   return "false";
  }
 }

 public function updateonboardstatus($id)
 {
  $data = array('status' => 'y');
  $where = array('id' => $id);
  $this->db->update('tbl_users', $data, $where);
 }

 public function updaterateofInterest($id)
 {
  $data = array('bank_id' => $id,'status' => "N");
  $this->db->insert('tbl_rate_of_interest', $data);
 }

 public function getUserInfoWherelogin($where)
 {
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('status', 'Y');
    $this->db->where("(uname='".$where['uname']."' OR email='".$where['uname']."')", NULL, FALSE);
    $query = $this->db->get();
    return $query->row_array();    
 }
 public function getUserInfoWherelogin23($uname,$pwd)
 {
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('status', 'Y');
    //$this->db->where("(uname='".$where['uname']."' OR email='".$where['uname']."')", NULL, FALSE);
    $this->db->where('uname', $uname);
    $this->db->where('pwd', $pwd);
    $query = $this->db->get();
    return $query->row_array();    
 }

 public function getUserInfoWherelogin2($uname)
 {
    $this->db->select('*');
    $this->db->from('tbl_users');
   // $this->db->where('status', 'Y');
    //$this->db->where("(uname='".$where['uname']."' OR email='".$where['uname']."')", NULL, FALSE);
    $this->db->where('uname', $uname);
    
    $query = $this->db->get();
    return $query->row_array();    
 }

 public function getCustomerInfoWhere($where)
 {
  $this->db->select('*');
  $this->db->from('tbl_customers');
  $this->db->where($where);
  $result = $this->db->get();
  if ($result->num_rows() > 0) {
   return $result->row_array();
  }
  return array();
 }

 public function forgot_password($username, $password)
 {
  $this->db->where('uname', $username);
  $this->db->or_where('email', $username);
  $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
  $data = array('pwd' => $hash);
  $this->db->update('tbl_users', $data);
  if ($this->db->affected_rows() > 0) {
   return true;
  } else {
   return false;
  }
 }


 public function updateviewuserDetails($userData)
 {
  $date = date("Y-m-d H:i:s");
  $sql = "INSERT INTO `only_view_users`(`id`, `id_i`, `first_name`, `Surname`, `email`,`client_sub_group`,`client_group`,`Name_company`,`address`,`when_login`, `how_often_login`) VALUES (null,'" . $userData['id'] . "','" . $userData['first_name'] . "','" . $userData['Surname'] . "','" . $userData['email'] . "','" . $userData['category'] . "','" . $userData['client_group'] . "','" . $userData['Name_company'] . "','" . $userData['address'] . "','" . $date . "','1')";
  $query = $this->db->query($sql);
  return "true";
 }

 public function updatecustomers($userData)
 {
  $updateqry = "UPDATE `tbl_customers` SET `processed` = 'Y' WHERE `id` = '" . $userData['id'] . "'";
  $eupdatquery = $this->db->query($updateqry);
  return "true";
 }

 public function getloginUserDetails($userId)
 {
  $this->db->select("clientgroup,company_name,lenderviewsection,settledlenderview,viewtype,offborrowers,onborrowers,lenderselectedterm,access_given_clientgroup,uname,email,LEI_Nummber,city,owner_account,iban_number,biccode,commission");
  $this->db->from("tbl_users");
  $this->db->where("id", $userId);
  $result = $this->db->get();
  return $result->result_array();
 }

 public function Notifications()
 {
    $userId = $_SESSION['user_id']; 
    $this->db->select("*");
    $this->db->from("tbl_lenders_request");
    $this->db->where("borrowerId", $userId);
    $this->db->where("lenderstatus",'Y');
    $this->db->where("borrowerstatus",'N');
    $result = $this->db->get();
    // echo $this->db->last_query();
    // exit();
    
    return $result->row_array();

 }

 public function updateRequestSend()
 {
    // $ticket_number = rand (10000 , 99999);
    $sql = "INSERT INTO `tbl_lenders_request`(`lenderId`, `borrowerId`, `amount`, `start_date`, `end_date`,`no_of_days`,`payments`,`interest`) VALUES (".$_POST['lenderId']."," . $_POST['borrowerId'] . ",'" .$_POST['amount']. "','" . $_POST['start_date'] . "','" . $_POST['end_date'] . "'," . $_POST['no_of_days'] . ",'" . $_POST['payments'] . "','".$_POST['interest']."')";
    $query = $this->db->query($sql);
    // echo $sql;
    // exit();
    //  $data = array("lenderId" => $_POST['lenderId'],"borrowerId" => $_POST['borrowerId'],"amount" =>$_POST['amount']
    //  ,"start_date" => $_POST['start_date'],"end_date" => $_POST['end_date'],"no_of_days" => $_POST['no_of_days'],"payments" => $_POST['payments'],"interest" =>$_POST['interest']);
    // //  print_r($data);
    // //  exit();
    //  $this->db->insert('tbl_lenders_request',$data);
    //  echo $this->db->last_query();
    //  exit();
}

public function AdminAcceptResponse()
{
    $updateqry = "UPDATE `tbl_customers` SET `processed` = 'Y' WHERE `id` = '" . $userData['id'] . "'";
    $eupdatquery = $this->db->query($updateqry);
    return "true";
}

 public function addremoveborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_users SET offborrowers = CONCAT(offborrowers,',$borrowerId') WHERE id = $user_id";
  $query = $this->db->query($SQL);
 }
 
 public function addkontakteremoveborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_customers SET offborrowers = CONCAT(offborrowers,',$borrowerId') WHERE id = $user_id";
  $query = $this->db->query($SQL);
 }

 public function adOnborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_users SET onborrowers = CONCAT(onborrowers,',$borrowerId') WHERE id = $user_id";
  $query = $this->db->query($SQL);
  $SQL1 = "UPDATE tbl_users SET offborrowers = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', offborrowers, ','), ',$borrowerId,', ',')) WHERE id = $user_id";
  $query1 = $this->db->query($SQL1);
 }
 
 public function adkontakteOnborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];

  $SQL = "UPDATE tbl_customers SET onborrowers = CONCAT(onborrowers,',$borrowerId') WHERE id = $user_id";
  $query = $this->db->query($SQL);
  $SQL1 = "UPDATE tbl_customers SET offborrowers = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', offborrowers, ','), ',$borrowerId,', ',')) WHERE id = $user_id";
  $query1 = $this->db->query($SQL1);
 }

 public function adOffborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_users SET onborrowers = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', onborrowers, ','), ',$borrowerId,', ',')) WHERE id = $user_id";
  $query = $this->db->query($SQL);
 }
 public function adkontakteOffborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_customers SET onborrowers = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', onborrowers, ','), ',$borrowerId,', ',')) WHERE id = $user_id";
  $query = $this->db->query($SQL);
 }


 public function removeborrower($user_id)
 {
  $borrowerId = $_REQUEST['borrowerId'];
  $SQL = "UPDATE tbl_users SET offborrowers = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', offborrowers, ','), ',$borrowerId,', ',')) WHERE id = $user_id";
  $query = $this->db->query($SQL);
 }

 public function getothersbankList($users)
 {

  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_rate_of_interest` as i JOIN  `tbl_users` as u ON i.bank_id = u.id  WHERE  i.bank_id IN ($users) AND i.status = 'Y' AND u.status ='y' AND (i.TN !=' ' OR i.1week != ' ' OR i.2weeks != ' ' OR i.3weeks != ' ' OR i.1month != ' ' OR i.2month != ' ' OR i.3month != ' ' OR i.4month != ' 'OR i.5month != ' ' OR i.6month != ' ' OR i.7month != ' '  OR i.8month != ' '  OR i.9month != ' ' OR i.10month != ' ' OR i.11month != ' ' OR i.12month != ' ' OR i.2year != ' ' OR i.3year != ' '  OR i.4year != ' ' OR i.5year != ' ') ORDER BY u.company_name";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }

 public function getothersblankbankList($users)
 {
 //   $query = "SELECT u.company_name as companyName,r.* FROM `tbl_users` as u LEFT JOIN `tbl_rate_of_interest` as r ON u.id = r.bank_id WHERE u.status = 'y' AND (u.user_type = 'borrower' OR u.user_type = 'both') AND r.TN = ' '  AND r.2weeks = ' ' AND r.3weeks = ' ' AND r.1month = ' ' AND r.2month = ' ' AND r.3month = ' ' AND r.4month = ' ' AND r.5month = ' ' AND r.6month = ' ' AND r.7month = ' ' AND r.8month = ' ' AND r.9month = ' ' AND r.10month = ' ' AND r.11month = ' ' AND r.12month = ' ' AND r.2year = ' ' AND r.3year = ' ' AND r.4year = ' ' AND r.5year = ' '";
  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_rate_of_interest` as i JOIN  `tbl_users` as u ON i.bank_id = u.id  WHERE  i.bank_id IN ($users) AND i.status = 'Y' AND u.status ='y' AND i.TN = ' ' AND 1week = ' ' AND i.2weeks = ' ' AND i.3weeks = ' ' AND i.1month = ' ' AND i.2month = ' ' AND i.3month = ' ' AND i.4month = ' ' AND i.5month = ' ' AND i.6month = ' ' AND i.7month = ' ' AND i.8month = ' ' AND i.9month = ' ' AND i.10month = ' ' AND i.11month = ' ' AND i.12month = ' ' AND i.2year = ' ' AND i.3year = ' ' AND i.4year = ' ' AND i.5year = ' ' ORDER BY u.company_name";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }


 public function bankList($client_group)
 {
  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y'";
//   echo $sql;
//   exit();
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }

 public function kontaktebankList($client_group)
 {
  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y' AND (i.TN !=' ' OR i.1week != ' ' OR i.2weeks != ' ' OR i.3weeks != ' ' OR i.1month != ' ' OR i.2month != ' ' OR i.3month != ' ' OR i.4month != ' 'OR i.5month != ' ' OR i.6month != ' ' OR i.7month != ' '  OR i.8month != ' '  OR i.9month != ' ' OR i.10month != ' ' OR i.11month != ' ' OR i.12month != ' ' OR i.2year != ' ' OR i.3year != ' '  OR i.4year != ' ' OR i.5year != ' ') ORDER BY u.company_name ASC";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }
 public function blankkontaktebankList($client_group)
 {
  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y' AND i.TN = ' ' AND 1week = ' ' AND i.2weeks = ' ' AND i.3weeks = ' ' AND i.1month = ' ' AND i.2month = ' ' AND i.3month = ' ' AND i.4month = ' ' AND i.5month = ' ' AND i.6month = ' ' AND i.7month = ' ' AND i.8month = ' ' AND i.9month = ' ' AND i.10month = ' ' AND i.11month = ' ' AND i.12month = ' ' AND i.2year = ' ' AND i.3year = ' ' AND i.4year = ' ' AND i.5year = ' '";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }


 public function MaxbankList($client_group,$offborrower)
 {
     
  $offborrower = trim($offborrower,",");
  
  if(!empty($offborrower)){
    $sql = "SELECT MAX(i.TN) as TN,MAX(i.1week) as 1week,MAX(i.2weeks) as 2weeks,MAX(i.3weeks) 3weeks,MAX(i.1month) as 1month,MAX(i.2month) as 2month,MAX(i.3month) as 3month,MAX(i.4month) as 4month,MAX(i.5month) as 5month,MAX(i.6month) as 6month,MAX(i.7month) as 7month,MAX(i.8month) as 8month,MAX(i.9month) as 9month,MAX(i.10month) as 10month,MAX(i.11month) as 11month,MAX(i.12month) as 12month,MAX(i.2year) as 2year,MAX(i.3year) as 3year,MAX(i.4year) as 4year,MAX(i.5year) as 5year FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.bank_id NOT IN($offborrower) AND i.status = 'Y' AND u.status = 'y'";
  }else{
    $sql = "SELECT MAX(i.TN) as TN,MAX(i.1week) as 1week,MAX(i.2weeks) as 2weeks,MAX(i.3weeks) 3weeks,MAX(i.1month) as 1month,MAX(i.2month) as 2month,MAX(i.3month) as 3month,MAX(i.4month) as 4month,MAX(i.5month) as 5month,MAX(i.6month) as 6month,MAX(i.7month) as 7month,MAX(i.8month) as 8month,MAX(i.9month) as 9month,MAX(i.10month) as 10month,MAX(i.11month) as 11month,MAX(i.12month) as 12month,MAX(i.2year) as 2year,MAX(i.3year) as 3year,MAX(i.4year) as 4year,MAX(i.5year) as 5year FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y'";
  }
  
 
  $query = $this->db->query($sql);
  $res = $query->row_array();
  return $res;
 }


 public function CustomerbankList($client_group,$sort)
 {
    //$sql = "select u.id as userId,u.fname,u.lname,u.company_name,i.* from tbl_rate_of_interest as i join  `tbl_users` as u ON i.bank_id = u.id WHERE  i.status = 'Y' AND u.status ='y'  order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0) , u.company_name ASC";
    if($sort == "bank_id"){
        $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y' order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0) , u.company_name ASC";
    }else{
        $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y' AND i.$sort != '' ORDER BY i.$sort+0 DESC";
    }
 
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;

 }
 public function CustomerBlankbankList($client_group,$sort)
 {
     
  $sql = "SELECT u.id as userId,u.fname,u.lname,u.company_name,i.* FROM `tbl_users` as u JOIN `tbl_rate_of_interest` as i ON u.id = i.bank_id WHERE FIND_IN_SET('$client_group', u.access_given_clientgroup) AND i.status = 'Y' AND u.status = 'y' AND i.$sort = '' order by if((i.TN = '' or i.TN is null) AND (i.1week = '' or i.1week is null) AND (i.2weeks = '' or i.2weeks is null) AND (i.3weeks = '' or i.3weeks is null) AND (i.1month = '' or i.1month is null) AND (i.2month = '' or i.2month is null) AND (i.3month = '' or i.3month is null) AND (i.4month = '' or i.4month is null) AND (i.5month = '' or i.5month is null) AND (i.6month = '' or i.6month is null) AND (i.7month = '' or i.7month is null) AND (i.8month = '' or i.8month is null) AND (i.9month = '' or i.9month is null) AND (i.10month = '' or i.10month is null) AND (i.11month = '' or i.11month is null) AND (i.12month = '' or i.12month is null) AND (i.2year = '' or i.2year is null) AND (i.3year = '' or i.3year is null) AND (i.4year = '' or i.4year is null) AND (i.5year = '' or i.5year is null) ,1,0)";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
 }

 public function checkLoginActive($userId)
 {
  $this->db->select("login_flag,loginBrowser");
  $this->db->from("tbl_users");
  $this->db->where("id", $userId);
  return $this->db->get()->row_array();
 }

 public function updateUserLoggedDetails($userId, $loggedInArray)
 {
  $this->db->where("id", $userId);
  $this->db->update("tbl_users", $loggedInArray);
 }

 public function updateoneTimeUserLoggedDetails($loggedInArray)
 {
  $this->db->update("tbl_users", $loggedInArray);

 }

 public function setviewtype()
 {
  $userTypeArray = array("viewtype" => $_REQUEST['userType']);
  $userId = $_SESSION['user_id'];
  $this->db->where("id", $userId);
  $this->db->update("tbl_users", $userTypeArray);
 }

}
