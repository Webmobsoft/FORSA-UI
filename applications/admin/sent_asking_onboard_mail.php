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
            // echo "SELECT tbl_onboard_emails.*, tbl_users.first_name, tbl_users.Surname  FROM `tbl_onboard_emails` inner join tbl_users on tbl_users.id = tbl_onboard_emails.to";
            // exit();
            // echo "SELECT tbl_emails.*, concat((tbl_customers.first_name), (' '), (tbl_customers.Surname)) as name FROM `tbl_emails` inner join tbl_customers on tbl_customers.id = tbl_emails.to";
            // exit();
            $select_lender = mysqli_query($mysql_connect,"SELECT tbl_onboard_emails.*, tbl_users.fname, tbl_users.lname  FROM `tbl_onboard_emails` inner join tbl_users on tbl_users.id = tbl_onboard_emails.to where tbl_onboard_emails.status = 'Y'");
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
                                    <h2 class="heading">EXTERNAL ONBOARDING MAILS</h2>
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
                                                        <th>Vorname</th>
                                                        <th>Nachname</th>
                                                        <!-- <th>Subject</th> -->
                                                        <th>Message </th>
                                                        <th>Sent </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($rows = mysqli_fetch_assoc($select_lender)) {
                                                        $user_id = $rows['id'];
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td><?php echo $rows['fname']; ?></td>
                                                            <td><?php echo $rows['lname']; ?></td>
                                                            <!-- <td><?php //echo $rows['subject']; ?></td> -->
                                                          <td><a href="onboarding_email_details.php?id=<?php echo $rows['id'];?>"><?php echo $rows['subject']." - ".$small = substr($rows['message'], 0, 30)."....";  ?></a></td>
                                                            <td><?php echo date('d/m/Y H:i:s A', strtotime($rows['sent_at'])); ?></td>
                                                            <td><a class="deleteonboardeEmail" data-id=<?php echo $user_id;?> href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a></td>
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
                                                        "sSearch": "Search all columns:",
                                                        "pageLength": 50
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
<script>

 $('.deleteonboardeEmail').click(function(){
 
 var id = $(this).data('id');
 var obj = $(this);
 var check = confirm('Do you really want to delete this email.');
 if(check == true) {
   var data_to_send = 'id=' + id +'&table=tbl_onboard_emails&function=deleteEmails';
   $.ajax({
     url:"ajax_function.php",
     method:"post",
     data: data_to_send,
     cache:false,
     success:function(result) {
        //  alert(result);
        //  return false;
       obj.parent().parent().remove();
       $("#alertArea").text('Successfully Deleted').show().delay(3000).fadeOut('slow');
     }
   });
 }
});

</script>