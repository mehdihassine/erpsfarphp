<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
		$request = json_decode($postdata);

		$iduser=$request->iduser ; 
		$nom=$request->nom;
		$prenom=$request->prenom;
		$login=$request->login;
		$mail=$request->mail;
		$mdp=$request->mdp;
		$photo=$request->photo;
		
		echo ($photo) ; 
		



		

		
	
		$sql =  "UPDATE `user` SET `iduser`='$iduser',`nomuser`='$nom',`prenomuser`='$prenom',
		`loginuser`='$login',`mpduser`='$mdp',`email`='$mail',`photo`='$photo'
		 WHERE `iduser`='$iduser  ' "; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	

		
			
	
			echo json_encode(array( 'RESPONSE'=>'modification ok' )); 




		}
		
		else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur modifier user' ));  
    }
 
?>