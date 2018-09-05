<?php
include_once 'config.php';

$user_status = mysqli_query($mysql_connect, "SELECT tbl_customers.first_name, tbl_customers.Surname,tbl_customers.Name_company, tbl_view_user_status.is_logged, tbl_view_user_status.last_login , tbl_view_user_status.user_id FROM tbl_customers LEFT JOIN tbl_view_user_status ON tbl_customers.id = tbl_view_user_status.user_id WHERE tbl_customers.id_i != 'ID' AND tbl_customers.id_i != '' AND tbl_customers.processed = 'N'");
$count = mysqli_num_rows($user_status);

?>
                          <div class="contents" style="margin-top:40px;">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">

                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                   <th>Name </th>
						   <th>Company Name </th>
                                                   <th class='sorting_1' id="clickThis">Last Login </th>
                                                   <th>Is Logged_in </th>
                                                </tr>
                                            </thead>

                                            <tbody>
						<?php
while ($rows = mysqli_fetch_array($user_status)) {

  ?>
                                                       <tr class="gradeX">
                                                           <td><a href="view_user_log_details.php?id=<?php echo $rows['user_id']; ?>"  id="user_detail"> <?php echo $rows['first_name'] . " " . $rows['Surname']; ?></a></td>                                                   <td><?php echo $rows['Name_company']; ?></td>
                                                           <td> <?php echo $rows['last_login'] ?></td>
                                                       <?php

  if ($rows['is_logged'] == 1) {
    echo "<td><img src='assets/images/onBulb.jpg' style='width:31px; height:29px;'></td>";
  } else {
    echo "<td><img src='assets/images/bulb_off.png'></td>";
  }

  ?>
						</tr>
                                                    <?php
}
?>




										</tbody>
											<tfoot>
											</tfoot>
											</table>
											<script>
											var asInitVals = new Array();
											$(document).ready(function()
											{
 											   var oTable = $('#example').dataTable( {
												   "oLanguage":
												   {
													   "sSearch": "Search all columns:"
												   }

										 } );
										 $("tfoot input").keyup( function () {
										 /* Filter on the column (the index) of this element */
										 oTable.fnFilter( this.value, $("tfoot input").index(this) );
										 } );
										 /*
										 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 												 * the footer												 */
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
													});

                                        $("#clickThis").click();   /* to last login sort by default  */

													} );
													</script>
											</div>
											</div>