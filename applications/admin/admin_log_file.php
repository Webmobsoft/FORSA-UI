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
            <script src="assets/js/jquery-ui.js" type="text/javascript"></script>


            <!-- Right Section Header End -->
            <!-- Content Section Start -->
             <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 16px 15px 15px;
    vertical-align: top;
}
.textMenu
{
    color:#fff;
}
.textMenu:hover
{
    color:#fff;
}
#nav3 li
{
    //height:40px;
    padding:10px;
    border-bottom:1px solid #fff;
}
            </style>
            <?php
$select_lender = mysql_query("SELECT tbl_users . * , tbl_lender_services.name as category_name, tbl_fedafin_rating.rating_name as fedafin_rating FROM `tbl_users` INNER JOIN tbl_lender_services ON tbl_lender_services.id = tbl_users.category
 LEFT JOIN tbl_fedafin_rating ON tbl_fedafin_rating.id = tbl_users.fedafin_rating WHERE tbl_users.user_type = 'lender' AND tbl_users.is_archieve = 'n' ");
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
                        <div class="col-xs-12 col-md-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Log File</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                    	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                        
                                         <?php
                                            $selectedMessage = mysql_query("SELECT * FROM `tbl_admin_logs` ORDER BY id DESC");
                                         ?>
                                        <div class="col-md-12" id="deletedUsers">
                                            <div id="logDeletedUsers">
                                                <form id="user_deleted" role="form" action="admin_export_log.php" method="post">
                                                   <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="delete_from">From:</label>
                                                        <input name="delete_from" type="text" class="" id="delete_from" style="padding:3%;width:80%;" required>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="delete_to">To:</label>
                                                        <input name="delete_to" type="text" class="" id="delete_to" style="padding:3%;width:80%;" required >

                                                    </div>
                                                   
                                                   <div class="col-md-4">
                                                    <input name="deletedUserExport" type="submit" class="btn btn-success" value="Submit">
                                                    <div class="clearfix"></div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                  <th width="80%">Message </th>
                                                  <th width="20%" id="timeHere">Date Time </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                       
                                                
                                                  <?php  while( $fetch = mysql_fetch_array($selectedMessage))
                                                    {
                                                     echo '<tr class="gradeX">';
                                                      echo "<td>".$fetch['msg']."</td>";
                                                      echo "<td>".date("d.m.Y H:i:s", strtotime($fetch['deleted_time']))."</td>";
                                                      echo "</tr>";
                                                    } 
                                                 ?>
                                                    
                                                
                                               
                                                
                                            </tbody>
                                            <tfoot>
                                              
                                            </tfoot>
                                        </table>
                                        </div>
                                    
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
 $(function () {
        $("#delete_from, #delete_to").datepicker();
    });    
    
</script>
<script>
    $( document ).ready(function() {
       $("#timeHere").click();
       $("#timeHere").click();
});
</script>
</body>
</html>
