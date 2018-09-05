<?php include_once 'header.php';?>
<?php 
if(isset($_POST['open_loansabc'])){
    $useri=$_POST['user_id'];
    header('Location:archive_data.php?start='.date("Y-m-d", strtotime($_POST['o_from'])).'&end='.date("Y-m-d", strtotime($_POST['o_to'])) );
}
 $msg = '';
if(isset($_POST['export'])){

 //$qry_final="SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name,  tbl_user_logged_status.is_logged, tbl_user_logged_status.last_login, tbl_user_logged_status.last_logout, tbl_user_logged_status.user_id, tbl_user_logged_status.ip_address FROM tbl_users INNER JOIN tbl_user_logged_status ON tbl_users.id=tbl_user_logged_status.user_id WHERE tbl_user_logged_status.user_id = '$useri' $qrypre ORDER BY tbl_user_logged_status.id DESC";
//---------------------------------------------------    
    $host='macmille.mysql.db.internal';
$user='macmille_mac';
$password='iuFWgCTS';
$database='macmille_instmtch';
$link=  mysqli_connect($host, $user, $password, $database);

$host1='macmille.mysql.db.internal';
$user1='macmille_mine';
$password1='2qDemZHV';
$database1='macmille_archived';
$link1=  mysqli_connect($host1, $user1, $password1, $database1);

        if(!empty($_POST['o_from'])){
        //$qrypre=" AND tbl_user_logged_status.last_login BETWEEN '" . date("Y-m-d", strtotime($_POST['o_from'])) . "' AND '" . date("Y-m-d", strtotime($_POST['o_to'])) . "'";
            $qry="SELECT * FROM tbl_borrower_request where DATE(tbl_borrower_request.created_date) BETWEEN '" . date("Y-m-d", strtotime($_POST['o_from'])) . "' AND '" . date("Y-m-d", strtotime($_POST['o_to'])) . "'";
            //$qry="SELECT * FROM tbl_borrower_request";
        }
        else {
            //$qrypre="";
            $qry="SELECT * FROM tbl_borrower_request";
        }

//$qry="SELECT * FROM tbl_borrower_request";
$res=  mysqli_query($link, $qry);
while ($row=  mysqli_fetch_array($res))
{
$insert="INSERT INTO `tbl_borrower_request`(`id`, `borrower_id`, `req_name`, `amount`, `amount_display`, `currency`, `maturity`, `minimum_bid`, `term`, `duration`, `interest_scheduled`, `close_date`, `close_time`, `notes`, `lender_id`, `annonymous_status`, `immediate_execution`, `status`, `closing_date`, `created_date`, `updated`, `type_of_investment`, `location`, `approx_yield`, `teaser_pdf`, `contact`) VALUES ('".$row['id']."','".$row['borrower_id']."','".$row['req_name']."','".$row['amount']."','".$row['amount_display']."','".$row['currency']."','".$row['maturity']."','".$row['minimum_bid']."','".$row['term']."','".$row['duration']."','".$row['interest_scheduled']."','".$row['close_date']."','".$row['close_time']."','".$row['notes']."','".$row['lender_id']."','".$row['annonymous_status']."','".$row['immediate_execution']."','".$row['status']."','".$row['closing_date']."','".$row['created_date']."','".$row['updated']."','".$row['type_of_investment']."','".$row['location']."','".$row['approx_yield']."','".$row['teaser_pdf']."','".$row['contact']."')";    
$rest=mysqli_query($link1, $insert);
$delete="DELETE FROM `tbl_borrower_request` WHERE `id`='".$row['id']."'";
$resdel=  mysqli_query($link, $delete);
}
 $msg = 'Archived Successfuly';
//--------------------------------------------------    
}

?>
<!-- Wrapper Start -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    //$(document).ready(function(){
        //setInterval(function() {
            //$("#container").load("user_stat.php");
        //}, 100);
    //});

</script>
<div class="wrapper">
	<div class="structure-row">
        <!-- Sidebar Start -->
        <?php include_once 'side_bar.php';?>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <?php include_once 'top_right.php';?>
            <!-- Right Section Header End -->
            <!-- Content Section Start -->
			
			 <?php
			 include_once 'config.php';
                         if(isset($_REQUEST['start'])){
                             $start=$_REQUEST['start'];
                             $end=$_REQUEST['end'];
                            $userid= $_REQUEST['id'];
                            //created_date;
                             //$wry="AND DATE(tbl_user_logged_status.last_login) BETWEEN '" . $start . "' AND '" . $end . "' ";
                            $qry="SELECT * FROM tbl_borrower_request where DATE(tbl_borrower_request.created_date) BETWEEN '" . $start . "' AND '" . $end . "'";
                         }
                        else {
                            //$wry="";
                            $qry="SELECT * FROM tbl_borrower_request";
                        }
                        $user_status= mysql_query($qry);
			 
//				$user_status= mysql_query("SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name,  tbl_user_logged_status.is_logged, tbl_user_logged_status.last_login, tbl_user_logged_status.last_logout
//				, tbl_user_logged_status.user_id, tbl_user_logged_status.ip_address
//											FROM tbl_users
//												INNER JOIN tbl_user_logged_status
//												ON tbl_users.id=tbl_user_logged_status.user_id WHERE tbl_user_logged_status.user_id = '$userid' $wry ORDER BY tbl_user_logged_status.id DESC
//													"); 
				$count=mysql_num_rows($user_status);
			?>
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 0 15px 23px;
    vertical-align: top;
	
}
.export{
   margin-left: 17px;
}
            </style>
            
            <button type="button" class="btn btn-primary btn-lg" id="popup" data-toggle="modal" data-target="#myModal" style="display: none">
  Launch demo modal
