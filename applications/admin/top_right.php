<?php
include_once 'header.php';
  ?>
<header>
                <!-- User Section Start -->
                <div class="user">
                    <figure>
                        <a href="#"><img src="assets/images/default_profile.jpg" alt="Adminise" /></a>
                    </figure>
                    <div class="welcome">
                        <p>Welcome</p>
                        
                  <h5>
				  <a href="#"><?php echo  $_SESSION['uname'];?></a></h5>
                    </div>
					
                </div>
				
				<div style="color:white;float:left;margin-left:200px;"> 
					<span class="headerNotifications badge-danger badge" style="background-color:red !important;"></span>  
					<li class="dropdown messageHolder" style="list-style-type:none;"> 
					<span id="hideThis">
					    <img src= "<?php echo $base_url; ?>assets/images/chat.png" alt="missing" id="hideImg"   style="position:relative;top:20px;"/>
				        </span>
					
					<span class ="showThis">
					   <a title="Messages" href="messagesAdmin.php" class="headerCustomLink"><img src= "<?php echo $base_url; ?>assets/images/chat.png" alt="missing" id="showImg"/>
				       </span>
					</a>    
					</li>  
				</div> 
                <!-- User Section End -->
                <!-- Search Section Start -->
<!--                <div class="search-box">
                    <input type="text" placeholder="Search Anything" />
                    <input type="submit" value="go" />
                </div>-->
                <!-- Search Section End -->
                <!-- Header Top Navigation Start -->																
                <nav class="topnav">
                    <ul id="nav1">
<!--                        <li class="tasks">
                        	<a href="#"><i class="glyphicon glyphicon-check"></i>Tasks<span>(04)</span></a>
                            <div class="popdown">
                            	<div class="taskslist">
                                	<ul>
                                    	<li>
                                        	<h6><a href="#">Vel lundium natoque</a><span class="pull-right">25%</span></h6>
                                            <div class="progress">
                                                <div style="width: 15%" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">35% Complete (success)</span>
                                                </div>
                                                <div style="width: 5%" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">20% Complete (warning)</span>
                                                </div>
                                                <div style="width: 5%" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">10% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a><span class="pull-right">75%</span></h6>
                                            <div class="progress">
                                                <div style="width: 30%" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">35% Complete (success)</span>
                                                </div>
                                                <div style="width: 30%" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">20% Complete (warning)</span>
                                                </div>
                                                <div style="width: 15%" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">10% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a><span class="pull-right">52%</span></h6>
                                            <div class="progress">
                                                <div style="width: 30%" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">35% Complete (success)</span>
                                                </div>
                                                <div style="width: 15%" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">20% Complete (warning)</span>
                                                </div>
                                                <div style="width: 7%" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">10% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a><span class="pull-right">90%</span></h6>
                                            <div class="progress">
                                                <div style="width: 30%" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">35% Complete (success)</span>
                                                </div>
                                                <div style="width: 30%" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">20% Complete (warning)</span>
                                                </div>
                                                <div style="width: 30%" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">10% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a href="#" class="viewall">View All Tasks</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>-->
<!--                        <li class="notifi">
                        	<a href="#"><i class="glyphicon glyphicon-bell"></i>Notifications</a>
                            <div class="popdown">
                            	<div class="notificationlist">
                                	<ul>
                                    	<li>
                                        	<h6><a href="#">Vel lundium natoque</a></h6>
                                            <p>In parturient! Vel lundium natoque</p>
                                            <span><i class="glyphicon glyphicon-time"></i>2hrs ago</span>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a></h6>
                                            <p>In parturient! Vel lundium natoque</p>
                                            <span><i class="glyphicon glyphicon-time"></i>2hrs ago</span>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a></h6>
                                            <p>In parturient! Vel lundium natoque</p>
                                            <span><i class="glyphicon glyphicon-time"></i>2hrs ago</span>
                                        </li>
                                        <li>
                                        	<h6><a href="#">Vel lundium natoque</a></h6>
                                            <p>In parturient! Vel lundium natoque</p>
                                            <span><i class="glyphicon glyphicon-time"></i>2hrs ago</span>
                                        </li>
                                    </ul>
                                    <a href="#" class="viewall">View All Notifications</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>-->
<!--                        <li class="inbox">
                        	<a href="inbox.html"><i class="glyphicon glyphicon-envelope"></i>Inbox<span>(03)</span></a>
                        </li>-->                     

						<?php if($_SESSION['user_type'] == "admin" ) { ?>
						
                        <li class="settings">
                        	<a href="#"><i class="glyphicon glyphicon-wrench"></i>Settings</a>
                            <div class="popdown popdown-right settings">
                            	<nav>
                                	<!--<a href="#"><i class="glyphicon glyphicon-user"></i>Your Profile</a>-->
                                    <a href="edit_account.php"><i class="glyphicon glyphicon-pencil"></i>Edit Account</a>
                                    <!--<a href="#"><i class="glyphicon glyphicon-question-sign"></i>Get Help</a>-->
                                    <a href="change_password.php"><i class="glyphicon glyphicon-lock"></i>Change Password</a>
                                    <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>Log out</a>
                                </nav>
                            </div>
                        </li>
						<?php }else { ?>
						     <li class="settings">

                        	<a href="#"><i class="glyphicon glyphicon-wrench"></i>Settings</a>

                            <div class="popdown popdown-right settings">

                            	<nav>

                                	<!--<a href="#"><i class="glyphicon glyphicon-user"></i>Your Profile</a>-->

                                    <a href="edit_account.php?subadmin"><i class="glyphicon glyphicon-pencil"></i>Edit Account</a>

                                    <!--<a href="#"><i class="glyphicon glyphicon-question-sign"></i>Get Help</a>-->

                                    <a href="change_password.php?subadmin"><i class="glyphicon glyphicon-lock"></i>Change Password</a>

                                    <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>Log out</a>

                                </nav>

                            </div>

                        </li>
						<?php } ?>
                    </ul>
                </nav>
                <!-- Header Top Navigation End -->
                <div class="clearfix"></div>
            </header>
            <!-- Right Section Header End -->
          		<script>
				function getMessagesCount()	
				{
				
				var data_to_send = 'function=get_message_count';	
				$.ajax({			
				url:"ajax_function.php",	
				method:"post",			
				data:data_to_send,		
				cache:false,			
				success:function(htnlstr)	
				{	
				//alert(htnlstr);
			        if(htnlstr == 0)
				   {
					   $("#hideThis").show();
					   $(".headerNotifications").hide;
                                           $("#showImg").hide();			  
				   }else
				   {
						  $("#hideThis").hide();
						  $(".headerNotifications").show().html(htnlstr); 
						  $("#showThis").show();
                                                  $("#showImg").show();
				   }
				   
				}             
				});					
				} $(document).ready(function () {  
				getMessagesCount();       
				setInterval(function () {  
				getMessagesCount();      
				}, 5000);       
				});   
				</script>
