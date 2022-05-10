<?php
  
  require 'vendor/autoload.php';
 
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

 // printCollection();
 // printDocuments();
 /*
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

    */
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
			<h2>Profil bearbeiten</h2>
			<form id="form1" action="insertDocument()" method="post">
				<h3>Name</h3>
				<input id="name" type="text" name="birthdate" placeholder="Name" /><br><br>
				
				<h3>Frage?</h3>
				<input id="questionbool" type="checkbox" name="questionbool" /><br><br>
				
				<h3>Antwort?</h3>
				<input id="answerbool" type="text" name="answerbool" /><br><br>
				
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