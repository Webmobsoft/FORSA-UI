
<?php

include_once 'config.php';
$showCustomNav = true;

/* functions start */
function getDataByQuery($select_query) {
    
    $m_result = mysql_query($select_query) or die("Some error occure");
    $m_data = array();
    if (mysql_num_rows($m_result) > 0) {
        while ($row = mysql_fetch_assoc($m_result)) {
            $m_data[] = $row;
        }
    }
    return $m_data;
}
function getDataRowByQuery($select_query) {
   
    $m_result = mysql_query($select_query) or die("Some error occure");
    $m_data = array();
    if (mysql_num_rows($m_result) > 0) {
        $m_data = mysql_fetch_assoc($m_result);
    }
    return $m_data;
}

/* functions end */

if (!empty($_POST)) {
   require_once 'Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Instimatch")
            ->setLastModifiedBy("Instimatch")
            ->setTitle("Loan Record")
            ->setSubject("Loan Record")
            ->setDescription("Loan Record")
           ->setKeywords("Loan Record")
           ->setCategory("Record");
     $currenSheet = $objPHPExcel->setActiveSheetIndex(0);

    $data = array();

	
    if (!empty($_POST['closed_mm_loans'])) {
		
        $currenSheet->setCellValue('A1', 'Borrower');
        $currenSheet->setCellValue('B1', 'Borrower User Name');
        $currenSheet->setCellValue('C1', 'Deal ID');
        $currenSheet->setCellValue('D1', 'Accepted Term');
        
        $currenSheet->setCellValue('E1', 'Interest scheduled');
        
        
       
        $currenSheet->setCellValue('F1', 'Lender');
        $currenSheet->setCellValue('G1', 'Lender User Name');
        $currenSheet->setCellValue('H1', 'Amount done');
        $currenSheet->setCellValue('I1', 'Time Stamp of Deal done');

 		   $query = "SELECT tbl_market_loan_accepted.* ,tbl_users.fname as borrowerFname, tbl_users.lname as borrowerLname , tbl_users.uname borrowerUsername ,tbl_users.company_name as borrowerCompany  FROM `tbl_market_loan_accepted` INNER JOIN tbl_users ON tbl_users.id = tbl_market_loan_accepted.borrower_id
		    WHERE tbl_market_loan_accepted.time_accept BETWEEN '" . date("Y-m-d", strtotime($_POST['c_mm_from']))." 00:00:00" . "' AND '" . date("Y-m-d", strtotime($_POST['c_mm_to'])). " 00:00:00" . "' ";
        
		$data = getDataByQuery($query);

		   
        if (!empty($data)) {
			
            $index = 2;
            foreach ($data as $key => $value) {
               if (!empty($value)) {
                    
					$lender_id  =  $value['lender_id'];
					
                    $landerName = '';
                    $landerUsername = '';
                    $amountDone = '';
                    $dateDealDone = '';
        
                    $loanAcceptedData = getDataRowByQuery($query);
                    
                    if(!empty($loanAcceptedData)) {
                        $query = "SELECT * FROM `tbl_users` WHERE `tbl_users`.`id` = '".$lender_id."' ";
                        $landerData = getDataRowByQuery($query);
						
                        $landerName = $landerData['fname'].' '.$landerData['lname'];
                        $landerUsername = $landerData['uname'];
                        $landerCompanyName  = $landerData['company_name'];
                        $dateDealDone = date("d/m/Y h:i a", strtotime($loanAcceptedData['date']));
                        
                    }
                    
                    $currenSheet->setCellValue('A' . $index, ($value['borrowerFname']) . ' ' . ucfirst($value['borrowerLname']));
                    $currenSheet->setCellValue('B' . $index, $value['borrowerUsername']);
                    $currenSheet->setCellValue('C' . $index, $value['id']);
                    $currenSheet->setCellValue('D' . $index, $value['accepted_term']);
                  
                   
                    $currenSheet->setCellValue('E' . $index, $value['interest_rate']);
                   
                   
                    $currenSheet->setCellValue('F' . $index, ucfirst($landerName));
                    $currenSheet->setCellValue('G' . $index, $landerUsername);
                    $currenSheet->setCellValue('H' . $index, $value['ammount_accepted']);
                    $currenSheet->setCellValue('I' . $index, $value['time_accept']);
                }
                $index++;
				
            }
        }
    }
	
	
	
	
	

    if (!empty($_POST['open_loans_mm'])) {
        $currenSheet->setCellValue('A1', 'Borrower');
        $currenSheet->setCellValue('B1', 'Borrower User Name');
        $currenSheet->setCellValue('C1', 'Amount');
        $currenSheet->setCellValue('D1', 'CCY');
	$currenSheet->setCellValue('E1', 'Date and time request');
        $currenSheet->setCellValue('F1', 'Maturity Date');
        $currenSheet->setCellValue('G1', 'Term'); 
       
  
        

           $query = "SELECT tbl_market_request.* , `tbl_users`.`fname` , `tbl_users`.`uname` , `tbl_users`.`lname`,`tbl_users`.`company_name` FROM `tbl_market_request` INNER JOIN `tbl_users` ON `tbl_users`.`id` = `tbl_market_request`.`borrower_id` WHERE tbl_market_request.status = 'open' AND tbl_market_request.on_date BETWEEN '" . date("Y-m-d", strtotime($_POST['mm_from']))." 00:00:00" . "' AND '" . date("Y-m-d", strtotime($_POST['mm_to'])). " 00:00:00" . "' ";

		//$query .= "SELECT * FROM `tbl_market_offer` ";
      
	   $query2 = "SELECT tbl_market_offer.*,tbl_market_offer.amount as amount_display , tbl_market_offer.offer_rate as min_bid , `tbl_users`.`fname` , `tbl_users`.`uname` , `tbl_users`.`lname`,`tbl_users`.`company_name`  FROM `tbl_market_offer` INNER JOIN `tbl_users` ON tbl_users.id = tbl_market_offer.lender_id WHERE tbl_market_offer.status = 'open' AND tbl_market_offer.on_date BETWEEN '" . date("Y-m-d", strtotime($_POST['mm_from']))." 00:00:00" . "' AND '" . date("Y-m-d", strtotime($_POST['mm_to'])). " 00:00:00" . "' ";
	
	   $data  = getDataByQuery($query);
	  $data2 = getDataByQuery($query2);
	
	   $data3 = array_merge($data,$data2);
	   
        if (!empty($data3)) {
            $index = 2;
            foreach ($data3 as $key => $value) {
                if (!empty($value)) {
                    
                   
                   $currenSheet->setCellValue('A' . $index, ($value['fname']) . ' ' . ucfirst($value['lname']));
                   $currenSheet->setCellValue('B' . $index, $value['uname']);
                   $currenSheet->setCellValue('C' . $index, $value['amount_display']);
					$currenSheet->setCellValue('D' . $index, $value['currency']);
                   $currenSheet->setCellValue('E' . $index, $value['on_date']);
                   $currenSheet->setCellValue('F' . $index, $value['min_bid']."%");
                   $currenSheet->setCellValue('G' . $index, $value['term']."");
                }
                $index++;
            }
        }
    }

    
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $staff_fileName = 'data/Loans - ' . date('m-d-Y H-i-s') . '.xlsx';
   $objWriter->save($staff_fileName);
   header('Location: ' . $staff_fileName);
}
?>