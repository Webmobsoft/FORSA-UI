<?php include_once 'header.php';
// header('Content-Type: text/html; charset=UTF-8');
// mysql_query("SET NAMES 'utf8'");
// mysql_query("SET CHARACTER SET 'utf8'");
?>
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
            $success_message = '';
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
        if ($Row[6] == "Unternehmen (AöR, Kdör)"){
            $Row[6] = "Unternehmen AöR Kdör";
        }
        
         $select_query = mysqli_query($mysql_connect,"SELECT `id` FROM `tbl_customers` WHERE `first_name` = '$Row[10]'  AND `Surname` = '$Row[11]'  AND `email` = '$Row[12]' AND `processed` = 'N'");
         if(mysqli_num_rows($select_query) > 0){
            if(!empty($Row[10]) && !empty($Row[11])){
                $message[] = "".$Row[10]."  ".$Row[11]." has already uploaded.Please use another";    
            } 
         }else{
            $sqlcatinsert = "INSERT INTO `tbl_customers`(`id`,`id_i`,`Name_company`,`address`,`Postcode`,`place`,`category`,`client_group`,`fo_assignment`,`salutation`,`title`,`first_name`,`Surname`,`email`,`password`,`spare1`,`spare2`,`spare3`,`spare4`,`active`) VALUES (null,'$Row[0]','$Row[1]','$Row[2]','$Row[3]','$Row[4]','$Row[5]','$Row[6]','$Row[7]','$Row[8]','$Row[9]','$Row[10]','$Row[11]','$Row[12]','$Row[13]','$Row[14]','$Row[15]','$Row[16]','$Row[17]','Y')";
            $mysql =  mysqli_query($mysql_connect,$sqlcatinsert);
            $success_message = "Uploaded Successfully"; 

         }
        
            /*echo "INSERT INTO `tbl_customers` (`id`,`id_i`,`Name_company`,`address`,`Postcode`,`place`,`category`,`client_group`,`fo_assignment`,`salutation`,`title`,`first_name`,`Surname`,`email`,`password`,`spare1`,`spare2`,`spare3`,`spare4`,`active`) VALUES (null,'$Row[0]','$Row[1]','$Row[2]','$Row[3]','$Row[4]','$Row[5]','$Row[6]','$Row[7]','$Row[8]','$Row[9]','$Row[10]','$Row[11]','$Row[12]','$Row[13]','$Row[14]','$Row[15]','$Row[16]','$Row[17]','Y') ON DUPLICATE KEY UPDATE id_i=VALUES('$Row[0]')";
            exit();*/

    

    }
    $msg = array();
    $msg = $message;
  }else { 
    echo "Invalid File";
  }
}

 
					  
                			
			    
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
                                <span id="add"><a href="customers.php" class="btn btn-primary style2" style="float: right;">Back to list</a></span>
                                <a style="display:none;" class="closethis">Close</a>
                                <header>
                                    <!--<h2 class="heading">Add Job</h2>-->
                                </header>
                                <div class="contents">
                                    <a style="display:none;" class="togglethis">Toggle</a>
                                  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
    <body>                                <div class="table-box">
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
												if (!empty($msg)) {
                                                    foreach ($msg as $key =>$value) {
                                                        echo "<div class='alert alert-error'>".$value."</div>";
                                                        
                                                    }
												 
													}if($success_message != ''){
                                                        echo "<div class='alert alert-success'>uploaded successfully</div>";

                                                    }
											?>
                                            
                                                
                                                
                                                
                                                <tr>
												<td class="col-md-4">UPLOAD Excel FILE</td>
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
