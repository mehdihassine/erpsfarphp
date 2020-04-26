<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$ncommande = $request->ncommande;
		$nligne = $request->nligne;
		$codarticle = $request->codarticle;
		$quantite = $request->quantite;

		
		$usercreation = "SYS";
		$datecreation = date("Y-m-d- H:i:s");

 
 		$sql =  "SELECT id, prixvente FROM article where codarticle = $codarticle" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$codartid1[0] =$row; 
		
			$codartid =$codartid1[0]['id']; 
			$prixvente =$codartid1[0]['prixvente'];
			//print ($codartid1[0]['id']); //codartid
			
			$montanttotal = $quantite*$prixvente;
			
			
			
			
	$insertdepot =  "INSERT INTO `cdv`(`id`, `ncommande`, `nligne`, `statut`,
		`codarticle`, `quantite`,
		`usercreation`, `datecreation`, `codartid`,`montanttotal`) 
		VALUES ('','$ncommande','$nligne','cree','$codarticle','$quantite',
		'$usercreation','$datecreation','$codartid',$montanttotal)"; 
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
		$resp1 = array ("$ncommande","$nligne","$codarticle","$quantite");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur add cdv");
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
