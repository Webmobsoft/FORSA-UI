<?php

if(isset($_POST['UPDATE']))
{
	 $ids       = $_POST['id'];
	 $mid       = $_POST['mid'];
	 $swap      = $_POST['swap'];
	 $kurve     = $_POST['kurve'];
	$time_now   = date("d.m.Y");
    $count= count($ids);
	
	$id=1;
		for($x = 0; $x <= $count; $x++)
		{
			$sql = "UPDATE tbl_interest SET mid ='".$mid[$x]."' , swap= '".$swap[$x]."' , kurve='".$kurve[$x]."' ,other = '".$time_now."' WHERE id='".$id."'  ";
			
			$query = mysql_query($sql);
			$id++;
		}
		

		
	
	
}


?> 