<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$dateprod = $request->dateprod;
		$nligne1 = $request->nligne1;
		$id_produit = $request->idproduit;
		$qteproduction = $request->qteproduction;

		
		
		$datecreation = date("Y-m-d- H:i:s");

 
 		$sql =  "SELECT idProduit, prixvente FROM produit where idProduit = '$id_produit'" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$codartid1[0] =$row; 
		
			$codartid =$codartid1[0]['idProduit']; 
			$prixvente =$codartid1[0]['prixvente'];
			//print ($codartid1[0]['idProduit']); //codartid
			
			$montanttotal = $qteproduction*$prixvente;
			
			
			
			
	$insertdepot =  "INSERT INTO `production`
	(`idproduction`, `dateprod`, `datesys`,
	`id_produit`, `qteproduction`, `qteRestProduction`,
	`qtejeter`, `prixTotal`, `benficeProd`,
	`nligne`, `qtevente`) 
	VALUES ('','$dateprod','$datecreation',
	'$id_produit','$qteproduction','',
	'','$montanttotal','',
	'$nligne1','')";
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
	
		$resp1 = array ("$dateprod","$nligne1","$id_produit","$qteproduction");
		echo json_encode ($resp1);		
		}
		
	else {
	$resp0 = array ("erreur add production");
	echo json_encode ($resp0);			
	
		}
 
 
		
    }
    else {
	echo json_encode(array( 'resp'=>"0" ));	    }
	
	
	
	
	}
	 else {
		echo json_encode(array( 'resp'=>'Erreur2' ));  
		}

 
?> 
