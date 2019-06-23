<?php


function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

function has_length_in_range($value, $min, $max) {
    $length = strlen($value);
    return $length < $min || $length > $max;
}

function has_length_exactly($value, $exact) {
    $length = strlen(trim($value));
    return $length == $exact;
}

function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
}

function contains_only_letters($string) {
    if (ctype_alpha($string)) {
        return true;
    }
}
function contains_only_numbers($phone) {
    if (is_numeric($phone)) {
        return true;
    }
}


function valid_email($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}


function has_unique_email($email) {
    global $db;

    $sql = "SELECT * FROM users " .
           "WHERE email='" . mysqli_real_escape_string($db, $email) . "' ";

    $result = mysqli_query($db, $sql);
    $users_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $users_count === 0;
}


?>