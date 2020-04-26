<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 

// update statut recep

		$sql =  "UPDATE `facture` SET `etat`='valide' WHERE `nfacture` = '$nfacture' and `type`='divers'";
        $result = mysqli_query($conn, $sql);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
		echo json_encode(array('resp'=>"facture $nfacture = validee" ));
		}
		 else {echo json_encode(array( 'resp'=>'facture non validee' ));}
	
// update stock



	
    }

    else {
		echo ('Erreur facture parametres');  
    }
 
?> 