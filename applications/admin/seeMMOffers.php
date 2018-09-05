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
           
		     if(isset( $_GET['id']))
		    {
			   $select_closed_loan = mysql_query("select tbl_market_offer.*, tbl_users.fname, tbl_users.lname ,tbl_users.company_name from tbl_market_offer inner join tbl_users on tbl_users.id = tbl_market_offer.lender_id where tbl_market_offer.status='open' AND on_date >= CURDATE() AND tbl_market_offer.id ='".$_GET['id']."'");
                   }
		    else
		   {
                          $select_closed_loan = mysql_query("select tbl_market_offer.*, tbl_users.fname, tbl_users.lname ,tbl_users.company_name from tbl_market_offer inner join tbl_users on tbl_users.id = tbl_market_offer.lender_id where tbl_market_offer.status='open' AND on_date >= CURDATE() AND tbl_users.is_archieve = 'n'" );            }

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
                                <header style="height:70px;">
                                    <h2 class="heading" style="float:left">Offers</h2>                                        									<a href="mmOpen_loan.php"><input placeholder="" name="goToOffers" value="SEE BIDS" class="btn btn-primary style2" type="submit" style="float:right;margin-right:10%;"></a>										
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
							<?php
							if ($count > 0) 
							{
								?>
                                            <table class="display table" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>Company Name </th>
                                                       
                                                        <th>Term </th>
                                                        <th>Amount </th>
                                                        <th>Offer Rate </th>
                                                        <th>Currency </th>
                                                        <th>Value Date </th>
                                                        <th>Maturity Date</th>
                                                      <?php if(!isset( $_GET['id'])){ ?>  <th></th> <?php } ?>
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
                                                            <td class=" " onclick="get_full_detail(<?php echo $user_id; ?>)" style="cursor: pointer"><?php echo $user_name; ?> (<?php if($rows['company_name'] != ""){echo $rows['company_name'] ;}else {echo "N/A" ;}  ?>)</td>
                                                           
                                                            <td class=" "><?php echo $rows['term']; ?></td>
                                                            <!--<td class=" "><?php //echo $rows['company_name'];?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $rows['amount']; ?> </td>                                                </td>
                                                            <td class=" "><?php echo $rows['offer_rate']; ?>%</td>
                                                             <td class=" "><?php echo $rows['currency']; ?></td>
                                                            <td class="a-right a-right "><?php echo $rows['value_date']; ?></td>
                                                            <td class="a-right a-right "><?php echo $rows['maturity_date'] ?></td>
                                                            
                                                           <?php if(!isset( $_GET['id'])){ ?>   <td class=" "><a href="seeMMOffers.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-eye fa-2x" title="See Full Details"></i></a></td><?php } ?>
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
    echo "<i style=color:red>Open offer list empty</i>";
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