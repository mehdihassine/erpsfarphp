<?php
include('../config.php');
//$postdata = file_get_contents("php://input"); 
//echo $file_name=$_FILES ['myFile'] ['name'];  
if($_FILES){ 
$target_dir="./image/";
 $target_file=$target_dir.basename($_FILES["myFile"]["name"]);
 $check=getimagesize($_FILES["myFile"]["tmp_name"]);
 	if($check!==false){
 		echo"File is an image - ".$check["mime"].".";
		$uploadOk=1;
		move_uploaded_file($_FILES["myFile"]["tmp_name"],$target_file);
 	}else{
 		echo "file is not an image.";
 		$uploadOk=0;

}
}






// $uploadOk=1;
// $imageFileType=strtolower(pathinfo($target_file,pathinfo_extension));
// if(isset($_POST)){
// 	$check=getimagesize($_FILES["myFile"]["tmp_name"]);
// 	if($check!==false){
// 		echo"File is an image - ".$check["mime"].".";
// 		$uploadOk=1;

// 	}else{
// 		echo "file is not an image.";
// 		$uploadOk=0;
// 	}
// }
?> 