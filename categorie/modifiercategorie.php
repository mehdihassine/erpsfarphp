<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$idtype=$request->idtype ; 
		$libelle=$request->libelle;
		$description=$request->description;
		
		
		$sql =  "UPDATE `categorie` SET `idtype`='$idtype',`libelle`='$libelle',`description`='$description' WHERE `idtype`='$idtype'"; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	

			//echo json_encode(array( 'RESPONSE'=>'categorie modifer ' )); 

			//select result where idtype
		$sql2="SELECT * FROM `categorie` WHERE `idtype`='$idtype'";
		
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune produit trouvee' )); 
		}





		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur modifiercategorie' ));  
    }
 
?>