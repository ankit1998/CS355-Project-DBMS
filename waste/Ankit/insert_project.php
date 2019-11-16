<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result.css">
</head>

<?php
	$name = $_POST['name'];
	$bug = $_POST['bug'];
	$sp = $_POST['sp'];
	$facs = $_POST['facs'];
	$role = $_POST['role'];
	$con = mysqli_connect("localhost","root","20/02/1998","cs355");
	
	// Checking connection
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = "SELECT pid FROM project WHERE pname='$name' AND budget='$bug' AND sponsor='$sp';";
	$result = mysqli_query($con, $query);
	echo "<br><br><br><center><table><thead>";
	if(mysqli_num_rows($result))
	{
		echo "<tr><th><center>Project already exists</center>";
		if($result)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<tr><th><center>Use Project ID : " . $row['pid'] . " to access it</centre>";
			}
		}
	}
	else
	{
		$chk = 1;
		for($i = 0; $i < count($facs); $i++)
		{
			$sql2 = "SELECT fid FROM faculty WHERE fid = '$facs[$i]';";
			$result = mysqli_query($con, $sql2);
			if(mysqli_num_rows($result) == 0)
			{
				$chk = 0;
			}
		}
		if($chk == 0)
		{
			echo "<tr><th><centre>One or more Faculty ID were non-existent</centre>";
			echo "</thead></center></table>";	
			echo "<thead><center><table>";	
		}
		else
		{
			$sql = "INSERT INTO project (pname, budget, sponsor) VALUES ('$name', '$bug', '$sp');";
			$con->query($sql);
			$result = mysqli_query($con, $query);
			echo "<tr><th><center>Project successful added!!!</center>";
			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr><th><center>Your Project ID is " . $row['pid'] . "</center>";
					echo "<tr><th><center>Remember it for future queries.</center>";
					$val = $row['pid'];
					for($i = 0; $i < count($facs); $i++)
					{
						$sql1 = "INSERT INTO works VALUES ('$val', '$facs[$i]', '$role[$i]');";
						$con->query($sql1);
					}
				}
			}
		}
		$result->free();
	}
	echo "</thead></center></table>";
	echo "<center><div class=\"wrapper\">";
	echo"<span class=\"square individual\">";
	if($chk == 0)
	{
		echo"<a class=\"ninth before after\" href=\" http://localhost/insert_project_main.php\">BACK</a>";
	}
	echo "<a class=\"ninth before after\" href=\" http://localhost/index.html\">MAIN</a>";
	echo "</span>";
	echo"</div></center>";
	$con->close();
?>


