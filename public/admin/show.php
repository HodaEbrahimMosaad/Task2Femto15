
<?php require_once("../../private/initialize.php"); ?>
<?php require_admin_login(); ?>
<?php include(LAYOUT_PATH . "/header.php"); ?>
<link rel="stylesheet" href="../../public/css/add_user_style.css">
<link rel="stylesheet" href="../../public/css/user_profile_style.css">

</head>
<body>
<?php include(LAYOUT_PATH . "/nav.php"); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"]) && $_GET["id"] != ""){
    $user = find_user_by_id($_GET["id"]);
} else {
    echo "Error";
    return;
}
?>
<div class="profile">
    <h4 class="text-center">Profile</h4>
    <span class="daimond"></span>
    <div class="row">
        <div class="col">
            Name:
        </div>
        <div class="col right">
            <?php echo htmlspecialchars(ucfirst($user["name"])); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            Email:
        </div>
        <div class="col right">
            <?php echo htmlspecialchars($user["email"]); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            Phone number
        </div>
        <div class="col right">
            <?php echo htmlspecialchars($user["phone_number"]); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            Birth-date
        </div>
        <div class="col right">
            <?php echo htmlspecialchars(format_birthdate($user["birthdate"])); ?>
        </div>
    </div>
    <br>
</div>

<?php include(LAYOUT_PATH . "/footer.php"); ?>

