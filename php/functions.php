<?php
  
  require '../vendor/autoload.php';
 
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
  function insertDocument($documentname, $questionbool, $answerbool, $questioncontent, $answercontent, $scenarioid) {
    $client=connectDB();
    $collection=getCollection();
    $result = $collection->insertOne( [ 'documentname' => $documentname, 'questionbool' => $questionbool,'answerbool' => $answerbool,'questioncontent' => $questioncontent,'answercontent' => $answercontent,'scenarioid' => $scenarioid ] );
    
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
      echo "<li>", $entry['_id'], ': ', $entry['documentname'], ': ', $entry['questionbool'],': ', $entry['answerbool'],': ', $entry['questioncontent'],': ', $entry['answercontent'],': ', $entry['scenarioid'],"</li>";
    }
    echo "/<ul>";
  }
?>