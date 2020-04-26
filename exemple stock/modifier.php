<?php
include('config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$qte = $request->quantite; 
		$pu = $request->prixUnt;
        $pt = $request->prixTt;		
		$da = $request-> datachat;
		$df = $request->datfin;
		$idar = $request->codear;
		$idfr = $request->codefr;
		$idd = $request->idd;
		
		$sql =  "  UPDATE  `stock` SET `qte` = '$qt', 
			`prixUnitaire` = '$pu', `prixTotal` = '$pt', 
			`datAcht` = '$da', `datFin`= '$df' , `idArticle` = '$idar' ,`idFournisseur`='$idfr' WHERE  `idStock` = '$idd'  " ; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>'Etudiant modifiee' )); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur modification' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 