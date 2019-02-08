<?php
if (!extension_loaded('grpc')) {
  dl('grpc.so');
}
$page = 'browse';
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;

// Generate database/storage references
$firestore = new FirestoreClient([
  'keyFilePath' => './auth.json'
]);
$counties_ref = $firestore->collection('counties');

// Get the list of counties and their image map data from the database
$counties = [];
foreach($counties_ref->documents() as $document) {
  array_push($counties, array(
    "name" => $document->id(),
    "x" => (float) $document->get('x'),
    "y" => (float) $document->get('y'),
    "radius" => (float) $document->get('radius')
  ));
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ambazonian Genocide Watch</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class='container'>
            <select onchange="document.getElementById('selector').value = value">
                <option value="all">Show all provinces</option>
<?php
foreach($counties as $county) {
  echo "<option value=\"" . $county["name"] . "\">"
    . $county["name"] . "</option>";
}
?>
            </select>
            <br>
            <img id='map' src='ambazonia_provinces.jpg' usemap='#bmap' />
            <map name='bmap'>
<?php
foreach($counties as $county) {
  $x = $county["x"] * 458;
  $y = $county["y"] * 547;
  $radius = $county["radius"] * 547;
  echo "<area shape=\"circle\" coords=\"" . $x . "," . $y . "," . $radius
    . "\" href=\"results.php?province=" . $county["name"] . "&type=all\" />";
}
?>
            </map>
            <form action='results.php' action='get'>
                <input type="hidden" name="province" value="all" id="selector" />
                <input type="hidden" name="type" value="all" />
                <input type='submit' value='View Documents' />
            </form>
        </div>
    </body>
</html>
