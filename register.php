<?php
	session_start();
    require 'models.php';

    $registrationForm = registrationForm();
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
					<a class="nav-link text-warning" href="login.php">Login <span class="sr-only">(current)</span></a>
				</li>
			</ul>
	<!--	<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0 text-white border-light" type="submit">Search</button>
			</form> -->
		</div>
	</nav>

<div class="container mt-5">
	<form id="frm" action="register.php" method="post">
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
			<input type="text" name="username" class="form-control w-50 " id="username" required autocomplete="off" placeholder="Enter Username">
		</div>
		<span id="feedback"></span>
        <div class="form-group">
			<label for="exampleInputEmail">Email</label>
			<input type="email" name="email" class="form-control w-50" id="email" required autocomplete="off" placeholder="example@website.com">
		</div>
		<div class="form-group">
			<label for="exampleInputRole">Role</label>
			<select name="role" class="form-control w-50" id="role" required>
				<option value="admin">Admin</option>
				<option value="tester">Tester</option>
				<option value="designer">Designer</option>
				<option value="developer">Developer</option>
				<option value="engineer">Engineer</option>
			</select>
		</div>
        <div class="form-group">
			<label for="exampleInputPassword1">D.O.B</label>
			<input type="text" name="dob" class="form-control w-50" id="dob" required autocomplete="off" placeholder="YYYY/MM/DD">
		</div>
        <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" class="form-control w-50" id="password" required autocomplete="off" placeholder="Enter Password">
		</div>
        <div class="form-group">
			<label for="exampleInputPassword1">Confirm Password</label>
			<input type="password" name="confirm_password" class="form-control w-50" id="confirm_password" required autocomplete="off" placeholder="Enter Confirm Password">
		</div>
		<button type="submit" name="submit" id="submit" class="btn btn-primary">Register</button>
		<div class="mt-2 mb-5">Already Registered? <a href="login.php">Login</a></div>
	</form>
</div>

</body>
<script>
/*	$(document).ready(function()
	{
		$("#username").keyup(function()
		{
			$.post("check_user.php", {check_available: frm.username.value}, function(data)
			{
				$("#feedback").html(data);
			});
		});
	});*/

	$(document).ready(function()
	{    
		$("#username").keyup(function()
		{		
			var username = $(this).val();
 
			if(username.length > 3)
			{		
				$("#feedback").html('checking...');
				$.ajax(
				{
					type : 'POST',
					url  : 'check_user.php',
					data : $(this).serialize(),
					success : function(data) 
					{
					    $("#feedback").html(data);
					}
				});
				return false;
			} 
			else
			{
				$("#feedback").html('');
			}
		});
	});

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
				email:{
					required: true,
					email: true
				},
				dob:{
					required: true,
					date: true
				},
				password:{
					required: true,
					minlength: 4
				},
				confirm_password:{
					required: true,
					minlength: 4,
					equalTo: "#password"
				}
			},

			messages:{
				username: "Please Enter Your Name",
				email:{
					required: "Enter Email Address",
					email: "Enter Valid Id"
				},
				dob:{
					required: "Enter Date of Birth",
					date: "Enter Correct Format"
				},
				password:{
					required: "Enter Password",
					minlength: "Enter Minimum 4 Character"
				},
				confirm_password:{
					required: "Enter Confirm Password",
					minlength: "Enter Minimum 4 Character",
					equalTo: "Mismatch Password"
				}
			}
		});
	});*/
</script>
</html>