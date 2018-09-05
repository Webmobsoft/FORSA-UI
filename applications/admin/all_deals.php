<?php include_once 'header.php';?>
<style>
/*    .table > thead > tr > th, table td {
        font-size: 12px;
        padding: 6px !important;
    }*/
</style>
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
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 0 15px 23px;
    vertical-align: top;
}
            </style>
            <?php
$complete_deal = mysqli_query($mysql_connect,"select * from tbl_lenders_request where accept = 'Y' or admin_client_deal_accepted = 'Y' or admin_accept_response = 'Y'");
$count = mysqli_num_rows($complete_deal);
?>
            <button type="button" class="btn btn-primary btn-lg" id="popup" data-toggle="modal" data-target="#myModal" style="display: none">
  Launch demo modal
</button>
            <!-- Modal -->
<div id="alertArea" class="alert alert-success" style="display: none;"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title user_popup_heading" id="myModalLabel">Completed Deals</h4>
      </div>
      <div class="modal-body">
        
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Completed Deals</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
                                    <div class="table-box">
                                    	
                                          <?php
                                        if($count > 0)
                                        {
                                        ?>
                                        <table class="display table" id="example">
                                            <thead>
                                            <tr>
                                                        <th>Ticket Number</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Name Unternehmen Borrower</th>
                                                        <th>Ort</th>
                                                        <th>Vorname</th>
                                                        <th>Nachname</th>
                                                        <th>Name Unternehmen Lender</th>
                                                        <th>Ort</th>
                                                        <th>Vorname</th>
                                                        <th>Nachname</th>
                                                        <th>Amount</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Interest Rate</th>
                                                        <th>Payments</th>
                                                        <th>Interest Convention</th>
                                                    
                                                        <!-- <th>Dealer Name of Borrower</th>

                                                        <th>Dealer Name of Lender</th>

                                                        <th>Amount </th>

                                                        <th>Start Date</th>

                                                        <th>End Date</th>

                                                        <th>Interest Rate</th>

                                                        <th>Payments</th> -->

                                                        <!-- <th></th> -->

                                                        <!--<th>option </th>-->

                                                    </tr>
                                            </thead>
                                            <tbody>

    <?php
    while ($rows = mysqli_fetch_array($complete_deal)) {
        $borrowerName_query = mysqli_query($mysql_connect,"select company_name,city,fname,lname from tbl_users where id = ".$rows['borrowerId']."");
        $borrowerDetails = mysqli_fetch_array($borrowerName_query);
        $lenderName_query = mysqli_query($mysql_connect,"select company_name,city,fname,lname from tbl_users where id = ".$rows['lenderId']."");
        $lenderDetails = mysqli_fetch_array($lenderName_query);?>
        <tr class="gradeX">
        <td class=" "><?php echo $rows['ticket_number'];?></td>
        <td class=" "><?php echo $rows['complete_deal_date'];?></td>
        <td class=" "><?php echo $rows['complete_deal_time'];?></td>
        <td class=" "><?php echo $borrowerDetails['company_name'];?></td>
        <td class=" "><?php echo $borrowerDetails['city'];?></td>
        <td class=" "><?php echo $borrowerDetails['fname'];?></td>
        <td class=" "><?php echo $borrowerDetails['lname'];?></td>
        <td class=" "><?php echo $lenderDetails['company_name']; ?></td>
        <td class=" "><?php echo $lenderDetails['city'];?></td>
        <td class=" "><?php echo $lenderDetails['fname'];?></td>
        <td class=" "><?php echo $lenderDetails['lname'];?></td>
        <td class=" "><?php echo $rows['amount']; ?> </td>      
        <td class=" "><?php echo $rows['start_date']; ?></td>
        <td class=" "><?php echo $rows['end_date']; ?></td>
        <td class=" "><?php echo $rows['interest_rate']; ?></td>
        <td class=" "><?php echo $rows['payments']; ?></td>
        <td class=" "><?php echo $rows['interest']; ?></td>

        </tr>
        <?php } ?>



                                                </tbody>
                                            <tfoot>
                                               
                                            </tfoot>
                                        </table>
                                         <?php
                                        }
                                        else
                                        {
                                            echo "<i style=color:red>User list empty</i>";
                                        }
                                        ?>
                                       
                                        
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

<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script>
    $('#example').DataTable();
</script>
