<?php
	require_once 'functions.php';
	session_start();
	
	if (!isset($_SESSION['username'])) {
		die("<p>Kein Zugang<br/><a href='/php/login.php'>Zum Login</a></p>");
	} 
	

	$question=queryQuestion($_GET['scenarioid'],$_GET['phase']);
	$answers=queryAnswers($_GET['scenarioid'],$_GET['phase']);
	$_SESSION['scenarioid'] = $_GET['scenarioid'];
	$_SESSION['phase'] = $_GET ['phase'];

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
						<button id="button_logout" formaction="/php/logout.php">Abmelden<br></button>
			</form>
		</div>
		<div id = "div_h2">
				<?php
					foreach ($question as $q) {
						echo '<h2>' . $q['questioncontent']; echo '</h2>';
					}
				?>
		</div>
		<div id = "aktuellepunktzahl">
			<?php
				echo '<h3>Aktuelle Punkzahl für den Benutzer '.$_SESSION['username']; echo': '.getUserPoints($_SESSION['scenarioid'],$_SESSION['username']); echo ' für dieses Szenario</h3>';
			?>
		</div>
		
		<form method="post" action="checkanswers.php">
			<div id="div_gamescreen">
				<div id="div_gamescreen_left">
					<div id ="div_bild1">
						<img id="bild1" src="../images/hacker.jpeg" alt="bild1">
					</div>

				
					<?php
						$counter=1;
						foreach ($answers as $a){
							
							if ($counter == 1) {
								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '">';
								echo '<label>';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
								echo '</div>';
								echo '<div id="div_gamescreen_center">';
							} if ($counter == 2 or $counter == 3) {
								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '">';
								echo '<label>';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
							} if ($counter == 4) {
								echo '</div>';
								echo '<div id="div_gamescreen_right">';
								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '">';
								echo '<label>';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
							} 
							$counter++;
						}
						
					?>
					<div id ="div_bild2">
						<img id="bild2" src="../images/user.jpeg" alt="bild2">
					</div>
			</div> 
			<div id="button_checkantworten">
				<input name="checkbutton" id="checkbutton" type="submit" value="Antworten prüfen"></input>
			</div>
		</form>
		
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
