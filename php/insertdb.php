<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';

  if (isset($_POST['scenarioid'])) {
    insertDocument($_POST['type'],
				   $_POST['questioncontent'],
				   $_POST['answercontent'],
				   $_POST['answerstate'],
				   $_POST['phase'],
				   $_POST['scenarioid']);
    printDocuments();
  }

  deleteallDocuments();

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Insertdata">
		<title>Daten einfügen</title>
	</head>
	<body>
		<div align="center" class="form-style-8">
			<h2>Daten einfügen</h2>
			<form id="form1" action="" method="post">
				<h3>Typ</h3>

				<h3><label for="type">Typ des Datenbankeintrags auswählen:</label></h3>
				<select id="type" name="type">
					<option value="question">Frage</option>
					<option value="answer">Antwort</option>
					<option value="user">Benutzer</option>
				</select>
				
				<h3>Inhalt Frage (nur bei Typ Frage angeben)</h3>
				<input id="questioncontent" type="text" name="questioncontent" placeholder="Frage eingeben" /><br><br>
				
				<h3>Inhalt Antwort (nur bei Typ Antwort angeben)</h3>
				<input id="answercontent" type="text" name="answercontent" placeholder="Antwort eingeben" /><br><br>
				
				<h3><label for="answerstate">Antwort Wahr oder Falsch? (nur bei Typ Antwort angeben)</label></h3>
				<select id="answerstate" name="answerstate">
					<option value="true">Wahr</option>
					<option value="false">Falsch</option>
				</select>

				<h3>Phase im Szenario? (nur bei Typ Frage oder Antwort angeben)</h3>
				<input id="phase" type="number" name="phase" placeholder="Phasennummer eintragen" /><br><br>

				<h3>Szenario ID (nur bei Typ Frage oder Antwort angeben)</h3>
				<input id="scenarioid" type="number" name="scenarioid" placeholder="ID des Szenarios" /><br><br>
				
				
				<input id="firebtn" type="submit" value="Daten in Datenbank speichern"></input>

			</form>
		
		</div>
	</body>
 </html>