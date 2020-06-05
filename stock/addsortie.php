<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$datesort = $request->datesort;
		$nligne1 = $request->nligne1;
		$codarticle = $request->codarticle;
		$quantite = $request->quantite;
		$motif = $request->motif;
		$nreception= 0;
		
		$type= '';
		$description ='';
		$fournisseur ='0';
		$prixachat=0;
		$datefinv = '';
		
		$quantites = 0;
		$numfact = '';
		$remise= 0;
		$taxe = 0; 
		
		$datesys1=date("Y-m-d");
		$quantitesort=0;
		$quantiteTot=$quantitesort-$quantite;
		$montant=0; 
		$montantremise=0;
		$montantTTC= 0;
		$montanttaxe=0;
		$etat='sortie';
 
		$sql2="SELECT `idarticle` from `article` where `codearticle`='$codarticle'";
		$result2=mysqli_query($conn,$sql2);
		if($result2->num_rows>0){
			while($row=mysqli_fetch_assoc($result2))
			$table[0]=$row;
			$idarticle=$table[0]['idarticle'];
			
	
			
			
			
		$insertart="INSERT INTO `stock`(`idstock`, `nreception`, `nligne`,
		`article_id`, `emplacement`, `quantite`,
		 `qteentree`, `qtesortie`, `fournisseur_id`,
		  `prixunitaire`, `prixTotal`, `datefinvaliditer`,
		   `dateachat`, `remise`, `taxes`, `commentaire`,
			`numfact`, `etat`, `datesortie`, `motif`) 
		VALUES ('NULL',
		 '$nreception',
		 '$nligne1',
		'$idarticle',
		'$type',
		'$quantiteTot',
		'$quantites',
		'$quantite',
		'$fournisseur',
		'$prixachat',
		'$montantTTC',
		'$datefinv',
		'$datesys',
		'$remise',
		'$taxe',
		'$description','$numfact','$etat','$datesort','$motif')";
		$resultinsert=mysqli_query($conn,$insertart);
		if ($resultinsert===true) {
		   
		echo json_encode(array("add ligne sortie ok"));
	
		
	}
	else{
	   echo json_encode(array("Erreur add ligne sortie"));
	  
	
	}
	
 
}
else {
echo json_encode(array( 'resp'=>"0" ));	    }
		
		
    
	
	
	
	
	}
	 else {
		echo json_encode(array( 'resp'=>'Erreur2' ));  
		}

 
?> 
