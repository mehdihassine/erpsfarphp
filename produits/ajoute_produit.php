<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$nm=$request->name;
		$di=$request->diamaitre;
		$pr=$request->prixP;
		$pv=$request->prixV;
		$ds=$request->desc;
		$ty=$resquest->type;
		
		$sql =  " INSERT INTO `produit`(`idProduit`, `diametre`, `nomProduit`, `coutrevien`, `prixvente`, `descriptionProduit`, `typeProduit_id`) 
		VALUES ('NULL','$di','$nm','$pr','$pv','$ds','1')  " ; 
        $result = mysqli_query($conn, $sql);
		
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' Produit ajoutee ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur Ajout ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur ajout Produit' ));  
    }
 
?> 