
<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata); 
        $nreception= $request->nreception; //
		$nligne1 = $request->nligne1; //
		$codarticle = $request->codarticle;//
		$quantite = $request->quantite;
		$type= $request->type;
		$description = $request->description;
		$fournisseur = $request->fournisseur;
		$prixachat= $request->prixachat;
		$datefinv = $request->datefinv;
		

		$numfact = $request->numfact;
		$remise= $request->remise;
		$taxe = $request->taxe; 
		$datesys= date("Y-m-d- H:i:s");//
		$quantitesort=0;
		$quantiteTot=$quantite-$quantitesort;
		$montant=$quantiteTot*$prixachat; 
		$montantremise=$montant-(($montant*$remise)/100);
		$montantTTC= round($montantremise+(($montantremise*$taxe)/100),3);
		
		$etat ="creer"; 
$sql1="SELECT `idfr` from `fournisseur` where`nomfr`='$fournisseur'";
$result1=mysqli_query($conn,$sql1);
if($result1->num_rows>0){
    while($row=mysqli_fetch_assoc($result1))
    $table[0]=$row;
    $idfr=$table[0]['idfr'];




$sql2="SELECT `idarticle` from `article` where `codearticle`='$codarticle'";
$result2=mysqli_query($conn,$sql2);
if($result2->num_rows>0){
	while($row=mysqli_fetch_assoc($result2))
    $table[0]=$row;
	$idarticle=$table[0]['idarticle'];




   
    




	


$insertart="	INSERT INTO `stock`(`idstock`, `nreception`, `nligne`, 
`article_id`, `emplacement`, `quantite`,
`qteentree`, `qtesortie`, `fournisseur_id`,
`prixunitaire`, `prixTotal`, `datefinvaliditer`,
`dateachat`, `remise`, `taxes`, `commentaire`,`numfact`,`etat`) 
VALUES ('NULL',
 '$nreception',
 '$nligne1',
'$idarticle',
'$type',
'$quantiteTot',
'$quantite',
'$quantitesort',
'$idfr',
'$prixachat',
'$montantTTC',
'$datefinv',
'$datesys',
'$remise',
'$taxe',
'$description','$numfact','$etat')";
$resultinsert=mysqli_query($conn,$insertart);
if ($resultinsert===true) {
    $resp1=array("$nreception","$nligne","$idarticle","$quantite");
    echo json_encode($resp1);
}
else{
    $resp0=array("Erreur add ligne stock");
    echo json_encode($resp0);
}


}else{
	echo json_encode(array("aucun article trouver"));
	echo json_encode(array("table"=>"$table",
								"idfr"=>"$rows"));
}
	}
else{
	echo json_encode(array("aucun fournisseur trouver"));
	echo json_encode(array("table"=>"$table",
								"idfr"=>"$rows"));

}

}
else {
   echo json_encode(array( 'resp'=>'Erreur2' ));  
   }
 
?> 
 