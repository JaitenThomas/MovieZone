

<?php 

    require_once('movie_zone_config.php');

    if(!isset($_SESSION)) 
    { 
        session_start(); 

        if (isset($_SESSION['username'])) 
        {
            
        } 
        else 
        {
            $_SESSION = array();
            session_destroy();
        }
    } 


    class MovieZoneController {

        private $model;
        private $view;
    
        /* Class constructor for initalising values */
        public function __construct ($model, $view) {
            $this->model = $model;
            $this->view = $view;
        }

        /* Class constructor for uninitalising values */
        public function __destruct () {
            $this->model = null;
            $this->view = null;
        }

        /*Loads left navigation panel*/
        public function loadLeftNavPanel () {
            $this->view->leftNavPanel();
        }

        public function loadLoginForm(){
            $this->view->loginForm();
        }

        /* Loads left new release panel */
        public function loadNewReleasePanel(){

            $releases = $this->model->selectMoviesLeftNavNewReleases();
        
            $this->view->leftNewReleasePanel($releases);
        }

        public function loadJoinForm () {
            $this->view->joinForm();
        }

        public function loadTopActorNavPanel () {
            $actors = $this->model->selectAllActors();

            if($actors != null){
                $this->view->topActorNavPanel($actors);
            } else {
                $error = $this->model->getError();
                if(!empty($error)){
                    $this->view->showError();
                }
            }
        }

        public function loadTopDirectorNavPanel () {
            $directors = $this->model->selectAllDirectors();

            if($directors != null){
                $this->view->topDirectorNavPanel($directors);
            } else {
                $error = $this->model->getError();
                if(!empty($error)){
                    $this->view->showError();
                }
            }
        }

        public function loadTopGenreNavPanel () {
            $genres = $this->model->selectAllGenres();

            if($genres != null){
                $this->view->topGenreNavPanel($genres);
            } else {
                $error = $this->model->getError();
                if(!empty($error)){
                    $this->view->showError();
                }
            }
        }

        public function loadTopClassificationNavPanel () {
            $classifications = $this->model->selectAllClassifications();

            if($classifications != null){
                $this->view->topClassificationNavPanel($classifications);
            } else {
                $error = $this->model->getError();
                if(!empty($error)){
                    $this->view->showError();
                }
            }
        }

        /*
          Processes user requests and call the corresponding functions
	      The request and data are submitted via POST or GET methods
	    */
        public function processRequest ($request) {
            switch($request) {
                case CMD_SHOW_TOP_ACTOR_NAV:
                    $this->loadTopActorNavPanel();
                    break;
                case CMD_MOVIE_ACTOR_FILTER:
                    $this->handleActorFilterMovieRequest();
                    break;
                case CMD_SHOW_TOP_DIRECTOR_NAV:
                    $this->loadTopDirectorNavPanel();
                    break;
                case CMD_MOVIE_DIRECTOR_FILTER:
                    $this->handleDirectorFilterMovieRequest();
                    break;
                case CMD_SHOW_TOP_GENRE_NAV:
                    $this->loadTopGenreNavPanel();
                    break;
                case CMD_MOVIE_GENRE_FILTER:
                    $this->handleGenreFilterMovieRequest();
                    break;
                case CMD_SHOW_TOP_CLASSIFICATION_NAV:
                    $this->loadTopClassificationNavPanel();
                    break;
                case CMD_MOVIE_CLASSIFICATION_FILTER:
                    $this->handleClassificationFilterMovieRequest();
                    break;
                case CMD_MOVIE_SELECT_ALL:
                    $this->handleSelectAllMovieRequest();
                    break;
                case CMD_MOVIE_SELECT_NEW_RELEASES:
                    $this->handleSelectNewMovieReleasesRequest();
                    break;
                case CMD_MEMBER_SIGN_UP:
                    $this->handleMemberSignUpRequest();
                case CMD_MEMBER_LOGIN:
                    $this->processUserLoginRequest();
                case CMD_DECREASE_MOVIE_RENTAL_AMOUNT:
                    $this->handleMovieDecreaseRentalAmount();
                case CMD_MOVIE_SELECT_BY_ID:
                    $this->handleMovieSelectById();
            }
        }

        private function handleMovieSelectById(){

            if(!empty($_REQUEST['id'])){
              //print_r($_REQUEST);
              $id = $_REQUEST['id'];

              $result = $this->model->selectMovieById($id);

              if ($result != null) {
                 
                   //session_start(); 
   
                   $index = count($_SESSION['book_movies']);
   
                   if($index == 5){
                       return;
                   }
                
                   if ($index > 0)
                   {
                       
                       $_SESSION['book_movies'][$index]['title'] = $result[0]['title'];   
                       $_SESSION['book_movies'][$index]['year'] = $result[0]['year'];   
                       $_SESSION['book_movies'][$index]['tagline'] = $result[0]['tagline'];   
                       $_SESSION['book_movies'][$index]['thumbpath'] = $result[0]['thumbpath'];  
       
                       $avaliableDVD = $result[0]['numDVD'] - $result[0]['numDVDout'];
                       $avaliableBluRay = $result[0]['numBluRay'] - $result[0]['numBluRayOut'];
       
                       $_SESSION['book_movies'][$index]['avaliableDVD'] = $avaliableDVD;   
                       $_SESSION['book_movies'][$index]['avaliableBluRay'] = $avaliableBluRay; 
                   } 
                   else if($index == 0)
                   {
                       $_SESSION['book_movies'][0]['title'] = $result[0]['title'];   
                       $_SESSION['book_movies'][0]['year'] = $result[0]['year'];   
                       $_SESSION['book_movies'][0]['tagline'] = $result[0]['tagline'];   
                       $_SESSION['book_movies'][$index]['thumbpath'] = $result[0]['thumbpath'];  
       
                       $avaliableDVD = $result[0]['numDVD'] - $result[0]['numDVDout'];
                       $avaliableBluRay = $result[0]['numBluRay'] - $result[0]['numBluRayout'];
       
                       $_SESSION['book_movies'][0]['avaliableDVD'] = $avaliableDVD;   
                       $_SESSION['book_movies'][0]['avaliableBluRay'] = $avaliableBluRay;   
                   }
               }
   
              return $result;
            }

          

        }

        private function handleMovieDecreaseRentalAmount() {
            

            if(!empty($_REQUEST['id'])){
                //print_r($_REQUEST);
                $id = $_REQUEST['id'];
                $this->model->decreaseRentalAmount($id);
            }

            

        }

        private function processUserLoginRequest(){
        
            $keys = array('username', 'password');

            $userData = array();

            foreach ($keys as $key) 
            {
                if (!empty($_REQUEST[$key])) 
                {
                    $userData[$key] = $_REQUEST[$key];
                } 
                else 
                {
                    $this->view->showError($key. ' cannot be blank');
                    return;
                }
            }

            $result = $this->model->selectUser($userData);

            if(!$result){
                return $this->view->showError("no user found with that username");
            }

            if($userData['password'] != $result[0]['password'])
		    {
                return $this->view->showError("username or password is incorrect");
            }
           

            if ($result != null) {
              
                session_start(); 
                $_SESSION['username'] = $result[0]['username'];
                return $this->view->showSuccess("Login Successfully!");
                
              

                 
            }
        }

        // function processUserLogoutRequest() {

          
        //     // Initialize the session.
        //     // If you are using session_name("something"), don't forget it now!
        //     session_start();
        
        //     // Unset all of the session variables.
        //     $_SESSION = array();
        
        //     // If it's desired to kill the session, also delete the session cookie.
        //     // Note: This will destroy the session, and not just the session data!
        //     if (ini_get("session.use_cookies")) {
        //         $params = session_get_cookie_params();
        //         setcookie(session_name(), '', time() - 42000,
        //             $params["path"], $params["domain"],
        //             $params["secure"], $params["httponly"]
        //         );
        //     }
        
        //     // Finally, destroy the session.
        //     session_destroy();
        // }
        


        private function notifyClient($code) {
            /*simply print out the notification code for now
            but in the future JSON can be used to encode the
            communication protocol between client and server
            */		
            //print $code;
        }
        

    

        private function handleMemberSignUpRequest () {
            $keys = array('surname', 'other_name', 'email', 'contact_method', 'mobile', 'landline', 'magazine', 'street', 'postcode', 'suburb', 'username', 'password', 'occupation');


            //print_r($_REQUEST);
           
           
            $memberdata = array ();

            if($_REQUEST['mobile'] == null){
                $_REQUEST['mobile'] = '';
            }

            if($_REQUEST['landline'] == null){
                $_REQUEST['landline'] = '';
            }

            if($_REQUEST['email'] == null){
                $_REQUEST['email'] = '';
            }



            foreach ($keys as $key) {
                if (!empty($_REQUEST[$key] || $key == 0 || $key == 1)) 
                {
                    $memberdata[$key] = $_REQUEST[$key];
                } 
                else 
                {
                    $this->view->showError($key. ' cannot be blank');
                    return;
                
                }

            }

            $result = $this->model->createMember($memberdata);

            


            

            if ($result != null) 
            {
                $this->notifyClient(ERR_SUCCESS);
            }
            else 
            {
               // print "Username already taken";
                $error = $this->model->getError();
                if (!empty($error))
                    $this->view->showError($error);			
            }
        }

        private function handleSelectAllMovieRequest () {
            $movies = $this->model->selectAllMovies();

        

            if($movies != null){
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if(!empty($error))
                    $this->view->showError($error);
            }  
        }

        private function handleSelectAllMovieActorRequest (){
            
            if($movies != null){
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if(!empty($error))
                    $this->view->showError($error);
            }  
        }

        private function handleSelectNewMovieReleasesRequest () {
            $movies = $this->model->selectMoviesNewReleases();
            
            if($movies != null){
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if(!empty($error))
                    $this->view->showError($error);
            }
        }

        private function handleSelectNewMovieLeftNavReleasesRequest () {
            $movies = $this->model->selectMoviesLeftNavNewReleases();
            
            if($movies != null){
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if(!empty($error))
                    $this->view->showError($error);
            }
        }

        /*
            Handles filter movies request
        */
        private function handleActorFilterMovieRequest() {		
            $condition = array();	
            if (!empty($_REQUEST['actor']))
                $condition['actor_id'] = $_REQUEST['actor']; //submitted is make id and not make name
            //call the dbAdapter function
            $movies = $this->model->filterActorMovies($condition);
            if ($movies != null) {
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if (!empty($error))
                    $this->view->showError($error);
            }
        }

        /*
            Handles filter movies request
        */
        private function handleDirectorFilterMovieRequest() {		
            $condition = array();	
            if (!empty($_REQUEST['director']))
                $condition['director_id'] = $_REQUEST['director']; //submitted is make id and not make name
            //call the dbAdapter function
            $movies = $this->model->filterDirectorMovies($condition);
            if ($movies != null) {
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if (!empty($error))
                    $this->view->showError($error);
            }
        }

        /*
            Handles filter movies request
        */
        private function handleGenreFilterMovieRequest() {		
            $condition = array();	
            if (!empty($_REQUEST['genre']))
                $condition['genre_id'] = $_REQUEST['genre']; //submitted is make id and not make name
            //call the dbAdapter function
            $movies = $this->model->filterGenreMovies($condition);
            //print_r($movies);
            if ($movies != null) {
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if (!empty($error))
                    $this->view->showError($error);
            }
        }

        /*
            Handles filter movies request
        */
        private function handleClassificationFilterMovieRequest() {		
            $condition = array();	
            if (!empty($_REQUEST['classification']))
                $condition['classification_name'] = $_REQUEST['classification']; //submitted is make id and not make name
            //call the dbAdapter function
            $movies = $this->model->filterClassificationMovies($condition);
            if ($movies != null) {
                $this->view->showMovies($movies);
            } else {
                $error = $this->model->getError();
                if (!empty($error))
                    $this->view->showError($error);
            }
        }


        /*
            ---------------------------------------
            LOGIN FUNCTIONS
            -------------------------------------
        */
    
        /* Gets, validates and returns submitted data in $user array
        */
        function getUserData($mandatory=false) {
            global $error;
            $user = null;
            $error = null;
            
            //retrive all submitted data
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST["uname"]))
                    $user['username'] = htmlspecialchars($_POST["uname"]);		
                if (!empty($_POST["pass"]))
                    $user['password'] = htmlspecialchars($_POST["pass"]);
            }	
            if ($mandatory) {
                //validate all submitted fields
                if (!preg_match(regexUsername, $user['username'])) {
                    $error = errUsername;
                } else
                if (!preg_match(regexPassword, $user['password'])) {
                    $error = errPassword;
                }		
            } else {
                if ($user == null) {
                    $error = errorEmptyData;
                }
            }
            
            if ($error != null) {
                return null;
            }
                
            return $user;
        }

    }
?>