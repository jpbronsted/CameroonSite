<?php
if( !isset( $page ) )
{
    $page = 'none';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Global stylesheet -->
        <link rel='stylesheet' href='header.css' />

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
            rel="stylesheet" crossorigin="anonymous">

        <!-- Latest compiled and minified Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

        <!-- Google Fonts API -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
            rel="stylesheet">
        
        <div class='menu-bar'>
            <ul>
                <li><a href='home.php' class="<?php echo $page === 'home'
                    ? 'active' : '';?>">Home</a></li>
                <li><a href='about.php' class="<?php echo $page === 'about'
                    ? 'active' : '';?>">About</a></li>
                <li class='dropdown'>
                    <a href='browse.php' class="<?php echo $page === 'browse'
                        ? 'active' : '';?>">Browse</a>
                    <div class='dropdown-content'>
                        <a href='results.php?province=all&type=Photo'>Photos</a>
                        <a href='results.php?province=all&type=Video'>Videos</a>
                        <a href='results.php?province=all&type=Audio'>Audio</a>
                    </div>
                </li>
            </ul>
        </div>
    </head>
    <body>
    </body>
</html>
