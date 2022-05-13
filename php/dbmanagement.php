<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';
  session_start();
	/* Kontrolle, ob innerhalb der Session */
  if (!isset($_SESSION['username'])) {
	die("<p>Kein Zugang<br/><a href='login.php'>Zum Login</a></p>");
  } 

  if (isset($_POST['scenarioid'])) {
    insertDocument($_POST['type'],
				   $_POST['questioncontent'],
				   $_POST['answercontent'],
				   $_POST['answerstate'],
				   $_POST['answerpoints'],
				   $_POST['phase'],
				   $_POST['scenarioid'],
				   $_POST['username'],
				   (password_hash($_POST['password'], PASSWORD_DEFAULT)));
  }
  
  if (isset($_POST['dbid'])) {
    deleteDocument($_POST['dbid']);
  } 
 
  if (isset($_POST['deleteallbtn'])) {
    deleteallDocuments();
  }

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Insertdata">
		<style>
			table, th, td {
			border: 1px solid;
			}
		</style>
		<title>Datenbankmanagement</title>
	</head>
	<body>
		<script src="../js/index.js"></script>
		<div align="center" class="form-style-8">
			<h2>Daten einfügen</h2>
			<form id="form1" action="" method="post">

				<h3><label for="type">Typ des Datenbankeintrags auswählen:</label></h3>
				<select id="type" name="type" onchange="selectCheck(this);">
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

				<h3>Anzahl Punkte (nur bei Typ Antwort angeben)</h3>
				<input id="answerpoints" type="number" name="answerpoints" placeholder="Anzahl Punkte eintragen" /><br><br>

				<h3>Phase im Szenario? (nur bei Typ Frage oder Antwort angeben)</h3>
				<input id="phase" type="number" name="phase" placeholder="Phasennummer eintragen" /><br><br>

				<h3>Szenario ID (nur bei Typ Frage oder Antwort angeben)</h3>
				<input id="scenarioid" type="number" name="scenarioid" placeholder="ID des Szenarios" /><br><br>
				
				<h3>Username (nur bei Typ Benutzer angeben)</h3>
				<input id="username" type="text" name="username" placeholder="Username eingeben" /><br><br>

				<h3>Passwort (nur bei Typ Benutzer angeben)</h3>
				<input id="password" type="text" name="password" placeholder="Passwort eingeben" /><br><br>

				<input id="firebtn" type="submit" value="Daten in Datenbank speichern"></input>

			</form>

			<br><br>
			<h2>Datenbankdaten</h2>

			<table>
				<thead>
				<tr>
					<th>ID</td>
					<th>Typ</td>
					<th>Frageninhalt</td>
					<th>Antwortinhalt</td>
					<th>Antwortstatus</td>
					<th>Antwortpunkte</td>
					<th>Phase im Szenario</td>
					<th>Szenario ID</td>
					<th>Username</td>
					<th>Passwort</td>
				</tr>
				</thead>

				<tbody>
				
				<?php 
					$result = getallDocuments();
					foreach ($result as $r){						
						echo '<tr>';
						echo '<td>' . $r['_id']; echo '</td>';  
						echo '<td>' . $r['type']; echo '</td>';  
						echo '<td>' . $r['questioncontent']; echo '</td>';  
						echo '<td>' . $r['answercontent']; echo '</td>';
						echo '<td>' . $r['answerstate']; echo '</td>';  
						echo '<td>' . $r['answerpoints']; echo '</td>'; 
						echo '<td>' . $r['phase']; echo '</td>'; 
						echo '<td>' . $r['scenarioid']; echo '</td>'; 
						echo '<td>' . $r['username']; echo '</td>';  
						echo '<td>' . $r['password']; echo '</td>'; 
						echo '</tr>';
					}

					?>
				</tbody>
			</table>
			
			<br><br>
			<h2> Daten mit bestimmter ID in Datenbank löschen</h2>
			<form method="post">
				<h3>ID des Datensatzes</h3>
				<input id="dbid" type="text" name="dbid" placeholder="ID eingeben" /><br><br>
				<input id="deletebtn" name="deletebtn" type="submit" value="Daten mit ID in der Datenbank löschen"></input>
			</form>

			<br><br>
			<h2> alle Daten in Datenbank löschen</h2>
			<form method="post">
				<input id="deleteallbtn" name="deleteallbtn" type="submit" value="Alle Daten in der Datenbank löschen" disabled="disabled"></input>
			</form>
			<br><br>
			<a id ="logout" href="logout.php">Abmelden</a>
		</div>

	</body>
 </html>