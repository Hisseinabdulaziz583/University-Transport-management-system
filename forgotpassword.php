<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
<script type="text/javascript" src="validate.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body style="background-color:#E6E6FA;">
  <center><img src="logo.jpeg" style="height: 150px; height: 150px;   border-radius:75px;"> </center>
  <form class="form" method="post" name="verification" onsubmit="return validateFormVerification()">

        <h1 class="login-title">RESET PASSWORD</h1>
        
        <p> <input type="email" class="login-input" name="email" placeholder="Email" autofocus="true" /></p>
        <p id="emailval"></p>
        <input type="submit" value="Send Code" name="sendcode" class="login-button"/><br><br>
        <p class="link"><a href="index.php">cancel</a></p>
  </form>
  <?php
if(!$conn = mysqli_connect("localhost","root","","sbtbsphp")){

    die("could not connect");
  }

  if (isset($_POST['sendcode'])) {
    // code...
    $code = random_int(100000,999999);
    $email=$_POST["email"];
    $query    = "SELECT * FROM `login` WHERE email='$email'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
    addCodeToDB($email,$code);
    sendCode($email,$code);}
    else{
 echo "<script> alert('This is not registered') </script>";

header('Location: index.php');
    }
  }
  function addCodeToDB($email,$code){
$conn=$GLOBALS['conn'] ;
 $sql="UPDATE `login` SET verification='$code' WHERE email='$email'";
 if (mysqli_query($conn,$sql)) {
    // code...
$_SESSION["email"] = $email;
header('Location: forgetpassword_login.php');

  
  }
  else{
      echo "<script> alert('Could not send verification code') </script>";
  }


  }
  function sendCode($email,$code){
require 'PHPMailerAutoload.php';

require 'credentials.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'CUEA TRANSPORT');
$mail->addAddress($email);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(EMAIL );
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Verification code';
$mail->Body    = 'Your Verification code is <b>'.$code.'</b>';
$mail->AltBody = 'Enter the code then Create New Password';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
  }
  ?>
  </body>
</html>
