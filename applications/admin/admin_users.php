<?php include_once 'header.php';?>
<?php 
if(isset($_POST['function']) && $_POST['function'] == 'deleteUserById')
{
   $id=$_POST['id'];
   $qry1="delete from tbl_users_admin where id=$id";
   $res=  mysql_query($qry1);
   if(mysql_affected_rows($res))
   {
       echo 'User deleted';
   }
 else {
       echo 'User not deleted';    
   }
}
?>
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
            <script type="text/javascript">
                $(document).ready(function(){
                $(".nochange").click(function () {
                return false;
                });
                });
            </script>
             <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 16px 15px 15px;
    vertical-align: top;
}
            </style>
            <?php
$select_lender = mysql_query("SELECT  * from tbl_users_admin ");
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
                                    <h2 class="heading">Admin User Details</h2>
                                </header>
                                <?php
                                if (strpos($_SESSION['privilege'], '2') !== false){
                                ?>
                                <a href="add_admin_user.php" ><input class="pull-right" type="button" value="Add Admin User" ></a>
                                <?php };?>
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
                                                <th>Email</th>
                                                <th>privilege</th>
                                                <th>option </th>
                                                <!--<th>Loan </th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
//                                                if (strpos($_SESSION['privilege'], '1') !== false){
                                                ?>
                                                <?php
                                            while($rows = mysql_fetch_array($select_lender))
                                            {
                                                $user_id = $rows['id'];
                                                ?>
                                                <tr class="gradeX">
                                                    <td class=" "><?php echo $rows['uname'];?></td>
                                                <td class=" " onclick="get_full_detail(<?php echo $user_id;?>)" style="cursor: pointer"><?php echo $rows['fname'];?></td>
                                                <td class=" "><?php echo $rows['lname'];?></td>
                                                <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                <td class=" "><?php echo $rows['email'];?></td>
                                                <?php 
                                                if(!empty($rows['privilege'])){
                                                    $final=$rows['privilege'];
                                                    $arra = explode(',', $final);
                                                    //print_r($arra);
                                                }
                                                ?>                                            
                                            <td class="last">
											
                                                Show: <input class="nochange" type="checkbox" name="pre[]" value="1" <?php if(in_array(1,$arra)) echo 'checked'; ?>>
                                                Add:<input class="nochange" type="checkbox" name="pre[]" value="2" <?php if(in_array(2,$arra)) echo 'checked'; ?>>
                                                Edit:<input class="nochange" type="checkbox" name="pre[]" value="3" <?php if(in_array(3,$arra)) echo 'checked'; ?>>
                                                Delete:<input class="nochange" type="checkbox" name="pre[]" value="4" <?php if(in_array(4,$arra)) echo 'checked'; ?>>
                                            </td>
<!--                                                <td class=" last"><a href="#"><?php //echo $rows['role'];?></a>-->
                                                   <?php
                                                   echo '<td id="status_bulb_'.$user_id.'">';
                                                   
//                                            if (strpos($_SESSION['privilege'], '1,2,3,4') !== false) {
//                                            echo 'true';
//                                            }
                                              if (strpos($_SESSION['privilege'], '3') !== false)
                                        //if($_SESSION['user_type'] && $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 1)
                                            {                                                   

                                            //$functionToOnOff = 'make_it_on('.$user_id.')';
                                            //$imgSrc = 'assets/images/bulb_off.png';
                                            //$title = 'Disable';
                                            //if($rows['status'] == 'y') {
                                            //    $functionToOnOff = 'make_it_off('.$user_id.')';
                                            //    $imgSrc = 'assets/images/bulb_on.png';
                                            //    $title = 'Enable';
                                            //}
                                            //echo '<img src="'.$imgSrc.'" title="'.$title.'" onclick="'.$functionToOnOff.'">';
                                            echo '<a href="edit_admin_user.php?id='.$user_id.'"><img src="'.$base_url.'assets/images/edit.png" title="Edit" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            //base64_encode($user_id)
                                            //echo '<a class="deleteUserById" data-id="'.$user_id.'" href="javascript:void(0);"><img src="'.$base_url.'assets/images/deleteuser.png" title="Delete User" ></a>';
                                            }
                                            else {
                                                echo 'N/A';    
                                            }
                                            if (strpos($_SESSION['privilege'], '4') !== false)
                                            {
                                                echo '<a class="deleteUserById" data-id="'.$user_id.'" href="javascript:void(0);"><img src="'.$base_url.'assets/images/deleteuser.png" title="Delete User" ></a>';  
                                            }
                                             else {
                                                echo 'N/A';    
                                            }
                                            echo '</td>';

                                                   /*if($rows['status'] == 'y')
                                                   {
                                                       echo "<td id='status_bulb_".$user_id."'><img src='assets/images/bulb_on.png' onclick='make_it_off(".$user_id.")'><a href='edit_user.php?id=".$user_id."'>Edit</a></td>";
//                                                       echo "<td  class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }
                                                   else
                                                   {
                                                       echo "<td id='status_bulb_".$user_id."'><img src='assets/images/bulb_off.png' onclick='make_it_on(".$user_id.")'><a href='edit_user.php?id=".$user_id."'>Edit</a></td>";
//                                                       echo "<td class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }*/
                                                       ?>
                                                </tr>
                                                    <?php
                                            }
                                            ?>
                                                <?php 
//                                                
//                                             }  else {
//     echo 'Soory You Have Not Permition For Detail Watch';    
//                                        }
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
                                            echo "<i style=color:red>Open Admin list empty</i>";
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
       url:"ajax_function_1.php",
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
       url:"ajax_function_1.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' title='Enable' onclick='make_it_on("+id+")'>");
       }
    });
}
function make_it_on(id)
{
    //alert(id);
    var data_to_send = 'id=' + id +'&function=make_it_on';
    $.ajax({
       url:"ajax_function_1.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr) {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_on.png' title='Disable' onclick='make_it_off("+id+")'>");
       }
    });
}
$('.deleteUserById').click(function(){
	var id = $(this).data('id');
//        alert(id);
	var obj = $(this);
	var check = confirm('Do you really want to delete this user.');
	if(check == true) {
		var data_to_send = 'id=' + id +'&function=deleteUserById';
		$.ajax({
			//url:"ajax_function_1.php",
                        url:"admin_users.php",
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
