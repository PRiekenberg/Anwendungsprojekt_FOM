<?php
	
	session_start();
	/*
	if (!isset($_SESSION['username'])) {
		die("<p>Kein Zugang<br/><a href='php/login.php'>Zum Login</a></p>");
	} 
	*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Virus zum Zusammenbauen">
        <link rel="stylesheet" media="screen" href="../css/frage.css">
    </head>
    <body>        
        <div id = "div_h1">
            	<h1><mode></h1>
        </div>
	<div id="div_logout">
            	<!--<a id ="logout" href="php/logout.php">Abmelden</a>-->
		<form>
                	<button id="button_logout" formaction="php/logout.php">Abmelden<br></button>
		</form>
        </div>
        <div id = "div_h2">
         	<h2><frage></h2>
        </div>
        <div id="div_gamescreen">
           	<div id="div_gamescreen_left">
            	</div>
            	<div id="div_gamescreen_center">
            	</div>
            	<div id="div_gamescreen_right">
            	</div> 
        </div>
        <div id="div_hinweis">
            	<a id ="hinweis">
                	Hinweis!
                	<br>
                	Dies ist keine Webseite um einen echten Virus zu bauen!
            	</a>
        </div>
        <div id ="div_copyright">
            	<a id="copyrigth">
                	&copy Gruppe 7: Virus zum zusammenbauen
            	</a>
	</div>
    </body>
</html> 
