<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$idProduit=$request->idProduit ; 
		$diametre=$request->diametre;
		$nomProduit=$request->nomProduit;
		$coutrevien=$request->coutrevien;
		$prixvente=$request->prixvente;
		$description=$request->descriptionProduit;
		$type=$request->type;
		$tva=$request->tva; 
		
		
		$sql2="SELECT `idtype` FROM `categorie` WHERE `libelle`='$type'";
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	

									while($row =   mysqli_fetch_assoc($result2))
									$tab[0] =$row; 
									$idtype = $tab[0]['idtype'];
		}
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune categorie trouvee' )); 
		}







		$sql =  "UPDATE `produit` SET `idProduit`='$idProduit',`diametre`='$diametre',`nomProduit`='$nomProduit',`coutrevien`='$coutrevien',
		`prixvente`='$prixvente',`descriptionProduit`='$description',`typeProduit_id`='$idtype',`tva`='$tva' WHERE `idProduit`='$idProduit'";
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	



			$sql3="SELECT * FROM `produit` e ,`categorie`s  WHERE `idProduit`='$idProduit'   AND   s.idtype=e.typeProduit_id" ;
		
			$result3 = mysqli_query($conn, $sql3);
			if ($result3->num_rows > 0) {	
				while($row = mysqli_fetch_assoc($result3)) 
				$tab[] =$row; 
				print(json_encode($tab)); 
			}else { 
				echo json_encode(array( 'RESPONSE'=>'Aucune caregorie trouvee' )); 
			}




			//echo json_encode(array( 'RESPONSE'=>' modifiee' )); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur modification' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?>