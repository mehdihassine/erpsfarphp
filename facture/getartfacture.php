<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 

		$sql =  "SELECT * FROM facture f , produit p  where f.nfacture ='$nfacture' and f.idproduit=p.idProduit and type='vente' order by f.nligne" ;
        //$sql =  "SELECT * FROM recep  where nfacture ='$nfacture' order by nligne" ;

		$result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
			print json_encode($tab); 
			

		}
		
		else { 
			$tab1[0] = json_encode(array("resp" => "0 ligne"));
		echo $tab1[0]; 
		}
	

//3ana relation mabin el table facture w tabel production 
//w 3ana relation mabin tabel production w tabel produit 

	
    }

    else {
		echo ('Erreur facture parametres');  
    }
 
?> 