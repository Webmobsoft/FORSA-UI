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
			if (isset($_REQUEST['upload']))
			{
				$fname = $_FILES['csv_file']['name'];
				$chk_ext = explode(".", $fname);
				if(strtolower(end($chk_ext)) == "csv")
				{
				$filename = $_FILES['csv_file']['tmp_name'];
				$handle = fopen($filename, "r");
				while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{ 
                    $companyName = utf8_encode($data[1]);
                    $companyName = html_entity_decode(htmlentities($companyName));
                    $address = utf8_encode($data[2]);
                    $address = html_entity_decode(htmlentities($address));
                    $place = utf8_encode($data[4]);
                    $place = html_entity_decode(htmlentities($place));
                    $category = utf8_encode($data[5]);
                    $category = html_entity_decode(htmlentities($category));
                    $fo_assignment = utf8_encode($data[6]);
                    $fo_assignment = html_entity_decode(htmlentities($fo_assignment));
                    $salutation = utf8_encode($data[7]);
                    $salutation = html_entity_decode(htmlentities($salutation));
                    $title = utf8_encode($data[8]);
                    $title = html_entity_decode(htmlentities($title));
                    $first_name = utf8_encode($data[9]);
                    $first_name = html_entity_decode(htmlentities($first_name));
                    $Surname = utf8_encode($data[10]);
                    $Surname = html_entity_decode(htmlentities($Surname));
                    $email = utf8_encode($data[11]);
                    $email = html_entity_decode(htmlentities($email));
                    $spare1 = utf8_encode($data[13]);
                    $spare1 = html_entity_decode(htmlentities($spare1));
                    $spare2 = utf8_encode($data[14]);
                    $spare2 = html_entity_decode(htmlentities($spare2));
                    $spare3 = utf8_encode($data[15]);
                    $spare3 = html_entity_decode(htmlentities($spare3));
                    $spare4 = utf8_encode($data[16]);
                    $spare4 = html_entity_decode(htmlentities($spare4));
                    mysql_query("SET NAMES 'utf8'");
                    mysql_query("SET character_set_client = 'utf8'");
                    mysql_query("SET character_set_results = 'utf8'");
                    mysql_query("SET character_set_connection = 'utf8'");
                    $sqlcatinsert="INSERT INTO `tbl_customers`(`id`,`id_i`,`Name_company`,`address`,`Postcode`,`place`,`category`,`fo_assignment`,`salutation`,`title`,`first_name`,`Surname`,`email`,`password`,`spare1`,`spare2`,`spare3`,`spare4`,`active`) VALUES (null,'$data[0]','$companyName','$address','$data[3]','$place','$category','$fo_assignment','$salutation','$title','$first_name','$Surname','$email','$data[12]','$spare1','$spare2','$spare3','$spare4','Y')";
                    $mysql =  mysql_query($sqlcatinsert);
                
				}
				fclose($handle);
                
				echo'<script>window.location="http://instimatch.com/forsa/applications/admin/customers.php";</script>';
                $msg = "Successfully Imported ";
				
			}else{
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
												if ($msg != '') {
												echo "<div class='alert alert-success'>" . $msg . "</div>";
													}
											?>
                                            
                                                
                                                
                                                
                                                <tr>
												<td class="col-md-4">UPLOAD CSV FILE</td>
                                                <td class="col-md-8">Select csv file to upload:
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
