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

    <!-- Bootstrap core JS & CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/bootstrap.min.js"></script>

    <!-- Google Fonts API -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
    rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div style="align-items: center;">
            <?php
            echo "<button type=\"button\" class=\"btn btn-outline-danger\" style=\"font-family: " .
            "\'Roboto\', sans-serif;\">Death Count : " . $dcount .
            "</button>";
            ?>

            <button type="button" class="btn btn-light">
            <?php
            foreach ($pdfs as $pdf) {
              echo "<a href=\"" . $pdf[1] . "\" download>" . $pdf[0] . "</a>" . PHP_EOL;
            }
            ?>
            </button>
        </div>

        <div class="row">
            <div class="col" style="text-align: right;">
                <h1>The Ambazonian Genocide</h1>
                <h4>the extensive documentation of the</h4>
                <h4>genocide that has been hidden from</h4>
                <h4>the world by an oppressive government</h4>
                <div class="space"></div>
                <h5>photos, videos, and audio are uploaded daily</h5>
                <h5>by the Ambazonians victims of the mass murder</h5>
                <h5>designed by the Cameroonian government</h5>
            </div>

            <div class="col">

            </div>
        </div>
  </div>
</body>
</html>
