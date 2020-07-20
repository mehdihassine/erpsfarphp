<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$etat='valide';
		$sql =  "SELECT  nreception, SUM(idarticle) as nbrarticle ,nomfr,
		numfact, SUM(quantite) as quantiterecep,dateachat,
		 SUM(prixTotal) as prixTotal ,etat FROM stock , fournisseur ,lignestock l  WHERE  stock.etat='$etat' and (fournisseur.idfr=stock.fournisseur_id  ) And( l.idreception=stock.idstock) GROUP BY nreception " ;
		
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