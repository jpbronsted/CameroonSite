<?php
$page = 'browse';

// Replae this declaration with a database query
$counties = array(
  array("name" => "Boyo", "x" => .73, "y" => .23, "radius" => .05),
  array("name" => "Bui", "x" => .85, "y" => .3, "radius" => .05),
  array("name" => "Donga-Mantung", "x" => .85, "y" => .17, "radius" => .075),
  array("name" => "Fako", "x" => .3, "y" => .9, "radius" => .075),
  array("name" => "Kupe", "x" => .425, "y" => .65, "radius" => .075),
  array("name" => "Lebialem", "x" => .525, "y" => .475, "radius" => .075),
  array("name" => "Manyu", "x" => .3, "y" => .425, "radius" => .125),
  array("name" => "Meme", "x" => .325, "y" => .75, "radius" => .075),
  array("name" => "Menchum", "x" => .625, "y" => .15, "radius" => .1),
  array("name" => "Mezam", "x" => .65, "y" => .35, "radius" => .075),
  array("name" => "Momo", "x" => .475, "y" => .275, "radius" => .075),
  array("name" => "Ndian", "x" => .15, "y" => .7, "radius" => .1),
  array("name" => "Ngo-Ketunjia", "x" => .75, "y" => .35, "radius" => .05)
);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ambazonian Genocide Watch</title>
        <script src='browse.js'></script>
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
