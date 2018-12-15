<?php 
	require 'models.php';
	session_start();

	$readmore = getReadmore();
 ?>		

<!DOCTYPE html>
<html>
<head>
	<title>Assignment 02</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

	<!-- Display news through Database -->
	<?php //foreach($readmore as $readmore): ?>
		<div class="mt-5 mb-5">
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-center" style="background-color: #ff8080; font-weight: ; font-size: 20px;">
                    <?php echo $readmore->title; ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-justify" style="background-color: #ffcccc;">
					<?php echo $readmore->full_content; ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="w-75 p-3 text-right" style="background-color: #ffcccc;">
					<img src="uploads/<?php echo $readmore->image; ?>" height="200" alt="" />
					<div class="mt-1 text-left">
						<a href="index.php">Go back</a>
					</div>
				</div>
			</div>
		</div>
	<?php //endforeach; ?>

</body>
</html>