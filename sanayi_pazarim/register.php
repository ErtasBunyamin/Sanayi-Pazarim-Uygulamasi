<?php 
include_once '../Database/sqlConnection.php';
// Define variables and initialize with empty values
$conn=OpenCon();
$username = $password = $confirm_password = "";	
$username_err = $password_err = $email_err = "";
$registercompleted = false;

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])){
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){

	    // Validate username
	    if(empty(trim($_POST["username"]))){
	        $username_err = "Lütfen bir kullanıcı adı giriniz.";
	    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
	        $username_err = "Kullanıcı adı sadece harfleri, numaraları ve alt tire içerebilir.";
	    } else{
	        $username = trim($_POST["username"]);
	    }

	    //Validate email
	    if(empty(trim($_POST["email"])))
	    {
	        $email_err = "Please enter a email.";
	    } 
	    else
	    {
	    	// Prepare a select statement
	        $sql = "SELECT id FROM users WHERE EMAIL = ?";
	        
	        if($stmt = mysqli_prepare($conn, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_email);
	            
	            // Set parameters
	            $param_email = trim($_POST["email"]);
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                /* store result */
	                mysqli_stmt_store_result($stmt);
	                
	                if(mysqli_stmt_num_rows($stmt) == 1){
	                    $email_err = "This username is already taken.";
	                } else{
	                    $email = trim($_POST["email"]);
	                }
	            } else{
	                echo "Oops! Something went wrong. Please try again later.";
	            }

	            // Close statement
	            mysqli_stmt_close($stmt);
	        }
	    }

	    // Validate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "Password must have atleast 6 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }


	    // Check input errors before inserting in database
	    if(empty($username_err) && empty($password_err) && empty($email_err)){
	        
	        // Prepare an insert statement
	        $sql = "INSERT INTO users (NAME,EMAIL,PASSWORD) VALUES (?, ?, ?)";
	         
	        if($stmt = mysqli_prepare($conn, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
	            
	            // Set parameters
	            $param_username = $username;
	            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
	            $param_email = $email;
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                // Redirect to login page
	                $username = $password = $email = "";
	                $registercompleted = true;
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