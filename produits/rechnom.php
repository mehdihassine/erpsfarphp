<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$nom = $_GET['nom'] ; 
		$sql =  "  SELECT * from produit p ,categorie c  WHERE  p.nomProduit='$nom' And   p.typeProduit_id = c.idtype" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune Produit trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur Produit parametres' ));  
    }
 
?> 
 