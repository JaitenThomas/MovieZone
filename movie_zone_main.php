<?php

    require_once('movie_zone_config.php');

    $model = new MovieZoneModel();
    $view = new MovieZoneView();
    $controller = new MovieZoneController($model, $view);

    /* interacts with UI via GET/POST methods and process all requests */
if (!empty($_REQUEST[CMD_REQUEST])) 
{ //check if there is a request to process
	$request = $_REQUEST[CMD_REQUEST];	
	$controller->processRequest($request);
}

?>