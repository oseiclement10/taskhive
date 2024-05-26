<?php

session_start();

use App\Controllers\UserController;

if (isset($_SESSION["loginFormValues"])) {
    unset($_SESSION["loginFormValues"]);
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userController = new UserController($email, $password, "");
    $userController->loginUser();
}else{
    header("Location: ./login?errors=login here");
}
