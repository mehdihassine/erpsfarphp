<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nfacture= $request->nfacture; //
		$nligne = $request->nligne; //
		$codarticle = $request->codarticle;//
		$quantite = $request->quantite;
		$nomclient= $request->nomclient;
		$adresse = $request->adresse;
		
		$type='vente';//
		
		$datesys= date("Y-m-d- H:i:s");//

 
 		$sql =  "SELECT prixvente , nomProduit, tva FROM produit where idProduit = $codarticle" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$table[0] =$row; 
		
			$nomProduit =$table[0]['nomProduit']; 
			$prixvente =$table[0]['prixvente'];
			$tva =$table[0]['tva'];
			//print ($codartid1[0]['id']); //codartid
			
			$montanttotal = $quantite*$prixvente;//
	          $montanttva = (($quantite*$prixvente) *$tva)/100;
			  $montantTHT=$montanttotal-$montanttva;
			  
			  $etat = "cree";
			  
			  
			  
			  
			  
	$insertdepot =  "INSERT INTO `facture`(
	`idfacture`, `nfacture`, `type`,
	`montanttotal`, `datesys`, `idfournisseur`,
	`description`, `idproduit`, `quantite`, `nomclient`,
	`adresse`, `montanttva`, `montantTHT`,`nligne`,`etat`) 
	VALUES
	('','$nfacture','$type',
	'$montanttotal','$datesys','',''
	,'$codarticle ','$quantite ','$nomclient',
	'$adresse',' $montanttva ','$montantTHT','$nligne','$etat')"; 
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
		$resp1 = array ("$nfacture","$nligne","$codarticle","$quantite","$nomclient");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur add ligne facture");
	echo json_encode ($resp0);			
	
		}
 
 
		
    }
    else {
echo json_encode(array("0 art trouvee" ));  
    }
	
	
	
	
	}
	 else {
		echo json_encode(array( 'resp'=>'Erreur2' ));  
		}

 
?> 
