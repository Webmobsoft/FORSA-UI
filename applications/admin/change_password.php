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
          
            if(isset($_POST['submit']))
		{
			if($_SESSION['user_type'] == "admin" )
				{
		           $old_password = $_POST['old_password'];
                   $new_password = $_POST['new_password'];
                   $confirm_password = $_POST['confirm_password'];
                if($new_password == $confirm_password)
                {
                      $select_query = "select pwd from tbl_users where id=".$_SESSION['user_id'];
                      $res_query = mysql_query($select_query); 
                      $row = mysql_fetch_array($res_query);
                       if($row['pwd'] == md5($old_password))
						{
									 
						 $update_qry = mysql_query("update tbl_users set pwd='".md5($new_password)."' where id='".$_SESSION['user_id']."'");
									 echo'<div class="alert alert-success">Password Changed successfully</div>';
						}
                       else
					   {
			              echo'<div class="alert alert-danger">Wrong old password</div>';
			               }
		        }
                    else{
                      echo'<div class="alert alert-danger">New password and confirm password does not match</div>';
		   }
            }
			else
			{
					 $old_password = $_POST['old_password'];

                     $new_password = $_POST['new_password'];

                     $confirm_password = $_POST['confirm_password'];
				if($new_password == $confirm_password)

                {

                      $select_query = "select pwd from tbl_users_admin where id=".$_SESSION['user_id'];

                      $res_query = mysql_query($select_query); 

                      $row = mysql_fetch_array($res_query);

                       if($row['pwd'] == md5($old_password))

						{
                           $update_qry = mysql_query("update tbl_users_admin set pwd='".md5($new_password)."' where id='".$_SESSION['user_id']."'");

									 echo'<div class="alert alert-success">Password Changed successfully</div>';

						}

                       else
					   {

			              echo'<div class="alert alert-danger">Wrong old password</div>';

			           }

		        }
			}
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
                                    <h2 class="heading">Change Password</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                         <form name="add_interest" method="post" id="add_interest">
                                        <table class="table">
                                           
                                            <tbody>
                                               
                                                   
                                                <!--<div class="alert alert-success"></div>-->
                                                 
                                                <tr>
                                                    <td class="col-md-4">Enter Old password</td>
                                                    <td class="col-md-8"><input type="password" placeholder="" id="old_password" name="old_password" value="" class="form-control" required></td>
                                                    
                                                </tr>
<tr>
                                                    <td class="col-md-4">Enter New password</td>
                                                    <td class="col-md-8"><input type="password" placeholder="" id="new_password" name="new_password" value="" class="form-control" required></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Confirm password</td>
                                                    <td class="col-md-8"><input type="password" placeholder="" id="confirm_password" name="confirm_password" value="" class="form-control" required></td>
                                                    
                                                </tr>
                                                
                                               <tr>
                                                    
                                                    <td></td><td class="col-md-1"  ><input type="submit" placeholder="" name="submit" value="Submit" class="btn btn-primary style2"></td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </form>
<!--                                            <script  type="text/javascript">
                                            var frmvalidator = new Validator("add_interest");
                                            frmvalidator.addValidation("swap","req","Please enter Swap");
                                            frmvalidator.addValidation("kurve","req","Please enter kurve");
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
