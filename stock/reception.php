<?php
include('../config.php');


$postdata = file_get_contents("php://input",true); 
if (isset($postdata)) {
	$request = json_decode($postdata);
		
	$nreception="3";// $request->nreception; //

	$codarticle ="ff1";//$request->codarticle;//
	$quantite ="50";// $request->quantite;
	$type="";// $request->type;
	$description ="";// $request->description;
	$fournisseur = "12";//$request->fournisseur;
	$prixachat= "500";//$request->prixachat;
	$datefinv ="";// $request->datefinv;
	
	$types="achat";
	$numfact ="";// $request->numfact;
	$remise= "5";//$request->remise;
	$taxe = "15";//$request->taxe; 
	
	$datesys=date("Y-m-d");
	$quantitesort=0;
	$quantiteTot=$quantite-$quantitesort;
	$montant=$quantiteTot*$prixachat; 
	$montantremise=$montant-(($montant*$remise)/100);
	$montantTTC= round($montantremise+(($montantremise*$taxe)/100),3);
	$montanttaxe=round(($montantTTC-$montantremise),3);
	$etat ="creer"; 
$qte=0; 
$requete="SELECT idstock FROM stock WHERE nreception ='$nreception'"; 
$resultat=mysqli_query($conn,$requete);
if ($resultat->num_rows > 0){
	$row = mysqli_fetch_assoc($resultat);
	$idstock =$row['idstock'];  
	
	$sql ="SELECT idarticle FROM article WHERE codearticle='$codarticle'";
	$result = mysqli_query($conn, $sql);
	
	if ($result->num_rows > 0) {
	   $row = mysqli_fetch_assoc($result); 
	 
	   $codearticle =$row['idarticle'];
	   $req2="INSERT INTO `lignestock`(`idreception`, `idarticle`, `quantite`, `prixachat`, `remise`, `taxe`, `datefin`, `emplacement`, `montant`, `montantht`, `montantremise`) VALUES
		('$idstock','$codearticle','$quantite','$prixachat','$remise','$taxe','$datefinv','$type','$montantTTC','$montanttaxe','$montantremise')";

			$result2 = mysqli_query($conn, $req2);	
				if ($result2===true) {
				   $resp1 = array ("$codearticle","$quantite","$montantTTC");
				   echo json_encode ($resp1);		
				}
				 else {echo json_encode(array( 'resp'=>'stock non valide' ));}

	}
	 else {
			echo json_encode(array( 'resp'=>"0" ));	   
			 }
}
else {
	$sql = "SELECT `idarticle` FROM `article` WHERE `idarticle`='$codarticle'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
	   $row = mysqli_fetch_assoc($result); 
	   $codearticle =$row['idarticle'];
	   $insertdepot="INSERT INTO `stock`(`idstock`, `nreception`, `article_id`,`quantites`, `qtesortie`, `fournisseur_id`, `prixTotal`, `dateachat`,
                 `commentaire`, `numfact`, `etat`, `datesortie`, `motif`) 
                VALUES  ('','$nreception','$qte',
                '$qte','$qte','$fournisseur','$qte','$datesys','$description','$numfact','$etat','','')" ;  

                    $resultInsertdp = mysqli_query($conn, $insertdepot);
                    $nbrow = mysqli_affected_rows($conn);
                    if ($nbrow>0) { 

                             $resp1 = array ("$nreception","$fournisseur","$numfact","$datesys");
                             echo json_encode ($resp1);		
   
                      }
   
                    else {
                            $resp0 = array ("erreur add reception");
                                echo json_encode ($resp0);			

						 }
						 insert ($conn,$nreception,$codarticle,$quantite,$remise,$taxe,$prixachat,$type,$datefinv);


}
else {
	echo json_encode(array( 'resp'=>'Erreur2' ));  
	}
}





}
else {
   echo json_encode(array( 'resp'=>'Erreur2' ));  
   }


   function insert ($conn,$nreception,$codarticle,$quantite,$remise,$taxe,$prixachat,$type,$datefinv){
    $req="SELECT * FROM stock WHERE nreception ='$nreception'";
    $result1 = mysqli_query($conn, $req);
    if ($result1->num_rows > 0) {	
        $row = mysqli_fetch_assoc($result1);
        $idstock =$row['idstock'];  
            $sql = "SELECT `idarticle` FROM `article` WHERE `codearticle`='$codarticle'";
             $result = mysqli_query($conn, $sql);
             if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result); 
                $codearticle =$row['idarticle'];
                $montant =$prixachat*$quantite;
                $montantremise=$montant-(($montant*$remise)/100);
                $montantTTC= round($montantremise+(($montantremise*$taxe)/100),3);
                $montanttaxe=round(($montantTTC-$montantremise),3);
                $req2="INSERT INTO `lignestock`(`idreception`, `idarticle`, `quantite`, `prixachat`, `remise`, `taxe`, `datefin`, `emplacement`, `montant`, `montantht`, `montantremise`) VALUES
                 ('$idstock','$codearticle','$quantite','$prixachat','$remise','$taxe','$datefinv','$type','$montantTTC','$montanttaxe','$montantremise')";
   
                     $result2 = mysqli_query($conn, $req2);	
                         if ($result2>0) {
                            $resp1 = array ("$idstock","$codearticle","$quantite","$montantTTC");
                            echo json_encode ($resp1);		
                          
                         }
                          else {echo json_encode(array( 'resp'=>'stock non valide' ));}

             }
              else {
                     echo json_encode(array( 'resp'=>"1" ));	   
                      }

    }
    else {
        $resp0 = array ("erreur add reception");
            echo json_encode ($resp0);			

     }


  }








?>
