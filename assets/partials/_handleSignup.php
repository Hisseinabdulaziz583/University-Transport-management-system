<?php
    require '_functions.php';

    $conn = db_connect();

    if(!$conn)
        die("Oh Shoot!! Connection Failed");

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"]))
    {
        // echo "<pre>";
        // var_export($_POST);
        // echo "</pre>";

        $fullName = $_POST["firstName"] . " " . $_POST["lastName"];
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $email=$_POST["email"];

        // Check if the username already exists
        $user_exists = exist_user($conn, $username);
        $signup_sucess = false;

        if(!$user_exists)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_fullname`, `user_password`, `user_created`, `email`) VALUES ('$username', '$fullName', '$hash', current_timestamp(), '$email');";

            $result = mysqli_query($conn, $sql);
            
            if($result)
                $signup_sucess = true;
        }

        // Redirect Page
        header("location: ../../index.php");

echo "<pre>";
var_export($_POST);
echo "</pre>";

    }

?>
