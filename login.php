<?php
require 'includes/config.php';
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
     
    $username = $password = '';
     // first validation
    if (empty($_POST['username']) || empty($_POST['password'])) {
        addMessage('error', 'Please enter both fields');
        // redirect('login.php');
    }
     // user from database
    $username = strtolower($_POST['username']);
    $password = strtolower($_POST['password']);
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $user = getUser($dbh, $username);
    // text the eneterd details match login details
    if (!empty($user) && ($username === strtolower($user['username']) || $username === strtolower($user['email'])) && password_verify($password, $user['password'])) {
    // add data to sessions
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];
            addMessage('success','You have been logged in');
            redirect('index.php');
        }
    else {
        addMessage('error','Username and password do not match our records');
    }
 }  
require 'partials/header.php';
require 'partials/navigation.php';    
?>

        <!-- Start of Content -->
        <div class="container">
            <div class="row">
            <?= showMessage() ?>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="login.php">

                                <!-- Email Input -->
                                <div class="form-group">
                                    <label for="username" class="col-md-4 control-label">Email Address/Username</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username" value="" required="" autofocus="">

                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required="">
                                    </div>
                                </div>

                                 <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content -->

<?php
require 'partials/footer.php';
?>
