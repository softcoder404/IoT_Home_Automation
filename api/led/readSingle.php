<?php

header("Access-Control-Allow-Origin: *");
 
// Check if we got the field from the user
if (isset($_GET['id'])) {
 
    $id = $_GET['id'];
   
    // Include data base connect class
	$filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

	// Connecting to database
    $db = new DB_CONNECT();
 
	// Fire SQL query to update LED status data by id
    $result = mysql_query("SELECT * FROM led WHERE id = '$id'");
 
    // Check for succesfull execution of query and no results found
    if ($result) {
        
        $response = $result['status'];
 
        if($response == "off"){
         echo "0";   
        }else{
            echo "1";
        }
    } 
}
 else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>