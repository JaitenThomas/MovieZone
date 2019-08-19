<?php

    class MovieZoneView {

        public function __construct() {

        }

        public function __destruct () {

        }

        public function leftNavPanel () {
            // Link to HTML file for panel buttons
            print file_get_contents('html/leftnav.html');
        }

        public function topActorNavPanel ($actors) {
           
           
            print "
            <div style='color: #0e5968; float:left;'>
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
            <div style='color: #0e5968; float:left;'>
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
            <div style='color: #0e5968; float:left;'>
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
            <div style='color: #0e5968; float:left;'>
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

        /* Displays the movies to the user. */
        private function printMoviesInHtml($movie){
            print_r($movie);
        }

        /* Displays error message */
        public function showError($error) {
            print "<h2>Error: $error</h2>";
        }
	

    }

?>