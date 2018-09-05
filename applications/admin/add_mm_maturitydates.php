




<?php include_once 'header.php';?>
 <script src="assets/js/jquery-ui.js" type="text/javascript"></script>
 <link href="assets/css/style_1.css" rel="stylesheet" type="text/css"/> 
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
  <?php
if(isset($_GET['id']))
{	
	 $monyMarketId = $_GET['id'];
}
else
{
	echo "You cant see this page";
	die;
}

    
	
	
	if(isset($_POST['add']))
	{
		$start_date    = $_POST['start_date'];
		$mat_date    = $_POST['mat_date'];
		$monyMarktId  = $_POST['monymarketId'];
		
		
		$updateMaturityDates = mysql_query("UPDATE `tbl_money_market` SET `start_date` = '".$start_date."' ,`maturity_date` = '".$mat_date."' WHERE `id` = '".$monyMarktId."' ");
	    
		$message = "Dates Successfully Added";
	}
	
  $selectMonyMarketValue = mysql_query("SELECT * FROM `tbl_money_market` WHERE `id` = '".$monyMarketId."'");
	
  ?>

          
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Add Maurity Dates</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                         <form name="add_interest" method="post" id="add_interest">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Field</th>
                                                    <th class="col-md-8">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                    <?php
                                                    if($msg != '')
                                                    {
                                                        echo "<div class='alert alert-success'>".$msg."</div>";
                                                    }
													$fetchValues = mysql_fetch_array($selectMonyMarketValue);
                          
                                                   
                                                    ?>
                                                <!--<div class="alert alert-success"></div>-->
                                                
                                                   <input type="hidden" name="monymarketId" id ="monymarketId" value = "<?php echo $fetchValues['id']; ?>" />
                                                <tr>
                                                    <td class="col-md-4">Name</td>
                                                    <td class="col-md-8"><input type="text" placeholder="" id="swap" name="value" value="<?php echo $fetchValues['value']; ?>" class="form-control" readonly></td>
                                                    <div name="add_interest_swap_errorloc" class="errorstring"></div>
                                                </tr>
												<tr>

                                                    <td class="col-md-4">Start Date</td>

                                                    <td class="col-md-8"><input title="Add Start Date" type="text" placeholder="" id="start_date" name="start_date" value="<?php if($fetchValues['start_date'] != ""){echo $fetchValues['start_date']; }; ?>" class="form-control" readonly></td>

                                                   

                                                </tr>
												<tr>

                                                    <td class="col-md-4">Maturity Date</td>

                                                    <td class="col-md-8"><input title="Add Maturity Date" type="text" placeholder="" id="mat_date" name="mat_date" value="<?php if($fetchValues['maturity_date'] != ""){echo $fetchValues['maturity_date']; } ?>" class="form-control" readonly></td>

                                                    

                                                </tr>
                                                
                                              
                                                
                                               <tr>
                                                    
                                                    <td class="col-md-1"><input type="submit" placeholder="" name="add" value="Add" class="btn btn-primary style2"></td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </form>

                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<script>

    $(function () {

        $("#start_date , #mat_date").datepicker({ dateFormat: 'dd.mm.yy' });

    });
	</script>
<!-- Wrapper End -->
</body>
	
</html>