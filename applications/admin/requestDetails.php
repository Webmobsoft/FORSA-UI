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
            <!-- Content Section Start -->
            <?php
            if (isset($_GET['id'])) {
                $requestId = $_GET['id'];
                $select_closed_loan = mysql_query("select tbl_borrower_request.*,tbl_users.fname,tbl_users.lname from tbl_borrower_request inner join tbl_users on tbl_users.id = tbl_borrower_request.borrower_id where tbl_borrower_request.id = '".$requestId."'");
            }
            else {
                die('Direct access not allowed!');
            }
            $count = mysql_num_rows($select_closed_loan);
            ?>
            <button type="button" class="btn btn-primary btn-lg" id="popup" data-toggle="modal" data-target="#myModal" style="display: none">
                Launch demo modal
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title user_popup_heading" id="myModalLabel">User Details</h4>
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
                                    <h2 class="heading">Request Detail</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<?php
if ($count > 0) {
    ?>
                                            <table class="display table" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>Borrower Name </th>
                                                        <th>Request Title </th>
                                                        <th>Amount </th>
                                                         <th>CCY</th>
                                                        <th>Interest scheduled </th>
                                                        <th>Maturity Date</th>
                                                        <th>Close Date </th>
                                                        <th>Status </th>
                                                        <!--<th>option </th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
    <?php
    while ($rows = mysql_fetch_array($select_closed_loan)) {
        $user_id = $rows['borrower_id'];
        $user_fname = $rows['fname'];
        $user_lname = $rows['lname'];
        $user_name = $user_fname . " " . $user_lname;
        ?>
                                                        <tr class="gradeX">
                                                            <td class=" " onclick="get_full_detail(<?php echo $user_id; ?>)" style="cursor: pointer"><?php echo $user_name; ?></td>
                                                            <td class=" "><?php echo $rows['req_name']; ?></td>
                                                            <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $rows['amount_display']; ?> </td> 
                                                            <td><?php echo $rows['currency']; ?></td>
                                                            <td class=" "><?php echo $rows['interest_scheduled']; ?></td>
                                                            <td class="a-right a-right "><?php echo date('d/m/Y', strtotime($rows['maturity'])); ?></td>
                                                            <td class=" last"><a href="#"><?php echo date('d/m/Y h:ia', strtotime($rows['close_date']. " " . $rows['close_time'])) ; ?></a>
                                                            <td class=" "><?php echo ucfirst($rows['status']); ?></td>
                                                        </tr>
        <?php
    }
    ?>

                                                </tbody>
                                            </table>
    <?php
} else {
    echo "<i style=color:red>Open loan list empty</i>";
}
?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!--Next section-->
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Offers List</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
<?php
$allOffers = mysql_query("SELECT tbl_lender_response.*, tbl_users.company_name FROM `tbl_lender_response` INNER JOIN tbl_users ON tbl_users.id = tbl_lender_response.lender_id where tbl_lender_response.request_id = '".$requestId."'");
if (mysql_num_rows($allOffers) > 0) {
    ?>
                                            <table class="display table" id="allOffers">
                                                <thead>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>Offered Amount</th>
                                                        <th>Date offered</th>
                                                        <th>Rate%</th>
                                                        <th>Response</th>
														<th>Timestamp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while ($row = mysql_fetch_array($allOffers)) {
                                                    echo '<tr class="gradeX">';
                                                    echo '<td>'.$row['company_name'].'</td>';
                                                    echo '<td>'.$row['lender_amount_display'].'</td>';
                                                    echo '<td>'.date('d/m/Y', strtotime($row['valid_date'])).'</td>';
                                                    echo '<td>'.$row['offer_rate'].'</td>';
                                                    echo '<td>';
                                                    $offerCheck = mysql_query("SELECT * FROM `tbl_loan_accepted` where request_id = '".$requestId."' and lender_id = '".$row['lender_id']."'");
													
													
													
													
                                                    if (mysql_num_rows($offerCheck) > 0) {
                                                        echo 'Accepted';
                                                    }
                                                    else {
                                                        echo 'Not Accepted';
                                                    }
                                                    echo '</td>';
                                                   
													
													echo '<td>';
													    $acceptedDate=mysql_fetch_array($offerCheck);
													 //print_r($array);
													 echo $acceptedDate['date'];
													echo '</td>';
													 echo '</tr>';
													
													
													
													
                                                }
                                                ?>

                                                </tbody>
                                            </table>
    <?php
} else {
    echo '<div class="col-md-12"><i style="color:red">Offers Not Found</i></div><div class="clearfix"></div><br/>';
}


?>
                                        <script>
                                            var asInitVals = new Array();
                                            $(document).ready(function () {
                                                var oTable = $('#allOffers').dataTable({
                                                    "oLanguage": {
                                                        "sSearch": "Search all columns:"
                                                    }
                                                });

                                                $("tfoot input").keyup(function () {
                                                    /* Filter on the column (the index) of this element */
                                                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                                                });



                                                /*
                                                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
                                                 * the footer
                                                 */
                                                $("tfoot input").each(function (i) {
                                                    asInitVals[i] = this.value;
                                                });

                                                $("tfoot input").focus(function () {
                                                    if (this.className == "search_init")
                                                    {
                                                        this.className = "";
                                                        this.value = "";
                                                    }
                                                });

                                                $("tfoot input").blur(function (i) {
                                                    if (this.value == "")
                                                    {
                                                        this.className = "search_init";
                                                        this.value = asInitVals[$("tfoot input").index(this)];
                                                    }
                                                });
                                            });

                                        </script>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!--Section end-->
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
<script>
    function get_full_detail(id) {
        var data_to_send = 'id=' + id + '&function=get_full_detail';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function (htnlstr) {
                $("#popup").click();
                $(".modal-body").html(htnlstr);
            }
        });
    }
</script>
</body>
</html>