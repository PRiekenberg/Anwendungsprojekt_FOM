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
	<div id="div_menu">
            	<!--<a id ="logout" href="php/logout.php">Abmelden</a>-->
		<form>
                	<button id="button_menu" formaction="../index.php">Menü<br></button>
		</form>
        </div>
        <div id = "div_h1">
            	<h1>Modus</h1>
        </div>
	<div id="div_logout">
            	<!--<a id ="logout" href="php/logout.php">Abmelden</a>-->
		<form>
                	<button id="button_logout" formaction="php/logout.php">Abmelden<br></button>
		</form>
        </div>
        <div id = "div_h2">
         	<h2>Einleitende Frage</h2>
        </div>
        <div id="div_gamescreen">
           	<div id="div_gamescreen_left">
			<div id ="div_bild1">
				<img id="bild1" src="../images/hacker.jpeg" alt="bild1">
			</div>
			<div id ="div_frage1">
			</div>
            	</div>
            	<div id="div_gamescreen_center">
			<div id ="div_frage2">
			</div>
			<div id ="div_frage3">
			</div>
            	</div>
            	<div id="div_gamescreen_right">
			<div id ="div_bild2">
				<img id="bild2" src="../images/user.jpeg" alt="bild2">
			</div>
			<div id ="div_frage4">
			</div>
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