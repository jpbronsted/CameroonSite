<?php
$page = 'browse';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ambazonian Genocide Watch</title> <!-- TODO: come up with a better name? -->
        <link rel='stylesheet' href='init.css' />
        <script src='browse.js'></script>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div style='padding:1.5rem;'></div>
            <select onchange="change_province(this.value)">
                <option value="Show all provinces">Show all provinces</option>
                <script type='text/javascript'>generate_dropdown();</script>
            </select>
        <br>
        <img id='map' src='ambazonia_provinces.jpg' usemap='#bmap' />
        <map name='bmap'>
            <script>generate_map();</script>
        </map>
        <form action='results.php' action='get'>
            <input type="hidden" name="province" value="all" id="selector" />
            <input type='submit' value='View Documents' />
        </form>
    </body>
</html>
