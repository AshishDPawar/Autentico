<?php
	include("includes/config.php");
  	include("includes/classes/Account.php");
  	include("includes/classes/Constants.php");
	include("includes/header.php"); 
	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name){
		if (isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>
	<?php
	if(isset($_POST['registerButton'])){
		echo 	'<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
				</script>';
	}
	else {
		echo 	'<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
				</script>';
	}
	?>
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Log in to your Account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username </label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. arnabBasu" value="<?php getInputValue('loginUsername') ?>"required>
					</p>
					<p>
						<label for="loginPassword">Password </label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
				    </p>
				    <button type="submit" name="loginButton">LOGIN</button>
				 	<div class="hasAccountText">
				 		<span id="hideLogin">Don't have an account yet? Signup here</span>
				 	</div>
				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free Account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Username </label>
						<input id="username" name="username" type="text" placeholder="e.g. arnabBasu" value="<?php getInputValue('username') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">First Name </label>
						<input id="firstName" name="firstName" type="text" placeholder="e.g. Arnab" value="<?php getInputValue('firstName') ?>"  required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last Name </label>
						<input id="lastName" name="lastName" type="text" placeholder="e.g. Basu"  value="<?php getInputValue('lastName') ?>" required>
					</p>
					<p>
						<label for="email">Email </label>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<input id="email" name="email" type="email" placeholder="e.g. arnabbasu98@gmail.com" value="<?php getInputValue('email') ?>" required>
					</p>
					<p>
						<label for="email2">Confirm Email </label>
						<input id="email2" name="email2" type="email" placeholder="e.g. arnabbasu98@gmail.com"  value="<?php getInputValue('email2') ?>" required>
					</p>
					<p>
						<label for="password">Password </label>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<input id="password" name="password" type="password" placeholder="Your password" required>
				    </p>
				    	<label for="password2">Confirm Password </label>
						<input id="password2" name="password2" type="password" placeholder="Your password" required>
				    </p>
				    <button type="submit" name="registerButton">SIGNUP</button>
				    <div class="hasAccountText">
				 		<span id="hideRegister">Already have an account? Log in here</span>
				 	</div>
				</form>
			</div>
			<div id="loginText">
				<h1>Get genuine reviews analysed and visualised</h1>
			</div>
		</div>

<?php include("includes/footer.php") ?>