<html>
	<head>
		<link rel="stylesheet" href="result.css">
		<title>Publication Trends</title>
	</head>

<?php
// echo "Hello World"; 
$fid = $_POST['fid']; 	
$yrs = $_POST['yrs'];
 
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "select fname, dop, pname, topic, ARank from faculty, publications, author
where publications.pubid = author.pubid
and faculty.fid = author.fid
and adddate(publications.dop, INTERVAL '$yrs' YEAR) > curdate()
and faculty.fid = '$fid';";

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
		echo "<center><h2>Trends of Companion Faculty of ". $facname . " </h2></center>";
		echo "<center><table>";
		echo "	<thead>
		            <tr>
		                <th>Paper</th>
		                <th>Topic</th>
		                <th>Date of Publications</th>
		            </tr>
    			</thead>";
		while($row = $result->fetch_assoc())
		{
			echo " 	<tbody>
			            <tr>
			                <td>". $row['pname'] ."</td>
			                <td>". $row['topic'] ."</td>
		        	        <td>". $row['dop'] ."</td>
			            </tr>
					</tbody>";
		}
		echo "</table></center>";
	echo "</article>";

	$result->free();
}

$sql = "select topic, count(topic) as cnt from publications, author, faculty
where publications.pubid = author.pubid
and faculty.fid = author.fid
and adddate(publications.dop, INTERVAL '$yrs' YEAR)>curdate()
and faculty.fid = '$fid'
group by publications.topic;;";

$result = $con->query($sql);

if($result)
{
	echo "<br><center><h2>Trend over topic of research </h2></center>";
		echo "<center><table>";
		echo "	<thead>
		            <tr>
		                <th>Topic</th>
		                <th>Count</th>
		            </tr>
    			</thead>";
		while($row = $result->fetch_assoc())
		{
			echo " 	<tbody>
			            <tr>
		        	        <td>". $row["topic"] ."</td>
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