<?php

    require 'database.php';

    // Display news in News page
    function displayNews()
	{
		$connection = getConnection();
		$query = 'SELECT * FROM news ORDER BY id DESC';
		$result = $connection->prepare($query);
		$result->execute();
		return $result->fetchAll(PDO::FETCH_OBJ);
		//return $result = $connection->query($query);
    }

    // Insert news in index page
	function insertNews()
	{
		$connection = getConnection();
		//$message = '';
		if(isset($_POST['submit']))
		{
			$title = $_POST['title'];
			$content = $_POST['content'];
			$full_content = $_POST['full_content'];
			//$image = $_POST['image'];
			$imageName = $_FILES['image']['name'];
			$imageTemDir = $_FILES['image']['tmp_name'];
			$imageSize = $_FILES['image']['size'];
			$imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf');

			if($title != "" && $content != "" && $full_content != "")
			{
				if(in_array($imageExt, $valid_extensions))
				{
					if($imageSize < 20000000)
					{
						$picProfile = rand(1000, 1000000).".".$imageExt;
						$upload_dir = 'uploads/'.$picProfile;
						move_uploaded_file($imageTemDir, $upload_dir);

						$query = 'INSERT INTO news(title, content, full_content, image) VALUES(:title, :content, :full_content, :image)';
						$result = $connection->prepare($query);
						//$result->bindParam(':image', $image);
						return $result->execute([':title' => $title, ':content' => $content, ':full_content' => $full_content, ':image' => $picProfile]);
					}
					else
					{
						//echo 'Your File is too big!';
					}
				}
				else
				{
					//$message = 'You cannot upload files of this format';
				}
			}
			else
			{
				//$message = 'Please fill all field';
			}
		}
	}
    
    // Login system
    function userLogin()
	{
		$connection = getConnection();
		if(isset($_POST['login']))
		{
			$username = strip_tags(trim($_POST['username']));
			$password = $_POST['password'];
			
			if($username != "" && $password != "")
			{
				$query = 'SELECT * FROM register_form WHERE username = :username AND password = :password';
				//$result = $connection->query($query);
				$result = $connection->prepare($query);
				$result->execute(array('username' => $_POST['username'], 'password' => sha1($_POST['password'])));
				$count = $result->rowCount();

				if($count > 0)
				{
					$_SESSION['username'] = $username;
                    header("location:admin.php");
				}
				else
				{
					//echo 'Invlid username or password';
				}
			}
		}
    }
    
    // Display each news as single in new page <readmore.php>
	function getReadmore()
	{
		$connection = getConnection();
        $id = $_GET['id'];
        $query = 'SELECT * FROM news WHERE id = :id';
		$result = $connection->prepare($query);
		$result->execute([':id' => $id]);
		return $result->fetch(PDO::FETCH_OBJ);
    }
    
    // Registration system
    function registrationForm()
    {
        $connection = getConnection();
        if(isset($_POST['submit']))
        {
            $username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$role = $_POST['role'];
            $dob = $_POST['dob'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if($username != "" && $email != "" && $dob != "" && $password != "" && $confirm_password != "")
            {
                if($password == $confirm_password)
                {
                    $query = 'INSERT INTO register_form(username, email, role, dob, password) VALUES(:username, :email, :role, :dob, :password)';
                    $result = $connection->prepare($query);
                    $result->execute([':username' => $username, ':email' => $email, ':role' => $role, ':dob' => $dob, ':password' => sha1($password)]);
					header('location: login.php');
				}
			}
        }
    }



?>