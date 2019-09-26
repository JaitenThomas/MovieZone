<?php 
    require_once('movie_zone_main.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/main.css">
    <script src="js/ajax.js"></script>
    <title>MovieZone</title>
</head>
<body>

<div id="container">
    <header>
        <h3>MovieZone</h3>
    </header>
    <nav>
        <ul>
            <li><button onclick="window.location.href = 'index.php';">Home</button></li>
            <li><button onclick="window.location.href = 'contact.php';">Contact</button></li>
            <li><button onclick="window.location.href = 'techzone.php';">TechZone</button></li>
            <li><button onclick="window.location.href = 'moviezone.php';">MovieZone</button></li>
            <li><button onclick="window.location.href = 'join.php';">Join</button></li>
        </ul>

    </nav>



    <div id="main-content">
        
        <div id="nav-side">
            <?php $controller->loadNewReleasePanel()?>
        </div>
        

        <div id="column2">
            

            <div class = "articleBody"> 
                <?php $controller->loadLoginForm() ?>
                <div id="Error"></div>
            </div>
        </div>
    </div>

  

    <footer>
    
    </footer>
</div>
    
</body>
</html>