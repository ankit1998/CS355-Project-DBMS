<html>
	<head>
		<link rel="stylesheet" href="result.css">
		<title>Project</title>
	</head>

<?php
// echo "Hello World"; 

$pid = $_POST['pid'];
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "<center><h3> Project </h3></Center>";
if($pid == '')
{
	$sql = "select * from project;";
	$result = $con->query($sql);
	if($result)
	{
		echo "<center>";
			echo "<table>";
			echo "	<thead>
			            <tr>
			                <th>Project Name</th>
			                <th>Budget</th>
			                <th>Sponsor</th>
			            </tr>
	    			</thead>";
			while($row = $result->fetch_assoc())
			{
				echo " 	<tbody>
				            <tr>
			        	        <td>". $row['pname'] ."</td>
				                <td>". $row['budget'] ."</td>
				                <td>". $row['sponsor'] ."</td>
				            </tr>
						</tbody>";
			}
			echo "</table></center>";
		echo "</center>";

		$result->free();
	}
}
else
{
	$sql1 = "select * from project where pid='$pid';";
	$sql2 = "select faculty.fname, works.role from faculty, works where faculty.fid = works.fid and works.pid='$pid';";
	$result1 = $con->query($sql1);
	$result2 = $con->query($sql2);
	// echo $sql1;
	// echo " " . $sql2;
	if(mysqli_num_rows($result1) == 0)
	{
		echo "Error : NO SUCH PROJECT EXISTS";
	}
	else
	{
		$facs = [];
		$role = [];
		$i = 0;
		$pname;
		$sp;
		$bug;
		if($result2)
		{
			while($row = $result2->fetch_assoc())
			{
				$facs[$i] = $row['fname'];
				$role[$i] = $row['role'];
				$i++;
			}
		}
		if($result1)
		{
			while ($row = $result1->fetch_assoc()) 
			{
				$pname = $row['pname'];
				$bug = $row['budget'];
				$sp = $row['sponsor'];
			}
		}
	// echo $pname;
		echo "<br><br><br><center><table><thead><tr><th>";
		echo $pname . ", " . $sp . ", ";
		echo $facs[0] . " (" . $role[0] . ")";
		for($j = 1; $j < $i - 1; $j++)
		{
			echo ", " . $facs[$j] . " (" . $role[0] . ")";
		}
		echo " and " . $facs[$i-1] . " (" . $role[0] . "), Budget : " .  $bug;
		echo "</thead></center></table>";
	}
	$result1->free();
	$result2->free();
}

$con->close();
?>

<body>
	<center><div class="wrapper">
	  <span class="square individual">
	    <a class="ninth before after" href=" http://localhost/index.html">MAIN</a>
	  </span>
	</div></center>
</body>
</html>