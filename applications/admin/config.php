<?php
error_reporting(0);
$host = "macmille.mysql.db.internal";
$uname = "macmille_forsat";
$pwd = "C1JXr3Mx";
$db = "macmille_forsatest";
$mysql_connect = mysqli_connect($host, $uname, $pwd) or die("Mysql is not connected");
$connet_db = mysqli_select_db($mysql_connect,$db) or die("Datbase is not connected");
@session_start();
//$base_url = 'http://instimatch.webmobsoft.com/applications/';
$base_url = 'http://demo.instimatch.com/forsa/';

$mailFooterEN = "Thank you very much<br/>Kind regards <br/><br/>Instimatch AG <br/>Riedm&uuml;hlestrasse 8 <br/>8305 Dietlikon  <br/>+41 43 543 06 63 <br/><br/>admin@instimatch.ch<br/>www.instimatch.ch "; 

$mailFooterFR = "Thank you very much<br/>Kind regards <br/><br/>Instimatch AG <br/>Riedm&uuml;hlestrasse 8 <br/>8305 Dietlikon  <br/>+41 43 543 06 63 <br/><br/>admin@instimatch.ch<br/>www.instimatch.ch "; 

$mailFooterDE = "Herzlichen Dank<br/> Freundliche Gr&uuml;sse <br/><br/> Instimatch AG <br>Riedm&uuml;hlestrasse 8 <br>8305 Dietlikon  <br>+41 43 543 06 63  <br/><br>admin@instimatch.ch<br>www.instimatch.ch";
?>