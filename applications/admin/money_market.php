 <?php include_once 'config.php'; ?>
<?php  if(isset($_POST['UPDATE']))
{
	//error_reporting(0);
	$tabId             = $_POST['tabId'];
	$start_date_manual = $_POST['start_date_manual'];
	$value_date_manual = $_POST['value_date_manual'];
	$mat_date_manual   = $_POST['mat_date_manual'];
	
	 $totalTabs = count($tabId);
	
	for ($x = 0 ; $x <= $totalTabs ; $x++ )
	{
		 $startdate = $start_date_manual[$x];
		 $id        = $tabId[$x];
		
		 $update = mysql_query("UPDATE tbl_money_market SET `start_date` = '".$startdate."' , `value_date` = '".$value_date_manual[$x]."' , `maturity_date` = '".$mat_date_manual[$x]."' WHERE `id` = '".$id."'");
		
	}
	
	
}







	?>



<?php include_once 'header.php';?>
 <script src="assets/js/jquery-ui.js" type="text/javascript"></script>
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
            $select_lender = mysql_query("SELECT * from `tbl_money_market` ORDER BY `by_order` asc ");
            $count = mysql_num_rows($select_lender);
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
                            <div class="sec-box">														<select onchange="Choose_Currency(this.value)" style="float:right;width: 150px;">
                            <option value="chf" checked="checked" selected>CHF </option><option value="eur">EUR </option><option value="usd" >USD </option></select>
				</span>
                                    <?php 
                                     $selectShowStatus = mysql_query("SELECT `showDatesManual` FROM `tbl_money_market` WHERE `id` = '1'");
                                     $showStts = mysql_fetch_array($selectShowStatus);

                                    ?>
                                
                                <header style="height:60px;">
                                    <h2 class="heading" style="float:left;">Money Market</h2>
                                     <span style="float:left;margin-left:75px;">
					<h6> <input type="radio" name = "radioCheck" title="Show Dates Automatic" class="radio-inline" value ="n" <?php if( $_SESSION['privilege'] != "1"  ){ ?> onclick="setMaturityShow(this.value)" <?php } ?><?php if($showStts ['showDatesManual'] == 'n') {echo  'checked'; } ?>> Show Dates Automatic
					<input type="radio" name = "radioCheck" title="Show Dates Manually" class="radio-inline" value="y" <?php if( $_SESSION['privilege'] != "1"  ){ ?> onclick="setMaturityShow(this.value)" <?php } ?> <?php if($showStts ['showDatesManual'] == 'y') {echo  'checked'; } ?>> Show Dates Manually</h6>
					<input type="hidden" name="choosenType" id = "choosenType"value="<?php echo $showStts['showDatesManual']; ?>"/>
				     </span>
                                </header>
                                <div class="contents">
                                   
                                    <div class="table-box">
                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                        <div class="col-xs-12">
                                    
                                        </div>
                                        <?php
                                        if ($count > 0) {
                                            ?>
                                            <table class="display table" id="example">
                                                <thead>
                                                    <tr>
                                                        <th style="display:none;">ID </th>
                                                        <th>Value </th>
														<th>Trading Day </th>
														<th>Value Date</th>
														<th>Maturity Date </th>

                                                       

                                                    </tr>
                                                </thead>
                                                <tbody>
<form name="submitDates" id="submitDates" action ="" method = "POST">
                                                    <?php

				$publicHolidays = mysql_query("SELECT `date_select` FROM (`tbl_calender`) WHERE `date_select` != ''");
				
				 $countAllHolidays = mysql_num_rows($publicHolidays);
				
				$publicHolidays1 = mysql_query("SELECT `date_select` FROM (`tbl_calender`) WHERE `date_select` != ''");							
														
		     echo "<input type='hidden' name='totalIds' id = 'totalIds' value = '".$count."' />"; 					
      
					 $count1 = 1;		
                 while ($rows = mysql_fetch_array($select_lender)) 
				 {
					
                       $user_id = $rows['id'];
                                                        
						$start_date = date("d.m.Y");
														
						$date = date("d.m.Y"); //today

						$date1 = strtotime($date);  // coverted in to date format

						$date2 = date("l", $date1);  // today day name 

						$date3 = strtolower($date2);



						 if($date3 == "friday" || $date3 == "saturday" )

						{
							$dateSelet = date('d.m.Y', strtotime($date . ' +1 Weekday'));
						}
						else
						{
							$dateSelet = date('d.m.Y', strtotime($date . ' +2 Weekday'));
						}
				
					
					while($holiday = mysql_fetch_assoc($publicHolidays))
					{
						$y =1 ;
						$twoDays = $dateSelet;
						

						if(in_array($twoDays, $holiday))
                        {
								
								 $twoDays1       = date('d.m.Y', strtotime($twoDays . ' +1 Weekday'));
                                 
						}
						
					}
					
					if($twoDays1 != "")
					{
						$twoDaysAdd = $twoDays1;
					}
					else
					{
						$twoDaysAdd = $dateSelet ;
					}
					
					
					$termOfMont  = str_replace('s','',$rows['value']);

                    $termOfMonth = $termOfMont."s";
				  
				
				$dateMonth         =  date('d.m.Y', strtotime($twoDaysAdd .'+ '.$termOfMonth.'s'));

                $dateMonthTotime   = strtotime($dateMonth);

                $dateMonthMatUpper = date("l", $dateMonthTotime);

                $dateMonthMat      = strtolower($dateMonthMatUpper);

                              

                 if($dateMonthMat == "saturday" || $dateMonthMat == "sunday")

                {

                    $maturityDay  = date('d.m.Y', strtotime($dateMonth . ' +1 Weekday'));

                }

                 else

                {

                    $maturityDay  = $dateMonth;

                }

				    
					
					
					$holidays = mysql_fetch_array($publicHolidays1);
					
					
					
					
					
					
					while($holidays = mysql_fetch_array($publicHolidays1))
					{
						$allHolidays[]  =  $holidays['date_select'];
					}
				
					
					   if(in_array($maturityDay, $allHolidays))
						{
							
							$maturityDay = date('d.m.Y', strtotime($maturityDay . ' +1 Weekday'));

						}
						else
						{
							$maturityDay = $maturityDay;
						}
						
						if($maturityDay == "01.01.1970")
						{
							$maturityDay = "N/A";
						}
													
											



                       
							


                        if($twoDays1 != "")
						{
							$valueDate =  $twoDays1 ;
						}else 
						{ 
					        $valueDate = $dateSelet ;
					    } 
							if($rows['id'] !='15') {
														?>
                                                        <tr class="gradeX">
                                                          
                                                           <input type="hidden" name ="tabId[]" id="tabId" value="<?php echo $rows['id']; ?>">                                                           
														   <td class="" onclick="" style="cursor: pointer;display:none;"><?php echo $rows['id']; ?></td>
                                                           
                                                            <td class=" "><?php echo $rows['value']; ?></td>
															<td class="showAutomatic"><input  type="text" placeholder="" id="start_date<?php echo $rows['id']; ?>"   name="start_date" value = "<?php echo $start_date; ?>" class="form-control" readonly> </td>
															<td class ="showAutomatic"><input type="text" placeholder="" id="value_date<?php echo $rows['id']; ?>" value="<?php echo $valueDate ; ?>" class="form-control" readonly></td>
															<td class="showAutomatic"><input type="text" placeholder="" id="mat_date<?php echo $rows['id']; ?>" value="<?php echo $maturityDay; ?>" class="form-control" readonly></td>
                                                            
															
															
															
                                                            <td class="showManual"  style="display:none;"><input title="Add Trading Day" type="text" placeholder="" id="start_date_manual<?php echo $count1;  ?>"   name="start_date_manual[]" value = "<?php if( $rows['start_date'] != ""){ echo $rows['start_date'] ; }else { echo $start_date; } ?>" class="form-control" readonly>          </td>
															<td class ="showManual" style="display:none;"><input title="Add value Date" type="text" placeholder="" id="value_date_manual<?php echo $count1;  ?>" name="value_date_manual[]" value="<?php if( $rows['value_date'] != ""){ echo $rows['value_date']; }else{ echo $valueDate; } ?>" class="form-control" readonly></td>
															<td class="showManual"  style="display:none;"><input title="Add Maturity Date" type="text" placeholder="" id="mat_date_manual<?php echo $count1;  ?>" name="mat_date_manual[]" value="<?php if( $rows['maturity_date'] != ""){ echo $rows['maturity_date']; }else { echo $maturityDay; } ?>" class="form-control" readonly></td>
																
                                                        </tr>
                                                       
                                                            <?php
                                                        }
                    $count1 ++;   
					   } 
                                                        ?>
                                                        <tr class="showManual" style="display:none;">
														   <td  colspan= ""><a href="add_money_market.php"><input class="btn btn-primary style2 glyphicon-plus" placeholder="" name="UPDATE" value="UPDATE" style="float:right;margin-right:10%;margin-top:10px;" type="submit"></a></td>
														</tr>
</form>
                                                </tbody>
                                              
                                            </table>
    <?php
} else {
    echo "<i style=color:red>Open loan list empty</i>";
}
?>
<script>

