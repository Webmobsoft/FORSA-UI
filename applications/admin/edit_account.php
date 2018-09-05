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
            if (isset($_POST['update'])) {

				if($_SESSION['user_type'] == "admin" )
				{
					$fedral_rating_verified = $_POST['fedral_rating_verified'];
					$mysql = mysql_query("UPDATE tbl_users SET `fname` = '".$_POST['fname']."', `email` = '".$_POST['email']."', `lname` = '".$_POST['lname']."' WHERE `id` = 1");
					$msg = "Updated Successfully";
                }
				else
				{
					$mysql = mysql_query("UPDATE tbl_users_admin SET `fname` = '".$_POST['fname']."', `email` = '".$_POST['email']."', `lname` = '".$_POST['lname']."' WHERE `id` = '". $_SESSION['user_id']."'");

					$msg = "Updated Successfully";
				}
            }
            ?>
            <?php
  if($_SESSION['user_type'] == "admin" )
  {
            $select_query = mysql_query("SELECT `tbl_users`.* FROM `tbl_users` WHERE `tbl_users`.`id` = '1'");
            $adminData = mysql_fetch_assoc($select_query);
  }
  else
  {
	        $select_query = mysql_query("SELECT `tbl_users_admin`.* FROM `tbl_users_admin` WHERE `tbl_users_admin`.`id` = '". $_SESSION['user_id']."'");

            $adminData = mysql_fetch_assoc($select_query);
  }
            ?>
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Edit Account</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="editAccount" method="post" id="add_interest">
                                            <table class="table">
                                                <tbody>
                                                    <!--<div class="alert alert-success"></div>-->
                                                    <tr>
                                                        <td class="col-md-4">First Name</td>
                                                        <td class="col-md-8">
                                                            <input type="text" placeholder="" id="fname" name="fname" value="<?php echo $adminData['fname']; ?>" class="form-control">
                                                            <span style="color: red;" class="error_strings" id="editAccount_fname_errorloc"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-4">Last Name</td>
                                                        <td class="col-md-8">
                                                            <input type="text" placeholder="" id="lname" name="lname" value="<?php echo $adminData['lname']; ?>" class="form-control">
                                                            <span style="color: red;" class="error_strings" id="editAccount_lname_errorloc"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-4">Email</td>
                                                        <td class="col-md-8">
                                                            <input type="text" placeholder="" id="email" name="email" value="<?php echo $adminData['email']; ?>" class="form-control">
                                                            <span style="color: red;" class="error_strings" id="editAccount_email_errorloc"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="col-md-1">
                                                            <input type="submit" placeholder="" name="update" value="Submit" class="btn btn-primary style2">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
<!--                                        <script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                                            var frmvalidator = new Validator("editAccount");
                                            frmvalidator.addValidation("fname","req","Please enter first name");
                                            frmvalidator.addValidation("lname","req","Please enter last name");
                                            frmvalidator.addValidation("email","req","Please enter email");
                                            frmvalidator.addValidation("email","email","Please enter valid email");
                                        //]]>
                                        </script>-->
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
