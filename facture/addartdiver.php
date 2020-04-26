<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nfacture= $request->nfacture; //
		$nligne = $request->nligne; //
		$description = $request->description;//
		$montant = $request->montant;
	
		
		$type='divers';//
		
		$datesys= date("Y-m-d- H:i:s");//

 $etat='creer';
 
	$insertdepot =  "INSERT INTO `facture`
	(`idfacture`, `nfacture`, `type`,
	`montanttotal`, `datesys`, `idfournisseur`,
	`description`, `idproduit`, `quantite`, 
	`nomclient`, `adresse`, `montanttva`,
	`montantTHT`, `nligne`, `etat`) VALUES
	('','$nfacture','$type',
	'$montant','$datesys','',
	'$description','0','',
	'','','',
	'','$nligne','$etat')";
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
	
		$resp1 = array ("$nfacture","$nligne");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur add ligne facture");
	echo json_encode ($resp0);			
	
		}
 
 
		
    
   
	
	
	
	
	}
	 else {
		echo json_encode(array( 'resp'=>'Erreur2' ));  
		}

 
?> 
