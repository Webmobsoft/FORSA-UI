<?php include_once 'header.php'; ?>
<!-- Wrapper Start -->

<style>
body .sec-box header h2 {
	padding: 0;
	margin: 0;
	width: 85% !important;
float:none !important;
	
}

#category_id {
  height: 250px;
}

</style>

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
            <?php
            $msg = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            
            ?>
			
			
			
            <?php
			if (isset($_REQUEST['upload']))
			{
    require('library/php-excel-reader/excel_reader2.php');
    require('library/SpreadsheetReader.php');
    $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(in_array($_FILES["csv_file"]["type"],$mimes))
    {
    $uploadFilePath = 'uploads/'.basename($_FILES['csv_file']['name']);
    move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadFilePath);
    $Reader = new SpreadsheetReader($uploadFilePath);
    //$totalSheet = count($Reader->sheets());
    foreach ($Reader as $Row)
    {   
         $select_query = mysqli_query($mysql_connect,"SELECT `id` FROM `tbl_category` WHERE `category` = '$Row[1]'");
         if(mysqli_num_rows($select_query) > 0){
            if(!empty($Row[1])){
                $message[] =  $Row[1]."has already uploaded.Please use another";    
            } 
         }else{
            $sqlcatinsert = "INSERT INTO `tbl_category`(`id`,`category`,`active`) VALUES (null,'$Row[1]','Y')";
            $mysql =  mysqli_query($mysql_connect,$sqlcatinsert);
            $success_message = "Uploaded Successfully"; 

         }
    }
    $msg = array();
    $msg = $message;
  }else { 
    echo "Invalid File";
  }           

 }


			// 	$fname = $_FILES['csv_file']['name'];
			// 	$chk_ext = explode(".", $fname);
			// 	if(strtolower(end($chk_ext)) == "csv")
			// 	{
			// 	$filename = $_FILES['csv_file']['tmp_name'];
			// 	$handle = fopen($filename, "r");

			// 	while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			// 	{ 

            //         $category = utf8_encode($data[1]);
            //         $insertCategory = html_entity_decode(htmlentities($category));

			// 		$sqlcatinsert="INSERT INTO `tbl_category`(`id`, `category`,`active`) VALUES (null,'$insertCategory','Y')";
					
			// 		$mysql =  mysql_query($sqlcatinsert);
				
			// 	}
			// 	fclose($handle);
			// 	echo'<script>window.location="http://instimatch.com/forsa/applications/admin/categorys.php";</script>';
            //     $msg = "Successfully Imported ";
				
			// }else{
			// 	echo "Invalid File";
			// }
				
			

 
					  
                			
			    
			?>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title user_popup_heading" id="myModalLabel">Import Category</h4>
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
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12 marg-padd-rmv">
                            <div class="sec-box">
                                <a style="display:none;" class="closethis">Close</a>
                                <header>
                                <span id="add"><a href="client_sub_group.php" style="float:right;" class="btn btn-primary style2">Back to list</a></span>
                                    <!--<h2 class="heading">Add Job</h2>-->
                                </header>
                                <div class="contents">
                                    <a style="display:none;" class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <form action=""  method="post" enctype="multipart/form-data">
											<?php
												if ($msg != '') {
												echo "<div class='alert alert-success'>" . $msg . "</div>";
													}
											?>
                                            
                                                
                                                
                                                
                                                <tr>
												<td class="col-md-4">UPLOAD EXCEL FILE</td>
                                                <td class="col-md-8">
													<input type="file" name="csv_file" id="csv_file"><br>
                                                 </td>
                                                </tr>
                                                
                                                <tr>
                                                 <td class="col-md-1"><input type="submit" placeholder="" id="upload" name="upload" value="Submit" class="btn btn-primary style2"></td>
                                                </tr>
                                            </form>
                                            
                                         
                                            
                                            
                                            
                                            
<!--                                               
                                            
                    <!-- Row End -->
                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<!-- Wrapper End -->
</body>
</html>
