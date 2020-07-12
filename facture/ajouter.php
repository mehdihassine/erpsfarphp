<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
        $nfacture=$request->nfacture; //
    
        $codproduit = $request->codproduit;//
        $quantite = $request->quantite;
        $nomclient= $request->nomclient;
        $adresse = $request->adresse;
       
      
        $type='vente';//
        $qte=0;
        $datesys= date("Y-m-d");//
	$req="SELECT * FROM  facturevente WHERE nfacture='$nfacture'";
	$result1 = mysqli_query($conn, $req);	
	if ($result1->num_rows > 0) {	
		$row = mysqli_fetch_assoc($result1);
        $idfacture=$row['idfacture'];
		$sql =  "SELECT idProduit, prixvente,tva FROM produit where idProduit = '$codproduit'" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			$row = mysqli_fetch_assoc($result); 
			$codartid =$row['idProduit']; 
			$prixvente =$row['prixvente']; 
            $tva =$row['tva'];
			$montanttotal = $quantite*$prixvente;//
            $montanttva = (($montanttotal*$tva)/100);
			  $montantTHT=$montanttotal-$montanttva;
			$req2="INSERT INTO `lignevente`(`idproduit`, `idfacture`, `quantite`, `montanttva`, `montantthtc`, `montantttc`) VALUES
            ('$codartid','$idfacture','$quantite','$montanttva','$montantTHT','$montanttotal')";
			$result2 = mysqli_query($conn, $req2);	
			if ($result2===true) {
				$resp1 = array ("$idfacture","$codproduit","$quantite","$montanttva");
				echo json_encode ($resp1);		
				}
				else {echo json_encode(array( 'resp'=>'vente non validee' ));}
	        }
		else {
		echo json_encode(array( 'resp'=>"0" ));	    }




	   }
		else { 
			$sql =  "SELECT idProduit, prixvente,tva FROM produit where idProduit = '$codproduit'" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
		
            $row = mysqli_fetch_assoc($result); 
			$codartid =$row['idProduit']; 
			$prixvente =$row['prixvente']; 
            $tva =$row['tva'];
			$montanttotal = $quantite*$prixvente;//
            $montanttva = (($montanttotal*$tva)/100);
			  $montantTHT=$montanttotal-$montanttva;
			
			
			
			
              $insertdepot =  "INSERT INTO `facturevente`(`idfacture`, `nfacture`, `types`, `quantiteTOT`, `nomclient`, `adresse`, `datesys`, `montanttvaTOT`, `montanthtcTOT`, `montantttcTOT`) 
              VALUES ('','$nfacture','$type','$qte','$nomclient','$adresse','$datesys','$qte','$qte','$qte')";
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
	
		$resp1 = array ("$nfacture","$nomclient","$type");
		echo json_encode ($resp1);		
		
		}
		
	else {
	$resp0 = array ("erreur add facture");
	echo json_encode ($resp0);			
	
		}
 
        insert($conn,$nfacture,$codproduit,$quantite);
		
    }
    else {
	echo json_encode(array( 'resp'=>"0" ));	    }
		}
























}
else {
   echo json_encode(array( 'resp'=>'Erreur2' ));  
   }







   function insert($conn,$nfacture,$codproduit,$quantite){
	$req="SELECT * FROM  facturevente WHERE nfacture='$nfacture'";
	$result = mysqli_query($conn, $req);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$resultat[0] =$row; 
			$idfacture =$resultat[0]['idfacture']; 
            $sql =  "SELECT idProduit, prixvente,tva FROM produit where idProduit = '$codproduit'" ;
            $result = mysqli_query($conn, $sql);
    
            if ($result->num_rows > 0) {	
                $row = mysqli_fetch_assoc($result); 
                $codartid =$row['idProduit']; 
                $prixvente =$row['prixvente']; 
                $tva =$row['tva'];
                $montanttotal = $quantite*$prixvente;//
                $montanttva = (($montanttotal*$tva)/100);
                  $montantTHT=$montanttotal-$montanttva;
                $req2="INSERT INTO `lignevente`(`idproduit`, `idfacture`, `quantite`, `montanttva`, `montantthtc`, `montantttc`) VALUES
                ('$codartid','$idfacture','$quantite','$montanttva','$montantTHT','$montanttotal')";
                $result2 = mysqli_query($conn, $req2);	
                if ($result2===true) {
                   
                    }
                    else {echo json_encode(array( 'resp'=>'vente non validee' ));}
                }
            else {
            echo json_encode(array( 'resp'=>"0" ));	    }
		}
		else{
			echo json_encode(array( 'resp'=>'idproduction non validee' ));
		}


	}

?> 
