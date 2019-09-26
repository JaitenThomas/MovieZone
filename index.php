<?php 
    require_once('movie_zone_main.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/main.css">
    <script src="js/ajax.js"></script>
    <script type = "text/javascript" src = "scripts/form_validation.js"></script>
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

            <h1> Welcome to the Emporium </h1>

            <p><span class="shopTitle">The MovieZone Emporium</span> is known for its high quality and customer service. We are 
            dedicated to procuring he finest movies for our customers. 
            DVD was the premier digital video storage medium of the 20th 
            century, and now you too can enjoy the crisp visuals and clean audio of DVD as well as 
            the improved quality of the 21st century's storage medium of choice BluRay.</p>
            <p>Our shop, conveniently located near Southern Cross University at the Gold Coast 
            contains literally thousands of new and quality pre-loved DVDs and BluRays available 
            for your viewing pleasure. Rent or purchase its up to you. Consider becoming a member as
            this will allow you to book on-line and save you the disappointment of arriving only to 
            find the movie you were wishing to view or purchase is currently out of stock.</p>
            <p>To become a member please <a href="join.php">join up</a>.</p>
            <p>You can view our extensive movie database in the <a href="moviezone.php">MovieZone
            </a>.</p>
            <p>As an additional service to our clientele our resident IT guru provides weekly advice
            on important developments in the IT industry. View the advice from our store IT expert
            in the<a href="techzone.php">TechZone</a>.</p>
         </div>

        </div>
    </div>

    <footer>
    
    </footer>
</div>
    
</body>
</html>