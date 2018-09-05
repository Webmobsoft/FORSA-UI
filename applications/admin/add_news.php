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
                if (!empty($_POST['emailMessage'])) {
                 $emailMessage = $_POST['emailMessage'];
                 //echo "INSERT INTO `tbl_home_news` (`content`, `Date`) VALUES ('$emailMessage', '".  date("d.m.Y")."');";
                    mysql_query("INSERT INTO `tbl_home_news` (`content`, `Date`) VALUES ('$emailMessage', '".  date("d.m.Y")."');");
                    
                    echo'<div class="alert alert-success">News Added Successfully.</div>';
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
                                    <h2 class="heading">Add New News</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="sendEmailForm" action="" method="post" id="add_interest">
                                            <table class="table">
                                                <tbody>
                                                    <!--<div class="alert alert-success"></div>-->
                                                   
                                                    <tr>
                                                        <td class="col-md-4">Message</td>
                                                        <td class="col-md-8">
                                                            <textarea id="emailMessage" class="form-control ckeditor" name="emailMessage" required=""></textarea>
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