$( document ).ready(function() 
{
	var choosenType = $("#choosenType").val();
	if(choosenType == "y")
	{
		$(".showManual").show();
		$(".showAutomatic").hide();
	}
	else
	{
		$(".showAutomatic").show();
		$(".showManual").hide();
	}
});
</script>

                                        <script>
                                        function Choose_Currency(value)
									{
										
										if(value == "chf")
										{
											window.location.href = "money_market.php";
									}
									if(value == "usd")
										{
											window.location.href = "usd_money_market.php";
									}
									if(value == "eur")
										{
											window.location.href = "eur_money_market.php";
									}
								}
                                     function setMaturityShow(value)
									{
										
										if(value == "y")
										{
											$("#choosenType").val(value);
											$(".showAutomatic ").hide();
											$(".showManual").show();
										}
										else
										{
											$("#choosenType").val(value);
											$(".showManual").hide();
											$(".showAutomatic").show();
										}
										
										var data_to_send = 'status=' + value + '&function=setMaturityShow';

										$.ajax({

											url: "ajax_function.php",

											method: "post",

											data: data_to_send,

											cache: false,

											success: function(htnlstr)

											{
												//alert(<?php echo $base_url ; ?>);
												window.location.href = "money_market.php";
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
<script>

    $(function () {

	   var totalIds = $("#totalIds").val();
	  
	  
	  var i =1 ;
	  for(i = 1; i <= totalIds ; i++)
	  {
		 $("#start_date_manual"+i).datepicker({ dateFormat: 'dd.mm.yy' });
		 $("#value_date_manual"+i).datepicker({ dateFormat: 'dd.mm.yy' });
		 $("#mat_date_manual"+i).datepicker({ dateFormat: 'dd.mm.yy' });
	  }
	   
	   

    });
	</script>
<script>

    function make_it_off(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_off_interest';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function(htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on(" + id + ")'>");
            }
        });
    }
    function make_it_on(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_on_interest';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function(htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_on.png' onclick='make_it_off(" + id + ")'>");
                
            }
        });
    }
</script>
</body>
</html>
