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
            $delete_password_emails = mysqli_query($mysql_connect,"SELECT tbl_password_email.*, tbl_customers.first_name, tbl_customers.Surname  FROM `tbl_password_email` inner join tbl_customers on tbl_customers.id = tbl_password_email.to where tbl_password_email.status = 'N' ");
            while ($rows = mysqli_fetch_assoc($delete_password_emails)){
                $deletedEmails['id']= $rows['id'];
                $deletedEmails['firstname']= $rows['first_name'];
                $deletedEmails['lastname'] = $rows['Surname'];
                $deletedEmails['subject'] = $rows['subject'];
                $deletedEmails['message'] = $rows['message'];
                $deletedEmails['sent_at']= $rows['sent_at'];
                $deletedEmails['by']= "P";
                $DeletedMails[] = $deletedEmails;
            }
            $delete_onboard_emails = mysqli_query($mysql_connect,"SELECT tbl_onboard_emails.*, tbl_users.fname, tbl_users.lname  FROM `tbl_onboard_emails` inner join tbl_users on tbl_users.id = tbl_onboard_emails.to where tbl_onboard_emails.status = 'N'");
            while ($rows = mysqli_fetch_assoc($delete_onboard_emails)){
                $deletedEmails['id']= $rows['id'];
                $deletedEmails['firstname']= $rows['fname'];
                $deletedEmails['lastname'] = $rows['lname'];
                $deletedEmails['sent_at']= $rows['sent_at'];
                $deletedEmails['subject'] = $rows['subject'];
                $deletedEmails['message'] = $rows['message'];
                $deletedEmails['by']= "O";
                $DeletedMails[] = $deletedEmails;
            }
            $deleted_confirmation = mysqli_query($mysql_connect,"SELECT tbl_confirmation_email.*, tbl_users.fname, tbl_users.lname  FROM `tbl_confirmation_email` inner join tbl_users on tbl_users.id = tbl_confirmation_email.to where tbl_confirmation_email.status = 'N'");
            while ($rows = mysqli_fetch_assoc($deleted_confirmation)){
                $deletedEmails['id']= $rows['id'];
                $deletedEmails['firstname']= $rows['fname'];
                $deletedEmails['lastname'] = $rows['lname'];
                $deletedEmails['sent_at']= $rows['sent_at'];
                $deletedEmails['subject'] = $rows['subject'];
                $deletedEmails['message'] = $rows['message'];
                $deletedEmails['by']= "C";
                $DeletedMails[] = $deletedEmails;
            }
            $deleted_kontake_email = mysqli_query($mysql_connect,"SELECT tbl_emails.*, tbl_customers.first_name, tbl_customers.Surname  FROM `tbl_emails` inner join tbl_customers on tbl_customers.id = tbl_emails.to where tbl_emails.status = 'N'");
            while ($rows = mysqli_fetch_assoc($deleted_kontake_email)){
                $deletedEmails['id']= $rows['id'];
                $deletedEmails['firstname']= $rows['first_name'];
                $deletedEmails['lastname'] = $rows['Surname'];
                $deletedEmails['sent_at']= $rows['sent_at'];
                $deletedEmails['subject'] = $rows['subject'];
                $deletedEmails['message'] = $rows['message'];
                $deletedEmails['by']= "K";
                $DeletedMails[] = $deletedEmails;
            }
            $count = count($DeletedMails);
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
                                    <h2 class="heading">DELETED EMAILS</h2>
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
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($DeletedMails as $rows1){
                                                       
                                                        $user_id = $rows1['id'];
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td><?php echo $rows1['firstname']; ?></td>
                                                            <td><?php echo $rows1['lastname']; ?></td>
                                                            <!-- <td><?php //echo $rows['subject']; ?></td> -->
                                                          <td><a href="deleted_emails_details.php?id=<?php echo $rows1['id'];?>&by=<?php echo $rows1['by'];?>"><?php echo $rows1['subject']." - ".$small = substr($rows1['message'], 0, 35)."....";  ?></a></td>
                                                            <td><?php echo date('d/m/Y H:i:s A', strtotime($rows1['sent_at'])); ?></td>
                                                           
                                                 
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

