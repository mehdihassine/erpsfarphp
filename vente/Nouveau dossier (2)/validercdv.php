<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 

		$sql =  "UPDATE `production` SET `etat`='valide' WHERE `numproduction` = '$id'";
        $result = mysqli_query($conn, $sql);
		
				
		$nbrow = mysqli_affected_rows($conn);

		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"prod $id = validee" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'prod non validee' ));}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 