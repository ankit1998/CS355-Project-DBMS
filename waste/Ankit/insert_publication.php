<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result.css">
</head>

<?php
	$name = $_POST['pname'];
	$facs = $_POST['facs'];
	$rank = $_POST['rank'];
	$pg = $_POST['pg'];
	$topic = $_POST['topic'];
	$dop = $_POST['dop'];
	$cn = $_POST['cn'];
	$jn = $_POST['jn'];
	$loc = $_POST['loc'];
	$vol = $_POST['vol'];
	$num = $_POST['num'];

	$con = mysqli_connect("localhost","root","20/02/1998","cs355");

	// Checking connection
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = "SELECT pubid FROM publications WHERE pname='$name' AND dop='$dop' AND pages='$pg' AND topic='$topic';";
	$result = mysqli_query($con, $query);
	echo "<br><br><br><center><table><thead>";
	if(mysqli_num_rows($result))
	{
		echo "<tr><th><center>Publication already exists</center>";
		if($result)
		{
			while($row = $result->fetch_assoc())
			{
				echo ">tr><th><center>Use Publication ID : " . $row['pubid'] . " to access it</centre>";
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
			$sql = "INSERT INTO publications (pname, dop, pages, topic) VALUES ('$name', '$dop', '$pg', '$topic');";
			$con->query($sql);
			$result = mysqli_query($con, $query);
			echo "<tr><th><center>Publication successfully added!!!</center>";
			// echo $query;
			// echo $sql;
			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr><th><center>Your Publication ID is " . $row['pubid'] . "</center>";
					echo "<tr><th><center>Remember it for future queries.</center>";	
					$val = $row['pubid'];
					for($i = 0; $i < count($facs); $i++)
					{
						$sql1 = "INSERT INTO author VALUES ('$facs[$i]', '$val', '$rank[$i]');";
						$con->query($sql1);
					}
					if($cn == '')
					{
						$sql1 = "INSERT INTO journal VALUES ('$val', '$jn', '$vol', '$num');";
						$con->query($sql1);
					}
					else if($jn == '')
					{
						$sql1 = "INSERT INTO conference VALUES ('$val', '$cn', '$loc');";
						$con->query($sql1);
					}
				}
			}	
		}
		$result->free();
	}
	$jn = NULL;
	$vol = NULL;
	$num = NULL;
	$cn = NULL;
	$loc = NULL;
	echo "</thead></center></table>";
	echo "<center><div class=\"wrapper\">";
	echo"<span class=\"square individual\">";
	if($chk == 0)
	{
		echo"<a class=\"ninth before after\" href=\" http://localhost/insert_publication_main.php\">BACK</a>";
	}
	echo "<a class=\"ninth before after\" href=\" http://localhost/index.html\">MAIN</a>";
	echo "</span>";
	
	$con->close();
?>

