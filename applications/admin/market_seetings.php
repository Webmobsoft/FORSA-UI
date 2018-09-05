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
			 $currency = $_GET['currency'];
				$user_status= mysql_query("SELECT tbl_users.fname, tbl_users.lname,tbl_users.company_name, tbl_marketsettings_log.*
											FROM tbl_users
												INNER JOIN tbl_marketsettings_log
												ON tbl_users.id=tbl_marketsettings_log.setter_user_id WHERE tbl_marketsettings_log.setter_user_id = '$userid' and tbl_marketsettings_log.currency='$currency' ORDER BY tbl_marketsettings_log.id DESC
													"); 
				$count=mysql_num_rows($user_status);
			?>
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 0 15px 23px;
    vertical-align: top;
	
}
            </style>
            
             
            <!-- Modal -->
<div id="alertArea" class="alert alert-success" style="display: none;"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title user_popup_heading" id="myModalLabel">Market Settings Details:</h4>
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
                                    <h2 class="heading">Market Settings Details:</h2><script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
									
                                </header>
                                <div style="float:right;">  Choose Currency : <select onchange="location = this.value;">
                <option value="market_seetings.php?id=<?php echo $userid;  ?>&amp;currency=CHF"  <?php if($currency =="CHF") {echo "selected";}?>>CHF</option>
                <option value="market_seetings.php?id=<?php echo $userid;  ?>&amp;currency=EUR" <?php if($currency =="EUR") {echo "selected";}?>>EUR</option>
                <option value="market_seetings.php?id=<?php echo $userid;  ?>&amp;currency=USD" <?php if($currency =="USD") {echo "selected";}?>>USD</option>
                            
                </select></div>
								 <div id = "container">
									
                          <div class="contents" style="margin-top:40px;">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                    	
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                   <th>Name </th>									
												   <th>User Company Name </th>
                                                <th class='sorting_1'>Other Company Name </th>
                                                 <th class='sorting_1'>Bid-Spread </th>
												 <th class='sorting_1'>Bid</th>
                                                                                                 <th class='sorting_1'>Offer </th>
                                                 <th class='sorting_1'>Offer-Spread </th>
												 <th class='sorting_1'>Date</th>
                                                </tr>
                                            </thead>
											
                                            <tbody>
											<?php
											  while($rows = mysql_fetch_array($user_status))
											  {
				
												 ?>
												 <tr class="gradeX">
                                                   <td><a> <?php echo $rows['fname'] ." " .$rows['lname'];?></a></td> 
                                                   <td><?php echo $rows['company_name'];?></td>
												   <td> <?php echo $rows['third_party_user'];  ?> </td>
													
													 <td> <?php echo $rows['bid_amount'];  ?> </td>
													 <td> <?php echo $rows['bid'];  ?> </td>
                                                                                                          <td> <?php echo $rows['offer'];  ?> </td>
													 <td> <?php echo $rows['offer_amount'];  ?> </td>
                                                                                                         <td> <?php echo $rows['date'];  ?> </td>
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
