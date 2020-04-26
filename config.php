<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");

 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");   
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);

}

$host ="localhost"; 
$user ="root"; 
$pass ="" ; 
$db = "bps_db" ;
$conn=mysqli_connect ($host, $user, $pass,$db); 
$conn-> set_charset("utf8"); 
if (!$conn) {
	echo json_encode(array( 'RESPONSE'=>'Connection failed to data Base' )); 
    //die("Connection failed: " . mysqli_connect_error());
} 
?>

