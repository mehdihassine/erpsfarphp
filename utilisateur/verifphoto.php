<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		 
		$iduser=$_GET['iduser'];
		
		$sql =  "SELECT * FROM `user` WHERE `iduser`='$iduser' ";
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		$row = mysqli_fetch_assoc($result);
		print( json_encode($row)); 
		}
		
		else { 
			echo json_encode(array( 'REPONSE'=>'Erreur login : verifier vos information !!'.$iduser)); 
			echo ($iduser);
		}
	



	
    }

    else {
		echo ('Erreur login parametres');  
    }
 
?> 