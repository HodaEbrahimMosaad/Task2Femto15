<?php require_once("initialize.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "getEditModal"){
    $user_id = $_POST["userId"];
    $user = find_user_by_id($user_id);
    header('Content-Type: application/json');
    exit(json_encode($user));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "updateUser"){
    $user = [
        "id"           => $_POST["id"],
        "name"         => $_POST["name"],
        "email"        => $_POST["email"],
        "phone_number" => $_POST["phone_number"],
        "birthdate"    => $_POST["birthdate"],
        "status"       => $_POST["status"]
    ];
    update_user($user);
    echo $user['name'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "loginAdmin"){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(is_blank($username)) {
        $errors['username'] = "Username cannot be blank.";
    }
    if(is_blank($password)) {
        $errors['logpassword'] = "Password cannot be blank.";
    }

    if(!empty($errors)) {
        $_SESSION["username"] = $errors['username'];
        $_SESSION["logpassword"] = $errors['logpassword'];
        redirect_to('../public/admin/login.php');
    }
    if(empty($errors)) {

        $admin = find_admin_by_username($username);
        if($admin) {
            if(password_verify($password, $admin['password'])) {
                log_in_admin($admin);
                $_SESSION["role"] = "admin";
                redirect_to('../public/admin/home.php');
            } else {
                $_SESSION["logpassword"] = "Password is incorrect.";
                redirect_to('../public/admin/login.php');
            }

        } else {
            $_SESSION["username"] = "username not found";
            redirect_to('../public/admin/login.php');
        }

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "deleteUser") {
    $id = $_POST['deletedId'];
    delete_user($id);
    $_SESSION["message"] = "Record has been deleted";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "filters") {
    $start = (int) $_POST["start"];
    $entries =(int) $_POST["entries"];
    $end =  $start + $entries;

    $sortingBy = $_POST["sortingBy"];

    $sortingType = $_POST["sortingType"];
    $statusFilter = $_POST["statusFilter"] == "all" ? "" : " AND (`status` LIKE '".$_POST["statusFilter"]."') ";
    $searchFilter = $_POST["searchFilter"];
    $sql2 = "SELECT * FROM `users`" .
        " WHERE (`name` LIKE '%" . $searchFilter .  "%'" .
        " OR `phone_number` LIKE '%" . $searchFilter . "%'" .
        " OR `email` LIKE '%" . $searchFilter .
        "%')" . $statusFilter . " ORDER BY `" . $sortingBy . "` {$sortingType}" ." LIMIT {$start}, {$entries}";
    $str = "";
    echo  $sql2;
    global $db;
    $result2 = mysqli_query($db, $sql2);
    confirm_result_set($result2);
    $totalRecords = mysqli_num_rows($result2);
    echo $totalRecords;

    while ($user2 = mysqli_fetch_assoc($result2)) {
        if ($user2["status"] == "ACCEPTED") {
            $stat = " green";
        } else{
            $stat = " red";
        }
        $str .= "<tr>" .
                "<td>" . htmlspecialchars($user2["id"]) . "</td>" .
                "<td>" . htmlspecialchars($user2["name"]) . "</td>" .
                "<td>" . htmlspecialchars($user2["email"]) . "</td>" .
                "<td>" . format_birthdate(htmlspecialchars($user2["birthdate"])) . "</td>" .
                "<td> <span class=\"status {$stat}\" " .
                    ">&nbsp;" . htmlspecialchars($user2["status"]) . "&nbsp</span>" .
                "</td>" .
                "<td>" .
                    " <button class=\"btn btn-primary edit\" data-id=\"" . $user2["id"] . "\">" .
                        "<i class=\"fa fa-edit\">" .
                            "edit" .
                        "</i>" .
                    "</button>" .
                    " <button class=\"btn btn-danger delete\" data-id=" . $user2["id"] . ">" .
                        "<i class=\"fa fa-trash\">" .
                            "delete" .
                        "</i>" .
                    "</button>" .
                    "<a>" .
                        " <button class=\"btn btn-dark\" id=\"show\">" .
                            "<i class=\"fa fa-search\">" .
                                "show" .
                            "</i>" .
                        "</button>" .
                    "</a>" .
                    "<input type=\"hidden\" id=\"hidID\" value=" . $user2["id"] . ">" .
                "</td>" .
            "</tr>";
    }

    echo $str;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["submit"] == "addUser") {

    $user = [
        "name"         => $_POST["name"],
        "email"        => $_POST["email"],
        "phone_number" => $_POST["phone_number"],
        "birthdate"    => $_POST["birthdate"],
        "password"     => $_POST["password"],
        "status"       => "ACCEPTED"
    ];
    insert_into_users($user);
    redirect_to('../public/admin/add_user.php');
}



?>