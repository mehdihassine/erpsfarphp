<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$sql =  "SELECT  nreception, COUNT(article_id) as nbrarticle ,nomfr,
		numfact, SUM(quantite) as quantiterecep,dateachat,
		 SUM(prixTotal) as prixTotal  FROM stock , fournisseur  WHERE (fournisseur.idfr=stock.fournisseur_id  )  GROUP BY nreception " ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			
		
			print(json_encode($tab)); 
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune reception trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
	// 			
?> 