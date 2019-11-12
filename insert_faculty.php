<?php
$fid = $_GET['fid']; 	
$name = $_GET['name'];
$dept = $_GET['dept'];
$doj = $_GET['doj'];
$url = $_GET['url'];
 
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Checking connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "INSERT INTO faculty VALUES ('$fid', '$name', '$dept', '$doj', '$url');";
echo "<center>Faculty successfully added!!!</center>";
echo "<br><br><center><a href = http://localhost/index.php> MAIN </a></center>";
$con->query($sql);
$con->close();
?>

