<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idfr=$request->idfr;
		$nomfourniseur = $request->nomfourniseur;
		$telephone=$request->telephone;
		$email=$request->email; 
		$ville=$request->ville; 
		$fax=$request->fax;
		$codepostal=$request->codepostal;
		$adress=$request->adress;
		
		$sql =  "  UPDATE `fournisseur` SET `idfr`='$idfr',`nomfr`='$nomfourniseur',`telfr`='$telephone',`mailfr`='$email',
		`villefr`='$ville',`fax`='$fax',`codepostal`='$codepostal',`adresse`='$adress' 
		WHERE
			idfr = '$idfr'  " ; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
	//echo json_encode(array( 'RESPONSE'=> 'modifiee' )); 

$sql2="SELECT * FROM `fournisseur` WHERE `idfr`='$idfr'";
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune article trouvee' )); 
		}



		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur modification' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
   