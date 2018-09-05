<?php
$to = "jackie.chan3146@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n";

mail($to,$subject,$txt,$headers);
?>