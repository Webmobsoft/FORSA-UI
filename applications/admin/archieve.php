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
           
            <?php 
            
               $update_query = mysql_query("UPDATE tbl_market_request SET status = withdraw WHERE status=open");
            
            
             