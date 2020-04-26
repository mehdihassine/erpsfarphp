<?php
include('../config.php');


    
		
		$empl1="UPDATE `emplacement` SET `idsupport`='0',`disponibilite`=1 WHERE idemplacement = '1'";
		$result1 = mysqli_query($conn, $empl1);
		
		$empl2="UPDATE `emplacement` SET `idsupport`='0',`disponibilite`=1 WHERE idemplacement = '2'";
		$result2 = mysqli_query($conn, $empl2);
		
		$empl3="UPDATE `emplacement` SET `idsupport`='0',`disponibilite`=1 WHERE idemplacement = '99'";
		$result3 = mysqli_query($conn, $empl3);
		
		/*
		if ($result3===true) {
		
		echo (json_encode("Emplacement [$idemplacement] mis à jour")); 
			}
			else {
			echo (json_encode ("erreur"));
			}
			
 */
?>