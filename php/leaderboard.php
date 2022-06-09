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
        <link rel="icon" href="/images/malware_icon.png">
    </head>
    <body>

        <?php 
            echo '<div align="center">';
                echo'<h1>Bestenliste Szenario '.$_SESSION['scenarioid'];echo'</h1>';
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
                            
                        }

                    echo '</tbody>';
                echo '</table>';
                echo '<br><br>';
		        echo '<form>';
                	echo '<button id="button_homescreen" formaction="/index.php">Zurück zur Startseite<br></button>';
		        echo '</form>';
            echo '</div>';
        ?>
    </body>