<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata); 
        $diametre = $request->diametre;		
		$nom = $request->nom;
		$cout = $request->cout;
		$vente = $request->vente;
		$type = $request->type;
		$description=$request->description;
		$tva=$request->tva;
		
	  





$sql =  "INSERT INTO `produit`(`idProduit`, `diametre`, `nomProduit`,
 `coutrevien`, `prixvente`, `descriptionProduit`, `typeProduit_id`, `tva`) VALUES 
('NULL','$diametre','$nom',
'$cout','$vente','$description','$type','$tva')";
$result = mysqli_query($conn, $sql);
if ($result===true) {	
	

	$sql3 =  "SELECT * FROM  `produit` p , `categorie` c WHERE p.nomProduit='$nom' AND p.typeProduit_id=c.idtype" ;
	$result3 = mysqli_query($conn, $sql3);
	if ($result3->num_rows > 0) {

		while($row = mysqli_fetch_assoc($result3))
		$tab[] =$row; 
		print(json_encode($tab)); 


		}
		else { 
		echo json_encode(array( 'RESPONSE'=>'Aucune produit trouvee' )); 
			}













}else { 
	echo json_encode(array( 'RESPONSE'=>'Erreur Ajout' )); 
}


			
		
		
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur employee parametres' ));  
    }
 
?> 
 