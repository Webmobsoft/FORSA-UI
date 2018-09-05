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
            <?php
            $msg = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if (isset($_POST['update'])) {

   
             $update = "update tbl_category set  `category` = '".$_POST['category']."' where id=".$id."";
             $mysql = mysqli_query($mysql_connect,$update);    
              
                $msg = "updated successfully";
               }
            ?>
            <?php

/*$category = mysql_query("SELECT id,category FROM `tbl_category`");
$count = mysql_num_rows($category);*/
            $category = mysqli_query($mysql_connect,"SELECT id, category FROM tbl_category where id=".$id."");
            $select_data = mysqli_fetch_array($category);
           
            ?>
            <style>

                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                    padding: 5px 18px;
                    vertical-align: top;
                }

            </style>
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Update</h2>
                                    <span id="add"><a href="client_sub_group.php" style="float:right;" class="btn btn-primary style2">Back to list</a></span>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <form id="updateUserData" name="update_user" method="post">
<?php
if ($msg != '') {
    echo "<div class='alert alert-success'>" . $msg . "</div>";
}
?>
                                                <!--<div class="alert alert-success"></div>-->
                                               
                                                
                                                <tr>
                                                    <td class="col-md-4">Category</td>
                     <td class="col-md-8"><input type="text"  placeholder="" name="category" value="<?php echo $select_data['category']; ?>" class="form-control" required></td>

                                                   
                                                </tr>
                                               




                                            
                                                     <tr>
                                                     <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                   
                                                </tr>
                                            </form>
                                            <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                                                
                                                var frmvalidator = new Validator("updateUserData");
                                                frmvalidator.EnableOnPageErrorDisplay();
                                                frmvalidator.EnableMsgsTogether();
                                                frmvalidator.addValidation("contact_number", "req", "Please enter contact number");
                                                frmvalidator.addValidation("email", "req", "Please enter email address");
                                                frmvalidator.addValidation("email", "email", "Please enter valid email address");
                                                frmvalidator.addValidation("bank_account", "req", "Please enter bank account number");
                                                frmvalidator.addValidation("beneficiary_name", "req", "Please enter beneficiary name");

                                                //]]>

                                            </script>

                                            </tbody>
                                        </table>
                                            <!--Market Settings-->
                                           
                                            
                                             <?php
                                        if($count > 0)
                                        {
                                        ?>
                                <table id="keywords" cellspacing="0" cellpadding="0" style="width:100%;margin-top:30px;margin-bottom:30px;margin-left: 1px;" class="table">
                    <thead>
                       
                    </thead>
                    <tbody>
                           
                                </tbody>
                </table>
                                        <?php } ?>
                                            <!--CHF currency end-->
                           
                      
                                             <?php
                                        if($count > 0)
                                        {
                                        ?>
                                <table id="keywords" cellspacing="0" cellpadding="0" style="width:100%;margin-top:30px;margin-bottom:30px;margin-left: 1px;" class="table">
                    <thead>
                       
                    </thead>
                   <tbody>
                          
                           
                                </tbody>
                </table>
                                        <?php } ?>
                                            <!--EUR currency end-->
                                               
                                             <?php
                                        if($count > 0)
                                        {
                                        ?>
                                <table id="keywords" cellspacing="0" cellpadding="0" style="width:100%;margin-top:30px;margin-bottom:30px;margin-left: 1px;" class="table">
                    <thead>
                       
                    </thead>
                    <tbody>
                          
                                </tbody>
                </table>
                                        <?php } ?>
                                            <!--USD currency end-->
                                    <!-- Market Settings end -->
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