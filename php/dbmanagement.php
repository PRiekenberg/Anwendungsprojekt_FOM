<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';
  session_start();
	/* Kontrolle, ob innerhalb der Session */
  if (!isset($_SESSION['username'])) {
	header("Location: /php/login.php");
	exit();
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

  echo 'applicaton setting:';
  echo getenv('connection_string');
  echo 'connection string';
  echo getenv(' CUSTOMCONNSTR_connection_string');

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Insertdata">
		<script src="../js/jquery.js"></script>
		<!--<link rel="stylesheet" media="screen" href="../css/stylesheet.css">-->
		<style>
			table, th, td {
			border: 1px solid;
			}
		</style>
		<title>Datenbankmanagement</title>
		<script>
			$(document).ready(function(){
				$('#type').change(function() {
					$('.select-default-hidden').hide();
					$('.select-default-shown').show();

					$('.select-' + $(this).val() + '-shown').show();
					$('.select-' + $(this).val() + '-hidden').hide();
				}).change();
			});
		</script>
	</head>
	<body>
		<script src="../js/index.js"></script>
		<div align="center" class="form-style-8">
			<h2>Daten einfügen</h2>
			<form id="form1" action="" method="post">

				<h3><label for="type">Typ des Datenbankeintrags auswählen:</label></h3>
				<select id="type" name="type">
					<option value="question">Frage</option>
					<option value="answer">Antwort</option>
					<option value="user">Benutzer</option>
				</select>
				<div id="questioncontentdiv" class="select-default-shown select-user-hidden select-answer-hidden">
					<h3>Inhalt Frage</h3>
					<input id="questioncontent" type="text" name="questioncontent" placeholder="Frage eingeben" /><br><br>
				</div>
				<div id="answercontentdiv" class="select-default-shown select-user-hidden select-question-hidden">
					<h3>Inhalt Antwort</h3>
					<input id="answercontent" type="text" name="answercontent" placeholder="Antwort eingeben" /><br><br>
				</div>
				<div id="answerstatediv" class="select-default-shown select-user-hidden select-question-hidden">
					<h3><label for="answerstate">Antwort Wahr oder Falsch?</label></h3>
					<select id="answerstate" name="answerstate">
						<option value="true">Wahr</option>
						<option value="false">Falsch</option>
					</select>
				</div>
				<div id="answerpointsdiv" class="select-default-shown select-user-hidden select-question-hidden">
					<h3>Anzahl Punkte</h3>
					<input id="answerpoints" type="number" name="answerpoints" placeholder="Anzahl Punkte eintragen" /><br><br>
				</div>
				<div id="phasediv" class="select-default-shown select-user-hidden">
					<h3>Phase im Szenario? </h3>
					<input id="phase" type="number" name="phase" placeholder="Phasennummer eintragen" /><br><br>
				</div>
				<div id="scenarioiddiv" class="select-default-shown select-user-hidden">
					<h3>Szenario ID</h3>
					<input id="scenarioid" type="number" name="scenarioid" placeholder="ID des Szenarios" /><br><br>
				</div>
				<div id="usernamediv" class="select-default-shown select-question-hidden select-answer-hidden">
					<h3>Username</h3>
					<input id="username" type="text" name="username" placeholder="Username eingeben" /><br><br>
				</div>
				<div id="passworddiv" class="select-default-shown select-question-hidden select-answer-hidden">
					<h3>Passwort</h3>
					<input id="password" type="text" name="password" placeholder="Passwort eingeben" /><br><br>
				</div>
				<input id="firebtn" type="submit" value="Daten in Datenbank speichern"></input>

			</form>

			<br><br>
			<h2>Fragen in der Datenbank</h2>

			<table>
				<thead>
				<tr>
					<th>ID</td>
					<th>Typ</td>
					<th>Frageninhalt</td>
					<th>Phase im Szenario</td>
					<th>Szenario ID</td>
				</tr>
				</thead>

				<tbody>
				
				<?php 
					$result = getallQuestions();
					foreach ($result as $r){						
						echo '<tr>';
						echo '<td>' . $r['_id']; echo '</td>';  
						echo '<td>' . $r['type']; echo '</td>';  
						echo '<td>' . $r['questioncontent']; echo '</td>';  
						echo '<td>' . $r['phase']; echo '</td>'; 
						echo '<td>' . $r['scenarioid']; echo '</td>'; 
						echo '</tr>';
					}

					?>
				</tbody>
			</table>

			<br><br>
			<h2>Antworten in der Datenbank</h2>

			<table>
				<thead>
				<tr>
					<th>ID</td>
					<th>Typ</td>
					<th>Antwortinhalt</td>
					<th>Antwortstatus</td>
					<th>Antwortpunkte</td>
					<th>Phase im Szenario</td>
					<th>Szenario ID</td>
				</tr>
				</thead>

				<tbody>
				
				<?php 
					$result = getallAnswers();
					foreach ($result as $r){						
						echo '<tr>';
						echo '<td>' . $r['_id']; echo '</td>';  
						echo '<td>' . $r['type']; echo '</td>';   
						echo '<td>' . $r['answercontent']; echo '</td>';
						echo '<td>' . $r['answerstate']; echo '</td>';  
						echo '<td>' . $r['answerpoints']; echo '</td>'; 
						echo '<td>' . $r['phase']; echo '</td>'; 
						echo '<td>' . $r['scenarioid']; echo '</td>'; 
						echo '</tr>';
					}

					?>
				</tbody>
			</table>

			<br><br>
			<h2>Benutzer in der Datenbank</h2>

			<table>
				<thead>
				<tr>
					<th>ID</td>
					<th>Typ</td>
					<th>Username</td>
					<th>Passwort</td>
					<th>Szenario 1 Phase</td>
					<th>Szenario 1 Punkte</td>
					<th>Szenario 2 Phase</td>
					<th>Szenario 2 Punkte</td>
					<th>Szenario 3 Phase</td>
					<th>Szenario 3 Punkte</td>
					<th>Szenario 4 Phase</td>
					<th>Szenario 4 Punkte</td>
					<th>Szenario 5 Phase</td>
					<th>Szenario 5 Punkte</td>
				</tr>
				</thead>

				<tbody>
				
				<?php 
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

					?>
				</tbody>
			</table>
			
			<br><br>
			<h2> Daten mit bestimmter ID in Datenbank löschen</h2>
			<form method="post">
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