<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$datesort = $_GET['datesort'] ; 

		$sql =  "SELECT * FROM stock s, article a where s.datesortie ='$datesort' and s.article_id= a.idarticle order by nligne" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 

			print json_encode($tab); 
		}
		else { 
	
		$tab[] = json_encode(array("newprod" => "0ligne"));
		echo $tab[0]; 
		}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 