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
        <link rel="stylesheet" media="screen" href="css/stylesheet.css">
        <link rel="icon" href="/images/malware_icon.png">
    </head>
    <body>
        <?php

            $gegebeneantworten=[$_POST['antwort1'],$_POST['antwort2'],$_POST['antwort3'],$_POST['antwort4'],$_POST['antwort5']];

            //hole alle Fragen für die Phase und das Szenario
            $result=queryRightAnswers($_SESSION['scenarioid'],$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase']);
            //erstelle leeren Array für die richtigen Antworten
            $richtigeantworten=[];
            //schreibe richtige Antworten in den Array
            foreach ($result as $r){
                array_push($richtigeantworten, $r['answercontent']);
            }

            $fehlergemacht = 0;

            echo '<h1>Auswertung:</h1>';
            foreach($gegebeneantworten as $antwort) {
                //prüfe ob gegebene Antwort in Array mit richtigen Antworten

                if ($antwort != null) {
                    
                    //punkte für die aktuelle Antwort abrufen
                    $answerpoints = queryAnswersPoints($_SESSION['scenarioid'],$_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'],$antwort);
                    $explanation=queryExplanationforAnswers($answer);

                    if (($key = array_search($antwort, $richtigeantworten)) !== false) {
                        unset($richtigeantworten[$key]);
                        echo 'Antwort "'.$antwort; echo '" war richtig!';
                        echo'<br>';
                        echo 'Hier werden '.$answerpoints; echo' punkte hinzugefügt!';
                        echo 'Hier ist die Erlärung zu der Antwort: '.$explanation;
                        setUserPoints($_SESSION['scenarioid'],10,$_SESSION['username']);
                    } else {
                        echo 'Antwort "'.$antwort; echo '" war falsch!';
                        echo'<br>';
                        echo 'Hier werden 5 punkte abgezogen!';
                        echo 'Hier ist die Erlärung zu der Antwort: '.$explanation;
                        $fehlergemacht=1;

                        setUserPoints($_SESSION['scenarioid'],-5,$_SESSION['username']);
                    }
                    echo '<br><br>';
                } 
            }
              
              //nicht alle richtigen Antworten waren dabei
              if (count($richtigeantworten) > 0) {
                  echo 'Sie haben '.count($richtigeantworten); echo ' richtige Antworten vergessen';
                  echo'<br>';
                  echo 'Hier werden '.count($richtigeantworten);echo' * 5 punkte abgezogen!';
                  $punkte=count($richtigeantworten)*-5;
                  setUserPoints($_SESSION['scenarioid'], $punkte, $_SESSION['username']);

                  echo '<div id="div_tryagain">';
				  echo '<form action="/php/frage.php">';
					$new_phase = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'];
					$scenarioid = $_SESSION['scenarioid'];
					echo '<input type="hidden"';
					echo 'name="scenarioid"';
					echo 'value="'.$scenarioid; echo'">';
					echo '<input type="hidden"';
					echo 'name="phase"';
					echo 'value="'.$new_phase; echo '">';
				
					echo '<input type="submit" id="button_next"
							value="Nochmal probieren">';
					echo '</form>';
			      echo '</div>';
              } 

              // alle richtigen Antworten waren dabei aber es wurden auch falsche angekreuzt
              if (count($richtigeantworten) == 0 and $fehlergemacht == 1) {
                echo 'Alle richtigen antworten wurden angegeben, aber es waren auch falsche dabei!';

                echo '<div id="div_tryagain">';
                echo '<form action="/php/frage.php">';
                  $new_phase = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'];
                  $scenarioid = $_SESSION['scenarioid'];
                  echo '<input type="hidden"';
                  echo 'name="scenarioid"';
                  echo 'value="'.$scenarioid; echo'">';
                  echo '<input type="hidden"';
                  echo 'name="phase"';
                  echo 'value="'.$new_phase; echo '">';
              
                  echo '<input type="submit" id="button_next"
                          value="Nochmal probieren">';
                  echo '</form>';
                echo '</div>';
              }
              
              // alle richtigen Antworten waren dabei und es wurden keine falschen angekreuzt
              if (count($richtigeantworten) == 0 and $fehlergemacht == 0) {
                  echo 'Alles richtig!';

                  echo '<div id="div_nextphase">';
                  echo '<form action="/php/frage.php">';
                      $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'] = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'] + 1;

                      $new_phase = $_SESSION['scenario'.$_SESSION['scenarioid'].'_phase'];
                      $scenarioid = $_SESSION['scenarioid'];

                      setUserPhase($scenarioid,$_SESSION['username'],$new_phase);
                      
                      echo '<input type="hidden"';
                      echo 'name="scenarioid"';
                      echo 'value="'.$scenarioid; echo'">';
                      echo '<input type="hidden"';
                      echo 'name="phase"';
                      echo 'value="'.$new_phase; echo '">';
                  
                      echo '<input type="submit" id="button_next"
                              value="Weiter zur nächsten Frage">';
                      echo '</form>';
                  echo '</div>';

              }

        ?>
    </body>