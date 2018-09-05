<?php include_once 'header.php'; ?>

<!-- Wrapper Start -->
<style>



input#selectedDays
{
 padding:5px;
 border-radius:10px;
 border:2px solid black;
 padding:5px;float:left; 
}
/*input#GO{
	padding:5px !important;
	float:left !important;
	border-radius:10px !important;
	border:2px solid black !important;
	margin-right:15px !important;
}*/
input#GO {
  border: 1px solid #979797 !important;
  border-radius: 4px !important;
  height: 30px;
  margin-right: 15px !important;
  padding-bottom: 5px !important;
  padding-left: 5px !important;
  padding-right: 7px;
  padding-top: 3px !important;
  width: 19%;
}





</style>
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

            

            <button type="button" class="btn btn-primary btn-lg" id="popup" data-toggle="modal" data-target="#myModal" style="display: none">

                Launch demo modal

            </button>

            <!-- Modal -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title user_popup_heading" id="myModalLabel"></h4>

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

                                <header style="width:100%;height:50px;">
                                   
                                    <h2 class="heading" style="float:left">Messages</h2>
                                    
								</header>

                                <div class="contents">

                                    <a class="togglethis">Toggle</a>

                                    <div class="table-box">

                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>


      <table class="display table" id="example">

                                                <thead>

                                                    <tr>

                                                        <th style="width:20%">Name </th>
														<th style="width:70%">Message </th>

                                                       

                                                        <th style="width:10%">View</th>

                                                        <!--<th>option </th>-->

                                                    </tr>

                                                </thead>

                                                <tbody>

    
                                                        <tr class="gradeX">
	  
	  
	  <?php
	    $select = "SELECT tbl_messages.id,tbl_messages.msg, tbl_messages.`from`, tbl_users.fname, tbl_users.lname FROM tbl_messages   INNER JOIN tbl_users ON tbl_messages.`from` = tbl_users.id WHERE tbl_messages.is_seen ='N' AND tbl_messages.`to` ='1' GROUP BY tbl_messages.`from`"; 
        $query = mysql_query($select);

while ($row = mysql_fetch_assoc($query))
{
	//print_r($row);
	?>
                                            

                                                            <td style="width:20%" ><?php  echo $row['fname']." ".$row['lname']; ?></td>

                                                             <th style="width:70%"> <?php echo $row['msg'] ; ?></th>
                                                            <td style="width:10%"><a onclick="unCheckChat(<?php  echo $row['from'];  ?>)" href="chatWithUser1.php?userId=<?php  echo $row['from'];  ?>"><i class="fa fa-eye fa-2x"></i></a></td>

                                                        </tr>

   



                                                </tbody>

   <?php
}
?>
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

<script>
 function unCheckChat(userId)
 {
	 //alert(userId);
	var data_to_send = 'id=' + userId +'&function=unCheckChat';
	 $.ajax({			
				url:"ajax_function.php",	
				method:"post",			
				data:data_to_send,		
				cache:false,			
				success:function(htnlstr)	
				{
					//alert(htnlstr);
				}					
    });
 } 



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