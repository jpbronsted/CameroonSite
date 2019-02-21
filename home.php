<?php
$page = 'home';

require 'vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\Timestamp;
use Google\Cloud\Firestore\FirestoreClient;

// Get a reference to Storage and get all the PDFs
$storage = new StorageClient([
  'keyFilePath' => './auth.json'
]);
$pdfs = [];
foreach ($storage->buckets() as $bucket) {
  foreach ($bucket->objects() as $object) {
    if (strpos($object->name(), '.pdf') !== false) {
      array_push($pdfs, array($object->name(),
        $object->signedURL(new Timestamp(new DateTime('tomorrow')))));
    }
  }
}

// Get a reference to Firestore and get the deathcount
$firestore = new FirestoreClient([
  'keyFilePath' => './auth.json'
]);
$dcount = $firestore->collection('info')->document('info')->snapshot()
  ->get('deathcount');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ambazonian Genocide Watch</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class="container">
<?php
echo "<button type=\"button\" class=\"btn btn-danger\" style=\"font-family: " .
  "\'Roboto\', sans-serif; margin-bottom: 10px;\">Death Count : " . $dcount .
  "</button>";
?>
            <h1> Ambazonian Genocide Watch</h1>
            <p> The Cameroonian government has begun a massive campaign to 
            oppress the Ambazonians via mass genocide and torture. The 
            government further prohibits the documentation of the atrocities 
            it commits, preventing the world from discovering the disasters the
             Ambazonians are facing every day. The censorship government has
             enforced has become so extreme that government agents randomly 
            confiscate and examine people’s electronic devices to find and 
            punish those who protest online. Additionally, the government 
            continues to restrict Internet access in Ambazonia to limit the 
            visibility of the ongoing conflict from outside the region.</p>
            <h3> The Ambazonians cannot and will not stay silenced. </h3>
            <h5> This website is a collection of video, visual, and auditory 
            recordings of the genocide that Ambazonians have sent in so the 
            world can know and learn of what has occurred in the once 
            beautiful nation of Ambazonia.</h5>
            <p> Find out more about the ongoing genocide in the documents
            below. </p>
<?php
foreach ($pdfs as $pdf) {
  echo "<a href=\"" . $pdf[1] . "\" download>" . $pdf[0] . "</a>" . PHP_EOL;
}
?>
        </div>
    </body>
</html>
