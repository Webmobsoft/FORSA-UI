<?php include_once 'header.php';?>
<!-- Wrapper Start -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    //$(document).ready(function(){
        //setInterval(function() {
            //$("#container").load("user_stat.php");
        //}, 100);
    //});

</script>
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
                                    <h2 class="heading">Live User Status</h2><script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
									
                                </header>
								 <div id = "container">
									<?php include_once 'live_user_stat.php';?>

                                       </div>
                               
 
</body>
</html>
	  <script>
$(document).ready(function(){
   
	
	 $('#myTable').DataTable( {
        "order": [[ 3, "asc" ]]
    } );
} );
	
	
</script>