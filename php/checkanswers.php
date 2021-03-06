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
        <meta name="description" content="Your state of knowledge - Attention! It's serious">
        <link rel="stylesheet" media="screen" href="/css/checkanswers.css">
		<link rel="icon" href="/images/malware_icon.png">
    </head>
    <body>
        <?php
			$scenarioName 	= getScenarioName($_SESSION['scenarioid']);
			$questionContent= getQuestionContent($_SESSION['scenarioid'], $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase']);
		
            $gegebeneantworten=[$_POST['antwort1'],$_POST['antwort2'],$_POST['antwort3'],$_POST['antwort4'],$_POST['antwort5']];
            //hole alle Fragen
            $question=queryQuestion($_GET['scenarioid'],$_GET['phase']);
            $answers=queryAnswers($_SESSION['scenarioid'],$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase']);
            //hole alle richtigen Antworten für die Phase und das Szenario
            $result=queryRightAnswers($_SESSION['scenarioid'],$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase']);
            //erstelle leeren Array für die richtigen Antworten
            $richtigeantworten=[];
            //schreibe richtige Antworten in den Array
            foreach ($result as $r){
                array_push($richtigeantworten, $r['answercontent']);
            }
			//Erstelle Kopie für späteren Einsatz beim Anzeigen des Ergebnisses
			$richtigeantworten2 = $richtigeantworten;

            $fehlergemacht = 0;

			foreach($gegebeneantworten as $antwort) {
                //prüfe ob gegebene Antwort in Array mit richtigen Antworten

                if ($antwort != null) {
                    
                    //punkte für die aktuelle Antwort abrufen ---- hat allerdings keine Verwendung
                    $answerpoints = queryAnswersPoints($_SESSION['scenarioid'],$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'],$antwort);

                    if (($key = array_search($antwort, $richtigeantworten)) !== false) {
                        unset($richtigeantworten[$key]);
                        setUserPoints($_SESSION['scenarioid'],10,$_SESSION['username']);
                    } else {
                        $fehlergemacht=1;

                        setUserPoints($_SESSION['scenarioid'],-5,$_SESSION['username']);
                    }
                } 
            }
              
			//nicht alle richtigen Antworten waren dabei
			if (count($richtigeantworten) > 0) {
				$punkte=count($richtigeantworten)*-5;
				setUserPoints($_SESSION['scenarioid'], $punkte, $_SESSION['username']);
			} 

			$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'] = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'] + 1;

			$new_phase = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'];
			$scenarioid = $_SESSION['scenarioid'];

			setUserPhase($scenarioid,$_SESSION['username'],$new_phase);
        ?>

		<div id="div_menu">
			<form>
				<button id="button_menu" formaction="../index.php">Menü<br></button>
			</form>
		</div>
		<div id = "div_h1">
			<h1>
				<?php
					echo $questionContent ; 
				?>
			</h1>
		</div>
		<div id="div_logout">
			<form>
				<button id="button_logout" formaction="/php/logout.php">Abmelden<br></button>
			</form>
		</div>
		<div id = "div_h2">
			<h2>	
				<?php
					echo 'Szenario: ';
					echo $scenarioName ;
				?>
			</h2>
		</div>
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
					<?php
						echo '<div id="div_button_next">';
						echo '<form action="/php/frage.php" method="post">';
							
							echo '<input type="hidden"';
							echo 'name="scenarioid"';
							echo 'value="'.$scenarioid; echo'">';
							echo '<input type="hidden"';
							echo 'name="phase"';
							echo 'value="'.$new_phase; echo '">';
						
							echo '<input type="submit" id="button_next"
									value="nächste Frage">';
							echo '</form>';
						echo '</div>'; 

					
						$counter=1;
						foreach ($answers as $a){
							$explanation = queryExplanationforAnswers($a['answercontent']);
							$anserstate = $a['answerstate'];
							
							if ($counter == 1) {
								echo '<div class="explanation '.$counter; echo '" id ="div_explanation'.$counter; echo '"';
								//Wenn Antwort gechecked wurde
								if (in_array($a['answercontent'], $gegebeneantworten)){
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig! : '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch! : '.$explanation;echo '</p>';
									}
								}
								//Antwort wurde nicht gechecked
								else{
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig! : '.$explanation;echo '</p>';
									}
								}
								echo '</div>';
								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '"';
								//Markiere gegebene Antwort
								if (in_array($a['answercontent'], $gegebeneantworten)){
									echo ' style="background-color: #249B3C"';
								}
								echo '>';

								echo '<label> ';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
								echo '</div>';
								echo '<div id="div_gamescreen_center">';
							} if ($counter == 2 or $counter == 3) {

								echo '<div class="explanation '.$counter; echo '" id ="div_explanation'.$counter; echo '"';
								//Wenn Antwort gechecked wurde
								if (in_array($a['answercontent'], $gegebeneantworten)){
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
								}
								//Antwort wurde nicht gechecked
								else{
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
								}
								echo '</div>';

								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '"';
								//Markiere gegebene Antwort
								if (in_array($a['answercontent'], $gegebeneantworten)){
									echo ' style="background-color: #249B3C"';
								}
								echo '>';
								echo '<label>';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
							} if ($counter == 4) {
								echo '</div>';
								echo '<div id="div_gamescreen_right">';

								echo '<div class="explanation '.$counter; echo '" id ="div_explanation'.$counter; echo '"';
								//Wenn Antwort gechecked wurde
								if (in_array($a['answercontent'], $gegebeneantworten)){
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
								}
								//Antwort wurde nicht gechecked
								else{
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
								}
								echo '</div>';

								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '"';
								//Markiere gegebene Antwort
								if (in_array($a['answercontent'], $gegebeneantworten)){
									echo ' style="background-color: #249B3C"';
								}
								echo '>';
								echo '<label>';
								echo '<input name="antwort'. $counter; echo '" id="antwort'. $counter; echo '" type="checkbox" value="'. $a['answercontent']; echo '"><span>'. $a['answercontent']; echo '</span>';
								echo '</label>';
								echo '</div>';
							} if ($counter == 5) {

								echo '<div class="explanation '.$counter; echo '" id ="div_explanation'.$counter; echo '"';
								//Wenn Antwort gechecked wurde
								if (in_array($a['answercontent'], $gegebeneantworten)){
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
								}
								//Antwort wurde nicht gechecked
								else{
									//Antwort gehört zu richtigen Antworten
									if (in_array($a['answercontent'], $richtigeantworten2)){ //Falsch
										echo ' style="background-color:#88001B">';
										echo '<p id="explanation">Falsch!: '.$explanation;echo '</p>';
									}
									//Anwort gehört zu falschen Antworten
									else{	//Korrekt
										echo ' style="background-color:#249B3C">';
										echo '<p id="explanation">Richtig!: '.$explanation;echo '</p>';
									}
								}
								echo '</div>';

								echo '<div class="antwort '.$counter; echo '" id ="div_antwort'.$counter; echo '"';
								//Markiere gegebene Antwort
								if (in_array($a['answercontent'], $gegebeneantworten)){
									echo ' style="background-color: #249B3C"';
								}
								echo '>';
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
		<div id="div_hinweis">
			<a id ="hinweis">
				Hinweis!
				<br>
				Dies ist nur ein Quiz!
			</a>
		</div>
		<div id ="div_copyright">
			<a id="copyrigth">
				&copy Your state of knowledge - Attention! It's serious
			</a>
		</div>

    </body>