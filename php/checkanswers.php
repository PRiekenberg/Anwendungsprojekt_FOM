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
            echo 'Antwort 1:'.$_POST['antwort1'];
            echo 'Antwort 2:'.$_POST['antwort2'];
            echo 'Antwort 3:'.$_POST['antwort2'];
            echo 'Antwort 4:'.$_POST['antwort2'];
        ?>
    </body>