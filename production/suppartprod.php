<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$dateprod =$_GET['dateprod'] ;
		$produit =$_GET['produit'] ;
		$req="SELECT * FROM production1 WHERE dateprod ='$dateprod'";
		$result1 = mysqli_query($conn, $req);	
		if ($result1->num_rows > 0) {	
			$row = mysqli_fetch_assoc($result1);
			$idproduction =$row['idproduction'];  

		$sql =  "DELETE FROM ligneproduction WHERE idproduction='$idproduction' AND produit='$produit'";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"ln $produit : cdv $dateprod supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup ln'));}
	
	}
		
	else {echo json_encode(array( 'resp'=>'erreur suup prod'));}
	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 