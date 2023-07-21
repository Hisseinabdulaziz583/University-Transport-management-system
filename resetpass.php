<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>password reset</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="p">
 <form action="resset.php" method="post">
    <div class="imgcontainer">
      <img src="ccc.png" alt="Avatar" class="avatar">
    </div>
    
    <div class="container">
  <label for="email"><b>User name</b></label>
      <input type="text" placeholder="Enter Username" name="mail" required><br>

      <button onclick="window.location.href='comfirm.php';">
            
            <a href="forgot.php" style="color: white">submit</a>
          </button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    </form>
</div>
    
    <main>

     
    
    </main>
    <footer>
      <p>&copy; 2023 CUEA Transport Management </p>
    </footer>
  </body>
</html>
