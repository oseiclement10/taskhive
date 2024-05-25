<?php

use App\Controllers\UserController;

if (isset($_POST["signup"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["password2"];

    $userController = new UserController($email, $password, $confirm_password);
    $userController->registerUser();
    $userController->loginUser();
} else {
    //handle missing fields validation error
}
