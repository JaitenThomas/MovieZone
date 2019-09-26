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
	public function insertMemberData($member) {

		
		//print_r($member['email']);

		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)
				$smt = $this->dbConn->prepare(
					'
					INSERT INTO member(surname, other_name, contact_method, email, mobile, landline, magazine, street, postcode, suburb, username, password, occupation)
					VALUES (:surname, :other_name, :contact_method, :email, :mobile, :landline, :magazine, :street, :postcode, :suburb, :username, :password, :occupation);
					'
					);
					
				//Bind the data from the form to the query variables.
				//Doing it this way means PDO sanitises the input which prevents SQL injection.
				$smt->bindParam(':surname', $member['surname'], PDO::PARAM_STR);
				$smt->bindParam(':other_name', $member['other_name'], PDO::PARAM_STR);
				//$smt->bindParam(':contact_method', $member['contact_method'], PDO::PARAM_STR); //float is accepted as PARAM_STR
				$smt->bindParam(':contact_method', $member['contact_method'], PDO::PARAM_STR);
				$smt->bindParam(':email', $member['email'], PDO::PARAM_STR); //make id
				$smt->bindParam(':mobile', $member['mobile'], PDO::PARAM_INT); //body id
				$smt->bindParam(':landline', $member['landline'], PDO::PARAM_INT);
				$smt->bindParam(':magazine', $member['magazine'], PDO::PARAM_INT);
				$smt->bindParam(':street', $member['street'], PDO::PARAM_STR);
				$smt->bindParam(':postcode', $member['postcode'], PDO::PARAM_INT);					
				$smt->bindParam(':suburb', $member['street'], PDO::PARAM_STR); //state id		
				$smt->bindParam(':username', $member['username'], PDO::PARAM_STR); //state id		
				$smt->bindParam(':password', $member['password'], PDO::PARAM_STR); //state id		
				$smt->bindParam(':occupation', $member['occupation'], PDO::PARAM_STR); //state id		
				//$smt->bindParam(':join_date', $member['join_date'], PDO::PARAM_INT); //state id		

				//Execute the query
				$smt->execute();

				
				// $result_actors = $smt1->fetchAll(PDO::FETCH_ASSOC);
				//$result = $smt->dbConn->lastInsertId();
				

				//use PDO::FETCH_BOTH to have both column name and column index
				// $result = $sql->fetchAll(PDO::FETCH_BOTH);
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
					'SELECT * FROM movie 
					join genre on movie.genre_id = genre.genre_id
					join director on movie.director_id = director.director_id
					join studio on studio.studio_id = movie.studio_id
					join movie_detail_view on movie_detail_view.movie_id = movie.movie_id');							  				
				//Execute the query
				$smt->execute();

				
				// $result_actors = $smt1->fetchAll(PDO::FETCH_ASSOC);
				$result = $smt->fetchAll(PDO::FETCH_ASSOC);	
				

				//use PDO::FETCH_BOTH to have both column name and column index
				// $result = $sql->fetchAll(PDO::FETCH_BOTH);
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
	public function movieSelectNewReleases($max){
		$result = null;
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				//Make a prepared query so that we can use data binding and avoid SQL injections. 
				//(modify suit the A2 member table)

				$smt = $this->dbConn->prepare(
					"SELECT * FROM movie 
					join genre on movie.genre_id = genre.genre_id
					join director on movie.director_id = director.director_id
					join studio on studio.studio_id = movie.studio_id
					join movie_detail_view on movie_detail_view.movie_id = movie.movie_id
					ORDER BY RAND()
					LIMIT $max");	
					  				
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

		//print_r($result);

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

				$sql = "SELECT * FROM movie_detail_view
					JOIN movie_actor_view ON movie_actor_view.movie_id = movie_detail_view.movie_id
					JOIN actor on movie_actor_view.actor_name = actor.actor_name
					where actor.actor_id = '$limit';
					"
				;
				
				
				// $sql = "SELECT DISTINCT movie.title
				// FROM movie
				// JOIN movie_actor
				// ON movie.movie_id = movie_actor.movie_id
				// JOIN actor
				// ON movie_actor.actor_id = actor.actor_id
				// WHERE actor.actor_id = '$limit'";	
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

				$sql = "SELECT * FROM movie_detail_view
						JOIN genre on genre.genre_name = movie_detail_view.genre
				 		where genre.genre_id = '$limit'";

				// $sql = "SELECT DISTINCT movie.title, movie.director_id
				// FROM movie
				// JOIN director
				// ON movie.director_id = director.director_id
				// WHERE director.director_id = '$limit'";	
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
				$sql = "SELECT * FROM genre
					JOIN movie_detail_view on movie_detail_view.genre = genre.genre_name
					where genre.genre_id = '$limit'";	
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
				$sql = "SELECT * FROM movie_detail_view 
					where movie_detail_view.classification = '$classification'";	
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



	/*Select an existing user from the database (TAB_USER)
	+ $user: is an associative array of user's details. 
	  Fill in the details you want to match	
	*/
	function userSelect($userData) {
		$result = null;


		$username = $userData['username'];
		$password = $userData['password'];
		// Get the user password.

		
		$this->dbError = null; //reset the error message before any execution
		if ($this->dbConn != null) {		
			try {
				$sql = "SELECT * FROM `member`
				where username = '$username'";	
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
	
		// if($result['password']){

		// }

		// print_r($result[0]['password']);

		// if($password != $result[0]['password'])
		// {
		// 	print "username or password is incorrect";
		// }


		return $result;		
	}

	function movieAmountDecrease($id) {
		$result = null;

		if($this->dbConn != null){
			try {
				$sql = "UPDATE movie set numDVD = numDVD - 1
				where movie_id = '$id'";	
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
		}
		else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
	}

	function movieWithId($id){
		$result = null;

		if($this->dbConn != null){
			try {
				$sql = "SELECT title, tagline, year, numDVD, numBluRay, numBluRayOut, numDVDout, thumbpath from movie
				where movie_id = '$id'";	
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
		}
		else {
			$this->dbError = MSG_ERR_CONNECTION;
		}
		
		return $result;
	}



// function testDBA() {
		
// 	$dbAdapter = new DBAdapter(DB_CONNECTION_STRING, DB_USER, DB_PASS);	

	

// 	// $car = array(
// 	// 'photo' => 'car1.jpg',
// 	// 'price' => 2000.0,	
// 	// 'car_id' => 7,
// 	// 'make_id' => 2,
// 	// 'body_id' => 2,
// 	// 'odometer' => 47000,
// 	// 'year' => 1970,
// 	// 'state_id' => 1,
// 	// 'title' => "Vinh's car"
// 	// );


// 	$dbAdapter->dbOpen();
// 	//$dbAdapter->db();
	
// 	$result = $dbAdapter->movieSelectAllActors(2);
// //	$result = $dbAdapter->carSelectRandom(2);	
// //	$result = $dbAdapter->carSelectAll();	
// //	$result = $dbAdapter->carFilter($car);	

// //	$result = $dbAdapter->stateSelectAll();	
// //	$result = $dbAdapter->makeSelectAll();	
// //	$result = $dbAdapter->bodySelectAll();	

// 	if ($result != null)		
// 		print_r($result);
// 	else
// 		echo $dbAdapter->lastError();

// 		foreach ($result as $element) {			
// 			echo $element['actor_name'].'<br>'; 
// 		}
	
// 	$dbAdapter->dbClose();
// }

// //execute the test
// 	testDBA();

}

?>
