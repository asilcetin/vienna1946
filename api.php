<?php
  include("functions.php");
  
  //Set header type
  header('content-type: application/json; charset=utf-8');

  //Handle the request and parameters
  $urlArray = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
  if(!empty($urlArray)) {
  	if ($urlArray[0] == "list") { //LIST REQUEST
    	$annotationID = $urlArray[1];
      $annotation = getAnnotations($annotationID);
      response(200,$annotation);
  	} 
  } else {
  	response(400,"Invalid request");
  }

  //REST HTTP response function
  function response($status,$data) {
  	header("HTTP/1.1 ".$status);
  	$response = $data;
  	$json_response = json_encode($response, JSON_PRETTY_PRINT);
  	echo $json_response;
  }


?>