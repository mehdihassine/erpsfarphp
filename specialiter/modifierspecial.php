<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$idspecialiter=$request->idspecialiter ; 
		$libelle=$request->libelle;
		$salairet=$request->salairet;
		$salairej=$request->salairej;
		


		$sql3="SELECT `libelle` FROM `specialiter` WHERE `libelle`='$libelle' and `salairetotale`= '$salairet'";
		$result3 = mysqli_query($conn, $sql3);
		if ($result3->num_rows > 0) {
			
			$tab[] = json_encode(array( 'RESPONSE'=>'specialiter existant!!!!' ));   //tres important pour retour angular 

		echo $tab[0]; 

		}else { 
			
		



		
		$sql =  "UPDATE `specialiter` SET `idspecialiter`='$idspecialiter',`libelle`='$libelle',`salairetotale`='$salairet',`salairejour`='$salairej' WHERE `idspecialiter`='$idspecialiter'"; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	

			//echo json_encode(array( 'RESPONSE'=>'categorie modifer ' )); 

			//select result where idtype
		$sql2="SELECT * FROM `specialiter` WHERE `idspecialiter`='$idspecialiter'";
		
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2)) 
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune specialiter trouvee' )); 
		}





		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification  ' )); 
		}
	}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur specialiter parametre ' ));  
    }
 
?>