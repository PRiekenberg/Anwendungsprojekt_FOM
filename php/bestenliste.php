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
        <link rel="stylesheet" media="screen" href="/css/frage.css">
    </head>
    <body>

        <?php 
            echo'<table>';
                echo'<thead>';
                    echo '<tr>';
                        echo '<th>Platzierung</td>';
                        echo '<th>Username</td>';
                        echo '<th>Punktzahl</td>';
                    echo '</tr>';
                echo '</thead>';

                echo '<tbody>';
                    
                    $result = getallUsers();
                    // sortiere Datensätze nach der Punktzahl absteigend für diese Szenario
                    $result->sort(array('scenario'.$_SESSION['scenarioid'].'_points' => -1));
                    $counter=1;
                    foreach ($result as $r){
                        
                        //nur die Benutzer deren Punktzahl ungleich 0 ist
                        if ($r['scenario'.$_SESSION['scenarioid'].'_points'] != 0) {
                            echo '<tr>';
                            echo '<td>' . $counter; echo '</td>';  
                            echo '<td>' . $r['username']; echo '</td>';  
                            echo '<td>' . $r['scenario'.$_SESSION['scenarioid'].'_points']; echo '</td>'; 
                            echo '</tr>';
                            $counter++;
                        }
                    }

                echo '</tbody>';
			echo '</table>';
        ?>
    </body>