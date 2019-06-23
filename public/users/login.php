
<?php require_once("../../private/initialize.php"); ?>
<?php include(LAYOUT_PATH . "/header.php"); ?>
<link rel="stylesheet" href="../../public/css/add_user_style.css">
<link rel="stylesheet" href="../../public/css/login_style.css">
<style>

</style>
</head>
<body>
<?php include(LAYOUT_PATH . "/nav.php"); ?>
<form action="../../private/user_process.php" method="post">
    <h4 class="e1 text-center">Log in</h4>
    <span class="daimond"></span>
    <div class="form-group row">

        <label for="staticEmail" class="col-sm-2 col-form-label">
            <i class="fa fa-envelope">

            </i>
        </label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="staticEmail" placeholder="email@example.com">
            <?php
            get_and_clear_session_error('email');
            ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">
            <i class="fa fa-unlock-alt">

            </i>
        </label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            <?php
            get_and_clear_session_error('logpassword');
            ?>
        </div>
    </div>
    <br>
    <input type="hidden" name="submit" value="login_user">
    <button class="btn btn-dark submit" type="submit">
        <i class="fa fa-submit">
            Submit
        </i>
    </button>
</form>

<?php include(LAYOUT_PATH . "/footer.php"); ?>

