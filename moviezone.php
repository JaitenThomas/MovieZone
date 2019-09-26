<?php 
    require_once('movie_zone_main.php');
?>

<?php
    if(!isset($_SESSION)) 
    { 
            session_start(); 

            if (isset($_SESSION['username'])) {
                $formTitle = "<h2>Logged on as: ". $_SESSION['username'] ."</h2>";
               
           
                
                // $photo = "\"photos/".$_SESSION['photo']."\"";
                // $btnTitle = "Logout";
                // $request = "'cmd_user_logout'";
                // $display = "style=\"display: none;\"";
            } else {
                $_SESSION = array();
                session_destroy();
                // $photo = "\"photos/avatar.png\"";
                $formTitle = "<h2>Login Form</h2>";
                // $btnTitle = "Login";
                // $request = "'cmd_user_login'";
                // $display = "style=\"display: inherit;\"";
            }
    } 
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

<div id="container-moviezone">
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
   

        <div id="sidebar-movie-zone">
            <div id="nav-side-movie-zone">
                <?php $controller->loadLeftNavPanel()?>
            </div>
        </div>

        <div id="column2-moviezone">
            <?php

            

                print "" . $formTitle;

                if (isset($_SESSION['book_movies'])) {

        
                

                    $selectCount = "" . count($_SESSION['book_movies']);
                    print $selectCount . " movies selected";
                        
                    

                   
                }
            
            ?>
            <div id="id_topnav"></div>
            <div id="id_content"></div>
        </div>
    </div>


    <footer>
    
    </footer>
</div>
    
</body>
</html>