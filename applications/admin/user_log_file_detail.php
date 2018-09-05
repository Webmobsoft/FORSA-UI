<?php include_once 'header.php';?>
<?php 
if(isset($_POST['open_loansabc'])){
    $useri=$_POST['user_id'];
    header('Location:user_log_file_detail.php?id='.$useri.'&start='.date("Y-m-d", strtotime($_POST['o_from'])).'&end='.date("Y-m-d", strtotime($_POST['o_to'])) );
}
function getDataByQuery($select_query) {
//    include_once 'config.php';
    $m_result = mysql_query($select_query) or die("Some error occure");
    $m_data = array();
    if (mysql_num_rows($m_result) > 0) {
        while ($row = mysql_fetch_assoc($m_result)) {
            $m_data[] = $row;
        }
    }
    return $m_data;
}
if(isset($_POST['export'])){
if (!empty($_POST)) {
    require_once 'Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Instimatch")
            ->setLastModifiedBy("Instimatch")
            ->setTitle("User Record")
            ->setSubject("User Record")
            ->setDescription("User Record")
            ->setKeywords("User Record")
            ->setCategory("Record");
    $currenSheet = $objPHPExcel->setActiveSheetIndex(0);

    $data = array();

    if (!empty($_POST['export'])) {
        $useri=$_POST['user_id'];
        if(!empty($_POST['o_from'])){
                $qrypre=" AND tbl_user_logged_status.last_login BETWEEN '" . date("Y-m-d", strtotime($_POST['o_from'])) . "' AND '" . date("Y-m-d", strtotime($_POST['o_to'])) . "'";
        }
 else {
     $qrypre="";
 }
        
//        if(isset($_POST['open_loans'])){
//        }
        $currenSheet->setCellValue('A1', 'ID');
        $currenSheet->setCellValue('B1', 'User Name');
        $currenSheet->setCellValue('C1', 'Company Name');
        $currenSheet->setCellValue('D1', 'Last Login');
        $currenSheet->setCellValue('E1', 'Ip Address');
$qry_final="SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name,  tbl_user_logged_status.is_logged, tbl_user_logged_status.last_login, tbl_user_logged_status.last_logout, tbl_user_logged_status.user_id, tbl_user_logged_status.ip_address FROM tbl_users INNER JOIN tbl_user_logged_status ON tbl_users.id=tbl_user_logged_status.user_id WHERE tbl_user_logged_status.user_id = '$useri' $qrypre ORDER BY tbl_user_logged_status.id DESC";
$data = getDataByQuery($qry_final); 
    if (!empty($data)) {
            $index = 2;
            foreach ($data as $value) {
               if (!empty($value)) {
                    $currenSheet->setCellValue('A' . $index, $value['user_id']); 
                    $currenSheet->setCellValue('B' . $index, ($value['fname']) . ' ' . ucfirst($value['lname']));
                    $currenSheet->setCellValue('C' . $index, $value['company_name']);
                    $currenSheet->setCellValue('D' . $index, $value['last_login']);
                    $currenSheet->setCellValue('E' . $index, $value['ip_address']);
                }
                $index++;
            }
        }
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $staff_fileName = 'data/User - ' . date('m-d-Y H-i-s') . '.xlsx';
    $objWriter->save($staff_fileName);
    header('Location: ' . $staff_fileName);
}
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
			 $userid = $_GET['id'];
                         if(isset($_REQUEST['start'])){
                             $start=$_REQUEST['start'];
                             $end=$_REQUEST['end'];
                            $userid= $_REQUEST['id'];
                             $wry="AND DATE(tbl_user_logged_status.last_login) BETWEEN '" . $start . "' AND '" . $end . "' ";
                         }
                        else {
                            $wry="";
                        }
			 
				$user_status= mysql_query("SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name,  tbl_user_logged_status.is_logged, tbl_user_logged_status.last_login, tbl_user_logged_status.last_logout
				, tbl_user_logged_status.user_id, tbl_user_logged_status.ip_address
											FROM tbl_users
												INNER JOIN tbl_user_logged_status
												ON tbl_users.id=tbl_user_logged_status.user_id WHERE tbl_user_logged_status.user_id = '$userid' $wry ORDER BY tbl_user_logged_status.id DESC
													"); 
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
                                    <h2 class="heading">User Log History</h2><script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
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
        echo '<input name="export" type="submit" class="btn btn-success pull-right export" value="Export">';
    }
    ?>    
<input name="open_loansabc" type="submit" class="btn btn-success pull-right" value="Submit">
<?php 
//if(isset($start)) {
//     echo '<input name="export" type="submit" class="btn btn-success pull-right" value="Export">';
//}
// else {
//         echo '<input name="export" type="submit" class="btn btn-success pull-right" value="Export">';
//}
?>
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
                                                   <th>Name </th>									
												   <th>Company Name </th>
                                                <th class='sorting_1'>Last Login </th>
<!--                                                 <th class='sorting_1'>Last Logout </th>-->
												 <th class='sorting_1'>IP Address</th>
                                                </tr>
                                            </thead>
											
                                            <tbody>
											<?php
											  while($rows = mysql_fetch_array($user_status))
											  {
												  
												 ?>
												 <tr class="gradeX">
                                                   <td><a href="#"  id="user_detail"> <?php echo $rows['fname'] ." " .$rows['lname'];?></a></td>                                                   <td><?php echo $rows['company_name'];?></td>
												   <td> <?php if($rows['last_login'] != ""){echo    date("d-F-Y H:i:s" ,strtotime($rows['last_login'] ));} ?></td>
													
<!--													 <td> <?php // if($rows['last_logout']!= ""){echo  date("d-F-Y H:i:s" ,strtotime($rows['last_logout']));} ?></td>-->
													 <td> <?php echo $rows['ip_address'];  ?> </td>
												</tr>
                                                    <?php
											  }
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