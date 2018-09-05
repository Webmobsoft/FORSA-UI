<?php
session_start();
session_destroy();
header('Location: dashboard.php');
die;
?>
<?php include_once 'header.php';
 //echo "hello";
         //echo $_SESSION['user_name'];
//die;?>
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
<!--            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="stat-box colorone">
                                <i class="author">&nbsp;</i>
                                <h4>Users</h4>
                                <h1>56</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colortwo">
                                <i class="chart">&nbsp;</i>
                                <h4>Visits</h4>
                                <h1>1288</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorthree">
                                <i class="pages">&nbsp;</i>
                                <h4>Pages</h4>
                                <h1>125</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorfour">
                                <i class="users">&nbsp;</i>
                                <h4>New Users</h4>
                                <h1>23</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorfive">
                                <i class="downloads">&nbsp;</i>
                                <h4>Downloads</h4>
                                <h1>4005</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorsix">
                                <i class="comments">&nbsp;</i>
                                <h4>Comments</h4>
                                <h1>56</h1>
                            </div>
                        </div>
                       
                        
                      
                    </div>
                     Row End 
                </div>
            </div>-->
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<!-- Wrapper End -->
</body>
</html>
