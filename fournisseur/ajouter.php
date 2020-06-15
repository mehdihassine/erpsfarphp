<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
		$request = json_decode($postdata); 		
		
		$nomfourniseur = $request->nomfournisseur;
		$telephone=$request->telephone;
		$email=$request->email; 
		$ville=$request->ville; 
		$fax=$request->fax;
		$codepostal=$request->codepostal;
		$adress=$request->adress;

		

		$sql3 =  "SELECT `nomfr` FROM `fournisseur` WHERE `nomfr`='$nomfourniseur'"; ;
		
		$result3 = mysqli_query($conn, $sql3);
			if ($result3->num_rows > 0) {	// trouvé

				echo json_encode(array( 'RESPONSE'=>'Fournisseur deja existant' ));   //tres important pour retour angular 

		  
			}
			else{

			
				
	
		
		$sql =  "  INSERT INTO `fournisseur`(`idfr`, `nomfr`, `telfr`, `mailfr`, `villefr`, `fax`, `codepostal`, `adresse`)
		VALUES ('NULL','$nomfourniseur ','$telephone','$email','$ville','$fax','$codepostal','$adress')";
		$result = mysqli_query($conn, $sql);
		
		if ($result===true) {	
			//echo json_encode(array( 'RESPONSE'=>'ajout avec succes' )); 

			$sql2 =  "  select * from fournisseur where nomfr='$nomfourniseur'" ;
		
			$result2 = mysqli_query($conn, $sql2);
			if ($result2->num_rows > 0) {	
				while($row2= mysqli_fetch_assoc($result2))
				$tab2[] =$row2; 
				print(json_encode($tab2)); 
			}else { 

				$tab[] = json_encode(array( 'RESPONSE'=>'Aucune fournisseur trouvee' ));   //tres important pour retour angular 

		echo $tab[0]; 
				
			}




		}
		else { 
			$tab[] =json_encode(array( 'RESPONSE'=>'Erreur Ajout' ));   //tres important pour retour angular 

		echo $tab[0]; 
			 
		}
	


	}



	
}
    else {

		$tab[] = json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));    //tres important pour retour angular 

	echo $tab[0]; 
		 
    }
 
?> 
 