<?php 
	session_start();
	require 'models.php';

/*	if(isset(SESSION['username']))
	{
		header('location: home.php');
	}
	else
	{
		header('location: login.php');
	}*/

	function getMenu()
	{
		$connection = getConnection();

		$query = 'SELECT *FROM menu WHERE id = 2';
		return $result = $connection->query($query);
	}

	$insertNews = insertNews();
	$menu = getMenu();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignment 02</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
						 <a class="nav-link text-warning" href="home.php"><?php if(isset($_SESSION['username'])){ echo $data['title'];} ?> <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="index.php">News</a>
					</li>
					<li class="nav-item">
						<?php 
							if(isset($_SESSION['username']))
							{ 
								echo '<a class="nav-link text-white" href="#"></a>';
							}
							else
							{
								echo '<a class="nav-link text-white" href="login.php">Login</a>';
							}
						?>
					</li>
				</ul>
		<!--	<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0 text-white border-light" type="submit">Search</button>
				</form>-->
			</div>
		</nav>
	<?php endforeach; ?>

	<!-- Form for input the news into Database -->
	<div class="container">
		<form method="post" enctype="multipart/form-data">
			<?php if(!empty($message)): ?>
				<div class="alert alert-success container" role="alert"> 
					<?php //echo $message; ?>
				</div>
			<?php endif; ?>
				<div class="form-group">
					<label for="formGroupExampleInput">News Headline</label>
					<input type="text" class="form-control" id="formGroupExampleInput" name="title" placeholder="Enter the news title" required>
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput2">News Content</label>
					<textarea class="form-control" id="formGroupExampleInput2" name="content" placeholder="Enter the news" required></textarea>
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput2">News Content (full length)</label>
					<textarea class="form-control" id="formGroupExampleInput3" name="full_content" placeholder="Enter the full news" required></textarea>
				</div>
				<div class="form-group">
					<input type="file" class="" id="" name="image">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary ">Submit</button>
				</div>
				<div class="mt-2">You are logout here | <a href="logout.php">Logout</a></div>
		</form>
	</div>

</body>
</html>