<?php
    if(!isset($_POST['login'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="trial_v2.css">
</head>
<body>
	<div class="container">
		<form action = "" method = "post">
			<div class="row"></div>
			<div class="row"></div>
			<div class="row">
				<h3><center>LOGIN</center></h3>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="username" placeholder="Username"/>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="password" required="required" name="password" placeholder="Password"/>
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<center><input type="submit" name="login" style="background-color: #007e90;"></center>
			</div>
		</form>
	</div>
</body>
</html>

<?php
    } else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == "ankit" && $password == "123"){
            session_start();
            $_SESSION['username'] = $username;
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/index.html';
            header('Location: ' . $home_url);
        } else{
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/login.php';
            header('Location: ' . $home_url);
        }
    }
?>