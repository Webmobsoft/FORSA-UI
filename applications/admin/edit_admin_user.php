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
            if(isset($_POST['pre'])){
                $al= $_POST['pre'];
                $test=implode(",", $al);
                }
                else {
                   $test=10;
                }
            $update = "update tbl_users_admin set `fname` = '".$_POST['fname']."',  `lname` = '".$_POST['lname']."', `uname` = '".$_POST['uname']."', `email` = '".$_POST['email']."', `privilege` = '".$test."' where id=".$id."";    
            $mysql = mysql_query($update);	 
                $msg = "updated successfully";
            }
            ?>
            <?php
            $select_query = mysql_query("select * from tbl_users_admin where tbl_users_admin.id='$id'");
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
                                    <h2 class="heading">Update Admin</h2>
                                </header>
                                <a href="admin_users.php" ><input class="pull-right" type="button" value="Back" ></a>
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
                                                    <td class="col-md-4">First Name</td>
                                                    <td class="col-md-8"><input type="text"  placeholder="" name="fname" value="<?php echo $select_data['fname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Last Name</td>
                                                    <td class="col-md-8"><input type="text" placeholder="lname" name='lname' value="<?php echo $select_data['lname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">User Name</td>
                                                    <td class="col-md-8"><input type="text" placeholder="lname" name="uname" value="<?php echo $select_data['uname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Admin type:</td>
                                                    <td class="col-md-8"><select name="role" id="role" class="form-control" >
                                                    <?php $fedafinName = trim($select_data['role'])  ?>
                                                     <option value='1' <?php if($select_data['role']=="1") {echo 'selected="selected"';}  ?>>AdminPS</option>
                                                    <option value='2' <?php if($select_data['role']=="2"){echo 'selected="selected"';}  ?>>AdminHM</option>
                                                    <option value='3' <?php if($select_data['role']=="3"){echo 'selected="selected"';}  ?>>AdminNHB</option>
                                                    </select>
                                                    </td>
						</tr>
                                                <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8">
                                                        <input id="email" class="form-control" name="email" type="text" value="<?php echo $select_data['email']; ?>"  />
                                                        <span id='updateUserData_email_errorloc' class="error_strings" style="color: red"></span>
                                                    </td>
                                                </tr>                                                
                                            <tr>
                                            <td class="col-md-4">privilege type:</td>
                                                <?php 
                                                if(!empty($select_data['privilege'])){
                                                    $final=$select_data['privilege'];
                                                    $arra = explode(',', $final);
//                                                    print_r($arra);
                                                }
                                                ?>                                            
                                            <td class="col-md-8">
                                                Show: <input type="checkbox" name="pre[]" value="1" <?php if(in_array(1,$arra)) echo 'checked'; ?>><br>
                                                Add:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pre[]" value="2" <?php if(in_array(2,$arra)) echo 'checked'; ?>><br>
                                                Edit:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pre[]" value="3" <?php if(in_array(3,$arra)) echo 'checked'; ?>><br>
                                                Delete:<input type="checkbox" name="pre[]" value="4" <?php if(in_array(4,$arra)) echo 'checked'; ?>><br>
                                            </td>
                                            </tr>                                                
                                                
                                                <!--Manu's code end here-->
                                                
                                                <tr>

                                                    <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                </tr>
                                            </form>
                                            <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                                                //You should create the validator only after the definition of the HTML form
                                                var frmvalidator = new Validator("updateUserData");
                                                frmvalidator.EnableOnPageErrorDisplay();
                                                frmvalidator.EnableMsgsTogether();
//                                                frmvalidator.addValidation("contact_number", "req", "Please enter contact number");
                                                frmvalidator.addValidation("email", "req", "Please enter email address");
                                                frmvalidator.addValidation("email", "email", "Please enter valid email address");
//                                                frmvalidator.addValidation("bank_account", "req", "Please enter bank account number");
//                                                frmvalidator.addValidation("beneficiary_name", "req", "Please enter beneficiary name");

                                                //]]>

                                            </script>
                                            </tbody>
                                        </table>
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
