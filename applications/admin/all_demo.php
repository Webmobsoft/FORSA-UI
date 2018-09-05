<?php include_once 'header.php'; ?>
<!-- Wrapper Start -->
<div class="wrapper">
    <div class="structure-row">
        <!-- Sidebar Start -->
        <?php include_once 'side_bar.php'; ?>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <?php include_once 'top_right.php'; ?>
            <!-- Right Section Header End -->
            <!-- Content Section Start -->
            
			
			
			<?php 

                           if(isset($_POST['archieveAll']))
			  {
				 $archieveAllDemoRequests = mysql_query("UPDATE `tbl_demo` SET `is_archieve` ='y' ");
				$updatedStatus = "1" ;
			  }



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
                                <header style="height:60px;">
                                    <?php if(isset($updatedStatus) && $updatedStatus == "1") { ?>
                                    <div id="alertArea" class="alert alert-success col-md-12" style="">All demo requests archieved successfully</div>
                                    <?php } ?>
                                    <h2 class="heading" style="float:left">All Demo Requests</h2>
									<span style="float:right;margin-right:15%;">
									  <form action="" method="POST">
									    <input class="btn btn-primary style2" placeholder="" name="archieveAll" value="Archieve All"  type="submit">
									  </form>
									</span>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

                                            <table class="display table" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>First Name </th>
                                                        <th>Name Title </th>
                                                        <th>Company </th>
                                                        <th>Telephone Number </th>
                                                        <th>Email</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Send Link</th>
							 <th>Archieve</th>
                                                        <!--<th>option </th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php    

  $demo_request = mysql_query("SELECT * FROM `tbl_demo` WHERE `is_archieve` = 'n' ORDER BY `id` DESC");
  // $allRequests = mysql_num_rows($demo_request);
   //echo $allRequests;
  
  while($get_request = mysql_fetch_assoc($demo_request))
  {
  
 //print_r($get_request);

    $requestId = $get_request['id'];                                       
?>

                                                    <tr class="gradeX" id="demoRequestId<?php echo $requestId; ?>">
                                                            <td class=" " style="cursor: pointer"><?php echo $get_request['fname']; ?></td>
                                                            <td class=" "><?php echo $get_request['name']; ?></td>
                                                            <td class=" "><?php echo $get_request['company']; ?></td>
                                                            <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $get_request['tel_num']; ?> </td>   
                                                            <td class=" "><?php echo $get_request['email']; ?></td>
                                                            <td class="a-right a-right "><?php echo $get_request['subject']; ?></td>
                                                            <td class=" last"><a href="#"><?php echo $get_request['message']; ?></a> </td>
                                                            <?php if($get_request['is_send'] == 'n')
															{ ?>
                                                            
                                                              <th><img src="assets/images/send.png" title="Send Video" onclick="sendVideo(<?php echo $get_request['id'] ?>)" style="cursor:pointer;"> </th>
                                                           <?php 
														    }
															 else
                                                            {
                                                           ?>
                                                                 <th><img src="assets/images/sent.png" title="video Sent" onclick="sendVideo(<?php echo $get_request['id'] ?>)" style="cursor:pointer;"> </th>
                                                         <?php 
                                                            } 
                                                            ?>
                                                            
                                                            <td> <input type="radio" class="f-option" name="selector" style="font-size:50px;cursor:pointer" title="Archieve this" onclick="archieveThisDemo(<?php echo $requestId; ?>)"></td>
                                                            
                                                        <?php
                                                            }
                                                        ?>
                                                 </tr>
   

                                                </tbody>
                                               
                                            </table>

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

</body>
</html>


<script>

 function sendVideo(id)
 {
       var data_to_send = 'id=' + id +'&function=send_video_to_demoRequest';
	 //alert(data_to_send) ;
	$.ajax({

                url:"ajax_function.php",

                method:"post",

                data:data_to_send,

                cache:false,

                success:function(htnlstr)

                {
                    location.reload();
                }
	  });
 }
 
 function archieveThisDemo(demoId)
 {
	
	var conf = confirm("Are you sure to archieve this ?");
	
	if(conf == true)
	{
		var data_to_send = "demoId="+demoId+"&function=archieveThisDemo";
		//alert(data_to_send);
		$.ajax({
			
			url    : "ajax_function.php" ,
			method : "post" ,
			data   : data_to_send ,
			cache  : false ,
			success : function(result)
			{
				//alert(result);
				$("#demoRequestId"+demoId).fadeOut("slow");
			}
			
		  });
		
		
	}
	else
	{
		return false;
	}
 }



</script>