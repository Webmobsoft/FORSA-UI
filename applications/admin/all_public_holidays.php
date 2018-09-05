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
           
			
<style>
#example_wrapper{display:none;}
#exampleEur_wrapper{display:none;}
</style>
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
			<?php
			//CHF 
				$select_holidaysChf = mysql_query("SELECT * from tbl_calender WHERE holidayFor = 'CHF' ORDER BY STR_TO_DATE(date_select,'%d.%m.%Y') ASC ");
				$countHolidaysChf   = mysql_num_rows($select_holidaysChf);
				
			//EUR
				$select_holidaysEur = mysql_query("SELECT * from tbl_calender WHERE holidayFor = 'EUR' ORDER BY STR_TO_DATE(date_select,'%d.%m.%Y') ASC ");
			    $countHolidaysEur   = mysql_num_rows($select_holidaysEur);
				
			//USD
			
			    $select_holidaysUsd = mysql_query("SELECT * from tbl_calender WHERE holidayFor = 'USD' ORDER BY STR_TO_DATE(date_select,'%d.%m.%Y') ASC ");
			    $countHolidaysUsd   = mysql_num_rows($select_holidaysUsd);
										
			?>
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">												
							<span>	
				               <a class="closethis">Close</a>
							   <a href="add_public_holidays.php" class="glyphicon glyphicon-plus hideMyDiv" title="Create new Holiday" style=" right: 40px ! important; top: 65px ! important;"> Add </a>	
							</span>				
								</span>
                                

                                <header>
                                    <h2 class="heading">Public Holidays List</h2><span class="add_btn">
                                </header>
								
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    
									<div class="col-md-12" id="currencyBttns" style="margin:0px auto;margin:30px 0px;">
									    <!--<span class="col-md-2"></span>-->
									    <button type="button" class="btn btn-primary btn-lg col-md-3" onclick="holidaysChf()">CHF</button>
										<span class="col-md-1"></span>
									    <button type="button" class="btn btn-primary btn-lg col-md-3" onclick="holidaysEur()">EUR</button>
										<span class="col-md-1"></span>
										<button type="button" class="btn btn-primary btn-lg col-md-3" onclick="holidaysUsd()">USD</button>
									</div>
									
									<!---CHF holidays---------------------------------------------->
									<div class="table-box tabHoliday" id="chfTbl" style="display:none;width:100%;">
									
									 <?php
										
										?>
									
									   <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                                                             <?php
                                        if ($countHolidaysChf > 0) {
                                            ?>
                                            <table class="display table" id="example" style="width:100%;" >
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%;">Sr. No</th>
                                                        <th style="width:30%;">Holiday Name</th>
														<th style="width:30%;">Holiday Date</th>
                                                        <th class="hideMyDiv" style="width:40%;">Action </th>
                                                       

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													$sNum = 1;
                                                    while ($rows = mysql_fetch_array($select_holidaysChf)) 
													{
													 ?>
                                                         <tr class="gradeX" id="list<?php echo $rows['id']; ?>">
                                                           <td class=" " onclick="" style="cursor: pointer;width:10%;"><?php echo $sNum; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['holiday_name']; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['date_select']; ?></td>

                                                            <?php
                                                                   
                                                                        echo "<td class='hideMyDiv' style='width:40%;'><a style='margin-top:-2px;' href='edit_public_holiiday.php?id=" . $rows['id'] . "'>Edit</a>
																		&nbsp;&nbsp;
																		<a class='deleteUserById' href='javascript:void(0);' data-id='MTU2'>
																		<i class='fa fa-times fa-2x red' onclick = 'deleteDate(".$rows['id'].")'></i></a>
																		</td>";
                                                                  
                                                                    ?>
                                                        </tr>
                                                            <?php
															$sNum++;
                                                    }
                                                        ?>

                                                </tbody>
                                              
                                            </table>
											
											
											
											
											
											
											
											
											
											
    <?php
} else {
    echo "<i style=color:red>Open loan list empty</i>";
}
?>
  
                                        <script>
                                            var asInitVals = new Array();
                                            $(document).ready(function() {
                                                var oTable = $('#example').dataTable({
                                                    "oLanguage": {
                                                        "sSearch": "Search all columns:"
                                                    }
                                                });

                                                $("tfoot input").keyup(function() {
                                                    /* Filter on the column (the index) of this element */
                                                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                                                });



                                                /*
                                                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
                                                 * the footer
                                                 */
                                                $("tfoot input").each(function(i) {
                                                    asInitVals[i] = this.value;
                                                });

                                                $("tfoot input").focus(function() {
                                                    if (this.className == "search_init")
                                                    {
                                                        this.className = "";
                                                        this.value = "";
                                                    }
                                                });

                                                $("tfoot input").blur(function(i) {
                                                    if (this.value == "")
                                                    {
                                                        this.className = "search_init";
                                                        this.value = asInitVals[$("tfoot input").index(this)];
                                                    }
                                                });
                                            });

											
											function holidaysChf()
											{
												
												$("#example_wrapper").show();
												$("#chfTbl").show();
												
												$("#exampleEur_wrapper").hide();
												$("#eurTbl").hide();
											}
											
                                        </script>
                                    </div>
									
									<!------EUR holidays ----------------------------------------->
									
									
									
									
								<div class="tabHoliday" id="eurTbl" style="display:none;">
									   
                                        <?php
                                        if ($countHolidaysEur > 0) {
                                            ?>
                                            <table class="" id="exampleEur" >
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%;">Sr. No</th>
                                                        <th style="width:30%;">Holiday Name</th>
														<th style="width:30%;">Holiday Date</th>
                                                         <th class="hideMyDiv" style="width:40%;">Action </th>
                                                       

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													$chfNum = 1;
                                                    while ($rows = mysql_fetch_array($select_holidaysEur)) 
													{
														
													 ?>
                                                        <tr class="gradeX" id="list<?php echo $rows['id']; ?>">
                                                           <td class=" " onclick="" style="cursor: pointer" style="width:10%;"><?php echo $chfNum; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['holiday_name']; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['date_select']; ?></td>

                                                            <?php
                                                                echo "<td class='hideMyDiv' style='width:40%'><a style='margin-top:-2px;' href='edit_public_holiiday.php?id=" . $rows['id'] . "'>Edit</a>
																&nbsp;&nbsp;
																<a class='deleteUserById' href='javascript:void(0);' data-id='MTU2'>
																<i class='fa fa-times fa-2x red' onclick = 'deleteDate(".$rows['id'].")'></i></a>
																</td>";
                                                            ?>
                                                        </tr>
                                                            <?php
															$chfNum++;
                                                    }
                                                        ?>

                                                </tbody>
                                              
                                            </table>
											
											
											
											
											
											
											
											
											
											
    <?php
} else {
    echo "<i style=color:red>Open loan list empty</i>";
}
?>
  
                                        <script>
                                            var asInitVals = new Array();
                                            $(document).ready(function() {
                                                var oTable = $('#exampleEur').dataTable({
                                                    "oLanguage": {
                                                        "sSearch": "Search all columns:"
                                                    }
                                                });

                                                $("tfoot input").keyup(function() {
                                                    /* Filter on the column (the index) of this element */
                                                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                                                });



                                                /*
                                                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
                                                 * the footer
                                                 */
                                                $("tfoot input").each(function(i) {
                                                    asInitVals[i] = this.value;
                                                });

                                                $("tfoot input").focus(function() {
                                                    if (this.className == "search_init")
                                                    {
                                                        this.className = "";
                                                        this.value = "";
                                                    }
                                                });

                                                $("tfoot input").blur(function(i) {
                                                    if (this.value == "")
                                                    {
                                                        this.className = "search_init";
                                                        this.value = asInitVals[$("tfoot input").index(this)];
                                                    }
                                                });
                                            });

											
											
											
											
											function holidaysEur()
											{
												
												$("#exampleEur_wrapper").show();
												$("#eurTbl").show();
												
												$("#example_wrapper").hide();
												$("#chfTbl").hide();
												
											}
											
                                        </script>
                                </div>
									
									
									
									
								<div class="tabHoliday" id="usdTbl" style="display:block;">
									   
                                        <?php
                                        if ($countHolidaysUsd > 0) {
                                            ?>
                                            <table class="" id="exampleUsd" >
                                                <thead>
                                                    <tr>
                                                        <th style="width:10%;">Sr. No</th>
                                                        <th style="width:30%;">Holiday Name</th>
														<th style="width:30%;">Holiday Date</th>
                                                         <th class="hideMyDiv" style="width:40%;">Action </th>
                                                       

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													$chfNum = 1;
                                                    while ($rows = mysql_fetch_array($select_holidaysUsd)) 
													{
														
													 ?>
                                                        <tr class="gradeX" id="list<?php echo $rows['id']; ?>">
                                                           <td class=" " onclick="" style="cursor: pointer" style="width:10%;"><?php echo $chfNum; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['holiday_name']; ?></td>
                                                           <td class=" " style="width:30%;"><?php echo $rows['date_select']; ?></td>

                                                            <?php
                                                                echo "<td class='hideMyDiv' style='width:40%'><a style='margin-top:-2px;' href='edit_public_holiiday.php?id=" . $rows['id'] . "'>Edit</a>
																&nbsp;&nbsp;
																<a class='deleteUserById' href='javascript:void(0);' data-id='MTU2'>
																<i class='fa fa-times fa-2x red' onclick = 'deleteDate(".$rows['id'].")'></i></a>
																</td>";
                                                            ?>
                                                        </tr>
                                                            <?php
															$chfNum++;
                                                    }
                                                        ?>

                                                </tbody>
                                              
                                            </table>
											
								<?php
                              } else {
                                        echo "<i style=color:red>Open loan list empty</i>";
									}
									?>
  
                                       
                                </div>
									 <script>
                                            var asInitVals = new Array();
                                            $(document).ready(function() {
                                                var oTable = $('#exampleUsd').dataTable({
                                                    "oLanguage": {
                                                        "sSearch": "Search all columns:"
                                                    }
                                                });

                                                $("tfoot input").keyup(function() {
                                                    /* Filter on the column (the index) of this element */
                                                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                                                });



                                                /*
                                                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
                                                 * the footer
                                                 */
                                                $("tfoot input").each(function(i) {
                                                    asInitVals[i] = this.value;
                                                });

                                                $("tfoot input").focus(function() {
                                                    if (this.className == "search_init")
                                                    {
                                                        this.className = "";
                                                        this.value = "";
                                                    }
                                                });

                                                $("tfoot input").blur(function(i) {
                                                    if (this.value == "")
                                                    {
                                                        this.className = "search_init";
                                                        this.value = asInitVals[$("tfoot input").index(this)];
                                                    }
                                                });
                                            });

											function holidaysUsd()
											{
												$(".tabHoliday").hide();
												$("#usdTbl").show();
												$("#exampleUsd_wrapper").show();
											}
                                        </script>
									
									
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
function deleteDate(dateId)
{
	$("#list"+dateId).hide();
	
	
	$.ajax({

                url:"ajax_function.php",

                method:"post",

                data  : "dateId="+dateId+'&function=dalete_holiday',

                cache:false,

                success:function(htnlstr)

                {
					
                }
	  });
	
	
	
	
}
   
</script>
</body>
</html>
