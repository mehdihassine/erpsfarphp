<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 
$type="vente";
$etat="valide";
// update statut recep

		$sql =  "INSERT INTO `facture`(`idfacture`, `nfacture`, `type`, `etat`) 
		VALUES ('NULL','$nfacture','$type','$etat')";
        $result = mysqli_query($conn, $sql);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
			update ($conn,$nfacture); 
		echo json_encode(array('resp'=>"facture $nfacture = validee" ));
		}
		 else {echo json_encode(array( 'resp'=>'facture non validee' ));}
	
// update stock



	
    }

    else {
		echo ('Erreur facture parametres');  
    }
 function update ($conn,$nfacture){
	$sql =  "SELECT SUM(montantthtc) as montantTHT, SUM(montanttva) as montanttva, SUM(montantttc) as montanttotale ,SUM(quantite) as quantite
	FROM lignevente l,facturevente f  where f.nfacture='$nfacture' AND l.idfacture=f.idfacture" ;
	 $result = mysqli_query($conn, $sql);
	 if ($result->num_rows > 0) {	
		 $row = mysqli_fetch_assoc($result);
		 $montantTHT =$row['montantTHT']; 
		 $montanttva =$row['montanttva']; 
		 $montanttotale =$row['montanttotale']; 
		 $quantite =$row['quantite']; 

	$req= "UPDATE `facturevente` SET `quantiteTOT`='$quantite',`montanttvaTOT`='$montanttva',`montanthtcTOT`='$montantTHT',`montantttcTOT`='$montanttotale' WHERE nfacture='$nfacture'"; 	
	$result = mysqli_query($conn, $req);	
	$nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
	
	}
	 else {echo json_encode(array( 'resp'=>'facture non update' ));}
 }
}
?> 