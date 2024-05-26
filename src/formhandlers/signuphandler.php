<?php

session_start();

use App\Controllers\UserController;

if (isset($_SESSION["regisFormValues"])) {
    unset($_SESSION["regisFormValues"]);
}

if (isset($_POST["signup"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["password_confirmation"];

    $userController = new UserController($email, $password, $confirm_password);
    $userController->registerUser();
} else {
    //handle missing fields validation error
}
