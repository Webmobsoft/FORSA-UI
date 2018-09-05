<?php include_once 'header.php';?>
<!-- Wrapper Start -->
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
                        $_where = "";
            if(isset($_GET['id'])){
                        $_where = " and tbl_borrower_request.borrower_id='".$_GET['id']."'";
            }

$select_closed_loan = mysql_query("select tbl_borrower_request.*,tbl_users.fname,tbl_users.lname from tbl_borrower_request inner join tbl_users on tbl_users.id = tbl_borrower_request.borrower_id where tbl_borrower_request.status='closed'".$_where);
$count = mysql_num_rows($select_closed_loan);
?>
            <button type="button" class="btn btn-primary btn-lg" id="popup" data-toggle="modal" data-target="#myModal" style="display: none">
  Launch demo modal
</button>
            <!-- Modal -->
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
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Closed Loan</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                    	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                        <?php
                                        if($count > 0)
                                        {
                                        ?>
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Borrower Name </th>
                                                    <th>Deal ID</th>
                                                    <th>Request Title </th>
                                                    <th>Amount </th>
                                                    <th>CCY </th>
                                                    <th>Interest scheduled </th>													<th>Interest Rate </th>
                                                    <th>Maturity Date</th>
                                                    <th>Close Date </th>
                                                    <th>Lender Name </th>
                                                    <th>Annonymous status </th>
                                                    <th></th>
                                                <!--<th>option </th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysql_fetch_array($select_closed_loan))
                                            {
                                               
                                                $id= $rows['id'];
//                                                echo "select * from tbl_users inner join  tbl_borrower_request on tbl_borrower_request.lender_id=tbl_users.id where tbl_users.id IN (lender_id) and tbl_borrower_request.id='$id'";
//                                                    die;
                                                 $lender_name = '';
                                                $get_lender_name = mysql_query("select `lender_id` from `tbl_loan_accepted` where `request_id` = '".$id."' ");												$fetch_array = mysql_fetch_array($get_lender_name);												$lender_id   = $fetch_array['lender_id'];                                                  $lender_name_sql = mysql_query("select `fname`,`lname` from `tbl_users` where `id` = '".$lender_id."' ");												$lender_name_fetch = mysql_fetch_array($lender_name_sql);																								                                                    $lenderFname = $string  = $lender_name_fetch['fname'];													$string = urlencode($string);													$string = str_replace('%DF','ß',$string);													$string = str_replace('%E4','ä',$string);													$string = str_replace('%F6','ö',$string);													$string = str_replace('%2B','+',$string);													$string = str_replace('%FC','ü',$string);													$string = str_replace('%26','&',$string);													$string = str_replace('%2F','/',$string);													$string = str_replace('%0A','',$string);													$string = str_replace('%0D','',$string);													$string = str_replace('%40','@',$string);													$string = str_replace('%2C',',',$string);													$string = str_replace('%E1','á',$string);													$string = str_replace('%D3','ó',$string);													$string = str_replace('+',' ',$string);																																							$lenderLname =  $lender_name_fetch['lname'];													$lenderLname = urlencode($lenderLname);													$lenderLname = str_replace('%DF','ß',$lenderLname);													$lenderLname = str_replace('%E4','ä',$lenderLname);													$lenderLname = str_replace('%F6','ö',$lenderLname);													$lenderLname = str_replace('%2B','+',$lenderLname);													$lenderLname = str_replace('%FC','ü',$lenderLname);													$lenderLname = str_replace('%26','&',$lenderLname);													$lenderLname = str_replace('%2F','/',$lenderLname);													$lenderLname = str_replace('%0A','',$lenderLname);													$lenderLname = str_replace('%0D','',$lenderLname);													$lenderLname = str_replace('%40','@',$lenderLname);													$lenderLname = str_replace('%2C',',',$lenderLname);													$lenderLname = str_replace('%E1','á',$lenderLname);													$lenderLname = str_replace('%D3','ó',$lenderLname);													$lenderLname = str_replace('+',' ',$lenderLname);																																																												$lender_name   = $string." ".$lenderLname;
                                               
                                                $user_id = $rows['borrower_id'];
                                                
                                                																																																   $BorrowerFname  = $rows['fname'];													$BorrowerFname = urlencode($BorrowerFname);													$BorrowerFname = str_replace('%DF','ß',$BorrowerFname);													$BorrowerFname = str_replace('%E4','ä',$BorrowerFname);													$BorrowerFname = str_replace('%F6','ö',$BorrowerFname);													$BorrowerFname = str_replace('%2B','+',$BorrowerFname);													$BorrowerFname = str_replace('%FC','ü',$BorrowerFname);													$BorrowerFname = str_replace('%26','&',$BorrowerFname);													$BorrowerFname = str_replace('%2F','/',$BorrowerFname);													$BorrowerFname = str_replace('%0A','',$BorrowerFname);													$BorrowerFname = str_replace('%0D','',$BorrowerFname);													$BorrowerFname = str_replace('%40','@',$BorrowerFname);													$BorrowerFname = str_replace('%2C',',',$BorrowerFname);													$BorrowerFname = str_replace('%E1','á',$BorrowerFname);													$BorrowerFname = str_replace('%D3','ó',$BorrowerFname);													$BorrowerFname = str_replace('+',' ',$BorrowerFname);																																							$BorrowerLname =  $rows['lname'];													$BorrowerLname = urlencode($BorrowerLname);													$BorrowerLname = str_replace('%DF','ß',$BorrowerLname);													$BorrowerLname = str_replace('%E4','ä',$BorrowerLname);													$BorrowerLname = str_replace('%F6','ö',$BorrowerLname);													$BorrowerLname = str_replace('%2B','+',$BorrowerLname);													$BorrowerLname = str_replace('%FC','ü',$BorrowerLname);													$BorrowerLname = str_replace('%26','&',$BorrowerLname);													$BorrowerLname = str_replace('%2F','/',$BorrowerLname);													$BorrowerLname = str_replace('%0A','',$BorrowerLname);													$BorrowerLname = str_replace('%0D','',$BorrowerLname);													$BorrowerLname = str_replace('%40','@',$BorrowerLname);													$BorrowerLname = str_replace('%2C',',',$BorrowerLname);													$BorrowerLname = str_replace('%E1','á',$BorrowerLname);													$BorrowerLname = str_replace('%D3','ó',$BorrowerLname);													$BorrowerLname = str_replace('+',' ',$BorrowerLname);												
                                                $user_name = $BorrowerFname." ".$BorrowerLname;
                                                ?>
                                                <tr class="gradeX">
                                                   <td class=" " onclick="get_full_detail(<?php echo $user_id;?>)" style="cursor: pointer"><?php echo $user_name;?></td>
                                                <td class=" "><?php echo $rows['id']; ?></td>
                                                   <td class=" "><?php echo $rows['req_name'];?></td>
                                                <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                <td class=" "><?php echo $rows['amount_display'];?> </td>                                                </td>
                                                <td class=" "><?php echo $rows['currency'];?> </td>    
                                                <td class=" "><?php echo $rows['interest_scheduled'];?></td>                                               <td>  <?php $sql = mysql_query("SELECT `offer_rate` FROM `tbl_lender_response` WHERE `request_id` = '".$rows['id']."'");														$fetch = mysql_fetch_array($sql);														if($fetch ['offer_rate'] != "")														{															echo $fetch ['offer_rate']."%";														}											   ?></td>
                                                <td class="a-right a-right "><?php echo date('j F Y',strtotime($rows['maturity']));?></td>
                                                <td class=" last"><a href="#"><?php echo date('j F Y',strtotime($rows['close_date']))." ".$rows['close_time'];?></a>
                                                  <td class=" "><?php echo $lender_name;?></td>
                                                  <td class=" "><?php echo $rows['annonymous_status'];?></td>
                                                <td class=" "><a href="requestDetails.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-eye fa-2x"></i></a></td>
                                                </tr>
                                                    <?php
                                            }
                                            ?>
                                                
                                            </tbody>
                                            <tfoot>
                                                <!--<tr>
                                                    <th><input type="text" name="search_engine" value="Search engines" class="search_init" /></th>
                                                    <th><input type="text" name="search_browser" value="Search browsers" class="search_init" /></th>
                                                    <th><input type="text" name="search_platform" value="Search platforms" class="search_init" /></th>
                                                    <th><input type="text" name="search_version" value="Search versions" class="search_init" /></th>
                                                    <th><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
                                                </tr>-->
                                            </tfoot>
                                        </table>
                                        <?php
                                        }
                                        else
                                        {
                                            echo "<i style=color:red>Open loan list empty</i>";
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
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<!-- Wrapper End -->
<script>
    function get_full_detail(id)
    {
         var data_to_send = 'id=' + id +'&function=get_full_detail';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
           $("#popup").click();
           $(".modal-body").html(htnlstr);
           //alert(htnlstr);
           //$("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on("+id+")'>");
       }
    });
    }
function make_it_off(id)
{
    //alert(id);
    var data_to_send = 'id=' + id +'&function=make_it_off';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on("+id+")'>");
       }
    });
}
function make_it_on(id)
{
    //alert(id);
    var data_to_send = 'id=' + id +'&function=make_it_on';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_on.png' onclick='make_it_off("+id+")'>");
       }
    });
}
</script>
</body>
</html>
