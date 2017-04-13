<?php
require 'includes/config.php';
$userDetails = (!empty($_GET['username']) && !empty($_GET['email']) && !empty($_GET['password'])) ? htmlspecialchars($_GET['username'] && $_GET['email'] && $_GET['password'],  ENT_QUOTES, 'utf-8') : '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // define variables and set to empty values
    $username = $email = $password = '';
    // Add data from form
    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);
    $confirmedPassword = e($_POST["password-confirm"]);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

	if($_POST['username'] === '' || $_POST['password'] === '' || $_POST['email'] === '') {
		addMessage('error', "Registration was not successful");
	}
	if ($_POST["password"] != $_POST["password-confirm"]) {
		addMessage('error', "The passwords do not match");
	}
	else {	
		$registered = addUser($dbh, $username, $email, $hashedPassword);
		$user = getUser($dbh, $username);

		if($registered) {   
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['id'] = $user['id'];
		addmessage('success', "You have registered successfully");
		redirect("index.php");
	}
}
}
require 'partials/header.php';
require 'partials/navigation.php';
?>

<div class="container">

	<div class="row">
		<div class="col-md-12">
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="register.php" onsubmit="return validate()">

					<div class="form-group">
						<label for="username" class="col-md-4 control-label">Username</label>

						<div class="col-md-6">
							<input id="username" type="text" class="form-control" name="username" value="" required="" autofocus="">
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-md-4 control-label">E-Mail Address</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control" name="email" value="" required="">
							</div>
					</div>

					<div class="form-group">
						<label for="password" class="col-md-4 control-label">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control" name="password" required="">
						</div>
					</div>

					<div class="form-group">
						<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password-confirm" required="">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>
					<div><?= showMessage(); ?></div>
					
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>

<?php 
    require 'partials/footer.php';
?>