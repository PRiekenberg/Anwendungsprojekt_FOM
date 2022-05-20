<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';
  session_start();
  if(isset($_POST['submit'])) {
      $login_result = checkCredentials(strtolower($_POST['username']),$_POST['password']);
  }
  
?>

<!DOCTYPE html> 
<html> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" media="screen" href="../css/login.css">
        <title>Login</title>  
    </head> 

    <body>
        <!--
        <div id="loginform" align="center" class="form-style-8">
        <h2>Einloggen</h2>
        <form action="" method="post">
            <input type="username" name="username" placeholder="Benutzername" />
            <input type="password" name="password" placeholder="Passwort" />
            <input type="submit" name="submit" value="Abschicken" />
        </form>
        -->
        <!--<p><a href="login/register.php">Registrieren</a></p>-->
        <!--
        </div> 
        -->

        <div id = "div_login">
            <h1> Virus zum Zusammenbauen </h1>
            <form action="" method="post">
                <input id="username" name="username" type="username" placeholder="Benutzername" />
                <br>
                <br>
                <input id="password" name="password" type="password" placeholder="Passwort" />
                <br>
                <br>
                <div id = "div_login_button">
                    <input type="submit" name ="submit" id="login" value="Login"/><br>
                </div>
                <a id = "login_result">
                    <?php 
                        if ( $login_result == 0 ){
                            echo "Zugangsdaten fehlerhaft!";
                        } 
                    ?> 
                </a>
                <div id = "div_login_img">
                    <img id="img_lock" src="../images/lock_icon.jpg"/>
                </div>
            </form>
        </div>

    </body>
</html>
