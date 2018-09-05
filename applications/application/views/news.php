<head>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
<!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- <script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script> -->

</head>
<?php  if($_SESSION['user_type'] == "borrower" || $_SESSION['user_type'] == "both"){ 
            include 'borrower.php';
   } else if($_SESSION['user_type'] == "lender"){
            include 'lender.php';
   } ?>







