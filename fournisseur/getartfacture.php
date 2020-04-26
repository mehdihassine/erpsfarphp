<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nreception = $_GET['nreception'] ; 

		$sql =  "SELECT * FROM recep r, article a where r.nreception ='$nreception' and r.codartid = a.id order by r.nligne" ;
        //$sql =  "SELECT * FROM recep  where nreception ='$nreception' order by nligne" ;

		$result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
			print json_encode($tab); 
			

		}
		
		else { 
			print json_encode("getartrecep : $nreception = 0"); 
		}
	



	
    }

    else {
		echo ('Erreur reception parametres');  
    }
 
?> 