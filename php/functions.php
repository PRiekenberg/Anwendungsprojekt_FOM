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
  function insertDocument($type, $questioncontent, $answercontent, $answerstate, $answerpoints, $phase, $scenarioid) {
    $client=connectDB();
    $collection=getCollection();
    $result = $collection->insertOne( [ 'type' => $type,
                                        'questioncontent' => $questioncontent,
                                        'answercontent' => $answercontent,
                                        'answerstate' => $answerstate,
                                        'answerpoints' => $answerpoints,
                                        'phase' => $phase,
                                        'scenarioid' => $scenarioid ] );
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
  function getallDocuments(){
    $collection = getCollection();
    $result = $collection->find();
    return $result;
  }

  function deleteallDocuments() {
    $collection = getCollection(); 
    $delRec = $collection->deletemany([], ['limit' => 0]);
  }

  function deleteDocument($id) {
    $collection = getCollection(); 
    $delRec = $collection->deletemany(['_id' => $id], ['limit' => 0]);
  }

  function queryQuestion($scenarioid, $phase) {
    $collection = getCollection();
    $result = $collection->find( [ 'scenarioid' => $scenarioid, 'phase' => $phase, 'type' => 'question' ] );
    return $result;
  }

  function queryAnswers($scenarioid, $phase) {
    $collection = getCollection();
    $result = $collection->find( [ 'scenarioid' => $scenarioid, 'phase' => $phase, 'type' => 'answer' ] );
    return $result;
  }
?>