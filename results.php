<?php
if (!extension_loaded('grpc')) {
  dl('grpc.so');
}
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;

// Generate database/storage references
$firestore = new FirestoreClient([
  'keyFilePath' => './CameroonSite-09776fca4fda.json'
]);
$counties_ref = $firestore->collection('counties');

// Generate page-level attributes
if( isset( $_REQUEST['province'] ) )
{
    $province = $_REQUEST['province'];
}
else
{
    $province = 'all';
}
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'all';

// Get the list of counties from the database
$counties = [];
foreach($counties_ref->documents() as $document) {
  array_push($counties, $document->id());
}

// Replace this declaration with a database lookup
$doctypes = array(
  "All",
  "Photo",
  "Video",
  "Audio"
);
?>

<!DOCTYPE html>
<html>
    <head>
        <script src='results.js'></script>
        <title>Ambazonian Genocide Watch</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class='container'>
            <form action='results.php' method='get'>
                <input type="hidden" value="<?php echo $province; ?>"
                    name="province" id="prov-selector" />
                <input type="hidden" value="<?php echo $type; ?>"
                    name="type" id="type-selector" />
                <select onchange="submit_form(value, 'type-selector',
                    this.form);">
<?php
foreach($doctypes as $doctype) {
  if ($doctype === $type) {
    echo "<option selected ";
  } else {
    echo "<option ";
  }
  echo "value=\"" . $doctype . "\">" . $doctype . "</option>";
}
?>
                </select>
                <select onchange="submit_form(value, 'prov-selector',
                    this.form);">
                    <option value="all">Show all provinces</option>
<?php
foreach($counties as $name) {
  if ($name === $province) {
    echo "<option selected ";
  } else {
    echo "<option ";
  }
  echo "value=\"" . $name . "\">" . $name . "</option>";
}
?>
                </select>
            </form>
            <p>The province that was selected is: <?php echo $province; ?>.</p>
            <p>The type that was selected is: <?php echo $type; ?>.</p>
        </div>
    </body>
</html>
