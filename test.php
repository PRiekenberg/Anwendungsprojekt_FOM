<?php
  
  require 'vendor/autoload.php';
  echo "<h1>Compose Test</h1>";
 
  /* create the mongo connection object
  $connection_url = "mongodb://anwendungsprojektdb:h5skd43Too0CJ5f8oAHu1MemBe8Xh3VHCRAsJ4lxsOukUQmpcNlZ1yLYM7QMKtRHG0edZvcohWWNaVdcZc6IYA==@anwendungsprojektdb.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@anwendungsprojektdb@";
  $client = new MongoDB\Client($connection_url);
  $collection = $client->anwendungsprojektdb->anwendungsprojektdb;
  $db = $client->anwendungsprojektdb;
   */

  //Connect Database
  function connectDB(){
    $connection_url = "mongodb://anwendungsprojektdb:h5skd43Too0CJ5f8oAHu1MemBe8Xh3VHCRAsJ4lxsOukUQmpcNlZ1yLYM7QMKtRHG0edZvcohWWNaVdcZc6IYA==@anwendungsprojektdb.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@anwendungsprojektdb@";
    $client = new MongoDB\Client($connection_url);
    return $client;
  }

  function getCollection() {
    $client=connectDB();
    $collection = $client->anwendungsprojektdb->anwendungsprojektdb;
    return $collection;
  }

  function getDB() {
    $client=connectDB();
    $db = $client->anwendungsprojektdb;
    return $db;
  }

  //insert function
  function insertDocument() {
    $client=connectDB();
    $collection=getCollection();
    $result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
    
    echo "Inserted with Object ID '{$result->getInsertedId()}'";
  }

  //print out list of collections
  function printCollection() {
    echo "<h2>Collections</h2>";
    echo "<ul>";
    $db = getDB();
    $cursor = $db->listCollections();
    foreach( $cursor as $doc ) {
      echo "<li>" .  $doc->getName() . "</li>";
    }
    echo "</ul>";
  }

  
  // print out documents in collection
  function printDocuments(){
    $collection = getCollection();
    $result = $collection->find();

    echo "<h2>Documents in Collection</h2>";
    echo "<ul>";
    foreach ($result as $entry) {
      echo "<li>", $entry['_id'], ': ', $entry['name'],"</li>";
    }
    echo "/<ul>";
  }

  printCollection();
  printDocuments();

  echo '
  <form name="form1" method="post" action="username()">
    <p>
      <label>
        <input type="text" name="textfield" id="textfield">
      </label>
    </p>
    <p>
      <label>
        <input type="submit" name="button" id="button" value="Submit">
      </label>
    </p>
  </form>';
  
  // disconnect from server
  $client->close();

    
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Berichtsheft">
		<meta name="author" content="Philipp Riekenberg">
		<script src="../../js/jquery.js"></script>
		<title>Daten einfügen</title>
		<link rel="stylesheet" href="../css/own.css">
	</head>
	<body>
		<div align="center" class="form-style-8">
			<h2>Profil bearbeiten</h2>
			<form id="form1" action="editprofile2.php" method="post">
				<h3>Geburtsdatum</h3>
				<input id="birthdateedit" type="date" name="birthdate" placeholder="Geburtsdatum" /><br><br>
				
				<h3>Adresse</h3>
				<input id="adressedit" type="text" name="adress" placeholder="Adresse" /><br><br>
				
				<h3>Ausbildungsberuf</h3>
				<input id="occupationedit" type="text" name="occupation" placeholder="Ausbildungsberuf" /><br><br>
				
				<h3>Ausbilder/in</h3>
				<input id="traineredit" type="text" name="trainer" placeholder="Ausbilder" /><br><br>
				
				<h3>Ausbildungsbeginn</h3>
				<input id="trainingstartedit" type="date" name="training_start" placeholder="Ausbildungsbeginn" /><br><br>
				
				<h3>Ausbildungsende</h3>
				<input id="trainingendedit" type="date" name="training_end" placeholder="Ausbildungsende" /><br><br>
				
				
				<input id="firebtn" type="submit" value="Daten ändern"></input>

			</form>
		
		</div>
	</body>
 </html>