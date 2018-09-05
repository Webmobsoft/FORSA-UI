<?php include_once 'header.php';?>
<style>
/*    .table > thead > tr > th, table td {
        font-size: 12px;
        padding: 6px !important;
    }*/
</style>
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
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 0 15px 23px;
    vertical-align: top;
}
            </style>
            <?php
$select_lender = mysql_query("SELECT tbl_users . * , tbl_lender_services.name as category_name, tbl_fedafin_rating.rating_name as fedafin_rating FROM `tbl_users` INNER JOIN tbl_lender_services ON tbl_lender_services.id = tbl_users.category
 LEFT JOIN tbl_fedafin_rating ON tbl_fedafin_rating.id = tbl_users.fedafin_rating WHERE user_type = 'borrower' AND tbl_users.is_archieve = 'n' ");
$count = mysql_num_rows($select_lender);
?>
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
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Borrower Details</h2>
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
                                                   <th>User Name </th>
                                                   <th>First Name </th>
                                                <th>Last Name </th>
                                                <th>Company Name </th>
                                                <th>Contact_Number </th>
                                                <th>Email</th>
                                                <th>Fedafin Rating </th>
                                                <th>category </th>
                                                <th>User Type </th>
                                                <th>Activated Date </th>
                                                 <?php if( $_SESSION['privilege'] != "1"  ){ ?> <th>option </th><?php } ?>
                                                <th>Loan </th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysql_fetch_array($select_lender))
                                            {

                                                $user_id = $rows['id'];
												$UName = $rows['uname'];
												$fName = $string = $rows['fname'];
												$LName = $rows['lname'];
												$compName =  $rows['company_name'];

                                                ?>
                                                <tr class="gradeX">
                                                    <td class=" "><?php echo $UName;?> 
                                                   <td class=" " onclick="get_full_detail(<?php echo $user_id;?>)" style="cursor: pointer"><?php echo $string;?></td>
                                                <td class=" "><?php echo $LName;?></td>
                                                <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                <td class=" "><?php echo $compName;?> 
                                                </td>
                                                <td class=" "><?php echo $rows['contact_number'];?></td>
                                                <td class=" " style="padding:none;"><?php echo $rows['email'];?></td>
                                                <td class="a-right a-right "><?php if($rows['fedafin_rating'] != "" ){echo $rows['fedafin_rating'];}else{echo "N/A";}?></td>
                                                <td class=" last"><a href="#"><?php echo $rows['category_name'];?></a></td>
                                                
                                                <td class=" last">
                                                    <?php
                                                    if($rows['annonymous_status'] == 'y'){
                                                        echo 'Annonymous';
                                                    }
                                                    else {
                                                        echo 'Not Annonymous';
                                                    }
                                                    ?>
                                                </td>
							 <td><?php echo date("d.m.Y H:i:s",strtotime($rows['activatedDate'])) ; ?></td>			
                                                   <?php
                                                   if($rows['status'] == 'y')
                                                   {
                                                      if( $_SESSION['privilege'] != "1"  ){ echo "<td><span id='status_bulb_".$user_id."'><img src='assets/images/bulb_on.png' title='Disable' onclick='make_it_off(".$user_id.")'></span>"
													  . "<a href='edit_user.php?id=".$user_id."'>Edit</a>"; 
echo '<a class="deleteUserById" data-id="'.base64_encode($user_id).'" href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a></td>'; }
                                                        echo "<td  class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }
                                                   else
                                                   {
                                                     if( $_SESSION['privilege'] != "1"  ){    echo "<td><span id='status_bulb_".$user_id."'><img src='assets/images/bulb_off.png' title='Enable' onclick='make_it_on(".$user_id.")'></span>"
													 . "<a href='edit_user.php?id=".$user_id."'>Edit</a>"; 
													 echo '<a class="deleteUserById" data-id="'.base64_encode($user_id).'" href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a></td>'; }
                                                        echo "<td  class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }
										
                                                       ?>
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
function make_it_off(id) {
    var data_to_send = 'id=' + id +'&function=make_it_off';
    $.ajax({
        url:"ajax_function.php",
        method:"post",
        data:data_to_send,
        cache:false,
        success:function(htnlstr) {
            $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png'  title='Enable' onclick='make_it_on("+id+")'>");
        }
    });
}
function make_it_on(id) {
    var data_to_send = 'id=' + id +'&function=make_it_on';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr) {
          
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_on.png'  title='Disable' onclick='make_it_off("+id+")'>");
           location.reload(true);
       }
    });
}
$('.deleteUserById').click(function(){
	var id = $(this).data('id');
	var obj = $(this);
	var check = confirm('Do you really want to delete this user.');
	if(check == true) {
		var data_to_send = 'id=' + id +'&function=deleteUserById';
		$.ajax({
			url:"ajax_function.php",
			method:"post",
			data: data_to_send,
			cache:false,
			success:function(result) {
				obj.parent().parent().remove();
				$("#alertArea").text('Successfully Deleted').show().delay(3000).fadeOut('slow');
			}
		});
	}
});
</script>
</body>
</html>
