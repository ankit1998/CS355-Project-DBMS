<?php
$pid = $_GET['id']; 	
$name = $_GET['name'];
$bug = $_GET['bug'];
$sp = $_GET['sp'];
$facs = $_GET['facs'];
$role = $_GET['role'];

$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Checking connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "INSERT INTO project VALUES ('$pid', '$name', '$bug', '$sp');";
$con->query($sql);
for($i = 0; $i < count($facs); $i++)
{
	$sql1 = "INSERT INTO works VALUES ('$pid', '$facs[$i]', '$role[$i]');";
	$con->query($sql1);
}
echo "<center>Project successful added!!!</center>";
echo "<br><br><center><a href = http://localhost/index.php> MAIN </a></center>";
$con->close();
?>
