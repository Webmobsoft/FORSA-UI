<?php

$showCustomNav = true;

/* functions start */
function getDataByQuery($select_query) {
    include_once 'config.php';
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
    include_once 'config.php';
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

    if (!empty($_POST['open_loans'])) {
        $currenSheet->setCellValue('A1', 'Borrower');
        $currenSheet->setCellValue('B1', 'Borrower User Name');
        $currenSheet->setCellValue('C1', 'Deal ID');
        $currenSheet->setCellValue('D1', 'Request Title');
        $currenSheet->setCellValue('E1', 'Amount');
        $currenSheet->setCellValue('F1', 'Date and time of original request');
        $currenSheet->setCellValue('G1', 'Interest scheduled');
        $currenSheet->setCellValue('H1', 'Maturity Date');
        $currenSheet->setCellValue('I1', 'Close Date');
        $currenSheet->setCellValue('J1', 'Annonymous status');
        $currenSheet->setCellValue('K1', 'Lender');
        $currenSheet->setCellValue('L1', 'Lender User Name');
        $currenSheet->setCellValue('M1', 'Amount done');
        $currenSheet->setCellValue('N1', 'Time Stamp of Deal done');

        $query = "SELECT tbl_borrower_request.*, tbl_users.uname, tbl_users.fname,tbl_users.lname "
                . "FROM tbl_borrower_request "
                . "INNER JOIN tbl_users ON tbl_users.id = tbl_borrower_request.borrower_id "
                . "WHERE tbl_borrower_request.status='open' "
                . "AND tbl_borrower_request.close_date BETWEEN '" . date("Y-m-d", strtotime($_POST['o_from'])) . "' AND '" . date("Y-m-d", strtotime($_POST['o_to'])) . "' ";
        $data = getDataByQuery($query);

        if (!empty($data)) {
            $index = 2;
            foreach ($data as $key => $value) {
               if (!empty($value)) {
                    
                    $landerName = '';
                    $landerUsername = '';
                    $amountDone = '';
                    $dateDealDone = '';
        
                    $query = "SELECT * FROM `tbl_loan_accepted` WHERE `tbl_loan_accepted`.`request_id` = '".$value['id']."' ";
                    $loanAcceptedData = getDataRowByQuery($query);
                    
                    if(!empty($loanAcceptedData)) {
                        $query = "SELECT * FROM `tbl_users` WHERE `tbl_users`.`id` = '".$loanAcceptedData['lender_id']."' ";
                        $landerData = getDataRowByQuery($query);
                        $landerName = $landerData['fname'].' '.$landerData['lname'];
                        $landerUsername = $landerData['uname'];
                        
                        $dateDealDone = date("d/m/Y h:i a", strtotime($loanAcceptedData['date']));
                        
                        $query = "SELECT * FROM `tbl_lender_response` WHERE `tbl_lender_response`.`request_id` = '".$value['id']."' AND `tbl_lender_response`.`lender_id` = '".$loanAcceptedData['lender_id']."' ";
                        $offerData = getDataRowByQuery($query);
                        $amountDone = $offerData['lender_amount_display'];
                    }
                    
                    $currenSheet->setCellValue('A' . $index, ($value['fname']) . ' ' . ucfirst($value['lname']));
                    $currenSheet->setCellValue('B' . $index, $value['uname']);
                    $currenSheet->setCellValue('C' . $index, $value['id']);
                    $currenSheet->setCellValue('D' . $index, $value['req_name']);
                    $currenSheet->setCellValue('E' . $index, $value['amount_display']);
                    $currenSheet->setCellValue('F' . $index, $value['created_date']);
                    $currenSheet->setCellValue('G' . $index, $value['interest_scheduled']);
                    $currenSheet->setCellValue('H' . $index, date('j F Y', strtotime($value['maturity'])));
                    $currenSheet->setCellValue('I' . $index, date('j F Y', strtotime($value['close_date'])) . " " . $rows['close_time']);
                    $currenSheet->setCellValue('J' . $index, ucfirst($value['annonymous_status']));
                    $currenSheet->setCellValue('K' . $index, ucfirst($landerName));
                    $currenSheet->setCellValue('L' . $index, $landerUsername);
                    $currenSheet->setCellValue('M' . $index, $amountDone);
                    $currenSheet->setCellValue('N' . $index, $dateDealDone);
                }
                $index++;
            }
        }
    }

    if (!empty($_POST['closed_loans'])) {
        $currenSheet->setCellValue('A1', 'Borrower');
        $currenSheet->setCellValue('B1', 'Borrower User Name');
        $currenSheet->setCellValue('C1', 'Deal ID');
        $currenSheet->setCellValue('D1', 'Request Title');
        $currenSheet->setCellValue('E1', 'Amount');
        $currenSheet->setCellValue('F1', 'Date and time of original request');
        $currenSheet->setCellValue('G1', 'Interest scheduled');
        $currenSheet->setCellValue('H1', 'Maturity Date');
        $currenSheet->setCellValue('I1', 'Close Date');
        $currenSheet->setCellValue('J1', 'Annonymous status');
        $currenSheet->setCellValue('K1', 'Lender');
        $currenSheet->setCellValue('L1', 'Lender User Name');
        $currenSheet->setCellValue('M1', 'Amount done');
        $currenSheet->setCellValue('N1', 'Time Stamp of Deal done');

        $query = "SELECT tbl_borrower_request.*, tbl_users.uname, tbl_users.fname, tbl_users.lname "
                . "FROM tbl_borrower_request "
                . "INNER JOIN tbl_users ON tbl_users.id = tbl_borrower_request.borrower_id "
                . "WHERE tbl_borrower_request.status='closed'"
                . "AND tbl_borrower_request.close_date BETWEEN '" . date("Y-m-d", strtotime($_POST['c_from'])) . "' AND '" . date("Y-m-d", strtotime($_POST['c_to'])) . "' ";
        $data = getDataByQuery($query);

        if (!empty($data)) {
            $index = 2;
            foreach ($data as $key => $value) {
                if (!empty($value)) {
                    
                    $landerName = '';
                    $landerUsername = '';
                    $amountDone = '';
                    $dateDealDone = '';
        
                    $query = "SELECT * FROM `tbl_loan_accepted` WHERE `tbl_loan_accepted`.`request_id` = '".$value['id']."' ";
                    $loanAcceptedData = getDataRowByQuery($query);
                    
                    if(!empty($loanAcceptedData)) {
                        $query = "SELECT * FROM `tbl_users` WHERE `tbl_users`.`id` = '".$loanAcceptedData['lender_id']."' ";
                        $landerData = getDataRowByQuery($query);
                        $landerName = $landerData['fname'].' '.$landerData['lname'];
                        $landerUsername = $landerData['uname'];
                        
                        $dateDealDone = date("d/m/Y h:i a", strtotime($loanAcceptedData['date']));
                        
                        $query = "SELECT * FROM `tbl_lender_response` WHERE `tbl_lender_response`.`request_id` = '".$value['id']."' AND `tbl_lender_response`.`lender_id` = '".$loanAcceptedData['lender_id']."' ";
                        $offerData = getDataRowByQuery($query);
                        $amountDone = $offerData['lender_amount_display'];
                    }
                    
                    $currenSheet->setCellValue('A' . $index, ($value['fname']) . ' ' . ucfirst($value['lname']));
                    $currenSheet->setCellValue('B' . $index, $value['uname']);
                    $currenSheet->setCellValue('C' . $index, $value['id']);
                    $currenSheet->setCellValue('D' . $index, $value['req_name']);
                    $currenSheet->setCellValue('E' . $index, $value['amount_display']);
                    $currenSheet->setCellValue('F' . $index, $value['created_date']);
                    $currenSheet->setCellValue('G' . $index, $value['interest_scheduled']);
                    $currenSheet->setCellValue('H' . $index, date('j F Y', strtotime($value['maturity'])));
                    $currenSheet->setCellValue('I' . $index, date('j F Y', strtotime($value['close_date'])) . " " . $rows['close_time']);
                    $currenSheet->setCellValue('J' . $index, ucfirst($value['annonymous_status']));
                    $currenSheet->setCellValue('K' . $index, ucfirst($landerName));
                    $currenSheet->setCellValue('L' . $index, $landerUsername);
                    $currenSheet->setCellValue('M' . $index, $amountDone);
                    $currenSheet->setCellValue('N' . $index, $dateDealDone);
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


<?php include_once 'header.php'; ?>

<script src="assets/js/jquery-ui.js" type="text/javascript"></script>
<link href="assets/css/style_1.css" rel="stylesheet" type="text/css"/>
<!-- Wrapper Start -->
<div class="wrapper">
    <div class="structure-row">
        <?php include_once 'side_bar.php'; ?>
        <div class="right-sec">
            <?php include_once 'top_right.php'; ?>
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                 <a class="closethis">Close</a>
								 <a class="togglethis">Toggle</a>
								 
                                <header>
								 
								<div class="col-md-3"></div>
								   <div class="col-md-6"><input type="radio" name="chooseMarketplace" checked="checked" onclick="showMarketplace()"> Marketplace &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="chooseMarketplace" onclick="showMMMarketplace()"> MM Marketplace</div>
                                <div class="col-md-3"></div>                                   
								   
                                </header>
                                <div class="contents" id= "marketplaceShow">
                                   <h2 class="heading col-md-12" id="headingMarketPlace">Export Data Marketplace</h2>
								   
                                    <div class="col-md-6" style="margin-top: 0px;">
                                        <h2>Open Loans</h2>
                                        <form id="o_form" role="form" action="" method="post">
                                            <div class="form-group">
                                                <label for="o_from">From:</label>
                                                <input name="o_from" type="text" class="form-control" id="o_from">
                                                <span id='o_form_o_from_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="o_to">To:</label>
                                                <input name="o_to" type="text" class="form-control" id="o_to">
                                                <span id='o_form_o_to_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="clearfix"></div><br/>
                                            <input name="open_loans" type="submit" class="btn btn-success" value="Submit">
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 0px;">
                                        <h2>Closed Loans</h2>
                                        <form id="c_form" role="form" action="" method="post">
                                            <div class="form-group">
                                                <label for="c_from">From:</label>
                                                <input name="c_from" type="text" class="form-control" id="c_from">
                                                <span id='c_form_c_from_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="c_to">To:</label>
                                                <input name="c_to" type="text" class="form-control" id="c_to">
                                                <span id='c_form_c_to_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="clearfix"></div><br/>
                                            <input name="closed_loans" type="submit" class="btn btn-success" value="Submit">
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div><br/>
                                </div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								 <div class="contents" id= "money_marketplaceShow" style="display:none;">
                                   <h2 class="heading col-md-12" id="headingMarketPlace">Export Data MM Marketplace</h2>
								   
                                    <div class="col-md-6" style="margin-top: 0px;">
                                        <h2>Open Loans</h2>
                                        <form id="o_mm_form" role="form" name="o_mm_form" action="mm_data_export.php" method="post">
                                            <div class="form-group">
                                                <label for="o_from">From:</label>
                                                <input name="mm_from" type="text" class="form-control" id="mm_from" required>
                                               <span id='o_mm_form_mm_from_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="o_to">To:</label>
                                                <input name="mm_to" type="text" class="form-control" id="mm_to" required>
                                               <span id='o_mm_form_mm_to_errorloc' class="text-danger"></span>
                                            </div>
                                            <div class="clearfix"></div><br/>
                                            <input name="open_loans_mm" type="submit" class="btn btn-success" value="Submit" >
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 0px;">
                                        
										
										<h2>Closed Loans</h2>
                                        <form id="c_mm_form" role="form" action="mm_data_export.php" method="post">
                                            <div class="form-group">
                                                <label for="c_from">From:</label>
                                                <input name="c_mm_from" type="text" class="form-control" id="c_mm_from" required>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="c_to">To:</label>
                                                <input name="c_mm_to" type="text" class="form-control" id="c_mm_to" required>
                                                
                                            </div>
                                            <div class="clearfix"></div><br/>
                                            <input name="closed_mm_loans" type="submit" class="btn btn-success" value="Submit">
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div><br/>
                                </div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#o_from, #o_to, #c_from, #c_to").datepicker();
    });
    $(function () {
        var frmvalidator = new Validator("o_form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("o_from", "req", "Please select date");
        frmvalidator.addValidation("o_to", "req", "Please select date");

        var frmvalidator = new Validator("c_form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("c_from", "req", "Please select date");
        frmvalidator.addValidation("c_to", "req", "Please select date");
    });
</script>
<script>
$(function () {
        $("#mm_from, #mm_to, #c_mm_to, #c_mm_from").datepicker();
    });
	
	 $(function () {
        var frmvalidator = new Validator("o_form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("mm_from", "req", "Please select date");
        frmvalidator.addValidation("mm_to", "req", "Please select date");

        var frmvalidator = new Validator("c_form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("c_from", "req", "Please select date");
        frmvalidator.addValidation("c_to", "req", "Please select date");
    });
function showMarketplace()
{
	$("#marketplaceShow").show();
	$("#money_marketplaceShow").hide();
}
function showMMMarketplace()
{
	$("#marketplaceShow").hide();
	$("#money_marketplaceShow").show();
}



</script>
</body>
</html>