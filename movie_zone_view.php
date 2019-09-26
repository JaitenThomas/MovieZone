

<?php

    require_once('movie_zone_dba.php');

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
    
//print_r($_SESSION);

 

    class MovieZoneView {

        public function __construct() {

        }

        public function __destruct () {

        }

        public function leftNavPanel () {
            // Link to HTML file for panel buttons

            if(empty($_SESSION)){
                print file_get_contents('html/leftnav.html');
            }
            else {
                print file_get_contents('html/leftnav_user.html');
            }
            
        }

        public function joinForm () {
            // Link to HTML file for panel buttons
            print file_get_contents('html/joinform.html');
        }

        public function loginForm(){
            print file_get_contents('html/loginform.html');
        }

        public function showLoginUsername() {
            
        }

        

        public function topActorNavPanel ($actors) {
            print "
            <div style='color: #0e5968;'>
                <div class='topnav'>
                <label for='actor'><b>Actor:</b></label><br>
                <select name='actor' id='id_actor''>
                    <option value='all'>Select all</option>
            ";
            //------------------
            foreach ($actors as $actor) {			
                print "<option value='".$actor['actor_id']."'>".$actor['actor_name']."</option>";
            }
            		
            print "
            </select>
            <button type='submit' value='search' onclick='movieActorFilterSearchClick();'>Search</button>
            </div>
                
            </div>
            ";
        }

        public function topDirectorNavPanel ($directors) {
           
            print "
            <div style='color: #0e5968;'>
                <div class='topnav'>
                <label for='director'><b>Director:</b></label><br>
                <select name='director' id='id_director''>
                    <option value='all'>Select all</option>
            ";
            //------------------
            foreach ($directors as $director) {			
                print "<option value='".$director['director_id']."'>".$director['director_name']."</option>";
            }
            		
            print "
            </select>
            <button type='submit' value='search' onclick='movieDirectorFilterSearchClick();'>Search</button>
            </div>
                
            </div>
            ";
        }

        public function topGenreNavPanel ($genres) {
           
           
            print "
            <div style='color: #0e5968;'>
                <div class='topnav'>
                <label for='genre'><b>Genre:</b></label><br>
                <select name='genre' id='id_genre''>
                    <option value='all'>Select all</option>
            ";
            //------------------
            foreach ($genres as $genre) {			
                print "<option value='".$genre['genre_id']."'>".$genre['genre_name']."</option>";
            }
            		
            print "
            </select>
            <button type='submit' value='search' onclick='movieGenreFilterSearchClick();'>Search</button>
            </div>
                
            </div>
            ";
        }

        public function topClassificationNavPanel ($classifications) {
           
            print "
            <div style='color: #0e5968;'>
                <div class='topnav'>
                <label for='classification'><b>Classification:</b></label><br>
                <select name='classification' id='id_classification''>
                    <option value='all'>Select all</option>
            ";
            //------------------
            foreach ($classifications as $classification) {			
              
                print "<option value='".$classification['classification']."'>".$classification['classification']."</option>";
               
            }
            		
            print "
            </select>
            <button type='submit' value='search' onclick='movieClassificationFilterSearchClick();'>Search</button>
            </div>
                
            </div>
            ";
        }


        /* Displays an array of movies */
        public function showMovies ($movie_array) {
            if(!empty($movie_array)){
                foreach($movie_array as $movie){
                    $this->printMoviesInHtml($movie);
                }
            }
        } 
        
    

        public function showNewReleaseMovies ($releases_array){
            if(!empty($releases_array)){
                foreach($releases_array as $movie){
                    $this->leftNewReleasePanel($movie);
                }
            }
        }
        
       

        public function leftNewReleasePanel($movies){


           
        // Movie 1
        $movie1 = $movies[0];
        $title1 = $movie1['title'];
        $thumbnail1 = $movie1['thumbpath'];
        $genre1 = $movie1['genre'];
        $director1 = $movie1['director'];
        $classification1 = $movie1['classification'];
        $tagline1 = $movie1['tagline'];
        $plot1 = $movie1['plot'];

        // Movie 1 - Actors

        $first_star1 = $movie1['star1'];
        $first_star2 = $movie1['star2'];
        $first_star3 = $movie1['star3'];
        $first_costar1 = $movie1['costar1'];
        $first_costar2 = $movie1['costar2'];
        $first_costar3 = $movie1['costar3'];
        
        // Movie 1 - push actors into array

        
        $actors1 = [];


        if($first_costar1 != null){
            array_push($actors1, $first_star1);
        }

        if($first_star2 != null){
            array_push($actors1, $first_star2);
        }

        if($first_star3 != null){
            array_push($actors1, $first_star3);
        }

        if($first_costar1 != null){
            array_push($actors1, $first_costar1);
        }

        if($first_costar2 != null){
            array_push($actors1, $first_costar2);
        }

        if($first_costar3 != null){
            array_push($actors1, $first_costar3);
        }

         // Movie 2
         $movie2 = $movies[1];

         $title2 = $movie2['title'];
         $thumbnail2 = $movie2['thumbpath'];
         $genre2 = $movie2['genre'];
         $director2 = $movie2['director'];
         $classification2 = $movie2['classification'];
         $tagline2 = $movie2['tagline'];
         $plot2 = $movie2['plot'];
 
         // Movie 2 - Actors
 
         $second_star1 = $movie2['star1'];
         $second_star2 = $movie2['star2'];
         $second_star3 = $movie2['star3'];
         $second_costar1 = $movie2['costar1'];
         $second_costar2 = $movie2['costar2'];
         $second_costar3 = $movie2['costar3'];
                 
         // Movie 2 - push actors into array
 
         $actors2 = [];
 
 
         if($second_star1 != null){
             array_push($actors2, $second_star1);
         }
 
         if($second_star2 != null){
             array_push($actors2, $second_star2);
         }
 
         if($second_star3 != null){
             array_push($actors2, $second_star3);
         }
 
         if($second_costar1 != null){
             array_push($actors2, $second_costar1);
         }
 
         if($second_costar2 != null){
             array_push($actors2, $second_costar2);
         }
 
         if($second_costar3 != null){
             array_push($actors2, $second_costar3);
         }
        
        //($actors1);
    
        //Print out first movie details
        print "

            <h1>New Releases</h1>

            <fieldset class='fieldset-new-releases'>
                <legend>$title1</legend>
        
                <span class='movieHeading'>Genre: </span> $genre1
                <img class='moviePoster' src='./movies/$thumbnail1' alt='Movie Thumbnail'></img>
                <br>
                <span class='movieHeading'>Director: </span> $director1
                <br>
                <span class='movieHeading'>Classification: </span> $classification1
                <br>
                <span class='movieBold'>Starring: </span> 

            ";
            
            foreach ($actors1 as $key=>$actor) {	
                
            
                if($key == count($actors1) - 1){
                    print "and $actor.";
                }

                else if($key == count($actors1) - 2){
                    print "$actor ";
                }

                else {
                    print "$actor, ";
                }
                
            }


            print "
                
                <br>
                <span class='movieHeading'>$tagline1</span>  
                <br>
                $plot1
            </fieldset>
        ";

            print "

            <fieldset class='fieldset-new-releases'>
                <legend>$title2</legend>
        
                <span class='movieHeading'>Genre: </span> $genre2
                <img class='moviePoster' src='./movies/$thumbnail2' alt='Movie Thumbnail'></img>
                <br>
                <span class='movieHeading'>Director: </span> $director2
                <br>
                <span class='movieHeading'>Classification: </span> $classification2
                <br>
                <span class='movieBold'>Starring: </span> 

                ";

                foreach ($actors2 as $key=>$actor) {	
                
            
                    if($key == count($actors2) - 1){
                        print "and $actor.";
                    }
    
                    else if($key == count($actors2) - 2){
                        print "$actor ";
                    }
    
                    else {
                        print "$actor, ";
                    }
                    
                }
                
                print "
            
                <br>
                <span class='movieHeading'>$tagline2</span>  
                <br>
                $plot2
            </fieldset>
        ";
        }


        public function showMoviesFromSession(){

            $movies = $_SESSION['book_movies'];

            if(!empty($movies)){
                foreach($movies as $movie){
                    $this->printMoviesFromSessionInHtml($movie);
                }
            }
        }

        private function printMoviesFromSessionInHtml($movie){
           // $id = $movie['movie_id'];
            $title = $movie['title'];
            $tagline = $movie['tagline'];
            $year = $movie['year'];

        

            $thumbnail = $movie['thumbpath'];

            $avaliableDvd = $movie['avaliableDVD'];
            $avaliableBluRay = $movie['avaliableBluRay'];

            print "
            <fieldset> 
                <legend>$title</legend>
                <span class='movieHeading'>Title: </span> $title
                <img class='moviePoster' src='./movies/$thumbnail' alt='Movie Thumbnail'></img>
                <br>
                <span class='movieHeading'>Year: </span> $year
                <br>
                <span class='movieHeading'>Tagline: </span> $tagline
                <br>
                <span> $avaliableDvd DVDs are available and $avaliableBluRay BluRays are available </span>
                <br>
            </fieldset>
            <br>
            <br>
            
        ";


            
        }
        

        /* Displays the movies to the user. */
        private function printMoviesInHtml($movie){
            //print_r($movie);

            $id = $movie['movie_id'];
            
            $title = $movie['title'];
            $thumbnail = $movie['thumbpath'];
            $rental_period = $movie['rental_period'];
            $genre = $movie['genre'];
            $year = $movie['year'];
            $director = $movie['director'];
            $classification = $movie['classification'];
            $studio = $movie['studio'];
            $tagline = $movie['tagline'];
            $plot = $movie['plot'];
            $dvdRentalPrice = $movie['DVD_rental_price'];
            $blurayRentalPrice = $movie['BluRay_rental_price'];
            $dvdPurchasePrice = $movie['DVD_purchase_price'];
            $blurayPurchasePrice = $movie['BluRay_purchase_price'];
            $numDVD = $movie['numDVD'];
            $numBluRay = $movie['numBluRay'];

            $numDVDOut = $movie['numDVDout'];
            $numBluRayOut = $movie['numBluRayOut'];

            $avaliableDvd = $numDVD - $numDVDOut;
            $avaliableBluRay = $numBluRay - $numBluRayOut;

            
            $star1 = $movie['star1'];
            

            



            
            $star2 = $movie['star2'];
            $star3 = $movie['star3'];
            $costar1 = $movie['costar1'];
            $costar2 = $movie['costar2'];
            $costar3 = $movie['costar3'];
            //print_r($star1);

            $actors = [];
            array_push($actors, $star1);
            array_push($actors, $star2);
            array_push($actors, $star3);
            array_push($actors, $costar1);
            array_push($actors, $costar2);
            array_push($actors, $costar3);
            
            print "
            <fieldset id='fieldset-moviezone'>
            ";

            if($avaliableDvd < 0){
                $avaliableDvd = 0;
            }

            if($avaliableBluRay < 0){
                $avaliableBluRay = 0;
            }

           
           
            $already = false;
            
            $count;

            

            if(isset($_SESSION['book_movies'])){
                $count = count($_SESSION['book_movies']);
            }
            else 
            {
                $count = '';
            }

           
                if(empty($_SESSION)){
                    print "";
                }

                else if(!empty($_SESSION) && isset($_SESSION['book_movies'])) 
                {
                    for ($i = 0; $i < $count; $i++) 
                    {
                        if(in_array($title, $_SESSION['book_movies'][$i]))
                        {
                            $already = true;
                            print "
                                <Button style='display: block;'>Already Selected</Button>
                            ";
                        }
                    }
                } 

                

                
                if($already == false)
                {

                    if(empty($_SESSION)){
                        print "";
                    }

                    else if($count >= 5)
                    {
                        print "
                            <Button style='display: block;'>Maxiumn Selections Made</Button>
                        ";
                    }
                    else if($avaliableBluRay <= 0 && $avaliableDvd <= 0)
                    {
                        print "
                            <Button onclick='addMovieToCheckOut($id, $count);' style='display: block;'>Out of Stock</Button>
                        ";
                    }
                    else if($avaliableBluRay <= 0 && $avaliableDvd > 0)
                    {
                        print "
                            <Button onclick='addMovieToCheckOut($id, $count);' style='display: block;'>Currently only DVD</Button>
                        ";
                    }
                    else if($avaliableBluRay > 0 && $avaliableDvd <= 0)
                    {
                        print "
                            <Button onclick='addMovieToCheckOut($id, $count);' style='display: block;'>Currently only BluRay</Button>
                        ";
                    }
                    else 
                    {
                        print "
                            <Button onclick='addMovieToCheckOut($id, $count);' style='display: block;'>Rent/Purchase</Button>
                        ";
                    }
                }

               
            // <Button onclick='addMovieToCheckOut($id);' style='display: block;'>Only BluRay Available</Button>
            

            print "
                <legend>$title</legend>
                <img class='moviePoster' src='./movies/$thumbnail' alt='Movie Thumbnail'></img>
                <span class='movieBold'> </span> $rental_period
                <br>
                <span class='movieHeading'>Genre: </span> $genre
                <br>
                <span class='movieHeading'>Year: </span> $year
                <br>
                <span class='movieHeading'>Director: </span> $director
                <br>
                <span class='movieHeading'>Classification: </span> $classification
                <br>
                <span class='movieBold'>Starring: </span>
                
            ";
           
            foreach ($actors as $key=>$actor) {			
            

                if($key == count($actors) - 1){
                    print "and $actor.";
                }

                else if($key == count($actors) - 2){
                    print "$actor ";
                }
               
                
                else {
                    print "$actor, ";
                }
            }

            print "

            <br>
            <span class='movieHeading'>Studio: </span> $studio
            <br>
            <span class='movieHeading'>Tagline: </span> $tagline 
            <br>
            <br>
            <p>$plot</p>
            <br>
            <span class='movieHeading'>Rental: </span> DVD - $$dvdRentalPrice BluRay - $$blurayRentalPrice
            <br>
            <span class='movieHeading'>Purchase: </span> DVD - $$dvdPurchasePrice BluRay - $$blurayPurchasePrice
            <br>
            <span class='movieHeading'>Availability: </span> DVD - $avaliableDvd BluRay - $avaliableBluRay

            </fieldset>
            ";

            // <span class='movieHeading'>Purchase: </span>
            // <br>  
            // <span class='movieHeading'>Availability: </span>
        }

        /* Displays error message */
        public function showError($error) {
            echo "<h2>Error: $error</h2>";
            
        }

        public function showSuccess($success) {
            echo "<h2>$success</h2>";
        }
    }
?>