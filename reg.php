<?php
$name = $_GET['name'];
$email = $_GET['email'];
$usrnm = $_GET['usrnm'];
$pass = $_GET['pass'];
$cpass = $_GET['cpass'];

$con = mysqli_connect('db', 'user', 'test', 'mydb');

// Checking connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "INSERT INTO user VALUES ('$name', '$email', '$usrnm', '$pass');";
echo "Successful!";
$con->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>&emsp;REGISTER NEW USER</h3>
<form action = "reg_user.php" method = "get">
	<table>
		<tr>
			<td>Name&emsp;</td> <td><input type="text" name="name" placeholder="Pahaad Singh"> <br><br>	</td>
		</tr>
		<tr>
			<td>E-Mail&emsp;</td>
			<td><input type="text" name="email" placeholder="parwat_mount@himalaya.com"> <br><br></td>
		</tr>
		<tr>
			<td>Username&emsp;</td>
			<td><input type="text" name="usrnm" placeholder="Canopy"> <br><br></td>
		</tr>
		<tr>
			<td>Password(Min. Length : 4)&emsp;</td>
			<td><input type="password" name="pass" placeholder="jingalahuhu"> <br><br></td>
		</tr>
		<tr>	
			<td>Confirm Password&emsp;</td>
			<td><input type="password" name="cpass" placeholder="uparwala"> <br><br></td>
		</tr>
	<?php
		if($pass != $cpass)
		{
			echo "Both Password should be same";
		}
		else
		{
			$con->query($sql);
		}
	?>	
	</table>
		<br>
		<input type="submit" name="Submit">
</form>

</body>
</html>