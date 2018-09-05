<?php session_start();?>
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

	$category = mysqli_query($mysql_connect,"SELECT * FROM `only_view_users` WHERE only_view_user = 'Y' AND status = 'Y'");
	$count = mysqli_num_rows($category);
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
        <h4 class="modal-title user_popup_heading" id="myModalLabel">View only Users</h4>
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


                            <div class="sec-box" >
                            	<!-- <form class="search-form" name="searching" method="post">
                            	<input type="text" class=" input-sec-box" name="search">
								<input type="submit" class="btn btn-primary style2 input-sec" name="searchsubmit" value="Send Email">
                        		
                        		
                        	</form> -->

                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">View only Users</h2>
                                </header>

                                <div class="contents">
                                  <?php
if ($msg != '' || isset($_GET['msg']) ) {
     $msg = $_GET['msg'];
    echo "<div class='alert alert-success'>" . $msg . "</div>";
}
?>
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
                                                <th>Name Unternehmen</th>
                                                <th>Strasse</th>
                                                <th>Client Sub group</th>
                                                <th>Client group</th>
                                                <th>Vorname</th>
                                                <th>Nachname</th>
                                                 <th>email</th>
                                                 <th>How often</th>
                                                 <th>login</th>
                                                 <th>options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysqli_fetch_array($category))
                                            {

                                                $customer_id = $rows['id'];
                                                ?>
                                                <tr class="gradeX">
                                                <td class=" "><?php echo $rows['Name_company'];?></td>
                                                <td class=" "><?php echo $rows['address'];?></td>
                                                <td class=" "><?php echo $rows['client_sub_group'];?></td>
                                                <td class=" "><?php echo $rows['client_group'];?></td>
                                                <td class=" "><?php echo $rows['first_name'];?>  </td>
                                                <td class="cust"><?php echo $rows['Surname'];?></td>
                                                <td class=" "><?php echo $rows['email'];?>  </td>
                                                <td class="cust"><?php echo $rows['how_often_login'];?></td>
                                                <td class=" "><?php echo $rows['when_login'];?>  </td>
                                                 <td>
                                                   <a class="deleteviewuserById" data-id="<?php echo "".base64_encode($customer_id).""; ?>" href="javascript:void(0);"><i class="fa fa-times fa-2x red"></i></a>
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
                                        }
                                        else
                                        {
                                            echo "<i style=color:red>customers list empty</i>";
                                        }
                                        ?>
                                       
                                        <script>
											

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
  /*$(document).ready(function() {
    $('#example1').DataTable( {
        "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
        "iDisplayLength": 100
    } );
} );*/
$(document).ready(function() {
  var oTable = $('#example').dataTable();

  $('.dataTables_filter input').unbind().on('blur',function() {
    var value = $(this).val();
    /*if (value.length>0) {*/
    /*$("#button").click(function(){*/
      oTable.fnFilter(value);
      var data = oTable._('.cust', {"filter": "applied"});
      //console.log( data +" rows matched the filter" );
      var len = data.length
      //console.log( data +" rows matched the filter" );
      $("#button").click(function(){
          var data_to_send = 'Emails=' + data +'&function=sendEmailInGroup';
          $.ajax({
          url:"ajax_function.php",
          method:"post",
          data: data_to_send,
          cache:false,
          success:function(result){
            if(result == 'true'){
              window.location.href = "http://instimatch.com/forsa/applications/admin/customers.php?msg=email sent Successfully"; 

            }else{
              alert("Please select Customer first");
               
            }
            
            //alert(result);
          //obj.parent().parent().remove();
          //$("#alertArea").text('Successfully Deleted').show().delay(3000).fadeOut('slow');
          }
          });
        //alert(data);
        oTable.fnFilter('');
        
      });
      return false;
    
   /* });*/
      //alert(value)
        //oTable.search(value).draw();
  
});
 }); 


	
	/*$('#example1').DataTable( {
	"order": [[ 0, "desc" ]]
  "lengthMenu": [[50, -1], [50, "All"]]
	} );*/

  function make_it_sendmail(id) {

    var data_to_send = 'id=' + id +'&function=make_it_sendemail_customer';
    $.ajax({
       url:"ajax_function.php",
       method:"post",
       data:data_to_send,
       cache:false,
       success:function(htnlstr) {
           $("#status_bulb_"+id).html("<img src='assets/images/bulb_on.png'  title='Disable'>");
           location.reload(true);
       }
    });
}
											
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
    var data_to_send = 'id=' + id +'&function=make_it_off_category';
    alert(data_to_send);
    $.ajax({
        url:"ajax_function.php",
        method:"post",
        data:data_to_send,
        cache:false,
        success:function(htnlstr) {
          alert(data_to_send);
            $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png'  title='Enable' onclick='make_it_on("+id+")'>");
        }
    });
}

$('.deleteviewuserById').click(function(){
	var id = $(this).data('id');
	var obj = $(this);
	var check = confirm('Do you really want to delete this customer.');
	if(check == true) {
		var data_to_send = 'id=' + id +'&function=deleteviewuserById';
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
</script>
</body>
</html>
