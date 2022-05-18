<?php
    require_once 'functions.php';
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Virus zum Zusammenbauen">
        <link rel="stylesheet" media="screen" href="css/stylesheet.css">
    </head>
    <body>
        <?php
            //hole alle Fragen für die Phase und das Szenario
            $result=queryRightAnswers($_SESSION['scenarioid'],$_SESSION['phase']);

            //erstelle leeren Array für die richtigen Antworten
            $richtigeantworten=[];
            $gegebeneantworten=[$_POST['antwort1'],$_POST['antwort2'],$_POST['antwort3'],$_POST['antwort4']];

            foreach ($result as $r){
                array_push($richtigeantworten, $r['answercontent']);
            }


            echo '<h1>Gegebene Antworten:</h1>';
            echo 'Scenarioid: '.$_SESSION['scenarioid'];
            echo '<br><br>';
            echo 'phase'.$_SESSION['phase'];
            echo '<br><br>';
            echo 'Antwort 1: '.$_POST['antwort1'];
            echo '<br><br>';
            echo 'Antwort 2: '.$_POST['antwort2'];
            echo '<br><br>';
            echo 'Antwort 3: '.$_POST['antwort3'];
            echo '<br><br>';
            echo 'Antwort 4: '.$_POST['antwort4'];
            echo '<br><br>';


            echo '<h1>Auswertung:</h1>';
            $counter=1;
            foreach($gegebeneantworten as $antwort) {
                //prüfe ob Post Value in Array 
                if (($key = array_search($antwort, $richtigeantworten)) !== false) {
                    unset($richtigeantworten[$key]);
                    echo 'Antwort '.$counter; echo ' war richtig!';
                } else {
                    echo 'Antwort '.$counter; echo ' war falsch!';
                }
                echo '<br><br>';
                $counter++;
              } if (count($richtigeantworten) > 0) {
                  echo 'Sie haben '.count($richtigeantworten); echo ' richtige Antworten vergessen';
              } else {
                  echo 'Alle richtigen Antworten wurden angegeben!';
              }
        ?>
    </body>