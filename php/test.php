<?php
  
  require '../vendor/autoload.php';
  require_once 'functions.php';

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
			<form id="form1" action="insertDocument()" method="post">
				<h3>Name</h3>
				<input id="name" type="text" name="birthdate" placeholder="Name" /><br><br>
				
				<h3>Frage?</h3>
				<input id="questionbool" type="checkbox" name="questionbool" /><br><br>
				
				<h3>Antwort?</h3>
				<input id="answerbool" type="checkbox" name="answerbool" /><br><br>
				
				<h3>Inhalt Frage</h3>
				<input id="questioncontent" type="text" name="questioncontent" placeholder="Frage eingeben" /><br><br>
				
				<h3>Inhalt Antwort</h3>
				<input id="answercontent" type="text" name="answercontent" placeholder="Antwort eingeben" /><br><br>
				
				<h3>Szenario ID</h3>
				<input id="scenarioid" type="text" name="scenarioid" placeholder="ID des Szenarios" /><br><br>
				
				
				<input id="firebtn" type="submit" value="Daten ändern"></input>

			</form>
		
		</div>
	</body>
 </html>