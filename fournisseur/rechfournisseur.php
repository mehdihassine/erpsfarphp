<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$nomfourniseur = $_GET['nomfourniseur'] ; 



		/*if(!$libelle){
		$sql =  "select * from categorie";
		}*/
		
		
		$sql =  "select * from fournisseur where nomfr='$nomfourniseur' "   ;
	


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurfournisseur';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste prod parametres');  
    }
 
?> 