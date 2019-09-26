/*Use onload event to load the page with random cars
*/
window.addEventListener("load", function(){
    makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_select_all', null, updateContent);
	//show the top navigation panel
	document.getElementById('id_topnav').style.display = "none";
});

function SendUserToLogin () {
	location.href = 'login.php';
}

function LogOutUser(){
	
	location.href = 'logout_user.php';
	//location.href = 'index.php';

}


function movieShowAllClick(){
	document.getElementById('id_topnav').style.display = "none";
	document.getElementById('id_content').innerHTML = "";
	makeAjaxGetRequest('movie_zone_main.php','cmd_movie_select_all', null, updateContent);
}

function movieNewReleasesFilterClick(){
	document.getElementById('id_topnav').style.display = "none";
	document.getElementById('id_content').innerHTML = "";
    makeAjaxGetRequest('movie_zone_main.php','cmd_movie_select_new_releases', null, updateContent);
}


// ------------- ACTOR -------------

function movieActorButtonClick(){
	document.getElementById('id_content').innerHTML = "";
    makeAjaxGetRequest('movie_zone_main.php','cmd_show_top_actor_nav', null, updateTopNav);
}

function movieActorFilterSearchClick() {
	var actor = document.getElementById('id_actor').value;



	var params = '';
	
	if (actor != 'all'){
		params += '&actor=' + actor;
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_actor_filter', params, updateContent);
	} else {
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_select_all', params, updateContent);
	}
}

//----------DIRECTOR------------------------------------

function movieDirectorButtonClick(){
	document.getElementById('id_content').innerHTML = "";
	makeAjaxGetRequest('movie_zone_main.php','cmd_show_top_director_nav', null, updateTopNav);
}

function movieDirectorFilterSearchClick() {
	var director = document.getElementById('id_director').value;
	var params = '';

	
	if (director != 'all'){
		params += '&director=' + director;
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_director_filter', params, updateContent);
	} else {
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_select_all', params, updateContent);
	}
}

//----------GENRE------------------------------------

function movieGenreButtonClick(){
	document.getElementById('id_content').innerHTML = "";
	makeAjaxGetRequest('movie_zone_main.php','cmd_show_top_genre_nav', null, updateTopNav);
}

function movieGenreFilterSearchClick() {
	var genre = document.getElementById('id_genre').value;
	var params = '';

	
	if (genre != 'all'){
		params += '&genre=' + genre;
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_genre_filter', params, updateContent);
	} else {
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_select_all', params, updateContent);
	}
}

//----------Classification------------------------------------

function movieClassificationButtonClick(){
	document.getElementById('id_content').innerHTML = "";
	makeAjaxGetRequest('movie_zone_main.php','cmd_show_top_classification_nav', null, updateTopNav);
}

function movieClassificationFilterSearchClick() {
	var classification = document.getElementById('id_classification').value;
	var params = '';
	
	if (classification != 'all'){
		params += '&classification=' + classification;
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_classification_filter', params, updateContent);
	} else {
		makeAjaxGetRequest('movie_zone_main.php', 'cmd_movie_select_all', params, updateContent);
	}
}

/*Updates the content area if success
*/
function updateContent(data) {
	document.getElementById('id_content').innerHTML = data;
}

/*Updates the top navigation panel
*/
function updateTopNav (data) {
	var topnav = document.getElementById('id_topnav');
	topnav.innerHTML = data;
	topnav.style.display = "inherit";
}


function addMovieToCheckOut ($id, $count) {

	


	var params = '';

	if($id != null){
		params += '&id=' + $id;
	}

	//Make an ajax request to reduce the movie rental amount;
	makeAjaxPostRequest('movie_zone_main.php','cmd_decrease_movie_rental_amount', params, success, false, false);
	function success(data) 
      {       

			
			makeGetMovieByIdRequest($id);
		
			if($count >= 4)
			{
				document.location = "booking.php";
			}
			else 
			{
				document.location.reload();
			}
			
			console.log(data);
        
            
		} 
      }

	//console.log('add movied ' + $movie_id);



function makeGetMovieByIdRequest ($movie_id) {


	var params = '';

	if($movie_id != null){
		params += '&id=' + $movie_id;
	}
	

	makeAjaxGetRequest('movie_zone_main.php','cmd_movie_select_by_id', params, updateContent, false);



}

function SendUserToCheckOut(){
	location.href = 'booking.php';
}
