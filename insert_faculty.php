<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result.css">
</head>

<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dept = $_POST['dept'];
	$doj = $_POST['doj'];
	$url = $_POST['url'];
	// $con = mysqli_connect("localhost","root","20/02/1998","cs355");
$con = mysqli_connect("db","user","test","myDb");
	

	// Checking connection
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = "SELECT fid FROM faculty WHERE email = '$email';";
	$result = mysqli_query($con, $query);
	// echo "yo";
	echo "<br><br><br><center><table><thead>";
	if(mysqli_num_rows($result))
	{
		echo "<tr><th><center>Faculty already exists</center>";
		if($result)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<tr><th><center>Use Faculty ID : " . $row['fid'] . " to access it</centre>";
			}
		}
	}
	else
	{
		$sql = "INSERT INTO faculty (fname, email, dept, doj, website) VALUES ('$name', '$email', '$dept', '$doj', '$url');"; 
		// echo $sql;
		// echo $dij;
		$con->query($sql);
		// $query = "SELECT fid FROM faculty WHERE email = '$email';";
		$result = $con->query($query);
		echo "<tr><th><center>Faculty successfully added!!!</center>";
		if($result)
		{
			// echo "yo1";
			while($row = $result->fetch_assoc())
			{
				// echo "yo2";
				echo "<tr><th><center>Your Faculty ID is " . $row['fid'] . "</center>";
				echo "<tr><th><center>Remember it for future queries.</center>";
			}
		}

		$result->free();
	}
	echo "</thead></center></table>";	
	$con->close();
?>
<body>
	<center><div class="wrapper">
	  <span class="square individual">
	    <a class="ninth before after" href="index.html">MAIN</a>
	  </span>
	</div></center>
</body>
</html>

