<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {

		$request = json_decode($postdata);
		
		$libelle=$request->libelle;
		$salairet=$request->salairet;
		$salairej=round(($salairet/26),2);
		

	$sql1 =  " select libelle FROM  specialiter WHERE libelle='$libelle'" ;
	$result1 = mysqli_query($conn, $sql1);
	if ($result1->num_rows > 0) {	

		$tab[] = json_encode(array( 'RESPONSE'=>'0' ));  //tres important pour retour angular 

		echo $tab[0]; 
		exit;
		
	}
	
	else { 
		
		$sql2 =  " INSERT INTO `specialiter`(`idspecialiter`, `libelle`, `salairetotale`, `salairejour`) VALUES ('NULL','$libelle','$salairet','$salairej')" ; 
		$result2 = mysqli_query($conn, $sql2);
		
		if ($result2===true) {	

			//echo json_encode(array( 'RESPONSE'=>' type ajoutee ' )); 


		$sql3 =  " select * FROM  specialiter WHERE libelle='$libelle'" ;
        $result3 = mysqli_query($conn, $sql3);
		if ($result3->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result3))
			$tab[] =$row; 
			print(json_encode($tab)); 

			//echo json_encode(array( 'RESPONSE'=>'Aucune categories trouvee' )); 


		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune specialiter trouvee' )); 
		}




		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur Ajout specialiter ' )); 
		}

















	}











		
	
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur parametres specialiter' ));  
    }
 
?> 