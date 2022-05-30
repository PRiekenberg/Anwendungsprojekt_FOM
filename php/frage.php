<?php
	require_once 'functions.php';
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: /php/login.php");
		exit();
	} 
	

	$question=queryQuestion($_GET['scenarioid'],$_GET['phase']);
	$answers=queryAnswers($_GET['scenarioid'],$_GET['phase']);
	$_SESSION['scenarioid'] = $_GET['scenarioid'];
	$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'] = $_GET ['phase'];

	$szenarioid 	= $_GET['scenarioid'];
	$phase 			= getUsersPhases($_SESSION['username'],$scenarioid);
	$szenarioName 	= getSzenarioName($scenarioid);
	$questionContent= getQuestionContent($scenarioid, $phase);

	//wenn keine Fragen mehr im Szenario vorhanden sind
	if ($question -> isDead()){
		//die ('
		//<div align="center">
		//<h1>Es sind keine Fragen in dem Szenario mehr vorhanden</h1>
		//<br><br>
		//<form>
        //        	<button id="button_homescreen" formaction="/index.php">Zurück zur Startseite<br></button>
		//</form>
		//<form>
        //        	<button id="button_homescreen" formaction="/php/bestenliste.php">Zur Bestenliste für dieses Szenario<br></button>
		//</form>
		//</div>
		//');
		header("Location: /php/error.php");
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
        <link rel="stylesheet" media="screen" href="/css/frage.css">
		<link rel="icon" href="/images/malware_icon.png">
    </head>
    <body>
		<div id="div_menu">
			<form>
				<button id="button_menu" formaction="../index.php">Menü<br></button>
			</form>
		</div>
		<div id = "div_h1">
			<h1>
				<?php
					echo $szenarioName;
				?>
			</h1>
		</div>
		<div id="div_logout">
			<form>
				<button id="button_logout" formaction="/php/logout.php">Abmelden<br></button>
			</form>
		</div>
		<div id = "div_h2">
				<?php
					echo $questionContent;
				?>
		</div>
		<form method="post" action="checkanswers.php">
			<div id="div_gamescreen">
				<div id="div_gamescreen_left">
					<div id ="div_bild1">
						<img id="bild1" src="../images/hacker.jpeg" alt="bild1">
					</div>
					<div id = "div_aktuellepunktzahl">
						<?php
							echo '<a id ="aktuellepunktzahl">';
							echo 'Benutzer: '.$_SESSION['username']; 
							echo '<br>';
							echo'Punkte: '.getUserPoints($_SESSION['scenarioid'],$_SESSION['username']); 
							echo '</a>';
						?>
					</div>
					<div id="div_button_checkanswers">
						<!--<input name="button_checkbutton" id="checkbutton" type="submit" value="Antworten prüfen"></input>-->
						<button id="button_checkanswers" name="checkanswers">Antworten prüfen<br></button>
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
							} if ($counter == 5) {
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
