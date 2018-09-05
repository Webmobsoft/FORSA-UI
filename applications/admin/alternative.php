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
                $user_id = $_GET['id'];
                $select_closed_loan = mysql_query("select tbl_borrower_request.*,tbl_users.fname,tbl_users.lname from tbl_borrower_request inner join tbl_users on tbl_users.id = tbl_borrower_request.borrower_id where tbl_borrower_request.status='alternative' and tbl_borrower_request.borrower_id='$user_id'");
            } else {
                $select_closed_loan = mysql_query("select tbl_borrower_request.*,tbl_users.fname,tbl_users.lname from tbl_borrower_request inner join tbl_users on tbl_users.id = tbl_borrower_request.borrower_id where tbl_borrower_request.status='alternative'");
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
                                    <h2 class="heading">Alternative Investment</h2>
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
                                                        <th>User Name </th>
                                                        <th>Request ID</th>
                                                        <th>Approx yield </th>
                                                        <th>Amount </th>
                                                        <th>Type of investment</th>
                                                        <th>Location</th>
                                                        <th>Contact </th>
                                                        <th>Notes </th>
                                                        <th>Teaser PDF</th>
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
                                                            <td class=" "><?php echo $rows['id']; ?></td>
                                                            <td class=" "><?php echo $rows['approx_yield']; ?></td>
                                                            <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $rows['amount_display']; ?> </td>                                                </td>
                                                            <td class=" "><?php echo $rows['type_of_investment']; ?></td>
                                                            
                                                            <td class="a-right a-right "><?php echo $rows['location']; ?></td>
                                                            <td class=" last"><a href="#"><?php echo $rows['contact']; ?></a>
                                                            <td class=" "><?php echo $rows['notes']; ?></td>
                                                            <td class=" ">
                                                                <?php
                                                                if ($rows['teaser_pdf'] !=""){ ?>
                                                                <a target="_blank" href="../assets/img/<?php echo $rows['teaser_pdf']; ?>"><img src="../assets/img/pdf.png"></a>
                                                                <?php } else {
                                                                    echo "N/A";
                                                                }?>
                                                            </td>
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
    echo "<i style=color:red>Open loan list empty</i>";
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