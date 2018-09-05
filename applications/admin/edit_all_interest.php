<?php include_once 'header.php';?>
<!-- Wrapper Start -->
<div class="wrapper" style="width:100%;">
	<div class="structure-row">
        <!-- Sidebar Start -->
        <?php include_once 'side_bar.php';?>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <?php include_once 'top_right.php';?>
            <!-- Right Section Header End -->
            <!---edit all interst action------>
            <?php  include_once 'interest_edit.php'; ?> 
            
            <?php
              $sql = 'select * from tbl_interest';
              $retval = mysql_query( $sql);
              ?>			
					 
           
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Update</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="update_user" method="post">
                                        <table class="table">
                                            <thead>
											     
										 <tr>
                                                    <th class="col-md-4">Mid</th>
                                                    <th class="col-md-4">Swap</th>
						<th class="col-md-4">Kurve</th>
													
                                                </tr>
                                            </thead>
											<tbody>
											<?php 
											while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
										 
                                         ?>    
											  <tr>
											  <form name="updateInterest" id="updateInterest" action="interest_edit.php">
											  <input type="hidden" name="id[]" value="<?php echo $row['id'];   ?>"> 
											  <input type="hidden" value="<?php echo $row['mid']; ?>">
											<td>
											<select  class="form-control" name="mid[]">
											
											<option  <?php if ($row['mid'] == 1 ) echo 'selected=selected' ; ?> value="1">1</option>
											<option <?php if ($row['mid'] == 2 ) echo 'selected=selected' ; ?> value="2">2</option>
											<option <?php if ($row['mid'] == 3 ) echo 'selected=selected' ; ?> value="3">3</option>
											<option <?php if ($row['mid'] == 4 ) echo 'selected=selected' ; ?> value="4">4</option>
											<option <?php if ($row['mid'] == 5 ) echo 'selected=selected' ; ?> value="5">5</option>
											<option <?php if ($row['mid'] == 6 ) echo 'selected=selected' ; ?> value="6">6</option>
											<option <?php if ($row['mid'] == 7 ) echo 'selected=selected' ; ?>value="7">7</option>
											<option <?php if ($row['mid'] == 8 ) echo 'selected=selected' ; ?>value="8">8</option>
											<option <?php if ($row['mid'] == 9 ) echo 'selected=selected' ; ?>value="9">9</option>
											<option <?php if ($row['mid'] == 10 ) echo 'selected=selected' ; ?>value="10">10</option>
											<option <?php if ($row['mid'] == 12 ) echo 'selected=selected' ; ?>value="12">12</option>
											<option <?php if ($row['mid'] == 15 ) echo 'selected=selected' ; ?>value="15">15</option>
											<option <?php if ($row['mid'] == 20 ) echo 'selected=selected' ; ?>value="20">20</option>
											
											</select>
											</td>
											<td><input type="text" class="form-control" name="swap[]" value="<?php echo $row['swap']; ?>"></td>
											<td><input type="text" class="form-control" name="kurve[]" value="<?php echo $row['kurve']; ?>"></td>
											
											  </tr>
											<?php }  ?>
											   </tbody>
                                        </table>
										<input type="submit"  value="UPDATE" name="UPDATE" style="background: #284b84 none repeat scroll 0 0; border: medium none;border-radius: 5px;color: #fff;padding: 10px 22px;float:right;
										margin:0px 20px 20px 0px">
                                             </form>
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


