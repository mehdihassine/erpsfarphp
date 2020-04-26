<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$codarticle = $request->codarticle;
		$qte = $request->quantite; 
		$idsuport = $request->idsuport;
		$motif = $request->motif;
	
	
		
		$sql="UPDATE `support` SET `etat`='supprime',`motif`='$motif' WHERE `idarticle`='$codarticle' and `idsupport`='$idsuport'";
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			
			echo json_encode(array( 'RESPONSE'=>'stock supprime succes' ));
			echo "<br>";
			}else { 
			echo json_encode(array( 'RESPONSE'=>'stock supprime erreur' )); 
		}
		
			$numEmplacement="SELECT `idemplacement`FROM `emplacement` WHERE `idsupport`='$idsuport'";
		$result2 = mysqli_query($conn, $numEmplacement);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2))
			$idemplacement =$row[idemplacement]; 
			
			echo (json_encode("Emplacement trouve [$idemplacement]")); 
			echo "<br>";
			
			
			$sql2="UPDATE `emplacement` SET `idsupport`=0,`disponibilite`=1 WHERE `idemplacement`=$idemplacement";
			$result3 = mysqli_query($conn, $sql2);
		if ($result3===true) {	
			 
			echo json_encode(array( 'RESPONSE'=>'liberation emplacement succes [$idemplacement]' ));
			echo "<br>";
			
			}
			else{
			echo json_encode(array( 'RESPONSE'=>'liberation emplacement erreur [$idemplacement]' ));
			echo "<br>";
			}
			
			
		}else { 
			echo json_encode("Aucun emplacement trouve" ); 
			echo "<br>";
			echo (json_encode("ID article [$codearticle]")); 
			echo "<br>";
			$idemplacement=0;
		}
			
			
			
		
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 