<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 

		$sql =  "SELECT * FROM facturedivers where nfacture ='$nfacture'  order by nligne" ;
        //$sql =  "SELECT * FROM recep  where nfacture ='$nfacture' order by nligne" ;

		$result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
			print json_encode($tab); 
			

		}
		
		else { 
		$tab1[] = json_encode(array("resp" => "0 ligne"));
		echo $tab1; 
			//echo json_encode(array ('getartdivers' => '0')); 
		}
	

	
    }

    else {
		echo ('Erreur facture parametres');  
    }
 
?> 