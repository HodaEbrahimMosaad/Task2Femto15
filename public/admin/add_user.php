
<?php require_once("../../private/initialize.php"); ?>
<?php require_admin_login(); ?>
<?php include(LAYOUT_PATH . "/header.php"); ?>
<link rel="stylesheet" href="../../public/css/add_user_style.css">
</head>
<body>
<?php include(LAYOUT_PATH . "/nav.php"); ?>

<?php if (isset($_SESSION["message"])) { ?>
    <div class="mess">
        <?php
        get_and_clear_session_error('message');
        ?>
    </div>
<?php } ?>

<form action="../../private/admin_process.php" method="post">
    <h4 class="e1 text-center">Add User    </h4>
    <span class="daimond"></span>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Name" name="name">
            <?php
            get_and_clear_session_error('name');
            ?>
        </div>
        <div class="col">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <?php
            get_and_clear_session_error('email');
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Phone number" name="phone_number">
            <?php
            get_and_clear_session_error('phone_number');
            ?>
        </div>
        <div class="col">
            <input type="password" class="form-control" placeholder="password" name="password">
            <?php
            get_and_clear_session_error('password');
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <input type="date" class="form-control" name="birthdate">
            <?php
            get_and_clear_session_error('birthdate');
            ?>
        </div>
    </div>
    <br>
    <input type="hidden" value="addUser" name="submit">
    <button class="btn btn-dark submit" type="submit">
        <i class="fa fa-submit">
            Submit
        </i>
    </button>
</form>

<?php include(LAYOUT_PATH . "/footer.php"); ?>

