<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$login = $request->login ; 
		$pass = $request->pass ; 
		
		$sql =  "SELECT * FROM `user` 
		WHERE `loginuser`='$login' AND`mpduser`='$pass' ";
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		$row = mysqli_fetch_assoc($result);
		print( json_encode($row)); 
		}
		
		else { 
			echo json_encode(array( 'REPONSE'=>'Erreur login : verifier vos information !!')); 
		}
	



	
    }

    else {
		echo ('Erreur login parametres');  
    }
 
?> 