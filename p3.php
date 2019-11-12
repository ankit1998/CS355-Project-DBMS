
<?php

$dept = $_GET['dept']; 	

$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select sum(budget) as tot from project where pid in(select distinct(project.pid) from works, faculty, project
where faculty.dept = '$dept'
and faculty.fid = works.fid 
and works.pid = project.pid);;
";

$result = $con->query($sql);

if($result)
{
	while($row = $result->fetch_assoc())
	{
		printf("Total funds recieved by %s department is : %s",$dept, $row['tot']);
	}
	$result->free();
}

echo "<br><br><a href = http://localhost/index.php> MAIN </a>";
	
$con->close();
?>
