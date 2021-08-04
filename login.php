
<?php
	/*session_start();
	ob_start();
	if(isset($_SESSION["loggedin"])){
		header('location: index.php');
	} */
	include 'sqlConnection.php';
	include 'register.php';
	include 'LoginControl.php';
	include 'header.php';
	$query = "SELECT ID FROM USERS";
	$result = mysqli_query($conn, $query);

	//users tablosunun var olup olmadigina bakiliyor
	//sistemde hata olmasini onlemek icin
	if(empty($result)){
		echo "girdiii";
		//yok ise olusturuluyor
		$query = "CREATE TABLE USERS (
                          ID int(11) AUTO_INCREMENT,
                          NAME varchar(255) NOT NULL,
                          EMAIL varchar(255) NOT NULL,
                          PASSWORD varchar(255) NOT NULL,
                          PERMISSION_LEVEL int,
                          PRIMARY KEY  (ID)
                          )";
        $result = mysqli_query($conn, $query);

        //tabloya varsayilan admin ekleniyor.
        $query = "insert into users (NAME,EMAIL,PASSWORD,PERMISSION_LEVEL) values (?,?,?,?)";
        if($stmt = mysqli_prepare($conn, $query)) {
        	mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_email, $param_password, $param_permisson);
        	$param_username = "admin";
        	$param_email = "admin@mail.com";
            $param_password = password_hash("12345", PASSWORD_DEFAULT);
            $param_permisson = 1;
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page

                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }else {
        	echo 'olmadi';
        }
	}


 ?>
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<input class="<?php echo (!empty($logEmail_err)) ? 'is-invalid' : ''; ?>" type="email" name="logEmail" 
						placeholder="Email Address" value="<?php echo $logEmail; ?>"/>
						<span class="invalid-feedback"><?php echo $logEmail_err; ?></span>
						<input type="password" name="logPassword" placeholder="password" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
						<span><?php echo "...".$isLog; ?></span>
					</form>
					<?php 
				        if(!empty($login_err)){
				            echo '<div class="alert alert-danger">' . $login_err . '</div>';
				        }        
			        ?>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<!--username-->
						<input class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" 
						placeholder="Name" value="<?php echo $username; ?>"/>
						<span class="invalid-feedback"><?php echo $username_err; ?></span>
						<!--email-->
						<input class="<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" type="email" name="email" 
						placeholder="Email Address" value="<?php echo $email; ?>"/>
						<span class="invalid-feedback"><?php echo $email_err; ?></span>
						<!--password-->
						<input class="<?php echo (!empty($password)) ? 'is-invalid' : ''; ?>" type="password" name="password" 
						placeholder="Password" value="<?php echo $password; ?>"/>
						<span class="invalid-feedback"><?php echo $password_err; ?></span>
						<button type="submit" class="btn btn-default">Signup</button>
						<span><?php echo $registercompleted ? "Kayıt Başarılı Bir Şekilde Gerçekleştirildi!":"" ?></span>
					</form>
					
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
<?php 
include 'footer.php';
 ?>