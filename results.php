<?php
if (!extension_loaded('grpc')) {
  dl('grpc.so');
}
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\Timestamp;

// Generate database/storage references
$firestore = new FirestoreClient([
  'keyFilePath' => './auth.json'
]);
$storage = new StorageClient([
  'keyFilePath' => './auth.json'
]);
$counties_ref = $firestore->collection('counties');

// Generate page-level attributes
$province = isset($_REQUEST['province']) ? $_REQUEST['province'] : 'all';
if ($province === '')
  $province = 'all';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'all';
if ($type === '')
  $type = 'all';

// Get the list of counties from the database
$counties = [];
foreach($counties_ref->documents() as $document)
  array_push($counties, $document->id());

$doctypes_ref = $firestore->collection('doctypes');

$doctypes = ["Sort By Document"];
foreach($doctypes_ref->documents() as $document)
  array_push($doctypes, $document->id());
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
  <script src='submit.js'></script>
  <title>Ambazonian Genocide Watch</title>

  <?php include 'header.php'; ?>

  <!-- Bootstrap core JS & CSS -->
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/bootstrap.min.js"></script>
</head>

<body>
  <div class='container'>
    <form action='results.php' method='get'>

      <!-- Select By Document Type -->
      <input type="hidden" value="<?php echo $province; ?>"
      name="province" id="prov-selector" />
      <input type="hidden" value="<?php echo $type; ?>"
      name="type" id="type-selector"/>
      <select class="btn btn-outline-dark" id='doctype' onchange="submit_form(value, 'type-selector',
      this.form);">
<?php
// Initialize the drop-down list with the preselected item active
foreach($doctypes as $doctype) {
  if ($doctype === $type)
    echo '<option selected ';
  else
    echo '<option ';
  echo 'value="' . $doctype . '">' . $doctype . '</option>' . PHP_EOL;
}
?>
      </select>

      <!-- Select By Province -->
      <select class="btn btn-outline-dark" id='province' onchange="submit_form(value, 'prov-selector',
      this.form);">
        <option value="all">Sort By Provinces</option>
<?php
// Initialize the drop-down list with the preselected item active
foreach($counties as $name) {
  if ($name === $province)
    echo '<option selected ';
  else
    echo '<option ';
  echo 'value="' . $name . '">' . $name . '</option>' . PHP_EOL;
}
?>
      </select>
    </form>
    <div style="padding-bottom: 3rem;"></div>
  </div> <!-- container -->

<!-- PHP for accomodating UI -->
<?php
// Generates a UI element for a particular URL and type
function add_UI($url, $doctype) {
  $audio_type = 'audio/mp4';
  switch($doctype) {
    case 'photo':
      echo '<img src="' . $url . '" />' . PHP_EOL;
      break;
    case 'video':
      echo '<video src="' . $url
        . '" controls>Please switch your browser to Chrome or Firefox</video>'
        . PHP_EOL;
      break;
    case 'audio':
      echo '<audio controls><source src="' . $url . '" type="' . $audio_type
        . '">Please switch your browser to Chrome or Firefox</audio>' . PHP_EOL;
      break;
    default:
      break;
  }   
}

// Assemble a set of prefixes that will find all the requested documents
$prototypes = [];
$prefixes = [];

if ($type === 'all' && $province === 'all') {
  // optimization for querying whole storage with an empty prefix
  $prefixes = [ '' ];
} else {
  // document type
  if ($type === 'all')
    $prototypes = ['Photos', 'Videos', 'Audio'];
  else if ($type === 'Audio Recordings')
    $prototypes = ['Audio'];
  else
    $prototypes = [$type];

  // province type
  if ($province === 'all')
    $prefixes = $prototypes;
  else
    foreach($prototypes as $prototype)
      array_push($prefixes, $prototype . '/' . $province);
}

// setting up the counter that will separate columns and rows
$counter = 0;
echo '<div class="container">'; // open container

// Issue queries for all the relevant prefixes
foreach($prefixes as $prefix) {
  foreach($storage->buckets() as $bucket) {
    foreach($bucket->objects(['prefix' => $prefix]) as $object) {

      // Get relevant info from the file path
      $parts = pathinfo($object->name());

      // Ignore elements that are directories
      if (!isset($parts['extension']))
        continue;

      // Arrange the objects in three columns
      if ($counter % 3 == 0 && $counter > 0)
        echo '</div>';
      if ($counter % 3 == 0)
        echo '<div class = "row">'; 
      echo '<div class = "col-sm" style="text-align: center;">';
      $counter += 1;

      // Set the document type appropriately
      $doctype = 'none';
      if (strpos($parts['dirname'], 'Photo') !== false)
        $doctype = 'photo';
      else if (strpos($parts['dirname'], 'Video') !== false)
        $doctype = 'video';
      else if (strpos($parts['dirname'], 'Audio') !== false)
        $doctype = 'audio';

      // Add an appropriate UI element for each object found
      add_UI($object->signedUrl(new Timestamp(new DateTime('tomorrow'))),
        $doctype);

      echo '</div>';
    }
  }
}
echo '</div></div>'; // end last row and container
?>
</body>
</html>
