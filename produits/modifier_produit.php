<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$idd=$request->idProduit ; 
		$diam=$request->diametre;
		$nm=$request->nomProduit;
		$pp=$request->coutrevien;
		$pv=$request->prixvente;
		$des=$request->descriptionProduit;
		$tp=$request->type;
		
		$sql =  "UPDATE `produit` SET `idProduit`='$idd',`diametre`='$diam',`nomProduit`='$nm',`coutrevien`='$pp',`prixvente`='$pv',`descriptionProduit`='$des',`typeProduit_id`='$tp'
		WHERE produit.idProduit='$idd'"; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' produit modifer ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur modifier produit' ));  
    }
 
?>