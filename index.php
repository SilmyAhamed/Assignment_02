<?php 
	session_start();
	require 'models.php';

	function getMenu()
	{
		$connection = getConnection();

		$query = 'SELECT * FROM menu WHERE id = 3';
		return $result = $connection->query($query);
	}

	$displayNews = displayNews();
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
						<a class="nav-link text-white" href="home.php"><?php if(isset($_SESSION['username'])){ echo 'Home';} ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="index.php"><?php echo $data['title']; ?> <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<?php if(isset($_SESSION['username'])){ echo '<a class="nav-link text-white" href="logout.php">Logout</a>';} else{echo '<a class="nav-link text-white" href="login.php">Login</a>';} ?>
					</li>
				</ul>
		<!--	<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0 text-white border-light" type="submit">Search</button>
				</form>-->
			</div>
		</nav>
	<?php endforeach; ?>	

	<!-- Display news through Database -->
	<?php foreach($displayNews as $rows): ?>
		<div class="mt-5 mb-5">
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-center" style="background-color: #ff8080; font-weight: ; font-size: 20px;">
					<?php echo $rows->title; ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-justify" style="background-color: #ffcccc;">
					<?php echo $rows->content; ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-right" style="background-color: #ffcccc;">
					<?php 
						//extract($rows); 
						//$imageLocation = '01.jpg';
					?>
					<img src="uploads/<?php echo /*$imageLocation;*/ $rows->image; ?>" height="200" alt="" />
					<div class="mt-1 text-left">
						<a href="readmore.php?id=<?php echo $rows->id; ?>">Read more</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

</body>
</html>