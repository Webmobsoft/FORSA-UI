<?php include_once 'header.php';?>
<!-- Wrapper Start -->
<div class="wrapper">	
<div class="structure-row">      
  <!-- Sidebar Start -->       
  <?php include_once 'side_bar.php';?> 
  <!-- Sidebar End -->        <!-- Right Section Start -->
  <div class="right-sec">   
  <!-- Right Section Header Start -->   
  <?php include_once 'top_right.php';?>   
  <!-- Right Section Header End -->           
  <?php                      if(isset($_POST['submit']))		
  {		   $username = $_POST['username'];      
             $select_query= "select * from tbl_users where uname ='".$username."'";  
			 $res_qry = mysql_query($select_query);                  
			 $row = mysql_fetch_array($res_qry); 	           
			 if(!empty($row['uname']))			
			 {               
		 $password = rand();  
		 $update_qry = mysql_query("update tbl_users set pwd='".md5($password)."' where uname='".$username."'");
		 $message  =  'Hello '.$row['fname'].' '.$row['lname'].'<br/><br/>';    
		 $message  .=  'Your new password is : '.$password.'<br/><br/>';    
		 $message   .= 'Herzlichen Dank <br/>';				
		 $message  .= 'Freundliche Gr&uuml;sse <br/>';	
		 $message .= "Instimatch AG <br>";				
		 $message  .= "Riedm&uuml;hlestrasse 8  <br>";
		 $message  .= "8305 Dietlikon  <br>";	
		 $message  .= "+41 43 543 06 63  <br>";	
		 $message  .= "admin@instimatch.ch";  	
		 $to       =  $row['email'];		
		 $subject  =  'Password Reset';   
		 $headers  = "MIME-Version: 1.0" . "\r\n";		
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";	
		 $headers .=  "From: admin@instimatch.ch \r\n";                     
		 $headers .= "Cc: info@instimatch.ch \r\n";    				    	
		 mail($to, $subject, $message, $headers);                        
		 echo'<div class="alert alert-success">New password sent to the email of this user</div>';			
		 }			
		 else{   
		 echo'<div class="alert alert-danger">Wrong username</div>';		
		 }		
		 }         
		 ?>              
         <!-- Content Section Start -->       
		 <div class="content-section">   
		 <div class="container-liquid">    
		 <div class="row">          
		 <div class="col-xs-12">     
		 <div class="sec-box">        
		 <a class="closethis">Close</a>      
		 <header>                           
         <h2 class="heading">Reset User Password</h2> 
		 </header>                                
		 <div class="contents">                   
		 <a class="togglethis">Toggle</a>        
		 <div class="table-box">                 
		 <form name="add_interest" method="post" id="add_interest">    
		 <table class="table">                                      
		 <tbody>                                    
		 <!--<div class="alert alert-success"></div>-->     
		 <tr>                                              
		 <td class="col-md-4">Enter Username</td>          
		 <td class="col-md-8"><input type="text" placeholder="" id="username" name="username" value="" class="form-control" required></td>
		 <div name="add_interest_swap_errorloc" class="errorstring"></div>  
		 </tr>                         
		 <tr>                         
		 <td></td>
		 <td class="col-md-1"  ><input type="submit" placeholder="" name="submit" value="Submit" class="btn btn-primary style2 hideMyDiv"></td> 
		 </tr>                                               
		 </tbody>                                            
		 </table>                                            
		 </form><!--                                          
		 <script  type="text/javascript"> 
		 var frmvalidator = new Validator("add_interest");
		 frmvalidator.addValidation("swap","req","Please enter Swap");   
		 frmvalidator.addValidation("kurve","req","Please enter kurve"); 
		 </script>-->             
		 </div>            
		 </div>           
		 <!-- Content Section End --> 
		 </div>        
		 <!-- Right Section End -->  
		 </div>
		 </div><!-- Wrapper End --></body>
		 </html>
		 