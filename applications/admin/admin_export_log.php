
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

    
    
    
    /*Deleted User Log Start*/
	
    if (!empty($_POST['deletedUserExport'])) {
		
        $delete_from = $_POST['delete_from'];
        $delete_to   = $_POST['delete_to'];
      
       $formatDeleteFrom = date("Y-m-d",strtotime($delete_from));
       $formatDeleteTo = date("Y-m-d",strtotime($delete_to));
        
       
        $currenSheet->setCellValue('A1', 'Admin Id');
        $currenSheet->setCellValue('B1', 'Detail');
        $currenSheet->setCellValue('D1', 'On Date');
 		  
        $query = "SELECT * from `tbl_admin_logs` WHERE tbl_admin_logs.deleted_time BETWEEN '" .$formatDeleteFrom." 00:00:00" . "' AND '" . $formatDeleteTo. " 00:00:00" . "' ";
      
        $data = getDataByQuery($query);

		   
        if (!empty($data)) {
			
            $index = 2;
            foreach ($data as $key => $value) {
               if (!empty($value)) {
                    
		  
                    
                   
                    $currenSheet->setCellValue('A' . $index, $value['admin_id']);
                    $currenSheet->setCellValue('B' . $index, $value['msg']);
                    $currenSheet->setCellValue('D' . $index, $value['deleted_time']);
                  
                }
                $index++;
				
            }
        }
       
    }
	 /*Deleted User Log Ends*/
	

    
    
    
    
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $staff_fileName = 'data/Loans - ' . date('m-d-Y H-i-s') . '.xlsx';
   $objWriter->save($staff_fileName);
   header('Location: ' . $staff_fileName);
}
?>