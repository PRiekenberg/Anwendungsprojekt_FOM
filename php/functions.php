<?php
  
  require '../vendor/autoload.php';
 
  //Connect Database
  function connectDB(){
    $connection_url = getenv('CUSTOMCONNSTR_connection_string');
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
  function insertDocument($type, $questioncontent, $answercontent, $answerstate, $answerpoints, $phase, $scenarioid, $username, $password, $admin, $answerid, $explanationcontent) {
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
                                        'admin' => $admin,
                                        'answerid' => $answerid,
                                        'explanationcontent' => $explanationcontent
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

  function getallExplanations(){
    $collection = getCollection();
    $result = $collection->find([ 'type' => 'explanation' ]);
    return $result;
  }

  function getUsersPointsforScenario($scenarioid){
    $collection = getCollection();
    $options = $options = array(
      "sort" => array('scenario'.$scenarioid.'_points' => -1),
    );
    $result = $collection->find([ 'type' => 'user' ],$options);
    return $result;
  }

  function getUserPoints($scenarioid,$username){
    $collection = getCollection();
    $result = $collection->find( [ 'username' => $username, 'type' => 'user' ] );
    switch ($scenarioid) {
      case "1":
        foreach ($result as $r) {
          return intval($r['scenario1_points']);
        }
        break;
      case "2":
        foreach ($result as $r) {
          return intval($r['scenario2_points']);
        }
        break;
      case "3":
        foreach ($result as $r) {
          return intval($r['scenario3_points']);
        }
        break;
      case "4":
        foreach ($result as $r) {
          return intval($r['scenario4_points']);
        }
        break;
      case "5":
        foreach ($result as $r) {
          return intval($r['scenario5_points']);
        }
        break;
    }
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

  function queryExplanationforAnswers($answer) {
    $collection = getCollection();
    //hole mir anhand des Antwortinhalts den Antwortdatensatz
    $result = $collection->find( [ 'answercontent' => $answer, 'type' => 'answer' ] );

    foreach ($result as $r) {
      //hole mir mithilfe der ID aus dem Antwortdatensatz die entsprechende Erklärung
      $explanation = $collection->find( [ 'answerid' => $r['_id'], 'type' => 'explanation' ] );
      echo $explanation["explanationcontent"];
      return $explanation;
      foreach ($explanation as $e) {
        return $e['explanationcontent'];
      }
    }
  }

  function queryAnswersPoints($scenarioid, $phase, $answercontent) {
    $collection = getCollection();
    $result = $collection->find( [ 'scenarioid' => $scenarioid, 'phase' => $phase, 'type' => 'answer', 'answercontent' => $answercontent ] );
    foreach ($result as $r) {
      $punkte=$r['answerpoints'];
    }
    return intval($punkte);
  }

  function setUserPoints($scenarioid,$points,$username){
    $aktuellepunkte=getUserPoints($scenarioid,$username);
    $neuepunke=$aktuellepunkte+$points;
    $collection = getCollection();
    $collection->updateOne(
      [ 'username' => $username ],
      [ '$set' => [ 'scenario'.$scenarioid.'_points' => $neuepunke ]]
   );
  }

  function setUserPhase($scenarioid,$username,$new_phase){
    $collection = getCollection();
    $collection->updateOne(
      [ 'username' => $username ],
      [ '$set' => [ 'scenario'.$scenarioid.'_phase' => $new_phase ]]
    );
  }

  function checkCredentials($username, $password){
    $collection = getCollection();
    $result = $collection->find( [ 'username' => $username, 'type' => 'user' ] );
    if (!$result -> isDead()){
      foreach ($result as $r) {
        
        $hashed_password = $r['password'];
        
        if(password_verify($password, $hashed_password)) {
          //echo "Login erfolgreich!";
          $login_result = 0;
          $_SESSION['username'] = $username;
          $_SESSION['admin'] = $r['admin'];
          $_SESSION['scenario1_phase'] = $r['scenario1_phase'];
          $_SESSION['scenario2_phase'] = $r['scenario2_phase'];
          $_SESSION['scenario3_phase'] = $r['scenario3_phase'];
          $_SESSION['scenario4_phase'] = $r['scenario4_phase'];
          $_SESSION['scenario5_phase'] = $r['scenario5_phase'];
          header('Location: ../index.php');
        } 
      
        // Else, Redirect them back to the login page.
        else {
          //echo "Passwort falsch!";
          $login_result = 1;
        }
      }
    }
      
    else {
      //echo "Benutzername nicht gefunden";
      $login_result = 1;
    }

    return $login_result;
}

function callEnde(){
  header("Location: ../php/ende.php");
}

function checkAdmin($username){
  $isAdmin = false;
  $result = $collection->find( [ 'username' => $username, 'admin' => 'true' ] );
  if (!$result -> isDead()){
    $isAdmin = true;
  }
  return $isAdmin;
}
?>
