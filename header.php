<?php
if( !isset( $page ) )
{
    $page = 'none';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' href='header.css' />
        <div class='menu-bar'>
            <ul>
                <li><a href='home.php'  class="<?php echo $page === 'home'  ? 'active' : '';?>">Home</a></li>
                <li><a href='about.php' class="<?php echo $page === 'about' ? 'active' : '';?>">About</a></li>
                <li class='dropdown'>
                    <a href='browse.php' class="<?php echo $page === 'browse' ? 'active' : '';?>">Browse</a>
                    <div class='dropdown-content'>
                        <a href='results.php?photos'>Photos</a>
                        <a href='results.php?videos'>Videos</a>
                        <a href='results.php?audio'>Audio</a>
                    </div>
                </li>
            </ul>
        </div>
    </head>
    <body>
    </body>
</html>
