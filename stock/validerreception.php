<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nreception =$_GET['nreception'] ; 
		$type="achat";
		$etat='valide';
		$sql =  "SELECT SUM(montant) as montant ,SUM(quantite) as quantite ,SUM(montantht) as montantht ,SUM(montantremise) as montantremise,numfact,fournisseur_id FROM lignestock l,stock f  where f.nreception='$nreception' AND l.idreception=f.idstock" ;
		 $result = mysqli_query($conn, $sql);
	
		 if ($result->num_rows > 0) {	
			 $row = mysqli_fetch_assoc($result);
			 $montant =$row['montant']; 
			 $quantite =$row['quantite']; 
			 $montantht =$row['montantht']; 
			 $montantremise =$row['montantremise']; 
			 $numfacture =$row['numfact']; 
			 $fournisseur_id =$row['fournisseur_id']; 
			 $montants=round(($montant),3);
			 $montanthts=round(($montantht),3);
			 $montantremises=round(($montantremise),3);
				
		$req= "UPDATE `stock` SET `quantites`='$quantite',`prixTotal`='$montanthts',`etat`='$etat'WHERE nreception='$nreception'"; 	
		$result = mysqli_query($conn, $req);	
		 $nbrow = mysqli_affected_rows($conn);
		 if ($nbrow>0) { 
		
		
		 }
		  else {echo json_encode(array( 'resp'=>'facture non update' ));}
	 }
	 else {
		echo json_encode(array( 'resp'=>'errrreeur non update' ));
	 }
// update statut recep
// insertfacture($conn,$nreception,$type,$etat);
// 		$sql =  "UPDATE `stock` SET `etat`='valide' WHERE `nreception` = '$nreception'";
//         $result = mysqli_query($conn, $sql);	
// 		$nbrow = mysqli_affected_rows($conn);
// 		if ($nbrow>0) { 
		
// 		}
// 		 else {echo json_encode(array( 'resp'=>'reception non validee' ));}
	
// update stock



	
    }
	
    else {
		echo ('Erreur facture parametres');  
    }
	// function insertfacture($conn,$nreception,$type,$etat)
	// {
	// 	$sql =  "INSERT INTO `facture`(`idfacture`, `nfacture`, `type`, `etat`) 
	// 	VALUES ('NULL','$nreception','$type','$etat')";
    //     $result = mysqli_query($conn, $sql);	
	// 	$nbrow = mysqli_affected_rows($conn);
	// 	if ($nbrow>0) { 
	// 	echo json_encode(array('resp'=>"facture $nfacture = validee" ));
	// 	}
	// 	 else {echo json_encode(array( 'resp'=>'facture non validee' ));}
	
	// }
	// function update ($conn,$nfacture,$etat){
	// 	$sql =  "SELECT SUM(montant) as montant, SUM(quantite) as quantite, SUM(montantht) as montantht ,SUM(montantremise) as montantremise,numfacture,fournisseur_id
	// 	FROM lignestock l,stock f  where f.nreception='$nreception' AND l.idreception=f.idstock" ;
	// 	 $result = mysqli_query($conn, $sql);
	// 	 if ($result->num_rows > 0) {	
	// 		 $row = mysqli_fetch_assoc($result);
	// 		 $montant =$row['montant']; 
	// 		 $quantite =$row['quantite']; 
	// 		 $montantht =$row['montantht']; 
	// 		 $montantremise =$row['montantremise']; 
	// 		 $numfacture =$row['numfacture']; 
	// 		 $fournisseur_id =$row['fournisseur_id']; 
	// 		 echo json_encode(array( 'resp'=> $montant));
	// 		 echo json_encode(array( 'resp'=>$quantite ));
	// 		 echo json_encode(array( 'resp'=>$montantht ));
	// 		 echo json_encode(array( 'resp'=> $numfacture ));
	// 		 echo json_encode(array( 'resp'=> $fournisseur_id ));

	
	// 	$req= "UPDATE `stock` SET `quantites`='$quantite',`prixTotal`='$montantht',`etat`='$etat'WHERE nreception='$nreception'"; 	
	// 	$result = mysqli_query($conn, $req);	
	// 	$nbrow = mysqli_affected_rows($conn);
	// 	if ($nbrow>0) { 
		
	// 	}
	// 	 else {echo json_encode(array( 'resp'=>'facture non update' ));}
	//  }
	// }	
?> 