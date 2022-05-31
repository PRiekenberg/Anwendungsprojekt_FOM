<?php
	require_once 'functions.php';
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: /php/login.php");
		exit();
	}
	$UserPoints = getUserPoints($_SESSION['scenarioid'],$_SESSION['username']); ;
	resetUserPhase($_SESSION['scenarioid'], $_SESSION['username']);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Virus zum Zusammenbauen">
        <link rel="stylesheet" media="screen" href="/css/ende.css">
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
            <h2>
		    Sie haben 
		    <?php
			echo $UserPoints; 
		    ?>
		    Punkte erreicht!
	    </h2>
	    </div>
		<div id="div_logout">
			<form>
					<button id="button_logout" formaction="/php/logout.php">Abmelden<br></button>
			</form>
		</div>
		<div id="div_gamescreen">
			<!--<div id="div_reset">
				<form method="post">
						<button id="button_reset" name="button_reset" value="button_reset">In Bestenliste eintragen und zurücksetzen<br></button>
				</form>
			</div>-->
			<div id="div_leaderboard">
				<form>
						<?php 
							echo'<table>';
							    echo'<thead>';
								echo '<tr>';
								    echo '<th>Platzierung</td>';
								    echo '<th>Username</td>';
								    echo '<th>Punktzahl</td>';
								    echo '<th>Zeitstempel</td>';
								echo '</tr>';
							    echo '</thead>';

							    echo '<tbody>';

								$result = getUsersPointsforScenario($_SESSION['scenarioid']);

								$counter=1;
								foreach ($result as $r){

									echo '<tr>';
									echo '<td>' . $counter; echo '</td>';  
									echo '<td>' . $r['username']; echo '</td>';  
									echo '<td>' . $r['points']; echo '</td>';
									echo '<td>' . $r['timestamp']; echo '</td>';
									echo '</tr>';
									$counter++;
									
									if ($counter == 11){
										break;
									}

								}

							    echo '</tbody>';
							echo '</table>';
						?>
						
				</form>
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
			<a id="copyright">
				&copy Gruppe 7: Virus zum zusammenbauen
			</a>
		</div>
		
    </body>
</html> 
