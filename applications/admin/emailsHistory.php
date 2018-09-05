<?php include_once 'header.php'; ?>
<div class="wrapper">
    <div class="structure-row">
        <?php include_once 'side_bar.php'; ?>
        <div class="right-sec">
            <?php include_once 'top_right.php'; ?>
            <style>
                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                    padding: 6px 0 15px 23px;
                    vertical-align: top;
                }
            </style>
            <?php
            $select_lender = mysqli_query($mysql_connect,"SELECT tbl_emails.*, concat((tbl_users.fname), (' '), (tbl_users.lname)) as name FROM `tbl_emails` inner join tbl_users on tbl_users.id = tbl_emails.to");
            $count = mysqli_num_rows($select_lender);
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
                            <h4 class="modal-title user_popup_heading" id="myModalLabel">Sent Email History</h4>
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
                                    <h2 class="heading">Sent Email History</h2>
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
                                                        <th>To</th>
                                                        <th>Subject</th>
                                                        <th>Message </th>
                                                        <th>Sent At </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($rows = mysqli_fetch_assoc($select_lender)) {
//                                                echo '<pre>';
//                                                print_r($rows);
//                                                echo '</pre>';
                                                        $user_id = $rows['id'];
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td><?php echo $rows['name']; ?></td>
                                                            <td><?php echo $rows['subject']; ?></td>
                                                            <td><?php echo $rows['message']; ?></td>
                                                            <td><?php echo date('d/m/Y H:ia', strtotime($rows['sent_at'])); ?></td>
                                                           
                                                        </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                </tbody>
                                            </table>
    <?php
} else {
    echo "<i style=color:red>History Not Found</i>";
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
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
