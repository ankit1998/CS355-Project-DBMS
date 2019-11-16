<html>
	<head>
		<link rel="stylesheet" href="phpcss_v2.css">
		<title>Projects</title>
	</head>

<?php
// echo "Hello World"; 
 
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select * from project;";
// echo $sql;
$result = $con->query($sql);
if($result)
{
	echo "<article>";
		echo "	<div class=\"box\">
					<h2>List of Projects </h2>
				</div>";
		echo "<center><table class = \"container\">";
		echo "	<thead>
		            <tr>
		                <th>Project Name</th>
		                <th>Budget Alloted</th>
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
	echo "</article>";

	$result->free();
}


$con->close();
?>


</html>