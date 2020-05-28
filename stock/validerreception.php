<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nreception = $_GET['nreception'] ; 
		$type="achat";
		$etat='valide';

// update statut recep

		$sql =  "UPDATE `stock` SET `etat`='valide' WHERE `nreception` = '$nreception'";
        $result = mysqli_query($conn, $sql);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
			insertfacture($conn,$nreception,$type,$etat);
		}
		 else {echo json_encode(array( 'resp'=>'reception non validee' ));}
	
// update stock



	
    }
	
    else {
		echo ('Erreur facture parametres');  
    }
	function insertfacture($conn,$nreception,$type,$etat)
	{
		$sql =  "INSERT INTO `facture`(`idfacture`, `nfacture`, `type`, `etat`) 
		VALUES ('NULL','$nreception','$type','$etat')";
        $result = mysqli_query($conn, $sql);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
		echo json_encode(array('resp'=>"facture $nfacture = validee" ));
		}
		 else {echo json_encode(array( 'resp'=>'facture non validee' ));}
	
	}	
?> 