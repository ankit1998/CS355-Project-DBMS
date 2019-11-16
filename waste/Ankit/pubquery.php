<html>
	<head>
		<link rel="stylesheet" href="result.css">
		<title>Publications</title>
	</head>

<?php
// echo "Hello World"; 

$pubid = $_POST['pubid'];
$con = mysqli_connect("localhost","root","20/02/1998","cs355");

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "<center><h3> Publications </h3></Center>";
if($pubid == '')
{
	$sql = "select * from publications;";
	$result = $con->query($sql);
	if($result)
	{
		echo "<center>";
			echo "<table>";
			echo "	<thead>
			            <tr>
			                <th>Paper Name</th>
			                <th>Date of Publish</th>
			                <th>Pages</th>
			                <th>Domain</th>
			            </tr>
	    			</thead>";
			while($row = $result->fetch_assoc())
			{
				echo " 	<tbody>
				            <tr>
			        	        <td>". $row['pname'] ."</td>
				                <td>". $row['dop'] ."</td>
				                <td>". $row['pages'] ."</td>
				                <td>". $row['topic'] ."</td>
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
	$sql1 = "select * from publications where pubid='$pubid';";
	$sql2 = "select * from conference where pubid='$pubid';";
	$sql3 = "select * from journal where pubid='$pubid';";
	$sql4 = "select fname from faculty where fid in (select fid from author where pubid='$pubid');";
	$result1 = $con->query($sql1);
	$result2 = $con->query($sql2);
	$result3 = $con->query($sql3);
	$result4 = $con->query($sql4);
	if(mysqli_num_rows($result1) == 0)
	{
		echo "Error : NO SUCH PUBLICATION EXISTS";
	}
	else
	{
		$facs = [];
		$i = 0;
		$pname;
		$dop;
		$pages;
		$name;
		$num;
		$vol;
		if($result4)
		{
			while($row = $result4->fetch_assoc())
			{
				// echo $row['fname'];
				// echo "<br>";
				$facs[$i] = $row['fname'];
				$i++;
			}
		}
		if($result1)
		{
			while ($row = $result1->fetch_assoc()) 
			{
				$pname = $row['pname'];
				$dop = $row['dop'];
				$pages = $row['pages'];
			}
		}
		if(mysqli_num_rows($result2) == 0)
		{
			if($result3)
			{
				while ($row = $result3->fetch_assoc()) 
				{
					$name = $row['jname'];
					$num = $row['num'];
					$vol = $row['volume'];
				}
			}	
		}
		else
		{
			if($result2)
			{
				while ($row = $result2->fetch_assoc()) 
				{
					$name = $row['cname'];
				}
			}	
		}
		echo "<br><br><br><center><table><thead><tr><th>";
		echo $facs[0];
		for($j = 1; $j < $i - 1; $j++)
		{
			echo ", " . $facs[$j];
		}
		echo " and " . $facs[$i-1] . ": " . " \"". $pname . " \", " . $name;
		if(mysqli_num_rows($result2) == 0)
		{
			echo ", Vol-" . $vol . ", No-" . $num; 
		}
		echo ", pages " . $pages . ", Date: " . $dop;
		echo "</thead></center></table>";
	}
	$result1->free();
	$result2->free();
	$result3->free();
	$result4->free();
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