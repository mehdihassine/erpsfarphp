<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {

		$request = json_decode($postdata);



		$nomuser=$request->nomuser;
		$prenomuser=$request->prenomuser;
		$email=$request->email;
		$loginuser=$request->loginuser;
		$mdpuser=$request->mdpuser;
		$role=$request->role;
		$photo='avatar.png';



		$sql1 =  " SELECT * FROM `user` WHERE `loginuser`='$loginuser'" ;
		$result1 = mysqli_query($conn, $sql1);
		if ($result1->num_rows > 0) {	
	
			$tab[] = json_encode(array( 'RESPONSE'=>'0' ));  //tres important pour retour angular 
	
			echo $tab[0]; 
			exit;
			
		}
		
		else { 
	
	
		   
		$sql2 =  "INSERT INTO `user`(`iduser`, `nomuser`, `prenomuser`, `roleuser`, `loginuser`, `mpduser`, `email`,`photo`)
		 VALUES ('NULL','$nomuser','$prenomuser','$role','$loginuser','$mdpuser','$email','$photo')" ; 
		$result2 = mysqli_query($conn, $sql2);
		
		if ($result2===true) {	

		


		$sql3 =  "SELECT * FROM `user` WHERE `loginuser`='$loginuser'" ;
        $result3 = mysqli_query($conn, $sql3);
		if ($result3->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result3))
			$tab[] =$row; 
			print(json_encode($tab)); 



		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucun utilisateur trouvee' )); 
		}




		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur Ajout ' )); 
		}



	}













	











		
	
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur parametres article' ));  
    }
 
?> 