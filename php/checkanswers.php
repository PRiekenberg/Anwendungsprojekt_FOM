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
            echo '<h1>Richtige Antworten für diese Frage:</h1>';
            foreach ($result as $r){
                echo $r['answercontent'];
                echo '<br><br>';
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
        ?>
    </body>