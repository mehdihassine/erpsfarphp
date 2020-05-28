<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 
$type="vente";
$etat="valide";
// update statut recep

		$sql =  "INSERT INTO `facture`(`idfacture`, `nfacture`, `type`, `etat`) 
		VALUES ('NULL','$nfacture','$type','$etat')";
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