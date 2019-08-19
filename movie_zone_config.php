<?php

//define ('DB_CONNECTION_STRING', "mysql:host=localhost;dbname=bv_caryard_db");
define ('DB_CONNECTION_STRING', "mysql:host=localhost;dbname=jthoma34_moviezone_db");
define ('DB_USER', "jthoma34");
define ('DB_PASS', "29051999");
define ('MSG_ERR_CONNECTION', "Open connection to the database first");

//request command messages for client-server communication using AJAX
define ('CMD_REQUEST','request'); //the key to access submitted command via POST or GET
define ('CMD_MOVIE_SELECT_ALL', 'cmd_movie_select_all');
define('CMD_MOVIE_SELECT_NEW_RELEASES', 'cmd_movie_select_new_releases');

define('CMD_SHOW_TOP_ACTOR_NAV', 'cmd_show_top_actor_nav'); 
define('CMD_MOVIE_ACTOR_FILTER', 'cmd_movie_actor_filter');


define('CMD_SHOW_TOP_DIRECTOR_NAV', 'cmd_show_top_director_nav'); 
define('CMD_MOVIE_DIRECTOR_FILTER', 'cmd_movie_director_filter');

define('CMD_SHOW_TOP_GENRE_NAV', 'cmd_show_top_genre_nav'); 
define('CMD_MOVIE_GENRE_FILTER', 'cmd_movie_genre_filter');

define('CMD_SHOW_TOP_CLASSIFICATION_NAV', 'cmd_show_top_classification_nav'); 
define('CMD_MOVIE_CLASSIFICATION_FILTER', 'cmd_movie_classification_filter');




require_once('movie_zone_dba.php');
require_once('movie_zone_model.php');
require_once('movie_zone_view.php');
require_once('movie_zone_controller.php');

?>
