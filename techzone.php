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

            <h1> TechZone</h1>

            <p>While it is easy to develop a static web site for your business
               the task of developing a site that can handle dynamic content such
               as blog posts, social networking, ecommerce, and customer support
               is much harder. It would also be very expensive to develop such
               software in-house. This is why many businesses use a content management
               system to drive their websites.</p>
            <p>A content management system is software which takes content stored
               in a database and transforms it for display as a web page. They allow
               non-technical staff to make updates through web based editing forms,
               with no knowledge required as to how the system actually stores or
               transforms the content. In addition the presentation of your content
               (such as the web site theme) can be changed without having to manually
               update a large number of web pages. Apart from their value in managing
               simple web site content these systems can be extended to handle tasks
               like ecommerce, customer relationship management, supply chain management,
               and enterprise resource planning.</p>
            <p>In this article we will look at four CMS systems Wordpress, XXXX, XXX, and
                XXXX comparing and contrasting their features and pricing.</p>

            <p>Wordpress is the web’s most popular content management system, with an
               estimated 60% of the CMS market (w3techs.com 2014). Wordpress was created in 
               2003 and was originally designed to be a blogging platform (Tiwari 2014). 
               Development over the years has expanded it into a general purpose CMS 
              (Calao 2012). </p>
            <p>Much more required for this article ......</p>
              
            <p>Word count: XXXX</p>
         </div>
         <div class = "references">
            <h4>References</h4>
               <p>Colao, J., 2012. With 60 Million Websites, WordPress Rules
                  The Web. So Where's The Money?. [online] Forbes. Available
                  at: &lt;http://www.forbes.com/sites/jjcolao/2012/09/05/the-internets-mother-tongue/&gt;
                  [Accessed 11 Jan. 2015].</p>
               <p>Tiwari, N., 2014. Which content management system is right for you? |
                  Opensource.com. [online] Opensource.com. Available at:
                  &lt;http://opensource.com/business/14/6/open-source-cms-joomla-wordpress-drupal&gt;
                  [Accessed 11 Jan. 2015].</p>
               <p>W3techs.com, 2014. Usage Statistics and Market Share of Content Management
                  Systems for Websites, January 2015. [online] Available at:
                  &lt;http://w3techs.com/technologies/overview/content_management/all&gt;
                  [Accessed 11 Jan. 2015].</p>
         </div>
         

        </div>

        </div>
    </div>


    <footer>
    
    </footer>
</div>
    
</body>
</html>