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
                        echo '<th>ID</td>';
                        echo '<th>Typ</td>';
                        echo '<th>Username</td>';
                        echo '<th>Passwort</td>';
                        echo '<th>Szenario 1 Phase</td>';
                        echo '<th>Szenario 1 Punkte</td>';
                        echo '<th>Szenario 2 Phase</td>';
                        echo '<th>Szenario 2 Punkte</td>';
                        echo '<th>Szenario 3 Phase</td>';
                        echo '<th>Szenario 3 Punkte</td>';
                        echo '<th>Szenario 4 Phase</td>';
                        echo '<th>Szenario 4 Punkte</td>';
                        echo '<th>Szenario 5 Phase</td>';
                        echo '<th>Szenario 5 Punkte</td>';
                    echo '</tr>';
                echo '</thead>';

                echo '<tbody>';
                    
                    $result = getallUsers();
                    foreach ($result as $r){						
                        echo '<tr>';
                        echo '<td>' . $r['_id']; echo '</td>';  
                        echo '<td>' . $r['type']; echo '</td>';  
                        echo '<td>' . $r['username']; echo '</td>';  
                        echo '<td>' . $r['password']; echo '</td>'; 
                        echo '<td>' . $r['scenario1_phase']; echo '</td>'; 
                        echo '<td>' . $r['scenario1_points']; echo '</td>'; 
                        echo '<td>' . $r['scenario2_phase']; echo '</td>'; 
                        echo '<td>' . $r['scenario2_points']; echo '</td>'; 
                        echo '<td>' . $r['scenario3_phase']; echo '</td>'; 
                        echo '<td>' . $r['scenario3_points']; echo '</td>'; 
                        echo '<td>' . $r['scenario4_phase']; echo '</td>'; 
                        echo '<td>' . $r['scenario4_points']; echo '</td>'; 
                        echo '<td>' . $r['scenario5_phase']; echo '</td>'; 
                        echo '<td>' . $r['scenario5_points']; echo '</td>'; 
                        echo '</tr>';
                    }

                echo '</tbody>';
			echo '</table>';
        ?>
    </body>