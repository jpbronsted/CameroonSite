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
foreach($counties_ref->documents() as $document) {
  array_push($counties, $document->id());
}

$doctypes_ref = $firestore->collection('doctypes');

$doctypes = ["Show All Documents"];
foreach($doctypes_ref->documents() as $document) {
  array_push($doctypes, $document->id());
}

?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
  <script src='results.js'></script>
  <title>Ambazonian Genocide Watch</title>
  <?php include 'header.php'; ?>

  <!-- Bootstrap core JS & CSS -->
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/bootstrap.min.js"></script>
</head>

<body> <!-- onload=initialize()> -->
  <div class='container'>

    <!-- document type -->
    <form action='results.php' method='get'>
      <input type="hidden" value="<?php echo $province; ?>"
      name="province" id="prov-selector" />
      <input type="hidden" value="<?php echo $type; ?>"
      name="type" id="type-selector" />
      <select class="btn btn-outline-dark" id='doctype' onchange="submit_form(value, 'type-selector',
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

<!-- province -->
<select class="btn btn-outline-dark" id='province' onchange="submit_form(value, 'prov-selector',
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
</div>
<?php
// Generates a UI element for a particular URL and type
function add_UI($url, $doctype) {
  // For now, just make generic UI elements
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
  // This is a small optimization -- if we're querying the whole storage, we
  // can just use an empty prefix to grab everything
  $prefixes = [ '' ];
} else {
  if ($type === 'all')
    $prototypes = ['Photos', 'Videos', 'Audio'];
else if ($type === 'Audio Recordings')
    $prototypes = ['Audio'];
else
    $prototypes = [$type];
if ($province === 'all') {
    $prefixes = $prototypes;
} else {
    foreach($prototypes as $prototype) {
      array_push($prefixes, $prototype . '/' . $province);
  }
}
}

// Issue queries for all the relevant prefixes
foreach($prefixes as $prefix) {
  foreach($storage->buckets() as $bucket) {
    foreach($bucket->objects(['prefix' => $prefix]) as $object) {
      $parts = pathinfo($object->name());
      $doctype = 'none';
      if (strpos($parts['dirname'], 'Photo') !== false
        && isset($parts['extension'])) {
        $doctype = 'photo';
} else if (strpos($parts['dirname'], 'Video') !== false
  && isset($parts['extension'])) {
  $doctype = 'video';
} else if (strpos($parts['dirname'], 'Audio') !== false
  && isset($parts['extension'])) {
  $doctype = 'audio';
}
      // Add an appropriate UI element for each object found
add_UI($object->signedUrl(new Timestamp(new DateTime('tomorrow'))),
  $doctype);
}
}
}
?>
</body>
</html>
