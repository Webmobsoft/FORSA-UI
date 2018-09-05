<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->Image('logo.png',18,13,33);
$pdf->SetFont('Arial','B',14);
//$pdf->WriteHTML('<para><h1>PHPGang Programming Blog, Tutorials, jQuery, Ajax, PHP, MySQL and Demos</h1><br>
//Website: <u>www.phpgang.com</u></para><br><br>How to Convert HTML to PDF with fpdf example');

$pdf->WriteHTML('<para>Loan Details</para><br><br><br><br><br><br>');
$pdf->SetFont('Arial','B',7); 
 $request_id = $_GET['id'];
$this->load->database();
$this->db->select("tbl_borrower_request.*,tbl_users.uname");
$this->db->from("tbl_borrower_request");
$this->db->join("tbl_users","tbl_borrower_request.borrower_id=tbl_users.id");
$this->db->where("tbl_borrower_request.id",$request_id);
$result = $this->db->get();
$get_result = $result->result_array();
//$select_query = mysql_query("select tbl_borrower_request.*,tbl_users.uname,tbl_users.email from tbl_borrower_request where id='$request_id'");
//$get_result = mysql_fetch_array($select_query);
//echo "<pr>";
//print_r($get_result);
//die;
$htmlTable='<TABLE>
    <tr><td>Request Name</td><td>Amount</td><td>Maturity</td><td>Interest Scheduled</td><td>Status</td><td>Closed Date</td><td>Closed Time</td></tr>
<TR>
<TD>'.$get_result['req_name'].'</TD>
<TD>'.$get_result['amount_display'].'</TD>
<TD>'.$get_result['maturity'].'</TD>
<TD>'.$get_result['interest_scheduled'].'</TD>
<TD>'.$get_result['status'].'</TD>
<TD>'.$get_result['close_date'].'</TD>
<TD>'.$get_result['close_time'].'</TD>
</TR>

</TABLE>';
$get_offers = mysql_query("select tbl_lender_response.*,tbl_users.company_name from tbl_lender_response inner join tbl_users on tbl_lender_response.lender_id = tbl_users.id where request_id = '$request_id'");
if(mysql_num_rows($get_offers) > 0 )
{
    $get_offer_result = mysql_fetch_array($get_offers);
    $offerTable='<TABLE>
    <tr><td>Company Name</td><td>Offered Amount</td><td>Notes</td></tr>
<TR>
<TD>'.$get_offer_result['company_name'].'</TD>
<TD>'.$get_offer_result['lender_amount_display'].'</TD>
<TD>'.$get_offer_result['response_notes'].'</TD>

</TR>

</TABLE>';
}
else
{
    $get_offer_result = "<br><style='color:red'>No result found.";
}

$pdf->WriteHTML2("<h3>Request Details</h3>$htmlTable");
$pdf->WriteHTML2("<h3>No. of offers</h3>$get_offer_result");
$pdf->SetFont('Arial','B',6);
$date = date('Ymdhs');
 $filename= $date.".pdf";
$filelocation = "files";
$fileNL = $filelocation."/".$filename;
$pdf->output($fileNL,'F');
$this->load->library('email');

$this->email->from('your@example.com', 'Your Name');
$this->email->to('santosh@cyberheight.ocm');
$this->email->cc('another@another-example.com');
$this->email->bcc('them@their-example.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

echo $this->email->print_debugger();
?>