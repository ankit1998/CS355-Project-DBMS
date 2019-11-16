<?php
    session_start();
    if(!isset($_SESSION['username'])){
         $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/login.php';
         header('Location: ' . $home_url);
    }
    //echo $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>New Faculty</title>
	<link rel="stylesheet" href="trial_v2.css">
</head>
<body>
	<div class="container">
		<form action = "insert_faculty.php" method = "post">
			<div class="row">
				<h3><center>New Faculty</center></h3>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="name" placeholder="Full Name"/>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="email" required="required" name="email" placeholder="Email Address"/>
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<div class="input-group input-group-icon">	
					<input type="text" required="required" name="dept" placeholder="Department Code"/>
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<!-- <input type="date" required="required" name="doj" placeholder="Date of Joining"/> -->
					<input placeholder="Date of Joining" name="doj" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"  id="date"/> 
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="url" placeholder="Website U.R.L"/>
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<center><input type="submit" name="Submit" style="background-color: #007e90;"></center>
			</div>
		</form>
	</div>
</body>
</html>