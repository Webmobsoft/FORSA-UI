<?php
include_once 'config.php';
        $base_url = $base_url."applications/admin/";
 session_start();
 unset($_SESSION["userID"]);
 unset($_SESSION["username"]);
 unset($_SESSION["adminName"]);
 unset($_SESSION["userType"]);
 session_destroy();
 echo "<script>window.location.href='".$base_url."login.php'</script>";
?>