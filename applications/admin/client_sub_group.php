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
 if(isset($_POST['all_deactive_users'])){
  $select_user = mysql_query("SELECT * FROM `tbl_category` WHERE active = 'N'");
  $count = mysql_num_rows($select_user);

   }else if(isset($_POST['all_active_users'])){
    $select_user = mysql_query("SELECT * FROM `tbl_category` WHERE active = 'Y'");
    $count = mysql_num_rows($select_user);

   }

$category = mysqli_query($mysql_connect,"SELECT id,category FROM `tbl_category`");
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
        <h4 class="modal-title user_popup_heading" id="myModalLabel">Category Details</h4>
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
                        <a href="import_client_sub_groups.php" class="btn btn-primary style2 pull-right">IMPORT CLIENT SUB GROUPS</a>
                        <div class="col-xs-12">

                            <div class="sec-box">

                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Client Sub Groups</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                    	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                          <?php
                                        if($count > 0)
                                        {
                                        ?>
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                   
                                                <th>Category</th>
                                                <th>option </th>
                                               <!--   <th>Enable/disable</th>
                                                 -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            while($rows = mysqli_fetch_array($category))
                                            {

                                                $category_id = $rows['id'];
												//echo $category_id;
                                                ?>
                                                <tr class="gradeX">
                                                     
                                                <td class=" "><?php echo $rows['category'];?> 
                                                </td>
                                                <td class="">
                                          <?php echo  '<a  href="edit_category.php?id='.$category_id.'">Edit</a>'; ?>
                                                 <!--  <a href="edit_category.php?id='.$user_id.'">Edit</a> --></td>
                                        <!-- <td id="status_bulb_<?php echo $category_id;?>" class=" ">
                        <?php  
                        if($rows['active'] == 'N'){ ?> <a href="">
                        <img title="inactive" onclick="make_it_on(<?php echo $category_id;?>)" src="assets/images/bulb_off.png">  
                         <?php  }else{ ?>
                       <a href="">    <img title="active" onclick="make_it_off(<?php echo $category_id;?>)" src="assets/images/bulb_on.png"></td> 
                           <?php  }
                        ?>
                                                 -->
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
                                            echo "<i style=color:red>User list empty</i>";
                                        }
                                        ?>
                                       
                                        <script>
                                        	var asInitVals = new Array();			
											$(document).ready(function() {
												var oTable = $('#example').dataTable( {
													"oLanguage": {
														"sSearch": "Search all columns:"
													}
												} );
												
												$("tfoot input").keyup( function () {
													/* Filter on the column (the index) of this element */
													oTable.fnFilter( this.value, $("tfoot input").index(this) );
												} );
												
												
												
												/*
												 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
												 * the footer
												 */
												$("tfoot input").each( function (i) {
													asInitVals[i] = this.value;
												} );
												
												$("tfoot input").focus( function () {
													if ( this.className == "search_init" )
													{
														this.className = "";
														this.value = "";
													}
												} );
												
												$("tfoot input").blur( function (i) {
													if ( this.value == "" )
													{
														this.className = "search_init";
														this.value = asInitVals[$("tfoot input").index(this)];
													}
												} );
											} );

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
        cache:true,
        success:function(htnlstr) {
          alert("Hello");
            $("#status_bulb_"+id).html("<img src='assets/images/bulb_off.png'  title='Enable' onclick='make_it_on("+id+")'>");
        }
    });
}
function make_it_on(id) {
    var data_to_send = 'id=' + id +'&function=make_it_on_category';
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
</script>
</body>
</html>
