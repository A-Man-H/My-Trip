<?php 
$servername = "localhost";
 $dBUsername = "root";
 $dBPassword = "";
 $dBName = "mytrip";
	$con=mysqli_connect("localhost","root","") or die("Couldn't connect to SQL server");
	mysqli_select_db($con,"mytrip");
?>