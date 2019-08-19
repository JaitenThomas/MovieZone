<?php

require_once('movie_zone_config.php');

class MovieZoneModel {

    private $error;
    private $dbAdapter;

    /*  Class constructor */
    public function __construct () {
        $this->dbAdapter = new DBAdapter(DB_CONNECTION_STRING, DB_USER, DB_PASS);
    }

    /*  Class destructor */
    public function __destruct () {
        $this->dbAdapter->dbClose();
    }

    /* Opens connection to the database */
	public function dbOpen() {
		try {
			$this->dbConn = new PDO($this->dbConnectionString, $this->dbUser, $this->dbPassword);
			// set the PDO error mode to exception
			$this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->dbError = null;
		}
		catch(PDOException $e) {
			$this->dbError = $e->getMessage();
			$this->dbConn = null;
		}
	}

    /*
        Closes connection to the database
	*/
	public function dbClose() {
		//in PDO assigning null to the connection object closes the connection
		$this->dbConn = null;
    }
    
    /*
        Return an error if there is one.
    */

    public function getError(){
        return $this->error;
    }

    public function selectAllMovies () {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectAll();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result;
    }

    public function selectMoviesNewReleases () {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectNewReleases();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result;
    }

    public function selectAllActors () {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectActors();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result;
    }

    /*
        Filter movies based on an actor from the database
	*/
	public function filterActorMovies($condition) {
		$this->dbAdapter->dbOpen();
		$result = $this->dbAdapter->movieActorFilter($condition);
		$this->dbAdapter->dbClose();
		$this->error = $this->dbAdapter->lastError();
		
		return $result;
    }	



    public function selectAllDirectors() {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectDirectors();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result; 
    }

    /*
        Filter movies based on a director from the database
	*/
	public function filterDirectorMovies($condition) {
		$this->dbAdapter->dbOpen();
		$result = $this->dbAdapter->movieDirectorFilter($condition);
		$this->dbAdapter->dbClose();
		$this->error = $this->dbAdapter->lastError();
		
		return $result;
    }	


    public function selectAllGenres() {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectGenres();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result; 
    }

    /*
        Filter movies based on a director from the database
	*/
	public function filterGenreMovies($condition) {
		$this->dbAdapter->dbOpen();
		$result = $this->dbAdapter->movieGenreFilter($condition);
		$this->dbAdapter->dbClose();
		$this->error = $this->dbAdapter->lastError();
		
		return $result;
    }	

    public function selectAllClassifications() {
        $this->dbAdapter->dbOpen();
        $result = $this->dbAdapter->movieSelectClassifications();
        $this->dbAdapter->dbClose();
        $this->error= $this->dbAdapter->lastError();

        return $result; 
    }

    /*
        Filter movies based on a director from the database
	*/
	public function filterClassificationMovies($condition) {
		$this->dbAdapter->dbOpen();
		$result = $this->dbAdapter->movieClassificationFilter($condition);
		$this->dbAdapter->dbClose();
		$this->error = $this->dbAdapter->lastError();
		
		return $result;
    }	
}

?>
