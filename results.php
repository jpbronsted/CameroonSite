<?php
if( isset( $_REQUEST['province'] ) )
{
    $province = $_REQUEST['province'];
}
else
{
    $province = 'all';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <script src='results.js'></script>
        <title>Ambazonian Genocide Watch</title> <!-- TODO: come up with a better name? -->
        <link rel='stylesheet' href='init.css' />
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div style='padding:1rem;'></div>
        <div style='padding:1.5rem;'></div>
        <select>
            <option value=-1>All</option>
            <option value=1>Photos</option>
            <option value=2>Videos</option>
            <option value=3>Audio Recordings</option>
        </select>
        <select onchange="change_province(this.value)">
            <option value="Show all provinces">Show all provinces</option>
            <script type='text/javascript'>province_dropdown();</script>
        </select>
        <p>The province that was selected is: <?php echo $province; ?>.</p>
      </body>
</html>
