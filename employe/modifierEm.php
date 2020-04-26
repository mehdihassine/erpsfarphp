<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idemployee=$request->idemployee;
		$nom = $request->nom;		
		$prenom = $request->prenom;
		$adress = $request->adress;
		$telephone = $request->telephone;
		$cin = $request->cin;
		$cnss=$request->cnss;
		$specialite = $request->specialite;
		$typec = $request->typec;
	
		
		
		$sql2="SELECT `idspecialiter` FROM `specialiter` WHERE `libelle`='$specialite'";
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	

									while($row =   mysqli_fetch_assoc($result2))
									$tab[0] =$row; 
									$idspecialiter = $tab[0]['idspecialiter'];
		}
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune specialiter trouvee' )); 
		}







		$sql =  "UPDATE `employee` SET `idEmployee`='$idemployee',`cinEmployee`='$cin',`nomEmployee`='$nom',`prenomEmployee`='$prenom ',
		`telEmployee`='$telephone',`adressEmployee`='$adress',`type_contrat`='$typec',`specialiteEmployee`='$idspecialiter',`cnssEmployee`='$cnss'
		WHERE idEmployee='$idemployee'";
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	



			$sql3="SELECT * FROM `employee` e ,`specialiter`s  WHERE `idEmployee`='$idemployee'    AND   s.idspecialiter=e.specialiteEmployee" ;
		
			$result3 = mysqli_query($conn, $sql3);
			if ($result3->num_rows > 0) {	
				while($row = mysqli_fetch_assoc($result3)) 
				$tab[] =$row; 
				print(json_encode($tab)); 
			}else { 
				echo json_encode(array( 'RESPONSE'=>'Aucune specialiter trouvee' )); 
			}




			//echo json_encode(array( 'RESPONSE'=>' modifiee' )); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur modification' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 