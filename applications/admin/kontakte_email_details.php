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
            
            ?>
            <?php
            $select_query = mysqli_query($mysql_connect,"SELECT tbl_emails.*, tbl_customers.first_name, tbl_customers.Surname  FROM `tbl_emails` inner join tbl_customers on tbl_customers.id = tbl_emails.to WHERE tbl_emails.id = $id");
            //$count = mysqli_num_rows($select_lender);

            // $select_query = mysqli_query($mysql_connect,"select * FROM tbl_users WHERE id='$id'");
             $select_data = mysqli_fetch_array($select_query);
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
                              <span id="add"><a href="sent_kontakte_mail.php" class="btn btn-primary style2" style="float: right;">Back to list</a></span>
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Sent Kontakte Email Details</h2>

                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <table class="table">
                                            <thead>
                                                <!-- <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr> -->
                                            </thead>
                                            <tbody>
                                            <tr>
                                                    
                                                    <td class="col-md-8"><?php echo $select_data['message']; ?></td>
                                            </tr>  
                                          
                                            

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