<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$libelle = $_GET['libelle'] ; 



		/*if(!$libelle){
		$sql =  "select * from categorie";
		}*/
		
		
		$sql =  "select * from specialiter where libelle='$libelle' "   ;
	


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurspecialiter';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste prod parametres');  
    }
 
?> 