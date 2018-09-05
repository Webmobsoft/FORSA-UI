<?php error_reporting(0); ?>
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
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="stat-box colorone">
                                <i class="author">&nbsp;</i>
                                <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_user = mysql_query("select count(*) as total_count from tbl_users where user_type != 'admin'");
                                $get_users = mysql_fetch_array($select_user);
                                ?>
                                <h4>Users</h4>
                                <h1><?php echo ($get_users['total_count'] == null)? '0' : $get_users['total_count'];?></h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <a href="lender_detail.php"><div class="stat-box colortwo">
                                <i class="chart">&nbsp;</i>
                                 <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_lender_user = mysql_query("select count(*) as total_lender from tbl_users where user_type != 'borrower' and user_type != 'admin'");
                                $get_lender_users = mysql_fetch_array($select_lender_user);
                                ?>
                                <h4>Lenders</h4>
                                <h1><?php echo ($get_lender_users['total_lender'] == null)? '0' : $get_lender_users['total_lender'];?></h1>
                            </div></a>
                        </div>
                        <div class="col-xs-2">
                              <a href="borrower_detail.php"> <div class="stat-box colorthree">
                                <i class="pages">&nbsp;</i>
                                 <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_borrower_user = mysql_query("select count(*) as total_borrower from tbl_users where user_type != 'lender' and user_type != 'admin'");
                                $get_borrower_users = mysql_fetch_array($select_borrower_user);
                                ?>
                                <h4>Borrowers</h4>
                                <h1><?php echo ($get_borrower_users['total_borrower'] == null)? '0' : $get_borrower_users['total_borrower'];?></h1>
                            </div></a>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorfour">
                                <i class="chart">&nbsp;</i>
                                 <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_loan_detail = mysql_query("select count(*) as total_loan from tbl_borrower_request");
                                $get_loan_users = mysql_fetch_array($select_loan_detail);
                                ?>
                                <h4>All Loan</h4>
                                <h1><?php echo ($get_loan_users['total_loan'] == null)? '0' : $get_loan_users['total_loan'];?></h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                             <a href="open_loan.php" style="cursor: pointer"> <div class="stat-box colorfive">
                                <i class="comments">&nbsp;</i>
                                 <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_open_loan= mysql_query("select count(*) as open_loan from tbl_borrower_request where status='open'");
                                $get_open_loan = mysql_fetch_array($select_open_loan);
                                ?>
                                <h4>Open Loan</h4>
                                <h1><?php echo ($get_open_loan['open_loan'] == null)? '0' : $get_open_loan['open_loan'];?></h1>
                            </div></a>
                        </div>
                        <div class="col-xs-2">
                            <a href="closed_loan.php" style="cursor: pointer"><div class="stat-box colorsix">
                                <i class="downloads">&nbsp;</i>
                                   <?php
                                //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";
                                $select_close_loan= mysql_query("select count(*) as closed_loan from tbl_borrower_request where status='closed'");
                                $get_close_loan = mysql_fetch_array($select_close_loan);
                                ?>
                                <h4>Close Loan</h4>
                                <h1><?php echo ($get_close_loan['closed_loan'] == null)? '0' : $get_close_loan['closed_loan'];?></h1>
                            </div></a>
                        </div>
                        
                       					  				
                        <div class="col-xs-2">    
                            <a href="all_demo.php"><div class="stat-box colortwo">
                                    <i class="chart">&nbsp;</i>    
                             <?php                             
                             //echo "select count(*) as total_count from tbl_users where status='y' and user_type != 'admin'";	
     	 																																																																																																																																																																																																																																																																																																																																																																																																																				
                               $demo_request = mysql_query("SELECT * FROM tbl_demo ORDER BY id ASC");
                               $allRequests = mysql_num_rows($demo_request);
                                      //echo $allRequests;
  															                                
                              ?>                               
                                    <h4>Demo Requests</h4> 
                                    <h1><?php  echo $allRequests; ?></h1>
                                </div></a>  
                        </div>
                        
                      
                    </div>
                     <!--Row End--> 
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
