<?php require_once("initialize.php");
function format_birthdate($birthdate) {
    $date = new DateTime($birthdate .' 00:00:00.000');
    return $date->format('j\'S F Y');
}


function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

function get_and_clear_session_error($errorType) {
    if(isset($_SESSION[$errorType]) && $_SESSION[$errorType] != '') {
        $error = $_SESSION[$errorType];
        unset($_SESSION[$errorType]);
        echo "<span class='error'>" . $error . "</span>";
    }
}

function log_in_admin($admin) {
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['username'] = $admin['username'];
    $_SESSION['last_login'] = time();
    return true;
}

function admin_is_logged_in() {
    return isset($_SESSION['admin_id']);
}

function log_out_admin() {
    unset($_SESSION['admin_id']);
    unset($_SESSION['username']);
    unset($_SESSION["role"]);

    unset($_SESSION['last_login']);
    return true;
}

function require_admin_login() {
    if(!admin_is_logged_in()) {
        redirect_to('../admin/login.php');
    }
}

function log_in_user($user) {
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['last_login_for_user'] = time();
    return true;
}

function user_is_logged_in() {
    return isset($_SESSION['user_id']);
}

function log_out_user() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION["role"]);
    unset($_SESSION['last_login_for_user']);
    return true;
}

function require_user_login() {
    if(!user_is_logged_in()) {
        redirect_to('../users/login.php');
    }
}

?>