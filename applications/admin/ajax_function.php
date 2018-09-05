<?php 
include_once 'config.php'; 
$function = $_REQUEST['function'];
$eFrom    = "info@forsa-gmbh.de";
if ($function == 'check_admin') 
{    
//$_SESSION['user_id'] = 1;    
//echo "hello";  
  $uname = $_REQUEST['uname'];   
  $pwd = md5($_REQUEST['pwd']); 
  //echo "select * from tbl_users where pwd='".$pwd."' and user_type='admin' and(uname='".$uname."' || email = '".$uname."')"; 
  $select_query = mysqli_query($mysql_connect,"select * from tbl_priviledged_users where pwd='" . $pwd . "' and user_type='admin' and(uname='" . $uname . "' || email = '" . $uname . "')");  
  
  if (mysqli_num_rows($select_query) > 0)
  {  
	  $admin_detail = mysqli_fetch_array($mysql_connect,$select_query); 
	  $_SESSION['userID'] = $admin_detail['id'];       
	  $_SESSION['username'] = $admin_detail['uname']; 
          $_SESSION['adminName'] = $admin_detail['fname']." ".$admin_detail['lname']; 
	  $_SESSION['userType'] = "admin"; 
	  echo "true";
  
  }else{
  	echo "false";
  }
 /* else if(mysql_num_rows($select_query) < 1 ) 
  {
	    $select_admin_us ="select * from tbl_priviledged_users where pwd='" . $pwd . "' and user_type='admin' and(uname='" . $uname . "' || email = '" . $uname . "')";  
		  $select_admin_user= mysql_query($select_admin_us);
			  $admin_detail_user = mysql_fetch_array($select_admin_user);
             
			 if(!empty($admin_detail_user ))
			  {				  
				  $_SESSION['user_id']    =  $admin_detail_user['id'];       
				  $_SESSION['uname']      =  $admin_detail_user['uname'];   
				   $_SESSION['user_type'] =   "subAdmin";
				  $_SESSION['privilege']  =  $admin_detail_user['privilege'];
				  $_SESSION['adminName'] = $admin_detail_user['fname']." ".$admin_detail_user['lname'];
				                           $explodeData = explode(",",$_SESSION['privilege']);
											
											 if(in_array(1,$explodeData))
											 {
												 $_SESSION['show'] = "y" ;
											 }
											 if(in_array(2,$explodeData))
											 {
												  $_SESSION['add'] = "y" ;
											 }
											
											 if(in_array(3,$explodeData))
											 {
												 $_SESSION['edit'] = "y" ;
											 }
											 if(in_array(4,$explodeData))
											 {
												 $_SESSION['delete'] = "y" ;
											 }
				  
				  
				  
				  
				   echo "true";
			  }
			  else
			  {
				  echo "false";
			  }
			   
	}*/
  
  
  
  }
  
  if ($function == 'forgot_password') {
	  $email = $_POST['email'];   
	  $select_query = "select * from tbl_users where email ='" . $email . "'";    
	  $res_qry = mysqli_query($mysql_connect,$select_query);    
	  $row = mysqli_fetch_array($res_qry);    
	  if (!empty($row['email'])) 
              {        
                    $password = rand();        
                    $update_qry = mysqli_query($mysql_connect,"update tbl_users set pwd='" . md5($password) . "' where email='" . $email . "'");       
                    $message  = 'Hello ' . $row['fname'] . ' ' . $row['lname'] . '<br/><br/>';        
                    $message .= 'Your new password is : ' . $password . '<br/><br/>';        
                    $message .= 'Thanks <br/>';
		   
				
            $to = $row['email'];       
	    $subject = 'Password Reset';       
	    $headers  = "MIME-Version: 1.0" . "\r\n";      
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";       
	    $headers .=  "From: nolte@forsa-gmbh.de \r\n";
	    $headers .= "Cc: info@forsa-gmbh.de \r\n";		
	  //$headers .= "Cc:info@instimatch.ch \r\n" ;
           mail($to, $subject, $message, $headers);   
	   echo'true';    
          
          } else {        echo'false';    }
          
          }
	  
