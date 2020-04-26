<?php
include('../config.php');



$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
	
        $request = json_decode($postdata); 
		$codarticle = $request->codarticle;
		$qte = $request->quantite; 
		$puttc = $request->prixttc;
		$datRecep = $request-> datRecep;
		$df = $request->datfin;
		$idfr = $request->codefr;
		
		
        $prixtax = ($puttc*100)/20;
		$priHT = $puttc - $prixtax;
		
		$numSupportsql="SELECT idsupport FROM `support`";
		$result1 = mysqli_query($conn, $numSupportsql);
		if ($result1->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result1))
			$idsupport=$row[idsupport]+1; 
			echo (json_encode("ID Support [$idsupport]")); 
			echo "<br>";
		}else { 
			echo (json_encode("Aucune Support trouvee")); 
		}
		
	
		
		$numEmplacement="Select (idemplacement) from emplacement where disponibilite = 1 and idsupport = 0";
		$result2 = mysqli_query($conn, $numEmplacement);
		if ($result2->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result2))
			$idemplacement =$row[idemplacement]; 
			
			echo (json_encode("ID Emplacement [$idemplacement]")); 
			echo "<br>";
			
		}else { 
			echo json_encode("Aucun emplacement trouve" ); 
			echo "<br>";
			echo (json_encode("ID article [$codearticle]")); 
			echo "<br>";
			$idemplacement=0;
		}
		
		$numrecep="SELECT idrecep FROM `recep2`";
		$result9 = mysqli_query($conn, $numrecep);
		if ($result9->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result9))
			$idrecep=$row[idrecep]+1; 
			echo (json_encode("ID reception [$idrecep]")); 
			echo "<br>";
		}else { 
			echo (json_encode("Aucune reception trouvée")); 
			echo "<br>";
		}
		
		$idemplacementsql="UPDATE `emplacement` SET `idsupport`='$idsupport',`disponibilite`=0 WHERE idemplacement = '$idemplacement'";
		$result3 = mysqli_query($conn, $idemplacementsql);
		if ($result3===true) {
		
		echo (json_encode("Emplacement [$idemplacement] mis a jour")); 
			echo "<br>";
			
			
		$rq="INSERT INTO `support`(`idsupport`, `idemplacement`, `idarticle`, `quantite`, `idrecep`, `etat`, `motif`) VALUES
		('$idsupport','$idemplacement','$codarticle','$qte','$idrecep','valide','recep')";
		$result4 = mysqli_query($conn, $rq);
		if ($result4===true) {	
		echo (json_encode("N Support [$idsupport] mis a jour")); 
			 echo "<br>";
		
		
		
				
		
	$sqlr= "INSERT INTO `recep2`(`idrecep`, `art`, `qte`, `idsupport`, `idemplacement`, `fournisseur`, `datrecep`, `datfin`, `prixttc`, `etat`) VALUES ('$idrecep','$codarticle','$qte','$idsupport','$idemplacement','$idfr','$datRecep','$df','$puttc','valide')";
		$result5 = mysqli_query($conn, $sqlr);
		if ($result5===true) {	
		
		echo (json_encode("N reception [$idrecep] validee")); 
			 	echo "<br>";	
			}
		else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur creation reception' )); 
			echo "<br>";
			}
		
		
		
		
		/*$sql =  "  INSERT INTO  `stock` (`idStock`, `qte` , `prixUnitaire`, `prixTotal`, `datAcht` , `datFin`, `idArticle`,`idFournisseur`) 
					VALUES (NULL, '$idd', '$qt', '$pu', '$pt','$da','$df','$idar','$idfr') " ; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>'ajout avec succes' )); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur Ajout' )); 
		}*/
    }
else{echo "erreur création support";}
	}
	else{echo "erreur mise à jour emplacement";}
	}
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
 
?> 