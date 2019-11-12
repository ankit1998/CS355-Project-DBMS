<?php
$fid = $_GET['fid']; 	
$yrs = $_GET['yrs'];
 
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Checking connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select fname, dop, pname, topic, ARank from faculty, publications, author where publications.pubid = author.pubid and faculty.fid = author.fid and adddate(publications.dop, INTERVAL '$yrs' YEAR) > curdate() and faculty.fid = '$fid';";

$result = $con->query($sql);

if($result)
{
	echo "<table border = 1>";
	echo "<tr> <th> Name </th> <th> DOP </th> <th> Paper </th> <th> Topic </th></tr>";
	while($row = $result->fetch_assoc())
	{
		echo "<tr>";
		printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td>",$row["fname"], $row['dop'],$row['pname'], $row['topic']);
		echo "</tr>";
	}
	echo "</table>";

	$result->free();
}

$sql = "select topic, count(topic) as cnt from publications, author, faculty
where publications.pubid = author.pubid and faculty.fid = author.fid and adddate(publications.dop, INTERVAL '$yrs' YEAR)>curdate() and faculty.fid = '$fid' group by publications.topic;";

$result = $con->query($sql);

if($result)
{
	echo "<br> <table border = 1>";
	echo "<tr> <th> Topic </th> <th> Count </th></tr>";
	while($row = $result->fetch_assoc())
	{
		echo "<tr>";
		printf("<td> %s </td> <td> %d </td>", $row["topic"], $row['cnt']);
		echo "</tr>";
	}
	echo "</table>";
	echo "<br><br>7<a href = http://localhost/index.php> MAIN </a>";

	$result->free();
}

$con->close();
?>
