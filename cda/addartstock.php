<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
		$request = json_decode($postdata);
		
		$codarticle = $request->codarticle;
		$quantite = $request->quantite;
		$emplacement = "DEBORD";
		$pump = 0;
		$dateentree = date("Y-m-d- H:i:s");
		$nsupport = 0;
		$codartid;
		$nreception = $request->nreception;
		$depot = 'null';
		$userentree = "SYS";
		$etat = "recu";
		
		
		
		//selecet from article => codartid!!!
		
		$sql =  "SELECT id FROM article where codarticle = $codarticle" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$codartid1[0] =$row; 
			$codartid =$codartid1[0]['id']; 
		
		
		
		
		/////
		
		

				
	
	$insertstock =  "INSERT INTO `stock`(
	`id`, `codarticle`, `quantite`, `emplacement`, `pump`,
	`dateentree`, `datesortie`, `nsupport`, `codartid`,
	`nreception`, `evsortie`, `depot`, `userentree`, `usersortie`, `etat`)VALUES (
	'','$codarticle','$quantite','$emplacement','$pump',
	'$dateentree','','$nsupport','$codartid','$nreception','',
	'$depot','$userentree','','$etat')"; 
		
     $resultInsertstock = mysqli_query($conn, $insertstock);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
		$resp1 = array ("stock ajoutee");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur ajout stock");
	echo json_encode ($resp0);			
	
		}
 
 
		
    }
    else {
echo json_encode(array("art non trouvee" ));  
    }
	
	
	
	
	}
	 else {
		echo json_encode( "erreur parametre stock" );  
		}

 
?> 
