<?php error_reporting(0);
?>

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
                        <a href="user_detail.php"><div class="col-xs-2">
                            <div class="stat-box colorone">
                                <i class="author">&nbsp;</i>
                                <?php
$select_user = mysqli_query($mysql_connect, "select count(*) as total_count from tbl_users where user_type != 'admin' AND status = 'y'");
$get_users = mysqli_fetch_array($select_user);
?>
                                <h4>Users</h4>
                                <h1><?php echo ($get_users['total_count'] == null) ? '0' : $get_users['total_count']; ?></h1>
                            </div>
                            </div>
                            </a>

                            <a href="only_view_users.php"><div class="col-xs-2">
                            <div class="stat-box colortwo">
                                <i class="author">&nbsp;</i>
                                    <?php
$select_user = mysqli_query($mysql_connect, "select count(*) as total_count from only_view_users where only_view_user = 'Y' AND status = 'Y'");
$get_users = mysqli_fetch_array($select_user);
?>
                                <h4>VIEW ONLY USERS</h4>
                                <h1><?php echo ($get_users['total_count'] == null) ? '0' : $get_users['total_count']; ?></h1>
                            </div>
                            </div>
                            </a>
                            <a href="customers.php"><div class="col-xs-2">
                            <div class="stat-box colorthree">
                                <i class="author">&nbsp;</i>
                                <?php
$select_user = mysqli_query($mysql_connect, "select count(*) as total_count from tbl_customers where processed = 'N' AND id_i != 'ID' AND id_i !=''");
$get_users = mysqli_fetch_array($select_user);
?>
                                <h4>KONTAKTE</h4>
                                <h1><?php echo ($get_users['total_count'] == null) ? '0' : $get_users['total_count']; ?></h1>
                            </div>
                            </div>
                            </a>
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
