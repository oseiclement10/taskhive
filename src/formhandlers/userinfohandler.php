<?php

use App\Controllers\UserController;

if (isset($_SESSION["userInfoForm"])) {
    unset($_SESSION["userInfoForm"]);
}

if (isset($_POST["updateUserInfo"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    $user = new UserController($username, $email, "", "");
    $user->updateUserInfo();
} else if (isset($_POST["changePassword"])) {
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    UserController::updateUserPassword($oldPassword, $newPassword, $confirmPassword);
} else {
    header("Location: /taskhive/usr/profile");
}
