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
$select_lender = mysqli_query($mysql_connect,"SELECT * FROM `only_view_users` WHERE status = 'N'");
$count = mysqli_num_rows($select_lender);
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
                                    <h2 class="heading">View Deleted Users</h2>
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
                                                <th>Name Unternehmen</th>
                                                <th>Strasse</th>
                                                <th>Client Sub group</th>
                                                <th>Client group</th>
                                                <th>Vorname</th>
                                                <th>Nachname</th>
                                                 <th>email</th>
                                                 
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysqli_fetch_array($select_lender))
                                            {

                                                $customer_id = $rows['id'];
                                                ?>
                                                <tr class="gradeX">
                                                <td class=" "><?php echo $rows['Name_company'];?></td>
                                                <td class=" "><?php echo $rows['address'];?></td>
                                                <td class=" "><?php echo $rows['client_sub_group'];?></td>
                                                <td class=" "><?php echo $rows['client_group'];?></td>
                                                <td class=" "><?php echo $rows['first_name'];?>  </td>
                                                <td class="cust"><?php echo $rows['Surname'];?></td>
                                                <td class=" "><?php echo $rows['email'];?>  </td>
                                                
                                                
                                                
                                                
                                                </tr>
                                                    <?php
                                            }
                                            ?>
                                                
                                            </tbody>
                                            <tfoot>
                                              
                                            </tfoot>
                                        </table>
                                         <?php
                                        }
                                        else
                                        {
                                            echo "<i style=color:red>User deleted list empty</i>";
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
    function enableUser(id)
    {
		
         var data_to_send = 'id=' + id +'&function=enableUser';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
//           alert(htnlstr);
//           return false;
         $("#userDeletedId"+id).hide();
           
		   $("#alertArea").html("User enabled successfully").show();
           //$("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on("+id+")'>");
       }
    });
    }

</script>
</body>
</html>
