<!-- Start of Navigation -->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="index.php">
                        Portfolio
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <?php if(loggedIn()): ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                                <img class="nav-profile-photo" img src="<?= get_gravatar($email = $_SESSION['email'])?>">
                                <?= $_SESSION['username'] ?>
                                <span class="caret"></span>
                            </a>
                                <ul role="menu" class="dropdown-menu panel">
                                    
                                    <li>
                                        <a href="index.php" class="item">Home</a>
                                    </li>
                                    <li>
                                        <a href="dashboard.php" class="item">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="logout.php" class="item">Logout</a>
                                    </li>
                                </ul>
                        </li>
                        <?php else: ?>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of Navigation -->