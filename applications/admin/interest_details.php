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
            $select_lender = mysql_query("SELECT * from tbl_interest");
            $count = mysql_num_rows($select_lender);
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
							<span>	
							<?php if( $_SESSION['privilege'] != "1"  ){ ?><button style=" background: #284b84 none repeat scroll 0 0; border: medium none;border-radius: 5px;color: #fff;left: 850px;padding: 4px 22px;position: relative;top: 85px;" onclick="location.href='edit_all_interest.php';">Edit</button>
                               
								 <a href="add_interest.php" class="glyphicon glyphicon-plus" title="Create new Interest" style=" right: 40px !important;
								 top: 90px !important;"></a>	<?php } ?>
								</span>				
								</span>
                                

                                <header>
                                    <h2 class="heading">Interest Details</h2><span class="add_btn">
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                        <div class="col-xs-12">
                                            
                                        </div>
                                        <?php
                                        if ($count > 0) {
                                            ?>
                                            <table class="display table" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>Mid </th>
                                                        <th>Swap </th>
                                                        <th>Kurve </th>
                                                     <?php if( $_SESSION['privilege'] != "1"  ){ ?>   <th>option </th> <?php } ?>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($rows = mysql_fetch_array($select_lender)) {
                                                        $user_id = $rows['id'];
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td class=" " onclick="" style="cursor: pointer"><?php echo $rows['mid']; ?></td>
                                                            <td class=" "><?php echo $rows['swap']; ?></td>
                                                            <!--<td class=" "><?php //echo $rows['company_name']; ?> <i class="success fa fa-long-arrow-up"></i>-->
                                                            <td class=" "><?php echo $rows['kurve']; ?> 
                                                            </td>

                                                            <?php
															if( $_SESSION['privilege'] != "1"  )
															{
                                                                    if ($rows['status'] == 'y') {
                                                                        echo "<td ><span id='status_bulb_" . $user_id . "'><img src='assets/images/bulb_on.png' onclick='make_it_off(" . $user_id . ")'></span>"
                                                                        . "<a href='edit_interest.php?id=" . $user_id . "'>Edit</a></td>";
                                                                    } else {
                                                                        echo "<td><span id='status_bulb_" . $user_id . "'><img src='assets/images/bulb_off.png' onclick='make_it_on(" . $user_id . ")'></span>"
                                                                        . "<a href='edit_interest.php?id=" . $user_id . "'>Edit</a></td>";
                                                                    }
															}
                                                                    ?>
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
                                            $(document).ready(function() {
                                                var oTable = $('#example').dataTable({
                                                    "oLanguage": {
                                                        "sSearch": "Search all columns:"
                                                    }
                                                });

                                                $("tfoot input").keyup(function() {
                                                    /* Filter on the column (the index) of this element */
                                                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                                                });



                                                /*
                                                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
                                                 * the footer
                                                 */
                                                $("tfoot input").each(function(i) {
                                                    asInitVals[i] = this.value;
                                                });

                                                $("tfoot input").focus(function() {
                                                    if (this.className == "search_init")
                                                    {
                                                        this.className = "";
                                                        this.value = "";
                                                    }
                                                });

                                                $("tfoot input").blur(function(i) {
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

    function make_it_off(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_off_interest';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function(htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on(" + id + ")'>");
            }
        });
    }
    function make_it_on(id)
    {
        //alert(id);
        var data_to_send = 'id=' + id + '&function=make_it_on_interest';
        $.ajax({
            url: "ajax_function.php",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function(htnlstr)
            {
                $("#status_bulb_" + id).html("<img src='assets/images/bulb_on.png' onclick='make_it_off(" + id + ")'>");
            }
        });
    }
</script>
</body>
</html>
