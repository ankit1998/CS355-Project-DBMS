<html>
	<head>
		<link rel="stylesheet" href="result.css">
		<title>Collaboration Trends</title>
	</head>


<?php
// echo "Hello World"; 
$fid = $_POST['fid']; 	

$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select fname, count(a1.fid) as cnt from author as a1, author as a2, faculty
where a1.pubid = a2.pubid
and a1.fid != a2.fid
and a2.fid = '$fid'
and faculty.fid = a1.fid
group by a2.fid, a1.fid;
";
$sql1 = "select fname from faculty where fid = '$fid';";
$result1 = $con->query($sql1);
$facname = '';
if($result1)
{
	while ($row = $result1->fetch_assoc()) {
		$facname = $row['fname'];
	}
}
$result = $con->query($sql);

if($result)
{
		echo "<center><h2>Collaboration Trends of " . $facname. "</h2></center>";
		echo "<center><table>";
		echo "	<thead>
		            <tr>
		                <th>Name</th>
		                <th>Count</th>
		            </tr>
    			</thead>";
		while($row = $result->fetch_assoc())
		{
			echo " 	<tbody>
			            <tr>
		        	        <td>". $row["fname"] ."</td>
		    	            <td>". $row['cnt'] ."</td>
			            </tr>
					</tbody>";
		}
		echo "</table></center>";
	echo "</article>";
	$result->free();
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
