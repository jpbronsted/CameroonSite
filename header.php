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

        <!-- Bootstrap core JS & CSS -->
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/bootstrap.min.js"></script>

        <!-- Google Fonts API -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
            rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="style.css">
        
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
                        <a href='results.php?province=all&type=Photos'>Photos</a>
                        <a href='results.php?province=all&type=Videos'>Videos</a>
                        <a href='results.php?province=all&type=Audio+Recordings'>Audio</a>
                    </div>
                </li>
            </ul>
        </div>
    </head>
    <body>
    </body>
</html>
