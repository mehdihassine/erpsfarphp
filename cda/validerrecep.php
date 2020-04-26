<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nreception = $_GET['nreception'] ; 

// update statut recep

		$sql =  "UPDATE `recep` SET `statut`='valide' WHERE `nreception` = '$nreception'";
        $result = mysqli_query($conn, $sql);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
		echo json_encode(array('resp'=>"recep $nreception = validee" ));
		}
		else {echo json_encode(array( 'resp'=>'recep non validee' ));}
	
// update stock



	
    }

    else {
		echo ('Erreur recep parametres');  
    }
 
?> 