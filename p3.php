<html>
	<head>
		<link rel="stylesheet" href="result.css">
		<title>Funds Alloted</title>
	</head>

<?php

$dept = $_POST['dept']; 	

// $con = mysqli_connect("localhost","root","20/02/1998","cs355");
$con = mysqli_connect("db","user","test","myDb");


// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select sum(budget) as tot from project where pid in(select distinct(project.pid) from works, faculty, project
where faculty.dept = '$dept'
and faculty.fid = works.fid 
and works.pid = project.pid);
";

$sql1 = "select pname, budget from project where pid in(select distinct(project.pid) from works, faculty, project
where faculty.dept = '$dept'
and faculty.fid = works.fid 
and works.pid = project.pid);
";

// echo $sql1;
$result1 = $con->query($sql1);

if($result1)
{
		echo "<center><h2>Projects allocated to " . $dept . " department</h2></center>";
		echo "<center><table>";
		echo "	<thead>
		            <tr>
		                <th>Name</th>
		                <th>Budget</th>
		            </tr>
    			</thead>";
		while($row = $result1->fetch_assoc())
		{
			echo " 	<tbody>
			            <tr>
		        	        <td>". $row['pname'] ."</td>
		    	            <td>". $row['budget'] ."</td>
			            </tr>
					</tbody>";
		}
		echo "</table></center>";
	echo "</article>";
	
	$result1->free();
}

$result = $con->query($sql);

if($result)
{
	while($row = $result->fetch_assoc())
	{
		echo "<br><br><center><table><thead><tr><th>";
		echo "<h2>Total funds allocated to ". $dept . " department is : ". $row['tot'] ."</h2>";
		echo "</thead></center></table>";

	}
	$result->free();
}

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