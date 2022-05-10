<?php
echo "<h1>Compose Test</h1>";
require 'vendor/autoload.php';
phpinfo();
  try {
    // connect to Compose assuming your MONGODB_URL environment
    // variable contains the connection string
    //$connection_url = "mongodb://anwendungsprojekt:qnG4mX0QNnGbGRgcjMe3UFXVEFqiBoceoFVp39P5YUEcNLuq0uJUWC0nDtXcapvZusgQEAhlkL2qhAwrDrxDxw%3D%3D@anwendungsprojekt.mongo.cosmos.azure.com:10255/anwendungsprojektdb?ssl=true";
    $connection_url = "mongodb://anwendungsprojektdb:h5skd43Too0CJ5f8oAHu1MemBe8Xh3VHCRAsJ4lxsOukUQmpcNlZ1yLYM7QMKtRHG0edZvcohWWNaVdcZc6IYA==@anwendungsprojektdb.mongo.cosmos.azure.com:10255/?ssl=true";

     // create the mongo connection object
    $client = new MongoClient($connection_url);

    $collection = $client->anwendungsprojektdb->anwendungsprojektdb;

    $result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

    echo "Inserted with Object ID '{$result->getInsertedId()}'";

   /* 
    // extract the DB name from the connection path
    $url = parse_url($connection_url);
    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);

    // use the database we connected to
    $db = $m->selectDB($db_name);

    echo "<h2>Collections</h2>";
    echo "<ul>";

    // print out list of collections
    $cursor = $db->listCollections();
    $collection_name = "";
    foreach( $cursor as $doc ) {
      echo "<li>" .  $doc->getName() . "</li>";
      $collection_name = $doc->getName();
    }
    echo "</ul>";

    // print out last collection
    if ( $collection_name != "" ) {
      $collection = $db->selectCollection($collection_name);
      echo "<h2>Documents in ${collection_name}</h2>";

      // only print out the first 5 docs
      $cursor = $collection->find();
      $cursor->limit(5);
      echo $cursor->count() . ' document(s) found. <br/>';
      foreach( $cursor as $doc ) {
        echo "<pre>";
        var_dump($doc);
        echo "</pre>";
      }
    }

    // disconnect from server
    $m->close();
  } catch ( MongoConnectionException $e ) {
    die('Error connecting to MongoDB server');
  } catch ( MongoException $e ) {
    die('Mongo Error: ' . $e->getMessage());
  } catch ( Exception $e ) {
    die('Error: ' . $e->getMessage());
  }
  */
?>