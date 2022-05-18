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
  function insertDocument($type, $questioncontent, $answercontent, $answerstate, $answerpoints, $phase, $scenarioid, $username, $password) {
    $client=connectDB();
    $collection=getCollection();
    $result = $collection->insertOne( [ 'type' => $type,
                                        'questioncontent' => $questioncontent,
                                        'answercontent' => $answercontent,
                                        'answerstate' => $answerstate,
                                        'answerpoints' => $answerpoints,
                                        'phase' => $phase,
                                        'scenarioid' => $scenarioid ,
                                        'username' => $username,
                                        'password' => $password,
                                        'scenario1_phase' => "1",
                                        'scenario1_points' => "0",
                                        'scenario2_phase' => "1",
                                        'scenario2_points' => "0",
                                        'scenario3_phase' => "1",
                                        'scenario3_points' => "0",
                                        'scenario4_phase' => "1",
                                        'scenario4_points' => "0",
                                        'scenario5_phase' => "1",
                                        'scenario5_points' => "0",
                                      ]);
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

  
  // Get all documents in collection
  function getallDocuments(){
    $collection = getCollection();
    $result = $collection->find();
    return $result;
  }

  function getallQuestions(){
    $collection = getCollection();
    $result = $collection->find([ 'type' => 'question' ]);
    return $result;
  }

  function getallAnswers(){
    $collection = getCollection();
    $result = $collection->find([ 'type' => 'answer' ]);
    return $result;
  }

  function getallUsers(){
    $collection = getCollection();
    $result = $collection->find([ 'type' => 'user' ]);
    return $result;
  }

  // Delete all documents in collection
  function deleteallDocuments() {
    $collection = getCollection(); 
    $delRec = $collection->deletemany([], ['limit' => 0]);
  }

  // Delete specific documents in collection
  function deleteDocument($id) {
    $collection = getCollection(); 
    $delRec = $collection->deleteone(['_id' => new \MongoDB\BSON\ObjectID($id)]);
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

  function queryRightAnswers($scenarioid, $phase) {
    $collection = getCollection();
    $result = $collection->find( [ 'scenarioid' => $scenarioid, 'phase' => $phase, 'type' => 'answer', 'answerstate' => 'true' ] );
    return $result;
  }

  function queryWrongAnswers($scenarioid, $phase) {
    $collection = getCollection();
    $result = $collection->find( [ 'scenarioid' => $scenarioid, 'phase' => $phase, 'type' => 'answer', 'answerstate' => 'true' ] );
    return $result;
  }

  function checkCredentials($username, $password){
    $collection = getCollection();
    $result = $collection->find( [ 'username' => $username, 'type' => 'user' ] );
    if (!$result -> isDead()){
      foreach ($result as $r) {
        
        $hashed_password = $r['password'];
        if(password_verify($password, $hashed_password)) {
          //echo "Login erfolgreich!";
          $_SESSION['username'] = $username;
          header('Location: ../index.php');
        } 
      
        // Else, Redirect them back to the login page.
        else {
          echo "Passwort falsch!";
        }
      }
    }
      
    else {
      echo "Benutzername nicht gefunden";
    }
    
}

function callEnde(){
  header("Location: ../php/ende.php");
}
?>
