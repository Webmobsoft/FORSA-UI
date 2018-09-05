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
            $select_closed_loan = mysql_query("SELECT * FROM `tbl_market_lender_response` where request_status='to'");
            $selected_accepted_offers = mysql_query("SELECT `tbl_market_offers_responces`.*,`tbl_users`.`fname` as borowerFname ,`tbl_users`.`lname` as borowerLname, `tbl_users`.`company_name` FROM `tbl_market_offers_responces` INNER JOIN `tbl_users` ON `tbl_users`.`id` = `tbl_market_offers_responces`.`borrower_id` WHERE `tbl_market_offers_responces`.`is_accepted` = 'to' AND tbl_users.is_archieve = 'n' ");
           
            $count_accepted_deals = mysql_num_rows($select_closed_loan);
            $count_accepted_offers = mysql_num_rows($selected_accepted_offers);
           
            
            
            $count = $count_accepted_deals + $count_accepted_offers;
            ?>

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
                                    <h2 class="heading">MM TIMED OUT TRADES</h2>
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
                                                        <th>Borrower Comp. Name/ User</th>
                                                        <th>Lender Comp. Name/ User </th>
                                                        <th>Deal Id </th>
                                                        <th>Term </th>
                                                        <th>CCY </th>
                                                        <th>Amount </th>

                                                        <th>Rate </th>
                                                        <th>Value Date</th>
                                                        <th>Maturity Date</th>
                                                        <th>No. of Days</th>
                                                        <th>Timed Out Time</th>
                                                        <th>Type</th>
  <?php if(isset( $_GET['bidId'])){ ?> <?php } else if($_GET['offerId']){ } else{ ?> <th></th> <?php } ?>   </tr>
                                                </thead>
                                                <tbody>
    <?php
    while ($rows = mysql_fetch_array($select_closed_loan)) {
        //echo "<pre>";
        //print_r($rows);
        $dealIds = $rows['id'];
        $user_id = $rows['lender_id'];


        $dealId = $rows['id'];
        $requestId = $rows['request_id'];

        $sql = mysql_query("SELECT borrower_id,currency,term FROM tbl_market_request WHERE `id` = '" . $requestId . "'");

        $fetch_array = mysql_fetch_array($sql);
        $borrowerId = $fetch_array['borrower_id'];
        $currency = $fetch_array['currency'];
        $term = $fetch_array['term'];
        ?>
                                                        <tr class="gradeX">
                                                            <td  style="cursor: pointer">
                                                        <?php
                                                        $borrower_name = mysql_query("SELECT  `fname`,`lname`,`company_name` FROM tbl_users WHERE `id` = '" . $borrowerId . "'");
                                                        $borrowerFetchArr = mysql_fetch_array($borrower_name);
                                                        echo $borrowerFetchArr['fname'] . " " . $borrowerFetchArr['lname'] . "/ " . $borrowerFetchArr['company_name'] . " ";
                                                        ?>
                                                            </td>
                                                            <td class=" "  style="cursor: pointer">
                                                                <?php
                                                                $borrower_name = mysql_query("SELECT  `fname`,`lname`,`company_name` FROM tbl_users WHERE `id` = '" . $user_id . "'");
                                                                $borrowerFetchArr = mysql_fetch_array($borrower_name);
                                                                echo $borrowerFetchArr['fname'] . " " . $borrowerFetchArr['lname'] . "/ " . $borrowerFetchArr['company_name'] . " ";
                                                                ?>
                                                            </td>
                                                            <td class=" "><?php echo $dealIds; ?> </td>   
                                                            <td class=" "><?php echo $term; ?></td>

                                                            <td class=" "><?php echo $currency; ?></td>
                                                            <td class=" "><?php
                                                                //echo $rows['amount']; 
                                                                echo str_replace("mio", " ", $rows['amount']) . ' mio';
                                                                ?> </td>                                                </td>
                                                            <td class=" "><?php echo $rows['int_rate']; ?></td>
                                                            <td class=" "><?php echo $rows['value_date']; ?> </td>
                                                            <td class="a-right a-right "><?php echo $rows['maturity_date']; ?></td>
                                                            <td class="a-right a-right ">
                                                                <?php
                                                                if ($rows['value_date'] != "" && $rows['maturity_date'] != "") {

                                                                    $val = $rows['value_date'];
                                                                    $val1 = explode(".", $val);
                                                                    $val3 = $val1[2] . "/" . $val1[1] . "/" . $val1[0];
                                                                    $mat = $rows['maturity_date'];

                                                                    $mat1 = explode(".", $mat);
                                                                    $mat3 = $mat1[2] . "/" . $mat1[1] . "/" . $mat1[0];
                                                                    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
                                                                    $numberDays = intval($numberDays);

                                                                    $startTimeStamp = strtotime($val3);
                                                                    $endTimeStamp = strtotime($mat3);

                                                                    $timeDiff = abs($endTimeStamp - $startTimeStamp);

                                                                    $numberDays = $timeDiff / 86400;
                                                                    echo $numberDays = intval($numberDays);
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <?php echo date("d.m.Y H:i:s", strtotime($rows['deniedDate'])); ?>
                                                            </td>
                                                            <td class=" ">Bid</td>
                                                                <?php if (!isset($_GET['bidId'])) { ?>   <td class=" " style="display: none;"><a href="mmClose_loan.php?bidId=<?php echo $dealIds; ?>"><i class="fa fa-eye fa-2x"></i></a></td><?php } ?>
                                                        </tr>
                                                                <?php
                                                            }


                                                            while ($rowS = mysql_fetch_array($selected_accepted_offers)) {
                                                                $borrowerId = $rowS['borrower_id'];
                                                                $lender_id = $rowS['lender_id'];
                                                                $offerId = $rowS['offer_id'];
                                                                $offerTerm_array = mysql_query("SELECT `currency_type`,`term`,`offer_rate`,`maturity_date`,`value_date`  from `tbl_market_offer` WHERE `id` = '" . $offerId . "'");
                                                                $fetchTerm = mysql_fetch_array($offerTerm_array);
                                                                $term_name = $fetchTerm['term'];
                                                                $offerRate = $fetchTerm['offer_rate'];
                                                                $mat_date = $fetchTerm['maturity_date'];
                                                                $dealId = $rowS['id'];
                                                                $currency = $fetchTerm['currency_type'];
                                                                $val_date = $fetchTerm['value_date'];
                                                                ?>

                                                        <tr class="gradeX">
                                                            <td  style="cursor: pointer">

                                                        <?php
                                                        $borrower_name = mysql_query("SELECT  `fname`,`lname`,`company_name` FROM tbl_users WHERE `id` = '" . $borrowerId . "'");
                                                        $borrowerFetchArr = mysql_fetch_array($borrower_name);
                                                        echo $borrowerFetchArr['fname'] . " " . $borrowerFetchArr['lname'] . "/ " . $borrowerFetchArr['company_name'] . " ";
                                                        ?>
                                                            </td>
                                                            <td class=" ">

        <?php
        $borrower_name = mysql_query("SELECT  `fname`,`lname`,`company_name` FROM tbl_users WHERE `id` = '" . $lender_id . "'");
        $borrowerFetchArr = mysql_fetch_array($borrower_name);
        echo $borrowerFetchArr['fname'] . " " . $borrowerFetchArr['lname'] . "/ " . $borrowerFetchArr['company_name'] . " ";
        ?></td>


                                                            <td class=" "><?php echo $dealId; ?></td>
                                                            <td class=" "><?php echo $term_name; ?></td>

                                                                    <!--<td class=" "><?php //echo $rows['company_name']; ?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $currency; ?></td>
                                                            <td class=" "><?php echo $rowS['amount_demand']; ?> </td>                                                </td>

                                                            <td class=" "><?php echo $offerRate; ?>%</td>
                                                            <td class=" "><?php echo $val_date; ?> </td> 
                                                            <td class="a-right a-right "><?php echo $mat_date; ?></td>
                                                            <td class="a-right a-right ">
        <?php
        if ($val_date != "" && $mat_date != "") {
            $val = $val_date;
            $val1 = explode(".", $val);
            $val3 = $val1[2] . "/" . $val1[1] . "/" . $val1[0];
            $mat = $mat_date;

            $mat1 = explode(".", $mat);
            $mat3 = $mat1[2] . "/" . $mat1[1] . "/" . $mat1[0];
            $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
            $numberDays = intval($numberDays);

            $startTimeStamp = strtotime($val3);
            $endTimeStamp = strtotime($mat3);

            $timeDiff = abs($endTimeStamp - $startTimeStamp);

            $numberDays = $timeDiff / 86400;
            echo $numberDays = intval($numberDays);
        }
        ?></td>
                                                            <td>
                                                                <?php echo date("d.m.Y H:i:s", strtotime($rowS['deniedDate'])); ?></td>
                                                            <td class=" ">Offer</td>
     <?php if(!isset( $_GET['offerId'])){ ?>   <td class=" " style="display: none;"><a href="mmClose_loan.php?offerId=<?php echo $dealId ; ?>"><i class="fa fa-eye fa-2x"></i></a></td><?php } ?>

                                                       
                                                        </tr>


                                                                <?php
                                                            }
                                                            ?>

                                                </tbody>
 <tfoot>
                                                    <!--<tr>
                                                        <th><input type="text" name="search_engine" value="Search engines" class="search_init" /></th>
                                                        <th><input type="text" name="search_browser" value="Search browsers" class="search_init" /></th>
                                                        <th><input type="text" name="search_platform" value="Search platforms" class="search_init" /></th>
                                                        <th><input type="text" name="search_version" value="Search versions" class="search_init" /></th>
                                                        <th><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
                                                    </tr>-->
                                                </tfoot>
                                            </table>
                                                            <?php
                                                        } else {
                                                            echo "<i style=color:red>MM TIMED OUT TRADES LIST EMPTY</i>";
                                                        }
                                                        ?>
                                        <script>
                                            var asInitVals = new Array();
                                            $(document).ready(function () {
                                                var oTable = $('#example').dataTable({
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
    function get_full_detail(id)
    {
        var data_to_send = 'id=' + id + '&function=get_full_detail';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function (htnlstr)
            {
                $("#popup").click();
                $(".modal-body").html(htnlstr);
                //alert(htnlstr);
                //$("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on("+id+")'>");
            }
        });
    }
    function make_it_off(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_off';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function (htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on(" + id + ")'>");
            }
        });
    }
    function make_it_on(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_on';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function (htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_on.png' onclick='make_it_off(" + id + ")'>");
            }
        });
    }
</script>
</body>
</html>