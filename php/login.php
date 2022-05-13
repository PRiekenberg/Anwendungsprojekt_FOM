<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';

  if(isset($_POST['submit'])) {
      checkCredentials(strtolower($_POST['username']),$_POST['password']);
  }
  
?>

<!DOCTYPE html> 
<html> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>  
    </head> 

    <body style="margin-top: 50px; margin-left: 100px">
    
        
        <div id="loginform" align="center" class="form-style-8">
        <h2>Einloggen</h2>
        <form action="" method="post">
            <input type="username" name="username" placeholder="Benutzername" />
            <input type="password" name="password" placeholder="Passwort" />
            <input type="submit" name="submit" value="Abschicken" />
        </form>
        
        <!--<p><a href="login/register.php">Registrieren</a></p>-->
        </div> 
    </body>
</html>
