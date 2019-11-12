<?php
$id = $_GET['id']; 	
$pg = $_GET['pg'];
$topic = $_GET['topic'];
$dop = $_GET['dop'];
$cn = $_GET['cn'];
$jn = $_GET['jn'];
$loc = $_GET['loc'];
$vol = $_GET['vol'];
$num = $_GET['num'];

$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Checking connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if($cn == '')
{
	$sql = "INSERT INTO publications VALUES ('$id', '$jn', '$dop', '$pg', '$topic');";
	$sql1 = "INSERT INTO journal VALUES ('$id', '$jn', '$vol', '$num');";
}
if($jn == '')
{
	$sql = "INSERT INTO publications VALUES ('$id', '$cn', '$dop', '$pg', '$topic');";
	$sql1 = "INSERT INTO conference VALUES ('$id', '$cn', '$loc');";
}
$con->query($sql);
$con->query($sql1);

echo "<center>Publication successful added!!!</center>";
echo "<br><br><center><a href = http://localhost/index.php> MAIN </a></center>";
$con->close();
?>
