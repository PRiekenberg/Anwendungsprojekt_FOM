<?php
	require_once 'functions.php';
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: /php/login.php");
		exit();
	} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Virus zum Zusammenbauen">
        <link rel="stylesheet" media="screen" href="../css/ende.css">
	<link rel="icon" href="/images/malware_icon.png">
        <title>Ende</title>

    </head>
    <body>
		<div id="div_menu">
			<form>
				<button id="button_menu" formaction="../index.php">Menü<br></button>
			</form>
		</div>
		<div id = "div_h1">
			<h1>Herzlichen Glückwunsch!</h1>
        </div>
        <div id = "div_h2">
			<?php
				echo '<h2>'; 
				echo 'Sie haben '; 
				echo .getUserPoints($_SESSION['scenarioid'],$_SESSION['username']); 
				echo ' Punkte erreicht!';
				echo '</h2>';
			?>
	    </div>
		<div id="div_logout">
			<form>
				<button id="button_logout" formaction="/php/logout.php">Abmelden<br></button>
			</form>
		</div>
		<div id="div_gamescreen">
            <div id="div_bestenliste">
				<form>
					<button id="button_bestenliste" formaction="/php/bestenliste.php">Bestenliste<br></button>
				</form>
			</div>

			<div id="div_reset">
				<form>
					<button id="button_logout" formaction="../index.php">Reset<br></button>
				</form>
			<div>
        </div>  		
		<div id="div_hinweis">
			<a id ="hinweis">
				Hinweis!
				<br>
				Dies ist keine Webseite um einen echten Virus zu bauen!
			</a>
		</div>
		<div id ="div_copyright">
			<a id="copyright">
				&copy Gruppe 7: Virus zum zusammenbauen
			</a>
		</div>
		
    </body>
</html> 
