<?php 
include_once '../Database/sqlConnection.php';
if(isset($_POST['offerDescription']) && isset($_POST['offerValue'])) {
	// Initialize the session
	session_start();
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(!isset($_SESSION["loggedin"])){
	    header("location: login.php");
	}else{
		$userId = $_SESSION["id"];
	}
	 
	// Define variables and initialize with empty values
	$offerDescription = $offerValue = "";
	$offerDescription_err = $offerValue_err = $offer_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Check if description is empty
	    if(empty(trim($_POST["offerDescription"]))){
	        $offerDescription_err = "Lütfen bir açıklama giriniz.";
	    } else{
	        $offerDescription = trim($_POST["offerDescription"]);
	    }
	    
	    // Check if value is empty
	    if(empty(trim($_POST["offerValue"]))){
	        $offerValue_err = "Lütfen bir teklif değeri giriniz.";
	    } else{
	        $offerValue = trim($_POST["offerValue"]);
	    }
	    
	    // Validate credentials
	    if(empty($offerDescription_err) && empty($offerValue_err)){
	       if($maxOffer['offerValue']<$offerValue){
	       		date_default_timezone_set('Europe/Istanbul');
		        $conn=OpenCon();
		        $sql = "INSERT INTO offers (productId,userId,offerHead,offerValue,offerCreateTime) values
		         (".$product['id'].",".$userId.",'".$offerDescription."',".$offerValue.",'".date('Y-m-d H:i:s')."')";
		        
		        if ($conn->query($sql) === TRUE) {
				  echo "New record created successfully";
				  header("location: product-details.php");
				  exit;
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}
				CloseCon($conn);
	    	}else{
	    		 $offer_err =$maxOffer['offerValue']." Degerinden Daha Yüksek Bir teklif giriniz!";
	    	}
	    }
	}
}

 ?>