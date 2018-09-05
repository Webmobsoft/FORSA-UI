<?php include_once 'config.php';?>


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
            $msg = '';
          if(isset($_POST['add']))
          {
			 
              $holiday_name    = $_POST['holiday_name'];
			  $holiday_date    = $_POST['holiday_date'];
              $selectCurrrency = $_POST['selectCurrrency'];
			
				 $insert_holidays = mysql_query("insert into tbl_calender(holiday_name,date_select,holidayFor)values('".$holiday_name."','".$holiday_date."','".$selectCurrrency."')");
                 $id = mysql_insert_id(); 
			 
              
              if($id > 0)
              {
                  $msg = "You have added successfully";
              }
              else
              {
                  $msg = "Please try again";
              }
          }
            ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
   <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd.mm.yy' });
  } );
  </script>


            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Add New</h2>
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
                                                   
                                                    ?>
                                                <!--<div class="alert alert-success"></div>-->
                                                
                                                <tr>
                                                    <td class="col-md-4">Holiday Name</td>
                                                    <td class="col-md-8"><input type="text" placeholder="" id="swap" name="holiday_name" value="" class="form-control"></td>
                                                    
                                                </tr>
												 <tr>
                                                    <td class="col-md-4">Selected For</td>
                                                    <td class="col-md-8"><select class="form-control" name="selectCurrrency">
													                          <option value="CHF">CHF</option>
																			  <option value="EUR">EUR</option>
																			  <option value="USD">USD</option>
													                     </select>
												    </td>
                                                    
                                                 </tr>
												 <tr>
                                                    <td class="col-md-4">Holiday Date</td>
                                                    <td class="col-md-8"><input type="date" placeholder="" id="datepicker" name="holiday_date" value="" class="form-control datepicker" required></td>
                                                    
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
<!-- Wrapper End -->
</body>
</html>
