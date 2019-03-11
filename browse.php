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

	<!-- Bootstrap core JS & CSS -->
	<link href="bootstrap/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/bootstrap.min.js"></script>

	<!-- Google Fonts API -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
	rel="stylesheet">

	<!-- CSS -->
	<link rel='stylesheet' href='style.css' />

</head>
<body>
	<div class='container'>
		<div class="row">
			<div class="col">

				<!-- TEXT -->
				<div style="text-align: right; padding-bottom: 2rem;">
					<h1>Browse the documents</h1>
					<h3>uploaded daily by the Ambazonians</h3>
					<h3>under siege by the Cameroonian</h3>
					<h3>government’s genocide</h3>
				</div>

				<!-- VIEW ALL DOCUMENTS -->
				<div class="form-group">
					<form action='results.php' action='get'>
						<input type="hidden" name="province" value="all" id="selector" />
						<input type="hidden" name="type" value="all" />
						<input class="form-control" type='submit' value='View All Documents' />
					</form>
				</div>

				<!-- SORT BY DOCUMENTS -->
				<div class="form-group">
					<form action='results.php' action='get'>
						<input type="hidden" name="province" value="all" id="selector" />
						<input type="hidden" name="type" value="all" />
						<select class="form-control" type='type-selector' value='Sort By Documents' ></select>
					</form>
				</div>
			</div> <!-- col 1 -->

			<br>

			<div class="col">
				<img id='map' src='map.jpg' usemap='#bmap' />
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
			</div> <!-- col 2 -->
		</div> <!-- row -->
	</div> <!-- container -->
</body>
</html>
