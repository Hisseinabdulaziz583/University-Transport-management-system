<?php

require '_functions.php';
require 'PHPMailer/PHPMailerAutoload.php';

$conn = db_connect();

if(!$conn)
    die("Oh Shoot!! Connection Failed");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset"]))
{
    $username = $_POST["username"];

    // Check if the username exists
    $user_exists = exist_user($conn, $username);

    if($user_exists)
    {
        $email = get_user_email($conn, $username);

        // Generate a random password reset token
        $token = uniqid();

        // Update the password reset token in the database
        $sql = "UPDATE `users` SET `password_reset_token`='$token' WHERE `user_name`='" . $username . "';";
        $result = mysqli_query($conn, $sql);

        if($result)
        {
            // Send the password reset email
            $mail = new PHPMailer();

            // Set the email address and password
            $mail->Username = "your_email_address";
            $mail->Password = "your_email_password";

            // Set the sender and recipient
            $mail->SetFrom("your_email_address", "Your Name");
            $mail->AddAddress($email, "Recipient Name");

            // Set the subject and body of the email
            $mail->Subject = "Password Reset";
            $mail->Body = "Hi,

You have requested a password reset. To reset your password, please click on the following link:

http://localhost/reset_password.php?token=$token

If you did not request a password reset, please ignore this email.

Thanks,
The Team";

            // Send the email
            if($mail->Send())
            {
                echo "A password reset email has been sent to your email address.";
            }
            else
            {
                echo "There was an error sending the email.";
            }
        }
    }
    else
    {
        echo "The username you entered does not exist.";
    }
}

?>
