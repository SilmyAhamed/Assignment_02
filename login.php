<?php
	session_start();
	require 'models.php';

	function getMenu()
	{
		$connection = getConnection();

		$query = 'SELECT *FROM menu WHERE id = 4';
		return $result = $connection->query($query);
	}

	$userLogin = userLogin();
	$registrationForm = registrationForm();
	$menu = getMenu();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignment 02</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.validate.js"></script>
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>

	<?php foreach($menu as $data): ?>
		<nav class="navbar navbar-expand-lg navbar-light p-3 mb-2 bg-primary">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" 	aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand text-white" href="index.php">Daily News</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link text-white" href="home.php"><?php if(isset($_SESSION['username'])){ echo 'Home';} ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="index.php">News</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="login.php"><?php echo $data['title']; ?> <span class="sr-only">(current)</span></a>
					</li>
				</ul>
		<!--	<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0 text-white border-light" type="submit">Search</button>
				</form> -->
			</div>
		</nav>
	<?php endforeach; ?>

	<div class="container mt-5">
		<div>
			<?php 
				
			?>
		</div>
		<form id="frm" action="login.php" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">Username</label>
				<input type="text" name="username" id="username" class="form-control w-50" id="exampleInputEmail1" required autocomplete="off" aria-describedby="emailHelp" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" id="password" class="form-control w-50" id="exampleInputPassword1" required autocomplete="off" placeholder="Enter Password">
			</div>
			<button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
			<div class="mt-2">Did not Register? <a href="register.php">Signin</a></div>
		</form>
	</div>

</body>
<script>
/*	$(document).ready(function()
	{
		$.validator.setDefaults(
		{
			submitHandler:function()
			{
				alert('Submited');
			}
		});

		$("#frm").validate(
		{
			rules:{
				username: "required",
				password:{
					required: true,
					minlength: 4
				}
			},

			messages:{
				username: "Please Enter Username",	
				password:{
					required: "Enter Your Password",
					minlength: "Enter Minimum 4 Character"
				},
			}
		});
	});*/
</script>
</html>