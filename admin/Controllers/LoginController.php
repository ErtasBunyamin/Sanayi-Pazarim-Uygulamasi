<?php 
include_once '../sqlConnection.php';
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedinAdmin"]) && $_SESSION["loggedinAdmin"] === true){
	    header("landing.php");
}
if(isset($_POST['logEmail']) && isset($_POST['logPassword'])) {
	// Define variables and initialize with empty values
	$logEmail = $logPassword = "";
	$logEmail_err = $logPassword_err = $login_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Check if email is empty
	    if(empty(trim($_POST["logEmail"]))){
	        $logEmail_err = "Lütfen E-posta giriniz.";
	    } else{
	        $logEmail = trim($_POST["logEmail"]);
	    }
	    
	    // Check if password is empty
	    if(empty(trim($_POST["logPassword"]))){
	        $logPassword_err = "Lütfen Şifrenizi Giriniz.";
	    } else{
	        $logPassword = trim($_POST["logPassword"]);
	    }
	    
	    // Validate credentials
	    if(empty($logEmail_err) && empty($logPassword_err)){
	        // Prepare a select statement
	        $conn = OpenCon();
	        $sql = "SELECT *  FROM users WHERE EMAIL ='".$logEmail."'";
	        $result = $conn->query($sql);
        	if($result->num_rows == 1) {
        		$row = $result->fetch_assoc();
        		echo '<br>'.$row['PERMISSION_LEVEL'].'<br>';
        		echo $row['PERMISSION_LEVEL'] == '1'?'dogru':'yanlis';
        		if(password_verify($logPassword,$row['PASSWORD']) && $row['PERMISSION_LEVEL'] == '1'){
        			session_destroy();
        		 	session_start();           
                    // Store data in session variables
                    $_SESSION["loggedinAdmin"] = true;
                    $_SESSION["id"] = $row['ID'];
                    $_SESSION["name"] = $row['NAME'];        
                    // Redirect user to welcome page
                    $login_err = "Giriş yapıldı!";
                    header('location: landing.php');
                } else{
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid E-mail or password.";
                }
        	} else{
        		$login_err = "Invalid E-mail or password.";
        	}
        	CloseCon($conn);
	    }
	}

}

?>