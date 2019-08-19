<?php 
    require_once('movie_zone_main.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/main.css">
    <script src="js/ajax.js"></script>
	<script src="js/movie_zone.js"></script>
    <title>MovieZone</title>
</head>
<body>

<div id="container">
    <header>
        <h3>MovieZone</h3>
    </header>

    <div id="main-content">
    
        <div id="sidebar">
            
            <nav>
                <?php $controller->loadLeftNavPanel()?>
            </nav>
        </div>

        <div id="column2">
            <div id="id_topnav"></div>
            <div id="id_content"></div>
        </div>
    </div>


    <footer>
    
    </footer>
</div>
    
</body>
</html>