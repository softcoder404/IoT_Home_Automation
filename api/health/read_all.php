<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");
 // Connecting to database 
$db = new Database();	
 
$conn = $db->connect();
 // Fire SQL query to get all data from weather
$query = "SELECT * FROM health";

$stmt = $conn->prepare($query);

$stmt->execute();

$count = $stmt->rowCount();
// Check for succesfull execution of query and no results found
if ($count > 0) {
    
	// Storing the returned array in response
    $response["health"] = array();
 
	// While loop to store all the returned response in variable
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // temperoary user array
        $health = array();
        $health["id"] = $row["id"];
        $health["temp"] = $row["temp"];
		$health["pulse"] = $row["pulse"];
		// Push all the items 
        array_push($response["health"], $health);
    }
    // On success
    $response["success"] = 1;
 
    // Show JSON response
    echo json_encode($response);
}	
else 
{
    // If no data is found
	$response["success"] = 0;
    $response["message"] = "No data on weather found";
 
    // Show JSON response
    echo json_encode($response);
}
?>