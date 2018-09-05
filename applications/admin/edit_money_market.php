<?php include_once 'header.php';?>
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
            if(isset($_GET['id']))
            {
                 $id = $_GET['id'];
            }
            if(isset($_POST['update']))
            {
                    
              $mid = $_POST['value'];
              
			  
			  
			  if (preg_match('/month/',$mid))
			{
                 preg_match_all('/([\d]+)/', $mid, $match);

                 $monthsDigit = $match[0][0];
				 if($monthsDigit >= 4 )
				 {
					 $buttons_id = "1";
				 }
				 else
				 {
					 $buttons_id = "0";
				 }
			  $orderBy = $monthsDigit."1";
			  
			}else
			{
				$buttons_id = "0";
				$orderBy = $monthsDigit;
			}
			  
			  
			  
			  
              $insert_interest = mysql_query("update tbl_money_market set value = '".$mid."' ,buttons_id = '".$buttons_id."' ,by_order ='".$orderBy."'   where id='".$id."'");
              //$id = mysql_insert_id();
              if($insert_interest)
              {
                  $msg = "You have Updated successfully";
              }
              else
              {
                  $msg = "Please try again";
              }
            }
            ?>
            <?php
               // echo "select tbl_users.*,tbl_fedafin_rating.rating_name from tbl_users inner join  tbl_fedafin_rating on tbl_fedafin_rating.id=tbl_users.fedafin_rating where id='$id'";
                $select_query  = mysql_query("select * from tbl_money_market where id='$id'");
                $select_data = mysql_fetch_array($select_query);
            
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
                                                    <td class="col-md-4">Name</td>
                                                    <td class="col-md-8"><input type="text" placeholder="" id="swap" name="value" value="<?php echo $select_data['value']?>" class="form-control" required></td>
                                                    <div name="add_interest_swap_errorloc" class="errorstring"></div>
                                                </tr>
                                              
                                               <tr>
                                                    <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                </tr>
                                               
<!--                                              
                                       
                                            </tbody>
                                        </table>
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
