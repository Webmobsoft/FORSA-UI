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
             if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if (isset($_POST['update'])) {                
                if (!empty($_POST['content'])) {
                 $update = "update tbl_home_news set `content` = '" . $_POST['content'] . "',`Date` = '" . $_POST['Dates'] . "',`showDate` = '" . $_POST['shown'] . "'  where id = " . $id . "";
                 $mysql = mysql_query($update);
                    echo'<div class="alert alert-success">News Updated Successfully.</div>';
                } else {
                    echo'<div class="alert alert-danger">Some Error Occur Please Try Again.</div>';
                }
            }
            
            $select_lender = mysql_query("SELECT * from tbl_home_news where id=$id");
            ?>

            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Update News</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="sendEmailForm" action="" method="post" id="add_interest">
                                            <table class="table">
                                                <tbody>
                                                    <!--<div class="alert alert-success"></div>-->
                                                    <?php
                                            while($rows = mysql_fetch_array($select_lender))
                                            {?>
                                                    <tr>
                                                        <td class="col-md-4">Message</td>
                                                        <td class="col-md-8">
                                                            <textarea id="emailMessage" class="form-control ckeditor" name="content" ><?php echo $rows['content'];?></textarea>
                                                          
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td class="col-md-4">Posted On</td>
                                                        <td class="col-md-8">
                                                           <input type="text" value="<?php echo $rows['Date'];?>" name="Dates">
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td class="col-md-4">Show Posted on</td>
                                                        <td class="col-md-8">
                                                         <input type="radio" value="y" name="shown" <?php if($rows['showDate'] =="y") {echo "checked";} ?>> Yes &nbsp; &nbsp;&nbsp;&nbsp;<input type="radio" value="n" name="shown" <?php if($rows['showDate'] =="n") {echo "checked";} ?>> No
                                                        </td>
                                                    </tr>
                                            <?php } ?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="col-md-1"  >
                                                            <input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2 hideMyDiv">
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
