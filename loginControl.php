<?php 
include_once 'sqlConnection.php';
$conn = OpenCon();
if(isset($_POST['logEmail']) && isset($_POST['logPassword'])) {
	// Initialize the session
	session_start();
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	    header("location: index.php");
	    console.log(isset($_SESSION["loggedin"]));
	}
	console.log(trim(isset($_SESSION["loggedin"])));
	 
	// Define variables and initialize with empty values
	$logEmail = $logPassword = "";
	$logEmail_err = $logPassword_err = $login_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Check if email is empty
	    if(empty(trim($_POST["logEmail"]))){
	        $logEmail_err = "Please enter E-mail.";
	    } else{
	        $logEmail = trim($_POST["logEmail"]);
	    }
	    
	    // Check if password is empty
	    if(empty(trim($_POST["logPassword"]))){
	        $logPassword_err = "Please enter your password.";
	    } else{
	        $logPassword = trim($_POST["logPassword"]);
	    }
	    
	    // Validate credentials
	    if(empty($logEmail_err) && empty($logPassword_err)){
	        // Prepare a select statement
	        $sql = "SELECT ID, NAME, PASSWORD FROM users WHERE EMAIL = ?";
	        
	        if($stmt = mysqli_prepare($conn, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_email);
	            
	            // Set parameters
	            $param_email = $logEmail;
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                // Store result
	                mysqli_stmt_store_result($stmt);
	                
	                // Check if username exists, if yes then verify password
	                if(mysqli_stmt_num_rows($stmt) == 1){                    
	                    // Bind result variables
	                    mysqli_stmt_bind_result($stmt, $id, $logUsername, $hashed_password);
	                    if(mysqli_stmt_fetch($stmt)){
	                        if(password_verify($logPassword, $hashed_password)){
	                            // Password is correct, so start a new session
	                            session_start();
	                            
	                            // Store data in session variables
	                            $_SESSION["loggedin"] = true;
	                            $_SESSION["id"] = $id;
	                            $_SESSION["name"] = $logUsername;                            
	                            
	                            // Redirect user to welcome page
	                            header('location: http://localhost/adim-2/index.php');
	                        } else{
	                            // Password is not valid, display a generic error message
	                            $login_err = "Invalid E-mail or password.";
	                        }
	                    }
	                } else{
	                    // Username doesn't exist, display a generic error message
	                    $login_err = "Invalid E-mail or password.";
	                }
	            } else{
	                echo "Oops! Something went wrong. Please try again later.";
	            }

	            // Close statement
	            mysqli_stmt_close($stmt);
	        }
	    }
	}
}
CloseCon($conn);
?>