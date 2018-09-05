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
                

            $ClientGroups = implode(',', $_POST['client_group']);
             $update = "update tbl_customers set  `Name_company` = '".$_POST['Name_company']."',`password` = '".$_POST['password']."',`address` = '".$_POST['address']."',`Postcode` = '".$_POST['Postcode']."',`place` = '".$_POST['place']."',`category` = '".$_POST['category']."',`client_group` = '".$ClientGroups."',`fo_assignment` = '".$_POST['fo_assignment']."',`salutation` = '".$_POST['salutation']."',`title` = '".$_POST['title']."',`first_name` = '".$_POST['first_name']."',`Surname` = '".$_POST['Surname']."',`email` = '".$_POST['email']."' where id=".$id."";
             $mysql = mysqli_query($mysql_connect,$update);    
              
                $msg = "updated successfully";
               }
            ?>
            <?php

/*$category = mysql_query("SELECT id,category FROM `tbl_category`");
$count = mysql_num_rows($category);*/
            $category = mysqli_query($mysql_connect,"SELECT * FROM tbl_customers where id=".$id."");
            $select_data = mysqli_fetch_array($category);
            $clientgroup = explode(",", $select_data['client_group']);
            $clientsubgroupquery = mysqli_query($mysql_connect,"select category FROM tbl_category WHERE active = 'Y'");
            // print_r($clientgroup);
            // exit();
           
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
                                <span id="add"><a href="customers.php" class="btn btn-primary style2" style="float: right;">Back to list</a></span>
                                <header>
                                    <h2 class="heading">Update</h2>
                                    
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
                                    <td class="col-md-4">Name Unternehmen</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="Name_company" value="<?php echo $select_data['Name_company']; ?>" class="form-control" required></td>

                                    </tr>
                                    <tr>
                                    <td class="col-md-4">Strasse</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="address" value="<?php echo $select_data['address']; ?>" class="form-control" required></td>

                                    </tr>
                                    <tr>
                                    <td class="col-md-4">PLZ</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="Postcode" value="<?php echo $select_data['Postcode']; ?>" class="form-control" required></td>

                                    </tr>
                                    <tr>
                                    <td class="col-md-4">ORT</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="place" value="<?php echo $select_data['place']; ?>" class="form-control" required></td>

                                    </tr>
                                    
                                    <tr>
                                                    <td class="col-md-4">Client group</td>
                                                    <td class="col-md-8">
                                                       <!--  <input type="text" class="form-control"  name="clientgroup"> -->

                                                        <select class="form-control" name="client_group[]">
                                                            <option value=""></option>
                                                            <option value="Bank" <?php if(isset($select_data['client_group']) && in_array("Bank",$clientgroup)){ echo "selected"; }?>>Bank</option>
                                                        <option value="Unternehmen GmbH" <?php if(isset($select_data['client_group']) && in_array("Unternehmen GmbH",$clientgroup)){ echo "selected"; }?>>Kommunale Unternehmen (GmbH)</option>
                                                        <option value="Unternehmen AöR KdöR" <?php if(isset($select_data['client_group']) && in_array("Unternehmen AöR KdöR", $clientgroup)){ echo "selected"; }?>>Kommunale Unternehmen (KdöR - AöR)</option>   
                                                        <option value="Kommunen" <?php if(isset($select_data['client_group']) && in_array("Kommunen", $clientgroup)  ){ echo "selected"; }?>>Kommunen</option>
                                                    </select>

                                                    </td>
                                                    
                                    </tr>
                                    <!-- <tr>
                                    <td class="col-md-4">Client Sub Group </td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="category" value="<?php echo $select_data['category']; ?>" class="form-control" required></td>

                                    </tr>  -->
                                    <tr>
                                                    <td class="col-md-4">Client Sub Group</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="category">
                                                        <option value="">--Select Client Sub Group--</option>
                                                            <?php 
                                                               while($rows = mysqli_fetch_assoc($clientsubgroupquery)){?>
                                                                    <option <?php if($rows['category'] == $select_data['category']){ echo "selected"; }?>><?php echo $rows['category'];?></option>
                                                                <?php } 
                                                            ?>
                                                        </select>
                                                        </td>
                                                </tr>

                                   <!--  <tr>
                                    <td class="col-md-4">Client Group</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="client_group" value="<?php echo $select_data['client_group']; ?>" class="form-control" required></td>
                                    </tr>
                                    <tr> -->
                                    <td class="col-md-4">FO-Zuordnung</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="fo_assignment" value="<?php echo $select_data['fo_assignment']; ?>" class="form-control" required></td>

                                    </tr>
                                    <tr>
                                    <td class="col-md-4">Anrede</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="salutation" value="<?php echo $select_data['salutation']; ?>" class="form-control" required></td>

                                    </tr>
                                    
<tr>
                                    <td class="col-md-4">Titel</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="title" value="<?php echo $select_data['title']; ?>" class="form-control"></td>

                                    </tr>
<tr>
                                    <td class="col-md-4">Vorname</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="first_name" value="<?php echo $select_data['first_name']; ?>" class="form-control" required></td>

                                    </tr>
<tr>
                                    <td class="col-md-4">Nachname</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="Surname" value="<?php echo $select_data['Surname']; ?>" class="form-control" required></td>

                                    </tr>
<tr>
                                    <td class="col-md-4">email</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="email" value="<?php echo $select_data['email']; ?>" class="form-control" required></td>

                                    </tr>
                                    <tr>
                                    <td class="col-md-4">password</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="password" value="<?php echo $select_data['password']; ?>" class="form-control" required></td>

                                    </tr><!-- 
<tr>
                                    <td class="col-md-4">password</td>
                                    <td class="col-md-8"><input type="text"  placeholder="" name="password" value="<?php echo $select_data['password']; ?>" class="form-control" required></td>

                                    </tr> -->


                                            
                                                     <tr>
                                                     <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                   
                                                </tr>
                                            </form>
                                            <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                                                
                                                // var frmvalidator = new Validator("updateUserData");
                                                // frmvalidator.EnableOnPageErrorDisplay();
                                                // frmvalidator.EnableMsgsTogether();
                                                // frmvalidator.addValidation("contact_number", "req", "Please enter contact number");
                                                // frmvalidator.addValidation("email", "req", "Please enter email address");
                                                // frmvalidator.addValidation("email", "email", "Please enter valid email address");
                                                // frmvalidator.addValidation("bank_account", "req", "Please enter bank account number");
                                                // frmvalidator.addValidation("beneficiary_name", "req", "Please enter beneficiary name");

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