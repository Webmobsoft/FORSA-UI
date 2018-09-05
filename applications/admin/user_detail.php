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
$select_lender = mysqli_query($mysql_connect,"SELECT * FROM `tbl_users` WHERE  tbl_users.is_archieve = 'n' AND id != '1'");
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
                                    <h2 class="heading">User Details</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
                                    <div class="table-box">
                                    	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                          <?php
                                        if($count > 0)
                                        {
                                        ?>
                                        <table class="display table" id="example">
                                            <thead>
                                              <tr>
                                                <th>Username</th>   
                                                <th>Name Unternehmen</th>
                                                <th>Ort</th>
                                                <th>usertype</th> 
                                                <th>Access Given to Clientgroup:</th>
                                                
                                                <th>Vorname</th>
                                                <th>Nachname</th>
                                                <th>Mail-Adresse</th>
                                                <th>Telefon Nr.</th>
                                                <th>Client Sub group</th>
                                                <th>Client group</th>
                                                <th>option</th>  
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysqli_fetch_array($select_lender))
                                            {

                                                $user_id = $rows['id'];
                                                $UName = $rows['uname'];
                                                $access_given_clientgroup = str_replace(' ' , "&nbsp", $rows['access_given_clientgroup']); 
                                                $clientgroup = str_replace(' ' , "&nbsp", $rows['clientgroup']); 

                                                ?>
                                                <tr class="gradeX">

                                                <td class=" "><?php echo $rows['uname'];?></td>
                                                <td class=" "><?php echo $rows['company_name'];?></td>
                                                <td class=" "><?php echo $rows['city'];?></td>
                                                <td class="" ><?php if($rows['bothUserType'] == "y"){ echo "both" ;}else{echo $rows['user_type'] ;}?>
                                                </td> 
                                                <td class=" " style="padding:none;">
                                                  <?php echo str_replace(',' ,"\n", $access_given_clientgroup); ?>
                                               </td>
                                                
                                                <td class=" "><?php echo $rows['fname'];?></td>
                                                <td class=" "><?php echo $rows['lname'];?></td>
                                                <td class=" " style="padding:none;"><?php echo $rows['email'];?></td>
                                                <td class=""><?php echo $rows['contact_number'];?></td>
                                                <td class=" "><?php echo $rows['client_sub_group'];?></td>
                                                <td class=" "><?php echo str_replace(',' ,"\n", $clientgroup); ?></td>
                                                   <?php
                                                   if($rows['status'] == 'y')
                                                   {
                                                      if( $_SESSION['privilege'] != "1"  ){
                                                       echo "<td><span id='status_bulb_".$user_id."'><img src='assets/images/bulb_on.png' title='Disable' onclick='make_it_off(".$user_id.")'></span>"
													  . "<a href='edit_user.php?id=".$user_id."'>Edit</a>"; 
echo '<a class="deleteUserById" data-id="'.base64_encode($user_id).'" href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a></td>'; }
                                                        // echo "<td  class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }
                                                   else
                                                   {
                                                     if( $_SESSION['privilege'] != "1"  ){    echo "<td><span id='status_bulb_".$user_id."'><img src='assets/images/bulb_off.png' title='Enable' onclick='make_it_on(".$user_id.")'></span>"
													 . "<a href='edit_user.php?id=".$user_id."'>Edit</a>"; 
													 echo '<a class="deleteUserById" data-id="'.base64_encode($user_id).'" href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a></td>'; }
                                                        // echo "<td  class='loan_td'><a href='open_loan.php?id=".$user_id."'>Open</a></br><a href='closed_loan.php?id=".$user_id."'>Close</a></td>";
                                                   }
										
                                                       ?>
                                                </tr>
                                                    <?php
                                            }
                                            ?>
                                                
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
<script>
  $('.deleteUserById').click(function(){
 
  var id = $(this).data('id');
  var obj = $(this);
  var check = confirm('Do you really want to delete this user.');
  if(check == true) {
    var data_to_send = 'id=' + id +'&function=deleteUserById';
    $.ajax({
      url:"ajax_function.php",
      method:"post",
      data: data_to_send,
      cache:false,
      success:function(result) {
        obj.parent().parent().remove();
        $("#alertArea").text('Successfully Deleted').show().delay(3000).fadeOut('slow');
      }
    });
  }
});
    $('#example').DataTable( {
    "order": [[ 0, "desc" ]]
    } );
    function get_full_detail(id)
    {
         var data_to_send = 'id=' + id +'&function=get_full_detail';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr)
       {
           $("#popup").click();
           $(".modal-body").html(htnlstr);
           //alert(htnlstr);
           //$("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png' onclick='make_it_on("+id+")'>");
       }
    });
    }
function make_it_off(id) {
    var data_to_send = 'id=' + id +'&function=make_it_off';
    $.ajax({
        url:"ajax_function.php",
        method:"post",
        data:data_to_send,
        cache:false,
        success:function(htnlstr) {
            
            $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png'  title='Enable' onclick='make_it_on("+id+")'>");
        }
    });
}
function make_it_on(id) {
    var data_to_send = 'id=' + id +'&function=make_it_on';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr) {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_on.png'  title='Disable' onclick='make_it_off("+id+")'>");
           location.reload(true);
       }
    });
}

</script>
</body>
</html>
