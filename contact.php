<?php 
    require_once('movie_zone_main.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/main.css">
    <script type = "text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type = "text/javascript">
      function initialize() {
         var myLatLng = new google.maps.LatLng (-28.168, 153.518);
         var mapCanvas = document.getElementById('map-canvas');
         var mapOptions = {
            center: myLatLng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
         }
         var map = new google.maps.Map(mapCanvas, mapOptions);
         var marker = new google.maps.Marker({
            position: myLatLng,
            map: map});
      }
      google.maps.event.addDomListener(window, 'load', initialize);
   </script>
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

            <h1> Contact Info for DVD Emporium </h1>

            <img class="center"src = "images/dvd_emporium.jpg" width = "410" height = "135" 
         alt = "Our extensive collection" title="Our extensive collection">

            <div id="contactBlock">
            <label>Phone:</label> (07) 1234-5678<br>
            <label>Address:</label> Southern Cross Drive<br>
            <label>&nbsp;</label>Bilinga, Queensland 4225<br>
            <label>Email:</label><a href="mailto:info@DVD-Emporium.com.au?subject=Direct from DVD Emporium website">
               info@DVD-Emporium.com.au</a><br>
         </div>
         <h2>DVD Emporium location (Google Map)<h2>    
         <div id="map-canvas">

         </div>   

         

        </div>

        </div>
    </div>


    <footer>
    
    </footer>
</div>
    
</body>
</html>