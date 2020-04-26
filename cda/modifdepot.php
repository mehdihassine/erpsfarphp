<?php

include('../../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id=$request->id ; 
		$coddepot = $request->coddepot;
		$libelle = $request->libelle;
		$statut = $request->statut;
		$localisation = $request->localisation;
		$defaut = $request->defaut;
		
		
		
		$datemodification = date("Y-m-d- H:i:s");
		$usermodification = "sys";
		
		$sql =  "UPDATE `depot` SET `coddepot`='$coddepot',`libelle`='$libelle',`statut`='$statut',
		`localisation`='$localisation',
		`defaut`='$defaut',`usermodification`='$usermodification',`datemodification`='$datemodification' 
		WHERE `id` = '$id'";
        $result = mysqli_query($conn, $sql);
		if ($result===true) { 
			echo json_encode(array( 'response2'=>'depot modifer '.$coddepot ));

			
		}
		
		else {
			echo json_encode(array( 'RESPONSE4'=>'erreur modification depot' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE5'=>'Erreur depot parametres' ));  
    }
 
?> 