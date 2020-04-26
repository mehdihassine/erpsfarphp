<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$id = $_GET['A']; 
		
		
		
		$update1="UPDATE `recep2` SET `etat`='supprime' WHERE idrecep='$id'";
		$result1 = mysqli_query($conn, $update1);
		if ($result1===true) {
		echo (json_encode("Reception [$id] supprimee")); 
			echo "<br>";
			}else {
			echo (json_encode("erreur suppression reception [$id]")); 
			}
		
		
		
		
		$update="UPDATE `support` SET `etat`='supprime' WHERE idrecep= '$id'";
		$result3 = mysqli_query($conn, $update);
		if ($result3===true) {
		
		echo (json_encode("Support [] supprimee")); 
			echo "<br>";
			}else {
			echo (json_encode("erreur suppression support []")); 
			}
		
		
		
		
		$select="SELECT `idemplacement` FROM `support` WHERE `idrecep`='$id'";
		$result9 = mysqli_query($conn, $select);
		if ($result9->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result9))
			$idemplacement=$row[idemplacement]; 
			
			
		$update4="UPDATE `emplacement` SET `idsupport`='0',`disponibilite`='1' WHERE `idemplacement`='$idemplacement'";
		$result3 = mysqli_query($conn, $update4);
		if ($result3===true) {
		echo (json_encode("emplacement [$idemplacement] libre")); 
			echo "<br>";
			}else {
			echo (json_encode("erreur liberation emplacement")); 
			}
	
			
			
		}else { 
			echo (json_encode("Aucune emplacement trouvee")); 
			echo "<br>";
		}
		
		
	
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 