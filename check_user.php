<?php
    require 'database.php';

    function getAvailability()
    {
        $connection = getConnection();

    /*    if(isset($_POST['check_available']))
        {
            $check_available = $_POST['check_available'];
            if(strlen($check_available) >= 4)
            {
                $query = 'SELECT check_available FROM reg_form WHERE check_available = :username';
                //$result = $connection->query($query);
                $result = $connection->prepare($query);
				$result->execute(array('check_available' => $_POST['check_available']));
                $count = $result->rowCount();

                if($count > 0)
                {
                    echo '<i>Username Already Taken</i>';
                }
                else
                {
                    echo '<i>Username is Available</i>';
                }
            }
            else
            {
                echo '<i>Please Enter Morthan 4 Character</i>';
            }
        }
        else
        {
            header('location: login.php');
        }*/

        if($_POST)
        {
            $username = trim(strip_tags($_POST['username']));
            $statement = $connection->prepare('SELECT username FROM register_form WHERE username = :username');
            $statement->execute(array(':username' => $username));
            $count = $statement->rowCount(); 
            if($count > 0)
            {
                echo "<span style='color: #e80000;'>SORRY! Username already taken.</span>";
            }
            else
            {
                echo "<span style='color: green;'>CONGRATULATIONS! Username is available.</span>";
            }
        }
    }

    $validate = getAvailability();
?>