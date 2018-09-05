<?php include_once 'header.php'; ?>
<script src="ckeditor/ckeditor.js"></script>
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
            if (isset($_POST['submit'])) {              
                if (!empty($_POST['userEmail']) && !empty($_POST['emailMessage']) && !empty($_POST['emailSubject'])) {
                    $userEmail = implode(",", $_POST['userEmail']);
                    $emailSubject = $_POST['emailSubject'];
                    $emailMessage = $_POST['emailMessage'];
                    $emailMessage .= 'Mit freundlichen Grüssen <br/>';
            	    $emailMessage .= 'Freundliche Gr&uuml;sse <br/>';
            	    $emailMessage .= "Ihr FORSA-Team <br>";
            	    $emailMessage .= "Riedm&uuml;hlestrasse 8  <br>";
            	    $emailMessage .= "8305 Dietlikon  <br>";
            	    $emailMessage .= "+41 43 543 06 63  <br>";
            	    $emailMessage .= "admin@instimatch.ch";

                    $users = $_POST['userEmail'];
                    foreach($users as $user){
                        mysqli_query($mysql_connect,"INSERT INTO `tbl_emails` (`to`, `subject`, `message`, `sent_at`) VALUES ('$user', '$emailSubject', '$emailMessage', '".  date("Y-m-d h:i:s")."');");
                    }
                   
                   $email = mysqli_query($mysql_connect,"SELECT email FROM `tbl_users` where id IN (".$userEmail.")");

                    $emails = array();
                    if(mysqli_num_rows($email) > 0) {

                        while ($emailing = mysqli_fetch_assoc($email)) {
                          $emails[] = $emailing['email'];    
                        }

                        
                    }   
                    foreach ($emails as $EmailID) {
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers  = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
                    $headers .=  "From: admin@instimatch.ch \r\n";
                    $headers .= "Cc: info@instimatch.ch \r\n";    
                    //echo $EmailID, $emailSubject, $emailMessage, $headers;
                    mail($EmailID, $emailSubject, $emailMessage, $headers);
                    }
                    
                    echo'<div class="alert alert-success">Email Sent Successfully.</div>';
                } else {
                    echo'<div class="alert alert-danger">Some Error Occur Please Try Again.</div>';
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
                                    <h2 class="heading">Send Email</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="sendEmailForm" action="" method="post" id="add_interest">
                                            <table class="table">
                                                <tbody>
                                                    <!--<div class="alert alert-success"></div>-->
                                                    <tr>
                                                        <td class="col-md-4">Select User</td>
                                                        <td class="col-md-8">
                                                            <select id="userEmail" name="userEmail[]" class="form-control" multiple="multiple" style="height: 300px;">
                                                                <?php
                                                                    $users = mysqli_query($mysql_connect,"SELECT id, user_type, email, concat((fname), (' '), (lname)) as name ,company_name FROM `tbl_users` where status = 'Y' and tbl_users.is_archieve = 'n' and user_type not like 'admin' order by user_type desc");
                                                                    if(mysqli_num_rows($users) > 0) {
                                                                        while($user = mysqli_fetch_assoc($users)) {
                                                                            echo '<option value="'.$user['id'].'">'.$user['name'].' - '.  ucfirst($user['user_type']).' ( '.$user["company_name"].' )</option>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span name="sendEmailForm_userEmail_errorloc" class="errorstring"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-4">Subject</td>
                                                        <td class="col-md-8">
                                                            <input id="emailSubject" class="form-control" name="emailSubject">
                                                            <span name="sendEmailForm_emailMessage_errorloc" class="errorstring"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-4">Message</td>
                                                        <td class="col-md-8">
                                                            <textarea id="emailMessage" class="form-control ckeditor" name="emailMessage"></textarea>
                                                            <span name="sendEmailForm_emailMessage_errorloc" class="errorstring"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="col-md-1"  >
                                                            <input type="submit" placeholder="" name="submit" value="Send" class="btn btn-primary style2 hideMyDiv">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                        <script  type="text/javascript">
                                            var frmvalidator = new Validator("sendEmailForm");
                                            frmvalidator.addValidation("userEmail","req","Please Select User");
//                                            frmvalidator.addValidation("emailMessage","req","Please Enter Message");
                                        </script>
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
