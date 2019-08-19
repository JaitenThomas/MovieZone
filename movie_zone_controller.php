<?php 

    require_once('movie_zone_controller.php');

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
            print_r($_REQUEST);
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

    }
?>