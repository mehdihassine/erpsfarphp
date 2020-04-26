<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nreception = $request->nreception;
		$nligne = $request->nligne;
		$codarticle = $request->codarticle;
		$quantite = $request->quantite;
		$prixunit = $request->prix;
		$fournisseur = $request->fournisseur;
		$bl = $request->bl;
		
		$usercreation = "SYS";
		$datecreation = date("Y-m-d- H:i:s");

 
 		$sql =  "SELECT id FROM article where codarticle = $codarticle" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$codartid1[0] =$row; 
		
			$codartid =$codartid1[0]['id']; 
			$prixvente =$codartid1[0]['prixvente'];
			//print ($codartid1[0]['id']); //codartid
			
			$montanttotal = $quantite*$prixunit;
	
	$insertdepot =  "INSERT INTO `recep`(
	`id`, `nreception`, `nligne`, `codarticle`,
	`quantite`, `prixunit`, `nfacture`,
	`usercreation`, `datecreation`, `codartid`,
	`montanttotal`, `fournisseur`, `statut`, `bl`)
	VALUES (
	'','$nreception','$nligne','$codarticle',
	'$quantite','$prixunit','',
	'$usercreation','$datecreation','$codartid','$montanttotal',
	'$fournisseur','cree','$bl')"; 
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
		$resp1 = array ("$nreception","$nligne","$codarticle","$quantite","$codartid");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur add ligne recep");
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
