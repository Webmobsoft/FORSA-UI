<?php include_once 'header.php';?>
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
			 
				$user_status= mysqli_query($mysql_connect,"SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name,  tbl_user_logged_status.is_logged, tbl_user_logged_status.last_login, tbl_user_logged_status.last_logout
				, tbl_user_logged_status.user_id, tbl_user_logged_status.ip_address
											FROM tbl_users
												INNER JOIN tbl_user_logged_status
												ON tbl_users.id=tbl_user_logged_status.user_id WHERE tbl_user_logged_status.user_id = '$userid' ORDER BY tbl_user_logged_status.id DESC
													"); 
				$count=mysqli_num_rows($user_status);
			?>
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 0 15px 23px;
    vertical-align: top;
	
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
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Live User Status</h2><script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
									
                                </header>
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
                                                 <th class='sorting_1'>Last Logout </th>
												 <th class='sorting_1'>IP Address</th>
                                                </tr>
                                            </thead>
											
                                            <tbody>
											<?php
											  while($rows = mysqli_fetch_array($user_status))
											  {
												  
												 ?>
												 <tr class="gradeX">
                                                   <td><a href="#"  id="user_detail"> <?php echo $rows['fname'] ." " .$rows['lname'];?></a></td>                                                   <td><?php echo $rows['company_name'];?></td>
												   <td> <?php if($rows['last_login'] != ""){echo    date("d-F-Y H:i:s" ,strtotime($rows['last_login'] ));} ?></td>
													
													 <td> <?php if($rows['last_logout']!= ""){echo  date("d-F-Y H:i:s" ,strtotime($rows['last_logout']));} ?></td>
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
                               
 
</body>
</html>
