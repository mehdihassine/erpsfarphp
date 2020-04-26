<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$idarticle=$request->idarticle ; 
		$codearticle=$request->codearticle;
		$libelle=$request->libelle;
		$description=$request->description;
		$type=$request->type;
		$nature=$request->nature;
		$typestockage=$request->typestockage;
		$seuil=$request->seuil;
		
		
		$sql =  "UPDATE `article` SET `idarticle`='$idarticle', `codearticle`='$codearticle',`libellearticle`='$libelle',`description`='$description',
		`seuilmin`='$seuil',`nature`='$nature',`typestockage`='$typestockage',`typearticle`='$type' WHERE `idarticle`='$idarticle' "; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	

			//echo json_encode(array( 'RESPONSE'=>'categorie modifer ' )); 

			//select result where idtype
		$sql2="SELECT * FROM `article` WHERE `codearticle`='$codearticle'";
		
		$result2 = mysqli_query($conn, $sql2);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune article trouvee' )); 
		}





		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur modifier article' ));  
    }
 
?>