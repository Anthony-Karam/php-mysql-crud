<?php

use App\Classes\User;

require_once 'vendor/autoload.php';
// session_start();

// $createUser= new User();
if(isset( $_POST['username'],$_POST['email'],$_POST['password'],$_POST['signUp'])){
    $user= new User();
       $username=$_POST['username'];
	   $email=$_POST['email'];
        $password=$_POST['password'];
		$user->store( $username, $email, $password);

    }

    if(isset($_POST['username'],$_POST['password'],$_POST['signIn'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $user= new User();
 
      $user->login($username,$password)	;
	  $user_id = $_SESSION['id'];
		
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
<!-- <h2>Sign in/up Form</h2> -->
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="" method="post">
			<h1>Create Account</h1>
			<div class="social-container">
			</div>
			<input type="text" placeholder="User name" name="username" />
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			<button name='signUp'>Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="" method="post">
			<h1>Sign in</h1>
			<div class="social-container">
			</div>
			<input type="text" placeholder="Email or Username" name="username" />
			<input type="password" placeholder="Password" name="password"/>
			
			<button name='signIn'>Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>


<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</body>
<footer>

</footer>
</html>