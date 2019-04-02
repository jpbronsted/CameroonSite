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
        
        <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href='home.php' class="<?php echo $page === 'home'
                    ? 'active' : '';?>">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href='about.php' class="<?php echo $page === 'about'
                    ? 'active' : '';?>">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href='browse.php' class="<?php echo $page === 'browse'
                        ? 'active' : '';?>">Browse</a>
                </li>
            </ul>
        </nav>
    </head>
    <body>
    </body>
</html>
