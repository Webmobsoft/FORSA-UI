<?php if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class m_register extends CI_Model
{
 public function __construct()
 {
  parent::__construct();
  $this->load->database();
 }

 public function checkuname_status($uname)
 {
  $this->db->select("*");
  $this->db->from("tbl_users");
  $this->db->where("uname", $uname);
  $this->db->where("is_archieve", 'n');
  $result = $this->db->get();
  echo $num = $result->num_rows();
 }

 public function insertEmailDetails($customerId,$subject,$message,$date)
 {
     $data['to'] = $customerId;
     $data['subject'] = $subject;
     $data['message	'] = $message;
     $data['sent_at'] = $date;
     $this->db->insert("tbl_password_email",$data);
     
 }
 public function insertonboardEmailDetails($customerId,$subject,$message,$date)
 {
     $data['to'] = $customerId;
     $data['subject'] = $subject;
     $data['message	'] = $message;
     $data['sent_at'] = $date;
     $this->db->insert("tbl_onboard_emails",$data);
     
 }

 public function checkEmail_status($email)
 {
  $this->db->select("*");
  $this->db->from("tbl_users");
  $this->db->where("email", $email);
  $this->db->where("is_archieve", 'n');
  $result = $this->db->get();
  echo $num = $result->num_rows();
 }

 public function updateonlyviewuserstats($customerId)
 {
  $data['only_view_user'] = 'N';
  $where['id_i'] = $customerId;
  $this->db->update('only_view_users', $data, $where);
 }

 public function checkOldPwd($password)
 {
  $user_id = $_SESSION['user_id'];
  $this->db->select("*");
  $this->db->from("tbl_users");
  $this->db->where("id", $user_id);
  $this->db->where("emailpwd", $password);
  $result = $this->db->get();
  return $result->num_rows();
 }

 public function lenderOption($user_id)
 {
  $this->db->select("*");
  $this->db->where('lender_id', $user_id);
  $this->db->from('tbl_mail_settings');
  $result = $this->db->get();
  return $ar = $result->result_array();
 }

 public function update_user_detail($data)
 {
  $user_id = $_SESSION['user_id'];
  $yupdate_array = array("fname" => htmlentities($_POST['fname']), "lname" => htmlentities($_POST['lname']), "company_name" => htmlentities($_POST['company_name']));
  $this->db->where("id", $user_id);
  $this->db->update("tbl_users", $yupdate_array);
  return ($this->db->affected_rows() > 0) ? true : false;
 }

 public function mail_setting($user_id)
 {
  $this->db->select("*");
  $this->db->where('lender_id', $user_id);
  $this->db->from("tbl_mail_settings");
  $result = $this->db->get();
  return $ar = $result->result_array();
 }

 public function insert_mail_setting($data)
 {
  $this->db->insert("tbl_mail_settings", $data);
  return $this->db->insert_id();
 }

 public function update_mail_setting($data, $user_id)
 {
  $this->db->where('lender_id', $user_id);
  $this->db->update("tbl_mail_settings", $data);
  return $this->db->affected_rows();
 }

 public function update_password()
 {
    //  echo "sdfgsdg";
    //  exit();
  $user_id = $_SESSION['user_id'];
//   echo $_POST['new_pwd'];
//   exit();
  $hash = password_hash($_POST['new_pwd'], PASSWORD_BCRYPT, ['cost' => 12]);
//   echo $hash;
//   exit();
  $update_array = array("pwd" => $hash);
//   print_r($update_array);
//   exit();
  $this->db->where("id", $user_id);
  $this->db->update("tbl_users", $update_array);
//   echo $this->db->last_query();
//   exit();
  return ($this->db->affected_rows() > 0) ? true : false;
 }
 public function allCategoriesexceptBank()
 {
  $this->db->select("*");
  $this->db->from("tbl_lender_services");
  $this->db->where("id !=", "1");
  $result = $this->db->get();
  return $result->result_array();
 }

 public function new_user($val)
 {
  $val['status'] = 'n';
  $this->db->insert("tbl_users", $val);
  return $result = $this->db->insert_id();
 }

 public function insert_mail_sett($result)
 {
  $dataVal = array("lender_id" => $result, "want_all_email" => "all");
  $this->db->insert("tbl_mail_settings", $dataVal);
 }

 public function get_user_detail()
 {
  $user_id = $_SESSION['user_id'];
  $this->db->select("*");
  $this->db->from("tbl_users");
  $this->db->where("id", $user_id);
  $this->db->where("is_archieve", 'n');
  $result = $this->db->get();
  return $ar = $result->result_array();
 }

 public function getUserData()
 {
  $user_id = $_SESSION['user_id'];
  $this->db->from("tbl_users");
  $this->db->where("id", $user_id);
  $this->db->where("is_archieve", 'n');
  $result = $this->db->get();
  return $result->row_array();
 }
}
