<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata); 
        $cin = $request->cin;		
		$nom = $request->nom;
		$prenom = $request->prenom;
		$telephone = $request->telephone;
		$adress = $request->adress;
		$cnss=$request->cnss;
		$typec=$request->typec;
		$specialite= $request->specialite;
		
       
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




			$sql22="SELECT `cinEmployee` FROM `employee` WHERE `cinEmployee`='$cin'";

			$result22 = mysqli_query($conn, $sql22);
			if ($result22->num_rows > 0) {	

				echo json_encode(array( 'RESPONSE'=>'Cart identite deja existant' )); 

			} 
			else {

				$sql23="SELECT `cnssEmployee` FROM `employee` WHERE `cnssEmployee`='$cnss'";

				$result23 = mysqli_query($conn, $sql23);
				if ($result23->num_rows > 0) {	
	
					echo json_encode(array( 'RESPONSE'=>'Compt CNSS deja existant' )); 

	
				} 

				else { 
				 /////// !!!!!!!

$sql =  "INSERT INTO `employee`(`idEmployee`, `cinEmployee`, `nomEmployee`, 
`prenomEmployee`, `telEmployee`, `adressEmployee`, `type_contrat`, `specialiteEmployee`, `cnssEmployee`)
 VALUES ('NULL','$cin','$nom','$prenom','$telephone','$adress','$typec','$idspecialiter','$cnss')";
$result = mysqli_query($conn, $sql);
if ($result===true) {	
	

	$sql3 =  " SELECT * FROM  employee e , specialiter s WHERE e.cinEmployee='$cin' AND e.specialiteEmployee=s.idspecialiter" ;
	$result3 = mysqli_query($conn, $sql3);
	if ($result3->num_rows > 0) {

		while($row = mysqli_fetch_assoc($result3))
		$tab[] =$row; 
		print(json_encode($tab)); 


		}
		else { 
		echo json_encode(array( 'RESPONSE'=>'Aucune employee trouvee' )); 
			}













}else { 
	echo json_encode(array( 'RESPONSE'=>'Erreur Ajout' )); 
}


}
			}	

		
		
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur employee parametres' ));  
    }
 
?> 
 