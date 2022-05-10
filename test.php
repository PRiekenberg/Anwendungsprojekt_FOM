<?php
  require 'vendor/autoload.php';
  echo "<h1>Compose Test</h1>";
    //try {
      // connect to Compose assuming your MONGODB_URL environment
      // variable contains the connection string
      //$connection_url = "mongodb://anwendungsprojekt:qnG4mX0QNnGbGRgcjMe3UFXVEFqiBoceoFVp39P5YUEcNLuq0uJUWC0nDtXcapvZusgQEAhlkL2qhAwrDrxDxw%3D%3D@anwendungsprojekt.mongo.cosmos.azure.com:10255/anwendungsprojektdb?ssl=true";
  $connection_url = "mongodb://anwendungsprojektdb:h5skd43Too0CJ5f8oAHu1MemBe8Xh3VHCRAsJ4lxsOukUQmpcNlZ1yLYM7QMKtRHG0edZvcohWWNaVdcZc6IYA==@anwendungsprojektdb.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@anwendungsprojektdb@";

    // create the mongo connection object
    $client = new MongoDB\Client($connection_url);
    $collection = $client->anwendungsprojektdb->anwendungsprojektdb;
    $db = $client->anwendungsprojektdb;
    /*
    $result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
    
    echo "Inserted with Object ID '{$result->getInsertedId()}'";
    */
    echo "<h2>Collections</h2>";
    echo "<ul>";
    // print out list of collections
    $cursor = $db->listCollections();
    foreach( $cursor as $doc ) {
      echo "<li>" .  $doc->getName() . "</li>";
    }
    echo "</ul>";

    // print out documents in collection
  
    $result = $collection->find();

    foreach ($result as $entry) {
      echo $entry['_id'], ': ', $entry['name'], "\n";
    }
    
    

      // disconnect from server
      $client->close();

    
?>