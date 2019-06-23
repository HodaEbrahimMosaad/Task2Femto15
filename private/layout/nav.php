<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ ?>
            <li class="nav-item">
                <a class="nav-link" href="../../public/admin/home.php">Home</a>
            </li>
            <?php } ?>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){ ?>
            <li class="nav-item active">
                <a class="nav-link" href="../../public/users/profile.php">Profile</a>
            </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav mr-1">
             <?php if(!isset($_SESSION['role'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>