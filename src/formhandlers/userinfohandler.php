<?php

use App\Controllers\UserController;

if (isset($_SESSION["userInfoForm"])) {
    unset($_SESSION["userInfoForm"]);
}

if (isset($_POST["updateUserInfo"])) {
    $username = $_POST["userinfo"];
    $email = $_POST["email"];

    $user = new UserController($username, $email, "", "");
    $user->updateUserInfo();
} else if (isset($_POST["changePassword"])) {
    $oldPassword = $_POST["old-password"];
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm_password"];

    UserController::changeUserPassword($oldPassword, $newPassword, $confirmPassword);
}