if ($function == 'make_it_off') 
    {   
    $id = $_POST['id'];  
       //echo "update tbl_users set status='n' where id='".$id."'"; 
    $update_status_off = mysql_query("update tbl_users set status='n' where id='" . $id . "'");  
     echo 'true';
  
}
if ($function == 'logoutUser') 
    {   
	$logout_query1 = mysqli_query($mysql_connect,"update tbl_user_status set is_logged = '0'");
	$logout_query2 = mysqli_query($mysql_connect,"update tbl_user_logged_status set is_logged = 'n'");
	$logout_query3 = mysqli_query($mysql_connect,"update tbl_view_user_status set is_logged = '0'");
	$logout_query4  = mysqli_query($mysql_connect,"update tbl_view_user_logged_status set is_logged = 'n'");  
	echo 'true';
}
if ($function == 'deleteEmails') 
    {   
	$id = $_POST['id'];
	$table = $_POST['table'];  
	//    echo "update ".$table." set status='N' where id='" . $id . "'";
	//    exit();
    $update_status_off = mysqli_query($mysql_connect,"update ".$table." set status='N' where id='" . $id . "'");  
     echo 'true';
  
}
if($function == 'get_borrower_response'){
	$m_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_lenders_request` WHERE admin_client_deal_accepted = 'Y'"); 
	if(mysqli_num_rows($m_result) > 0) {  
		while($notification = mysqli_fetch_assoc($m_result)){
		 $borrower_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_users` WHERE id = '".$notification['borrowerId']."'");
		 $borrowerDetails = mysqli_fetch_assoc($borrower_result);
		 echo ''.$borrowerDetails['company_name'].' has accepted your Deal.<br>';
		 echo '<input type="button" id="request-decline" value="OK" data-value="'.$notification['id'].'" class="btn btn-info btn-lg acceptresponsedeal" >';
		}
		
		}else{
			echo 'false';
		}


}
if($function == 'get_borrower_decline_response'){
	$m_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_lenders_request` WHERE admin_client_deal_rejected = 'Y'"); 
	if(mysqli_num_rows($m_result) > 0) {  
		while($notification = mysqli_fetch_assoc($m_result)){
		 $borrower_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_users` WHERE id = '".$notification['borrowerId']."'");
		 $borrowerDetails = mysqli_fetch_assoc($borrower_result);
		 echo ''.$borrowerDetails['company_name'].' has declined your Deal.<br>';
		 echo '<input type="button" id="request-decline" value="OK" data-value="'.$notification['id'].'" class="btn btn-info btn-lg declineresponsedeal" >';
		}
		
		}else{
			echo 'false';
		}


}
if ($function == 'getRequests') 
    {   
		$m_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_lenders_request` WHERE chat_with_forsa ='Y'  AND processed = 'Y' AND adminView = 'N'
		AND admin_deal_response = 'N' "); 
        if(mysqli_num_rows($m_result) > 0) {  
		   while($notification = mysqli_fetch_assoc($m_result)){
			$lender_result = mysqli_query($mysql_connect, "SELECT * FROM `tbl_users` WHERE id = '".$notification['lenderId']."'");
			$lenderDetails = mysqli_fetch_assoc($lender_result);
			$borrower_result = mysqli_query($mysql_connect, "SELECT company_name FROM `tbl_users` WHERE id = '".$notification['borrowerId']."'");
			$borrowerDetails = mysqli_fetch_assoc($borrower_result);
			// print_r($lenderDetails);
			// exit();	

			
			echo '<table><tbody><tr><th>LENDER</th><td>'.$lenderDetails['company_name'].'</td></tr>
					<tr><th>LENDER\'s FIRST NAME</th><td>'.$lenderDetails['fname'].'</td></tr>
					<tr><th>LENDER\'s LAST NAME</th><td>'.$lenderDetails['lname'].'</td></tr>
				 <tr><th>LENDER\'s Contact Number</th><td>'.$lenderDetails['contact_number'].'</td></tr>
				 <tr><th>LENDER\'s Email</th><td>'.$lenderDetails['email'].'</td></tr>
				
                  <tr><th>BORROWER</th><td>'.$borrowerDetails['company_name'].'</td></tr>
                  <tr><th>AMOUNT</th><td>'.$notification['amount'].'</td></tr>
                  <tr><th>START-DATE</th><td>'.$notification['start_date'].'</td></tr>
                  <tr><th>END-DATE</th><td>'.$notification['end_date'].'</td></tr>
                  <tr><th>NR. OF DAYS</th><td id="no_of_days">'.$notification['no_of_days'].'</td></tr>
                  <tr><th>INTEREST RATE</th><td>'.$notification['interest_rate'].'</td></tr>
                  <tr><th>INTEREST CONVENTION</th><td>'.$notification['interest'].'</td></tr>
				  <tr><th>PAYMENTS</th><td>'.$notification['payments'].'</td></tr>
				  <tr><th>CHAT MESSAGE</th><td>'.$notification['chat_description'].'</td></tr>
				  <tr><td><input type="button" id="request-accept" value="ACCEPT" data-lender="'.$lenderDetails['company_name'].'" data-borrower="'.$borrowerDetails['company_name'].'" data-value="'.$notification['lenderId'].'" data-id="'.$notification['id'].'" class="btn btn-info btn-lg okresponse" >
				  <input type="button" id="request-decline" value="DECLINE" data-lender="'.$lenderDetails['company_name'].'" data-borrower="'.$borrowerDetails['company_name'].'" data-value="'.$notification['lenderId'].'" data-id="'.$notification['id'].'" class="btn btn-info btn-lg declineresponse" ></td></tr>
				  <tr><td><input type="button"  value="CLOSE" data-value="close"  id="closing" disabled="disabled" class="btn btn-info btn-lg requestresponse closes" data-id="'.$Notifications['id'].'"></td></tr>
				  </tbody></table>
				 ';
			// echo "".$row['uname']." has Mobile Number : ".$row['contact_number']." wants to contact with you."; 
			// echo '<br><input type="button" id="request-accept" value="ACCEPT" data-value="'.$rows['lenderId'].'" class="btn btn-info btn-lg okresponse" >
			// <input type="button" id="request-decline" value="DECLINE" data-value="'.$rows['lenderId'].'" class="btn btn-info btn-lg okresponse" >';
			//print_r($row['uname'] );  
		}
		  
		   //print_r($rows);	
		}  
}

if($function == "updateAdminView")
{
	$dealdate = date("d M Y");
	$dealtime = date("H:i:s A");
	$lenderDetails = mysqli_query($mysql_connect, 'select * from tbl_users where id = '.$_POST["Ids"].'');
	if (mysqli_num_rows($lenderDetails) > 0)
	{
		$lenderDetail = mysqli_fetch_assoc($lenderDetails);
		$message = 'Hi '.$lenderDetail['uname'].',<br/>';
		$message .= 'Admin has accepted your deal. Be in touch to get Exciting Deals. <br/><br/>';
		$message .= 'Thanks For Contacting Forsa, <br/>';	
		$message .= 'FORSA GmbH<br/>';
      	$message .= 'Wiesbaden<br/>';
     	$message .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';
        $to = $lenderDetail['email'];       
	    $subject = 'Forsa:Request Accepted By Admin';       
	    $headers  = "MIME-Version: 1.0" . "\r\n";      
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";       
	    $headers .=  "From: nolte@forsa-gmbh.de \r\n";
	    $headers .= "Cc: info@forsa-gmbh.de \r\n";		
		mail($to, $subject, $message, $headers);   
	}
	$query = mysqli_query($mysql_connect, "SELECT ticketIncrementor FROM tbl_lenders_request WHERE accept = 'Y' OR admin_accept_response = 'Y' ORDER BY id DESC LIMIT 1");
	$res = mysqli_fetch_assoc($query);
    if(!empty($res['ticketIncrementor'])){
    $ticketIncre = $res['ticketIncrementor'] + 1;
    $ticketIncre = str_pad($ticketIncre, 5, "0", STR_PAD_LEFT);  //00002
    }else{
        $ticketIncre = "00001";
	}
	$ticketyear = date("Y");
	$ticketNumber = $ticketyear.$ticketIncre."8202";
	
	$m_result = mysqli_query($mysql_connect, "update tbl_lenders_request set ticket_number = '$ticketNumber',ticketIncrementor = '$ticketIncre', adminView = 'Y',admin_accept_response = 'Y',complete_deal_date ='".$dealdate."', complete_deal_time = '".$dealtime."'  where id = ".$_POST['notificationId']." ");
	
	if(mysqli_affected_rows($m_result) == 1)
	{
		echo 'true';
	}
	else
	{
		echo 'false';
	}
}

if($function == "updateAdminDeclineView"){
	$query = mysqli_query($mysql_connect, "SELECT ticketIncrementor FROM tbl_lenders_request WHERE admin_decline_response = 'Y' OR decline = 'Y' ORDER BY id DESC LIMIT 1");
	$res = mysqli_fetch_assoc($query);
    if(!empty($res['ticketIncrementor'])){
    $ticketIncre = $res['ticketIncrementor'] + 1;
    $ticket_number = str_pad($ticketIncre, 6, "0", STR_PAD_LEFT);  //00002
    }else{
        $ticket_number = "000001";
	}

  $m_result = mysqli_query($mysql_connect, "update tbl_lenders_request set ticket_number = '$ticket_number',ticketIncrementor = '$ticket_number',adminView = 'Y',admin_decline_response = 'Y' where lenderId = ".$_POST['Ids']." ");
echo 'true';	
}

if($function == "updateAdminClose"){
  
	$m_result = mysqli_query($mysql_connect, "update tbl_lenders_request set admin_deal_response = 'Y' where lenderId = ".$_POST['Ids']." ");
  echo 'true';	
  }



if($function == "updateacceptresponsedeal"){
  
	$m_result = mysqli_query($mysql_connect, "update tbl_lenders_request set admin_client_deal_accepted = 'N'");
  echo 'true';	
  }
  if($function == "updatedeclineresponsedeal"){
  
	$m_result = mysqli_query($mysql_connect, "update tbl_lenders_request set admin_client_deal_rejected = 'N'");
  echo 'true';	
  }



// if($functionEmail == "EmailAdminAcceptResponse")
// {
// 	$Emaildata = $this->mlogin->EmailAdminAcceptResponse($_POST['Ids']); 
//     $lenderDetails = $this->mlogin->getloginUserDetails($Emaildata[0]['lenderId']); 
// 	    $message = 'Hi '.$lenderDetails[0]['uname'].', Admin has accepted your deal; <br/><br/>';	
//         $to = $lenderDetails[0]['email'];       
// 	    $subject = 'Request Accepted';       
// 	    $headers  = "MIME-Version: 1.0" . "\r\n";      
// 	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";       
// 	    $headers .=  "From: nolte@forsa-gmbh.de \r\n";
// 	    $headers .= "Cc: info@forsa-gmbh.de \r\n";		
// 	    mail($to, $subject, $message, $headers);   
		   

//     //   $message = 'Hi '.$lenderDetails[0]['uname'].', Admin has accepted your deal; <br/><br/>';
//     //   $to = ''.$lenderDetails[0]['email'].'';
// 	//   $subject = "Request Accepted";
// 	//   $headers = "From: admin@instimatch.ch";

// 	// 	mail($to,$subject,$message,$headers);
// }
  
/*if ($function == 'make_it_off_category') 
    {   
    $id = $_POST['id'];  
       //echo "update tbl_users set status='n' where id='".$id."'"; 
    $update_status_off = mysql_query("update tbl_category set active='N' where id='" . $id . "'");  
     echo 'true';
    }
 if ($function == 'make_it_on_category') 
    {   
    $id = $_POST['id'];  
       //echo "update tbl_users set status='n' where id='".$id."'"; 
    $update_status_on = mysql_query("update tbl_category set active='Y' where id='" . $id . "'");  
     echo 'true';
    }
if ($function == 'make_it_off_interest') {
	  $id = $_POST['id'];    
	  //echo "update tbl_users set status='n' where id='".$id."'"; 
	  $update_status_off = mysql_query("update tbl_interest set status='n' where id='" . $id . "'");    echo 'true';}*/
	 

if($function == 'make_it_sendemail_customer'){
	 $customerId = $_POST['id'];
	 $m_result = mysqli_query($mysql_connect,"SELECT * FROM `tbl_customers` WHERE id ='".$customerId."' "); 
        if(mysqli_num_rows($m_result) > 0) {  
           $rows = mysqli_fetch_assoc($m_result);	
			$emailTo = $rows['email'];
			$ID = $rows['id'];
            $baseId = base64_encode($ID);
			$message  = 'Sehr geehrter  '.$rows['salutation'].'  '. $rows['first_name'] ." ".$rows['Surname'].','.'<br/><br/>'; 
			$message .= 'Mit folgenden Link können Sie sich für die FORSA Plattform anmelden:<br/><br/>';     
			$message .= '<a href="http://demo.instimatch.com/forsa/applications/?customerid='.$baseId.'" target="_blank">Anmelden</a><br/>';
			$message .= 'Ihr Passwort lautet:'.$rows['password'].'<br/><br/>';
			$message .= 'Benutzerhinweise:<br/>'; 
			$message .= 'Die FORSA-Anleihensuche funktioniert allerdings nur, wenn auf dem PC die
			Speicherung lokaler Daten (Cookies) zugelassen wird und ausschließlich bei
			Nutzung des Internet-Explorers ab Version 9.0.<br/><br/>'; 
			$message .= 'Mit freundlichen Grüssen<br/>'; 
			$message .= 'Ihr FORSA-Team';
			$headers = "MIME-Version: 1.0" . "\r\n";  
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
			$headers .=  "From: admin@instimatch.ch \r\n";
			$headers .= "Cc: info@instimatch.ch \r\n"; 
			mail($emailTo, 'Ihre Anmeldung FORSA', $message, $headers);
		
  	
		} 
	$subject = 'Ihre Anmeldung FORSA';
	$send_date = date("Y-m-d H:i:s");	
	$update_status_off = mysqli_query($mysql_connect,"update tbl_customers set send_email='Y' where id='" . $customerId . "'");
	$insert_query = mysqli_query($mysql_connect,"insert into tbl_emails (`to` , `subject` , `message`,`sent_at`) values ('".$customerId."','".$subject."' ,'".$message."','".$send_date."')");
	echo 'true';
	
}


if($function == 'sendEmailInGroup'){
	//echo $_POST['Emails'];
	$IdArrays = explode(",", $_POST['Emails']);
	if(!empty($IdArrays)){
	foreach ($IdArrays as $customerId) {
		$m_result = mysqli_query($mysql_connect,"SELECT * FROM `tbl_customers` WHERE id_i = '".$customerId."' "); 
	if(mysqli_num_rows($m_result) > 0) {  
	$rows = mysqli_fetch_assoc($m_result);	
	$emailTo = $rows['email'];

	$message  = 'Sehr geehrter  '.$rows['fo_assignment'].'  '. $rows['first_name'] ." ".$rows['Surname'].','.'<br/><br/>'; 
	$message .= 'Mit folgenden Link können Sie sich für die FORSA Plattform anmelden:<br/><br/>';     
	$message .= '<a href="http://demo.instimatch.com/forsa/applications/?customerid='.$rows['id'].'" target="_blank">Anmelden</a><br/>';
	$message .= 'Ihr Passwort lautet:'.$rows['password'].'<br/><br/>';
	$message .= 'Benutzerhinweise:<br/>'; 
	$message .= 'Die FORSA-Anleihensuche funktioniert allerdings nur, wenn auf dem PC die
	Speicherung lokaler Daten (Cookies) zugelassen wird und ausschließlich bei
	Nutzung des Internet-Explorers ab Version 9.0.<br/><br/>'; 
	$message .= 'Mit freundlichen Grüssen<br/>'; 
	$message .= 'Ihr FORSA-Team';
	$headers = "MIME-Version: 1.0" . "\r\n";  
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
	$headers .=  "From: admin@instimatch.ch \r\n";
	$headers .= "Cc: info@instimatch.ch \r\n"; 
	mail($emailTo, 'Ihre Anmeldung FORSA', $message, $headers);
	$update_status_off = mysqli_query($mysql_connect,"update tbl_customers set send_email='Y' where id_i='" . $customerId . "'");
	}

	}
	echo "true";

}else{
	echo "false";
}
	
	exit();

}



if ($function == 'make_it_on') 
    {  
        $dateTime = date("Y-m-d H:i:s");
        $id = $_POST['id']; 
        $newUser = ''; 
        $m_result = mysqli_query($mysql_connect,"SELECT `tbl_users`.* FROM `tbl_users` WHERE `id` = '" . $id . "'"); 
        if(mysqli_num_rows($m_result) > 0) { 
		$pwd = substr(md5(date('YidMHs') . rand()), rand(0, 20), 8);
		$hash = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
		$newUser = ", pwd='".$hash."'";    
		$m_data = mysqli_fetch_assoc($m_result);
		if($m_data['user_type'] == "borrower"){
		$insert1_query = mysqli_query($mysql_connect,"insert into tbl_rate_of_interest (`bank_id`) values ('".$id."')");
		}		       
        $alternate_email = $m_data['alternate_email'];
        // $prefferedLanguage=$m_data['preferredLanguage'];
        $emailTo = $m_data['email'].",".$alternate_email;
           
                $message  = 'Guten Tag ' . $m_data['fname'] ." ".$m_data['lname']. '<br/><br/>';      
				$message .= 'Ihre Anmeldung wurde bei FORSA &uuml;berpr&uuml;ft. <br/>'; 
				$message .= 'Bitte melden Sie sich an unter <a href="http://demo.instimatch.com/forsa/applications/?wlogin='.base64_encode('Y').'" target="_blank">http://demo.instimatch.com/forsa/</a> : <br/><br/>'; 			
				$message .= 'Username: ' . $m_data['uname'] . '<br/>';		
				$message .= 'Password: ' . $pwd . '<br/><br/>';        	
				$message .= 'Bitte &auml;ndern Sie Ihr Passwort bei der ersten Anmeldung.<br/><br/>'; 
				//$message .= $mailFooterDE;
				$message .= 'Herzlichen Dank<br/>';
				$message .= 'Freundliche Grüsse<br/><br/>';
				$message .= 'FORSA GmbH<br/>';
				$message .= 'Wiesbaden<br/>';
				$message .= '<a href="www.forsa-gmbh.de/de/" target="_blank">www.forsa-gmbh.de/de/</a>';
				$headers = "MIME-Version: 1.0" . "\r\n";	
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";		
				$headers .=  "From: admin@instimatch.ch \r\n";
				$headers .= "Cc: info@instimatch.ch \r\n";   		
             
             mail($emailTo, 'Ihre Anmeldung FORSA', $message, $headers);			
  	
		} 
	$subject = 'Ihre Anmeldung FORSA';
	$send_date = date("Y-m-d H:i:s A");	
	//$update_status_off = mysqli_query($mysql_connect,"update tbl_customers set send_email='Y' where id='" . $customerId . "'");
	$insert_query = mysqli_query($mysql_connect,"insert into tbl_onboard_emails (`to` , `subject` , `message`,`sent_at`) values ('".$id."','".$subject."' ,'".$message."','".$send_date."')");
    $update_status_off = mysqli_query($mysql_connect,"update tbl_users set status='y' $newUser where id='" . $id . "'");
	echo 'true';
                
  }
                
       /*         if ($function == 'make_it_on_interest') {    $id = $_POST['id'];  
		//echo "update tbl_users set status='n' where id='".$id."'"; 
		$update_status_off = mysql_query("update tbl_interest set status='y' where id='" . $id . "'");  
		echo 'true';
	}*/
               /* if ($function == 'get_full_detail')
                {    $id = $_POST['id'];  
		//echo "update tbl_users set status='n' where id='".$id."'";//  
		// "select tbl_users.*,tbl_fedafin_rating.rating_name from tbl_users inner join tbl_fedafin_rating on tbl_fedafin_rating.id=tbl_users.fedafin_rating where id='".$id."'";
		//    die;    
		$update_status_off = mysql_query("select tbl_users.*,tbl_fedafin_rating.rating_name from tbl_users inner join tbl_fedafin_rating on tbl_fedafin_rating.id=tbl_users.fedafin_rating where tbl_users.id='" . $id . "'"); 
		$get_user_detail = mysql_fetch_array($update_status_off);   
		$user_name = $get_user_detail['fname'] . " " . $get_user_detail['lname'];  
		$basic_info = '<span id="contact_detail" class="contact_detail"><i class="user_popup_heading" style="">Contact Details</i></span> 
		<table class="display table basic_info" id="example" data-toggle="table">'            . '<tr>'            . '<td>User Name</td><td>' . $get_user_detail['uname'] . '</td></tr>'            . '<tr>'            . '<td>Name</td>
		<td>' . $user_name . '</td>
		</tr>' . '<tr><td>Company Name</td><td>' . $get_user_detail['company_name'] . '</td>
		</tr>'            . '<tr><td>Contact Number</td><td>' . $get_user_detail['contact_number'] . '</td>
		</tr>'            . '<tr><td>Email</td><td>' . $get_user_detail['email'] . '</td></tr>'            . '<tr>
		<td>Fedafin Rating</td><td>' . $get_user_detail['rating_name'] . '</td>'            . '</tr></table>';
		$bank_info = '<span id="contact_detail" class="contact_detail"><i class="user_popup_heading" style="">Bank Details</i></span>  <table class="display table basic_info" id="example" data-toggle="table">'            . '<tr>'            . '<td class="col-md-5">Bank Account</td><td>' . $get_user_detail['bank_account'] . '</td></tr>'            . '<tr><td>IBAN Number</td><td>' . $get_user_detail['iban_number'] . '</td></tr>'            . '<tr><td>Beneficiary Name</td><td>' . $get_user_detail['beneficiary_name'] . '</td></tr></table>';
		//     $bank_info = '  <span class="bank_detail" id="bank_detail"><i class="user_popup_heading" style="">Bank Details</i></span><table class="display table bank_info" id="example" data-toggle="table">'//    . '<tr>'//            .'<td>Bank Account</td><td>'.$get_user_detail['bank_account'].'</td></tr>'//            .'<tr><td>IBAN Number</td><td>'.$get_user_detail['iban_number'].'</td></tr>'//            .'<tr><td>Beneficiary Name</td><td>'.$get_user_detail['beneficiary_name'].'</td>'//            . '</tr></table>'; 
		echo $basic_info . $bank_info;
	}*/
		
                if ($function == 'deleteUserById')
                { 
                  $id       =  base64_decode($_REQUEST['id']);
                  $adminId  = $_SESSION['user_id'];
                  $userDetails  = mysqli_query('SELECT * FROM `tbl_users` WHERE `id` = "'.$id.'"');
                  $fetch = mysqli_fetch_array($userDetails);
                  $userFullName = $fetch['fname']." ".$fetch['lname'];
                  $userUserName = $fetch['uname'];
                  $adminFullName =  $_SESSION['adminName'];
                  $dateTime      = date("Y-m-d H:i:s"); 
                  $todayDate     = date("d.m.Y H:i:s"); 
                  $update = mysqli_query($mysql_connect,"UPDATE `tbl_users` SET `is_archieve` = 'y' , `status` = 'n' WHERE `id` = " . base64_decode($_REQUEST['id']));
                   //$logMessage = "$adminFullName has deleted the user $userFullName ( $userUserName ) on $todayDate";
                   //echo $logMessage;
                   //$insertIntoAdminLog = mysqli_query($mysql_connect,"INSERT INTO `tbl_admin_logs` (`admin_id` , `msg` , `deleted_time`) VALUES ('".$adminId."','".$logMessage."' ,'".$dateTime."' )");
		}

        if ($function == 'deleteCustomerById') 
		{  
           $update = mysqli_query($mysql_connect,"DELETE FROM `tbl_customers` WHERE `id_i` = 'ID' OR `id_i` = '' OR `id` = " . base64_decode($_REQUEST['id']));
		}
		if($function == 'deleteviewuserById'){
					
                  $update = mysqli_query($mysql_connect,"UPDATE `only_view_users` SET `status` = 'N' WHERE  `id` = ". base64_decode($_REQUEST['id']));
                  echo "true";
		}

		/*
		if ($function == 'get_message_count') 
		{  
	          $select = "SELECT * FROM tbl_messages WHERE is_seen ='N' AND `to` = '1'";    
		  $query = mysql_query($select);    
		  echo mysql_num_rows($query);
		}if ($function == 'unCheckChat') 
		{	
	              $id = $_POST['id'];		
				  $query = mysql_query("UPDATE tbl_messages SET `is_seen` ='Y' WHERE `from`='$id'");	
		
		}*/
// if ($function == 'getAdminChatWithUser') 
//         { 
//               	$userId = $_REQUEST['userId'];  
// 				$data = array();  
// 				$query = "SELECT `tbl_messages`.*, concat((`tbl_users`.`fname`), (' '), (`tbl_users`.`lname`)) as name ,tbl_users.company_name FROM `tbl_messages` inner join `tbl_users` on `tbl_users`.`id` = `tbl_messages`.from where `to` = '".$userId."' or `from` = '".$userId."' "; 
// 				$result = mysql_query($query);  
// 				if(mysql_num_rows($result) > 0) 
// 				{        
// 			        while($row = mysql_fetch_assoc($result)) 
// 					{            
// 				         echo '<li>';       
// 						 echo '<div class="col-md-4">', ($row['from'] != 1)? $row['name']." (".$row['company_name'].")" : 'You' ,'</div>'; 
// 						 echo '<div class="col-md-4">'.$row['msg'].'</div>';       
// 						 echo '<div class="col-md-4">'.date('d/m/Y h:ia', strtotime($row['time_stamp'])).'</div>'; 
// 						 echo '</li>';          
// 						 $data[] = $row;   
// 					}   
// 				}//    print_r($data);
// 		}
		
// if ($function == 'sendChatMessage') {
//     $query = "INSERT INTO `tbl_messages` (`from`, `to`, `msg`, `readed`, `time_stamp`) VALUES ('1', '".$_REQUEST['userId']."', '".$_REQUEST['messageForUser']."', 'N', '".date('Y-m-d h:i:s')."');"; 
// 	mysql_query($query);
        
// }
	
	
	
	/*if ($function == 'send_video_to_demoRequest')
	{
		$id= $_REQUEST['id'];
              
                $query = "UPDATE tbl_demo SET is_send='y' WHERE id='$id'";
                $update = mysql_query($query);
                
		//select email of user
		$selectId = mysql_query("SELECT * FROM tbl_demo WHERE id='$id'");
		$data     = mysql_fetch_array($selectId);
               
	        $eMailId  =    $data['email'];
                $name     =    $data['name'];
            
             //sending mail to user
               $to = $eMailId;
               $subject = "Book a demo";

               $message = "Guten Tag ".$name." <br/><br/>";
               $message .= "Vielen Dank f&uuml;r Ihr Interesse an FORSA GMBH Bitte klicken Sie auf untenstehenden Link<br/>";
               $message .= "<a href='$base_url?show_video'>Demolink</a><br/><br/>";
               $message .= 'Herzlichen Dank <br/>';
		$message .= 'Freundliche Gr&uuml;sse <br/>';
		$message .= "FORSA GMBH <br>";
		
		$message .= "nolte@forsa-gmbh.de";
               
               
               //$header = "From:noreply@webmobinfo.ch \r\n";
               $header  =  "From: nolte@forsa-gmbh.de \r\n";
               $header .= "Cc: info@forsa-gmbh.de \r\n";       
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
         
                $retval = mail ($to,$subject,$message,$header);

                if( $retval == true ) {
                   echo "Message sent successfully...";
                }else {
                   echo "Message could not be sent...";
                }
             
               
	}*/
	 /*if( $function ==  "setMaturityShow" )
	 {
	       $status = $_POST['status'];
		$updateStatus = mysql_query("UPDATE `tbl_money_market` SET `showDatesManual` = '".$status."'");
		 
	 }
 if( $function ==  "eur_setMaturityShow" )
	 {
	       $status = $_POST['status'];
		$updateStatus = mysql_query("UPDATE `tbl_money_market` SET `eur_showDatesManual` = '".$status."'");
		 
	 }

if( $function ==  "usd_setMaturityShow" )
	 {
	       $status = $_POST['status'];
		$updateStatus = mysql_query("UPDATE `tbl_money_market` SET `usd_showDatesManual` = '".$status."'");
		 
	 }
         if ($function == 'dalete_holiday') 
        { 
            $dateId  = $_POST['dateId'];
			
			$delete  = mysql_query("delete from tbl_calender where id = '$dateId'");
	    }
            
             if ($function == 'deleteNewsById') 
        { 
            $dateId  = $_POST['id'];
			
			$delete  = mysql_query("delete from tbl_home_news where id = '$dateId'");
	    }
		if($function == 'enableUser')
		{
			$id            = $_POST['id'];
                        $adminId       = $_SESSION['user_id'];
			$adminFullName = $_SESSION['adminName'];
                        $userDetails = mysql_query("SELECT `id`, `fname` , `lname`,`uname` FROM `tbl_users` WHERE `id` = '$id'");
                        
                        $fetchUser   = mysql_fetch_assoc($userDetails);
                        $userfullName = $fetchUser['fname']." ".$fetchUser['lname']; 
                        $userUserName  = $fetchUser['uname'];
                        $dateTime     = date("d.m.Y H:i:s");
                        $insertedDateTime = date("Y-m-d H:i:s");
			$update = mysql_query("UPDATE `tbl_users` SET `is_archieve` = 'n' , `status` = 'y' WHERE `id` = " . $id );
                        
                        $logReintiateUSer = "$adminFullName has reinitiated the user $userfullName ( $userUserName ) on $dateTime";
			
                        $insertIntoLog   = mysql_query("INSERT INTO `tbl_admin_logs`(`admin_id`,`msg`,`deleted_time`)VALUES ('".$adminId."','".$logReintiateUSer."','".$insertedDateTime."') ");
		}
                if($function == "archieveThisDemo")
		{
			$demoId = $_POST['demoId'];
			$archieveThisDemoRequest = mysql_query("UPDATE `tbl_demo` SET `is_archieve` = 'y' WHERE `id` = '$demoId' ");
		}
		if($function == "activeThisDemo")
		{
			$demoId = $_POST['demoId'];
			$archieveThisDemoRequest = mysql_query("UPDATE `tbl_demo` SET `is_archieve` = 'n' WHERE `id` = '$demoId' ");
		}
                if($function == "deleteThisDemo")
		{
			$demoId = $_POST['demoId'];
			$archieveThisDemoRequest = mysql_query("DELETE FROM `tbl_demo` WHERE `id` = '$demoId' ");
		}*/
                
                
                
	?>
