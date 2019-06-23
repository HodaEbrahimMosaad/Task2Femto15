<?php
require_once("initialize.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "login_user") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if(is_blank($email)) {
        $errors['email'] = "Email cannot be blank.";
    }
    if(is_blank($password)) {
        $errors['logpassword'] = "Password cannot be blank.";
    }

    if(!empty($errors)) {
        $_SESSION["email"] = $errors['email'];
        $_SESSION["logpassword"] = $errors['logpassword'];
        redirect_to('../public/users/login.php');
    }
    if(empty($errors)) {
        $user = find_user_by_email($email);
        if($user) {
            if(password_verify($password, $user['password'])) {
                if ($user['status'] === "ACCEPTED") {
                    log_in_user($user);
                    $_SESSION["role"] = "user";
                    redirect_to('../public/users/profile.php');
                } else {
                    $_SESSION["logpassword"] = "You are not allowed to login.";
                    redirect_to('../public/users/login.php');
                }
            } else {
                $_SESSION["logpassword"] = "Password is incorrect.";
                redirect_to('../public/users/login.php');
            }

        } else {
            $_SESSION["username"] = "username not found";
            redirect_to('../public/users/login.php');
        }

    }
}


?>