</button>
            <!-- Modal -->
<div id="alertArea" class="alert alert-success" style="display: none;"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title user_popup_heading" id="myModalLabel">User Details</h4>
      </div>
      <div class="modal-body">
        
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a href="user_log_file.php" ><input style="margin-top: -33px;" class="pull-right" type="button" value="Back" ></a>
                                <a class="closethis">Close</a>
                                <header>
                                    <?php // echo $count; ?>
                                    <h2 class="heading">Archive Data</h2><script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                </header>
                                
<!-----------------for date picker-start------->
<div class="col-md-12" style=" margin-bottom: 6px;margin-top: -27px;" >
<!--    <h2 style="text-align: center">Get User Log History By Date</h2>-->
<form id="o_form" role="form" action="" method="post">
<div class="form-group col-md-6" >
<label for="o_from">From:</label>
<input type="hidden" name="user_id" value="<?php echo $userid; ?>" />
<input name="o_from" type="text" class="form-control" id="o_from" value="<?php if(isset($start)) echo $start; ?>">
<span id='o_form_o_from_errorloc' class="text-danger"></span>
</div>
<div class="form-group col-md-6" >
<label for="o_to">To:</label>
<input name="o_to" type="text" class="form-control" id="o_to" value="<?php if(isset($end)) echo $end; ?>" >
<span id='o_form_o_to_errorloc' class="text-danger"></span>
</div>
<div class="clearfix"></div>
<div class="form-group col-md-6" ></div>
<div class="form-group col-md-6" >
    <?php 
    if($count > 0){
        echo '<input name="export" type="submit" class="btn btn-success pull-right export hideMyDiv" value="Archive">';
    }
    ?>    
<input name="open_loansabc" type="submit" class="btn btn-success pull-right hideMyDiv" value="Submit">
</div>
<div class="clearfix"></div>
</form>
</div>
<!-----------------for date picker------End-->
								 <div id = "container">
									
                          <div class="contents" style="margin-top:40px;">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                    	
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                <th>ID </th>									
                                                <th>Borrower Id </th>
                                                <th class='sorting_1'>Req Name </th>
                                                <th class='sorting_1'>Created Date </th>
                                                </tr>
                                            </thead>
											
                                            <tbody>
<?php
if ($msg != '') {
    echo "<div class='alert alert-success'>" . $msg . "</div>";
}
?>                                                
                                                   <?php
                                                while($rows = mysql_fetch_array($user_status))
                                                {											
                                                                        echo '<tr class="gradeX">';
                                                                        echo "<td>".$rows['id']."</td><td>".$rows['borrower_id']."</td><td>".$rows['req_name']."</td><td>".$rows['created_date']."</td>";
        //<td>".$rows[4]."</td><td>".$rows[5]."</td><td>".$rows[6]."</td><td>".$rows[7]."</td><td>".$rows[8]."</td><td>".$rows[9]."</td><td>".$rows[10]."</td><td>".$rows[11]."</td><td>".$rows[12]."</td><td>".$rows[13]."</td><td>".$rows[14]."</td><td>".$rows[15]."</td><td>".$rows[16]."</td><td>".$rows[17]."</td><td>".$rows[18]."</td><td>".$rows[19]."</td><td>".$rows[20]."</td><td>".$rows[21]."</td><td>".$rows[22]."</td><td>".$rows[23]."</td><td>".$rows[24]."</td>
                                                                                              
        echo '</tr>';
        }  
												 ?>
                                                    <?php
											  
                                            ?>
                                                  
											<script>
                                        	var asInitVals = new Array();			
											$(document).ready(function() {
												var oTable = $('#example').dataTable( {
													"oLanguage": {
														"sSearch": "Search all columns:"
													}
												} );
												
												$("tfoot input").keyup( function () {
													/* Filter on the column (the index) of this element */
													oTable.fnFilter( this.value, $("tfoot input").index(this) );
												} );
												
												
												
												/*
												 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
												 * the footer
												 */
												$("tfoot input").each( function (i) {
													asInitVals[i] = this.value;
												} );
												
												$("tfoot input").focus( function () {
													if ( this.className == "search_init" )
													{
														this.className = "";
														this.value = "";
													}
												} );
												
												$("tfoot input").blur( function (i) {
													if ( this.value == "" )
													{
														this.className = "search_init";
														this.value = asInitVals[$("tfoot input").index(this)];
													}
												} );
											} );

                                        </script>	  
											  
											
										</tbody>
											<tfoot>
											</tfoot>
											</table>
											</div>

											</div>

                                       </div>
<script src="assets/js/jquery-ui.js" type="text/javascript"></script>
<link href="assets/css/style_1.css" rel="stylesheet" type="text/css"/>                               
 <script>
    $(function () {
        $("#o_from, #o_to, #c_from, #c_to").datepicker();
    });
    $(function () {
//        var frmvalidator = new Validator("o_form");
//        frmvalidator.EnableOnPageErrorDisplay();
//        frmvalidator.EnableMsgsTogether();
//        frmvalidator.addValidation("o_from", "req", "Please select date");
//        frmvalidator.addValidation("o_to", "req", "Please select date");
//        
//        var frmvalidator = new Validator("c_form");
//        frmvalidator.EnableOnPageErrorDisplay();
//        frmvalidator.EnableMsgsTogether();
//        frmvalidator.addValidation("c_from", "req", "Please select date");
//        frmvalidator.addValidation("c_to", "req", "Please select date");
    });
</script>
</body>
</html>
<?php

?>