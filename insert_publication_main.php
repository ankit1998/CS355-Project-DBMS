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
	<title>New Publication</title>
	<link rel="stylesheet" href="trial_v2.css">
	<script language="Javascript">
       	function hideA(x)
       	{
		   	if (x.checked)
		   	{
		     	document.getElementById("A").style.display = "none";
	     		document.getElementById("B").style.	display = "block";
	   		}
	 	}

	 	function hideB(x) 
	 	{
		   if (x.checked) 
		   	{
				document.getElementById("B").style.display = "none";
				document.getElementById("A").style.display = "block";
	   		}
		}
	</script>
	<script type="text/javascript">

		function BuildFormFields($amount)
		{
			var
				$container = document.getElementById('FormFields'),
				$item, $field, $i;

			$container.innerHTML = '';
			for ($i = 0; $i < $amount; $i++) {
				$item = document.createElement('div');
				$item.style.margin = '20px';
				
				$field = document.createElement('span');
				// $field.style.marginRight = '10px';
				$item.appendChild($field);

				$field = document.createElement('input');
				$field.name = 'facs[' + $i + ']';
				$field.type = 'number';
				$field.min = '1001';
				$field.placeholder = 'Faculty ID';
				$item.appendChild($field);

				$field = document.createElement('span');
				// $field.style.margin = '0px 10px';
				$item.appendChild($field);

				$field = document.createElement('input');
				$field.name = 'rank[' + $i + ']';
				$field.type = 'number';
				$field.placeholder = 'Rank';
				$item.appendChild($field);

				$container.appendChild($item);
			}
		}
	</script> 
</head>
<body>
	<div class="container">
		<form action = "insert_publication.php" method = "post">
			<div class="row">	
				<h3><center>New Publication</center></h3>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="pname" placeholder="Publication Name"></input>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="pg" placeholder="Pages (XXX-YYY)"></input>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="text" required="required" name="topic" placeholder="Topic"></input>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
			 	<div class="input-group input-group-icon">
					<!-- <input type="date" required="required" required="required" name="doj" placeholder="Date of Joining"/> -->
					<input placeholder="Date of Publish" required="required" name="dop" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"  id="date"/> 
					<div class="input-icon"><i class="fa fa-envelope"></i></div>
				</div>
				<div class="input-group input-group-icon">
					<input type="number" min="1" required="required" placeholder="No. of Faculty Involved" onkeyup="BuildFormFields(parseInt(this.value, 10));" />
					<div id ="FormFields" ></div>
					<div class="input-icon"><i class="fa fa-user"></i></div>
				</div>
				<div class="middle">
					<label>
						<input type="radio" onchange="hideB(this)" name="radio" checked/>
							<div class="front-end box">
								<span>Conference</span>
							</div>
					</label>

					<label>
						<input type="radio" onchange="hideA(this)" name="radio"/>
							<div class="back-end box">
								<span>Journal</span>
							</div>
					</label>
				</div>
				<div id="A">
					<br>
					<div class="input-group input-group-icon">
						<input type="text" name="cn" placeholder="Conference Name"></input>
						<div class="input-icon"><i class="fa fa-user"></i></div>
					</div>
					<div class="input-group input-group-icon">
						<input type="text" name="loc" placeholder="Location"></input>
						<div class="input-icon"><i class="fa fa-user"></i></div>
					</div>
				</div>
				<div id="B" style="display:none"><br>
					<div class="input-group input-group-icon">
						<input type="text" name="jn" placeholder="Journal Name"></input>
						<div class="input-icon"><i class="fa fa-user"></i></div>
					</div>
					<div class="input-group input-group-icon">
						<input type="number" name="vol" placeholder="Volume"></input>
						<div class="input-icon"><i class="fa fa-user"></i></div>
					</div>
					<div class="input-group input-group-icon">
						<input type="number" name="num" placeholder="Number"></input>
						<div class="input-icon"><i class="fa fa-user"></i></div>
					</div>
				</div>
				<div>		
					<center><input type="submit" name="Submit" style="background-color: #007e90;"></center>
				</div>
		</form>
	</div>
</body>
</html>