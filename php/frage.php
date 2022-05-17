<?php
	require_once 'functions.php';
	session_start();
	/*
	if (!isset($_SESSION['username'])) {
		die("<p>Kein Zugang<br/><a href='php/login.php'>Zum Login</a></p>");
	} 
	*/

	$question=queryQuestion($_GET['scenarioid'],$_GET['phase']);
	$answers=queryAnswers($_GET['scenarioid'],$_GET['phase']);


	if (isset($_POST['aw1'])) {
		
	}
	if (isset($_POST['aw2'])) {
		
	}
	if (isset($_POST['aw3'])) {
		
	}
	if (isset($_POST['aw4'])) {
	
	}

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
			<?php
				foreach ($question as $q) {
					echo '<h2>' . $q['questioncontent']; echo '</h2>';
				}
			?>
	</div>
	<div id="div_gamescreen">
		<div id="div_gamescreen_left">
		<div id ="div_bild1">
			<img id="bild1" src="../images/hacker.jpeg" alt="bild1">
		</div>

		<?php

			$counter=1;
			foreach ($answers as $a){
				
				if ($counter == 1) {
					echo '<div id ="div_antwort'.$counter; echo '">';
					echo '<form method="post" action="frage.php">';
					echo '<button id="button_antwort'.$counter; echo '" name="aw'.$counter; echo '">'. $a['answercontent']; echo '<br></button>';
					echo '<form>';
					echo '</div>';
					echo '</div>';
					echo '<div id="div_gamescreen_center">';
				} if ($counter == 2 or $counter == 3) {
					echo '<div id ="div_antwort'.$counter; echo '">';
					echo '<form method="post" action="frage.php">';
					echo '<button id="button_antwort'.$counter; echo '" name="aw'.$counter; echo '">'. $a['answercontent']; echo '<br></button>';
					echo '<form>';
					echo '</div>';
				} if ($counter == 4) {
					echo '</div>';
					echo '<div id="div_gamescreen_right">';
					echo '<div id ="div_antwort'.$counter; echo '">';
					echo '<form method="post" action="frage.php">';
					echo '<button id="button_antwort'.$counter; echo '" name="aw'.$counter; echo '">'. $a['answercontent']; echo '<br></button>';
					echo '<form>';
					echo '</div>';

				} 
				$counter++;
			}
		?>
			<!--
					<div id ="div_antwort1">
						<form method="post" action="frage.php">
							<button id="button_antwort1" name="aw1">Antwort1<br></button>
						<form>
					</div>
						</div>
						<div id="div_gamescreen_center">
					<div id ="div_antwort2">
						<form method="post" action="frage.php">
							<button id="button_antwort2" name="aw2">Antwort2<br></button>
						</form>
					</div>
					<div id ="div_antwort3">
						<form method="post" action="frage.php">
							<button id="button_antwort3" name="aw3">Antwort3<br></button>
						</form>
					</div>
						</div>
						<div id="div_gamescreen_right">
					<div id ="div_antwort4">
						<form method="post" action="">
							<input id="button_antwort4" type="submit" name="aw4">Antwort4<br></input>
						</form>
					</div>
			-->
		<div id ="div_bild2">
			<img id="bild2" src="../images/user.jpeg" alt="bild2">
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
	<div id="div_nextphase">
		<form action="frage.php">
			<?php
			$new_phase=$_GET['phase'] + 1;
			echo '<input type="hidden"';
			echo 'name="scenarioid"';
			echo 'value="'.$_GET['scenarioid'];echo'">';
			echo '<input type="hidden"';
			echo 'name="phase"';
			echo 'value="'.$new_phase; echo '">';
			?>
			<input type="submit" id="button_next" value="Weiter">
		</form>
	</div>
    </body>
</html> 
