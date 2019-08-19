<?php

require_once('movie_zone_config.php');

class DBAdapter {
    private $dbConnectionString;
	private $dbUser;
	private $dbPassword;
	private $dbConn; //holds connection object
    private $dbError; //holds last error message
	
	
	/* Class Constructor */
    public function __construct($dbConnectionString, $dbUser, $dbPassword) {
		$this->dbConnectionString = $dbConnectionString;
		$this->dbUser = $dbUser;
		$this->dbPassword = $dbPassword;
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
    
    /* Closes connection to the database */
	public function dbClose() {
		//in PDO assigning null to the connection object closes the connection
		$this->dbConn = null;
	}
	/* Return last database error */
	public function lastError() {
		return $this->dbError;
    }
    
    /* ------------------------------------------------------ */
    /* ---------- Database Manipulation Functions ----------- */
	/* ------------------------------------------------------ */

	/*
		Select all existing movies from the movie table
		@return: an array of matched movies
	*/
	public function movieSelectAll() {
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT title, tagline, plot, thumbpath, year FROM movie');							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		

		return $result;			
	}


	/* 
		Select all existing new release movies >=2014.
		@return: an array of matched movies.
	*/
	public function movieSelectNewReleases(){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT * FROM `movie` WHERE movie.year >= 2014' );							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		

		return $result;	
	}

	/* 
		Select all existing new release movies >=2014.
		@return: an array of matched movies.
	*/
	public function movieSelectActors(){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT * FROM `actor`' );							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		

		return $result;	
	}

	/*Select an existing car from the car table
	@param $condition: is an associative array of car's details you want to match
	@return: an array of matched cars
	*/
	public function movieActorFilter($condition) {
		$result = null;
		//print_r($condition['actor_id']);
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)

				//Turns value into int
				$limit = intval($condition['actor_id']); //casting to int type!
				$query = "SELECT * FROM table LIMIT $limit";
				$sql = "SELECT DISTINCT movie.title
				FROM movie
				JOIN movie_actor
				ON movie.movie_id = movie_actor.movie_id
				JOIN actor
				ON movie_actor.actor_id = actor.actor_id
				WHERE actor.actor_id = '$limit'";	
				$smt = $this->dbConn->prepare($sql);							  
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
	
		return $result;		
	}	


	/* 
		Select all existing new release movies >=2014.
		@return: an array of matched movies.
	*/
	public function movieSelectDirectors(){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT * FROM `director`' );							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		

		return $result;	
	}

	/*
		Select an existing car from the car table
		@param $condition: is an associative array of car's details you want to match
		@return: an array of matched cars
	*/
	public function movieDirectorFilter($condition) {
		$result = null;
		//print_r($condition['actor_id']);
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)

				//Turns value into int
				$limit = intval($condition['director_id']); //casting to int type!
				$query = "SELECT * FROM table LIMIT $limit";
				$sql = "SELECT DISTINCT movie.title, movie.director_id
				FROM movie
				JOIN director
				ON movie.director_id = director.director_id
				WHERE director.director_id = '$limit'";	
				$smt = $this->dbConn->prepare($sql);							  
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
	
		return $result;		
	}	



	//--------- GENRE ----------

	/* 
		Select all existing new release movies >=2014.
		@return: an array of matched movies.
	*/
	public function movieSelectGenres(){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT * FROM `genre`' );							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		

		return $result;	
	}

	/*
		Select an existing car from the car table
		@param $condition: is an associative array of car's details you want to match
		@return: an array of matched cars
	*/
	public function movieGenreFilter($condition) {
		$result = null;
		//print_r($condition['actor_id']);
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)

				//Turns value into int
				$limit = intval($condition['genre_id']); //casting to int type!
				$query = "SELECT * FROM table LIMIT $limit";
				$sql = "SELECT DISTINCT movie.title, movie.genre_id
				FROM movie
				JOIN genre
				ON movie.genre_id = genre.genre_id
				WHERE genre.genre_id = '$limit'";	
				$smt = $this->dbConn->prepare($sql);							  
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
	
		return $result;		
	}	
				
	//--------- GENRE ----------

	/* 
		Select all existing new release movies >=2014.
		@return: an array of matched movies.
	*/
	public function movieSelectClassifications(){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'SELECT DISTINCT classification FROM `movie`' );							  				
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}

		return $result;	
	}

	/*
		Select an existing car from the car table
		@param $condition: is an associative array of car's details you want to match
		@return: an array of matched cars
	*/
	public function movieClassificationFilter($condition) {
		$result = null;



		//print_r($condition['classification_name']);
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)

				//Turns value into int
				$classification = $condition['classification_name']; //casting to int type!
				$sql = "SELECT DISTINCT movie.title, movie.classification
				FROM movie
				WHERE movie.classification = '$classification'";	
				$smt = $this->dbConn->prepare($sql);							  
				//Execute the query
				$smt->execute();
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				//use PDO::FETCH_BOTH to have both column name and column index
				//$result = $sql->fetchAll(PDO::FETCH_BOTH);
			}catch (PDOException $e) {
				//Return the error message to the caller
				$this->dbError = $e->getMessage();
				$result = null;
			}
		} else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
	
		return $result;		
	}	
}