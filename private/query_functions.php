<?php
include("validation_funcs.php");
function validate_user($user) {
    $errors = [];
    if(is_blank($user["name"])) {
        $errors["name"] = "Name cannot be blank.";
    } elseif(has_length_in_range($user["name"], 5, 100)) {
        $errors["name"] = "Name must be between 5 and 100 characters.";
    } elseif (contains_only_letters($user["name"])) {
        $errors["name"] = "Name must be consists of only letters.";
    }

    if(is_blank($user["email"])) {
        $errors["email"] = "Email cannot be blank.";
    } elseif(!valid_email($user["email"])) {
        $errors["email"] = "Email is not valid.";
    } elseif (!has_unique_email($user["email"])) {
        $errors["email"] = "Email must be unique.";
    }

    if(is_blank($user["phone_number"])) {
        $errors["phone_number"] = "Phone number cannot be blank.";
    } elseif(!contains_only_numbers($user["phone_number"])) {
        $errors["phone_number"] = "Phone must be only numbers.";
    }

    if(is_blank($user["birthdate"])) {
        $errors["birthdate"] = "birthdate cannot be blank.";
    }

    if(is_blank($user["password"])) {
        $errors["password"] = "password cannot be blank.";
    } elseif(has_length_in_range($user["password"], 7, 100)) {
        $errors["password"] = "password must be between 7 and 100 characters.";
    } elseif (contains_only_letters($user["password"])) {
        $errors["password"] = "Name must be consists of only letters.";
    }
    return $errors;
}


function confirm_result_set($result) {
    if (!$result) {
        exit("Database query failed.");
    }
}

function insert_into_users($user)
{
    global $db;
    $errors = validate_user($user);
    if(!empty($errors)) {
        $_SESSION["name"] = $errors["name"];
        $_SESSION["email"] = $errors["email"];
        $_SESSION["phone_number"] = $errors["phone_number"];
        $_SESSION["password"] = $errors["password"];
        $_SESSION["birthdate"] = $errors["birthdate"];
        return;
    }

    $query = "INSERT INTO `users` " .
             "(`name`, `phone_number`, `email`, `password`,`birthdate` , `status`) " .
             "VALUES ('" . mysqli_real_escape_string($db, $user['name']) . "'," .
             "'" . mysqli_real_escape_string($db, $user["phone_number"]) . "'," .
             "'" . mysqli_real_escape_string($db, $user["email"])        . "'," .
             "'" . password_hash($user["password"], PASSWORD_BCRYPT) . "'," .
             "'" . mysqli_real_escape_string($db, $user["birthdate"])    . "'," .
             "'" . mysqli_real_escape_string($db, $user["status"])       . "')" ;
    $result = mysqli_query($db, $query);
    confirm_result_set($result);
    $_SESSION["message"] = "User has been added.";
    return $result;
}

function get_users_default_limit()
{
    global $db;
    $query = "SELECT `id`, `name`, `birthdate`, `email` ,`status`
               FROM `users` ORDER BY `id` ASC LIMIT 10";
    $result = mysqli_query($db, $query);
    confirm_result_set($result);
    return $result;
}
function get_users()
{
    global $db;
    $query = "SELECT `id`, `name`, `phone_number`, `email` ,`status`
               FROM `users` ORDER BY `id` ASC";
    $result = mysqli_query($db, $query);
    confirm_result_set($result);
    return $result;
}

function find_user_by_id($id) {
    global $db;
    $sql = "SELECT * FROM `users` WHERE id='" . mysqli_real_escape_string($db, $id) . "' LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function update_user($user) {
    global $db;

    $query = "UPDATE users SET " .
        "name='" .           mysqli_real_escape_string($db, $user['name']) .
        "',phone_number='" . mysqli_real_escape_string($db, $user['phone_number']) .
        "',email='" .        mysqli_real_escape_string($db, $user['email']) .
        "',birthdate='" .    mysqli_real_escape_string($db, $user['birthdate']) .
        "',status='" .       mysqli_real_escape_string($db, $user['status']) .
        "' WHERE id ='" .    mysqli_real_escape_string($db, $user['id']) . "'";

    $result = mysqli_query($db, $query);

    if($result) {
        $_SESSION["message"] = "Record has been updated";
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


function delete_user($id) {
    global $db;

    $sql = "DELETE FROM `users` WHERE `id`='" . mysqli_real_escape_string($db, $id) . "' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM `admins` " .
            "WHERE `username`='" . mysqli_real_escape_string($db, $username) . "' " .
            "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;
}


function find_user_by_email($email) {
    global $db;

    $sql = "SELECT * FROM `users` " .
        "WHERE `email`='" . mysqli_real_escape_string($db, $email) . "' " .
        "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

?>