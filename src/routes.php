<?php


define("VIEWS_DIR", "./src/views/");
define("FORM_HANDLERS_DIR", "./src/formhandlers/");


$publicGetRoutes = [
    "/" =>  VIEWS_DIR . "home.php",
    "/login" => VIEWS_DIR . "login.php",
    "/signup" => VIEWS_DIR . "signup.php",
];

$protectedGetRoutes = [
    "/usr/dashboard" => VIEWS_DIR . "dashboard.php",
    "/usr/tasks" => VIEWS_DIR . "tasks.php",
    "/usr/profile" => VIEWS_DIR . "profile.php",
    "/usr/logout" => VIEWS_DIR . "logout.php",
];

$publicPostRoutes = [
    "/login" => FORM_HANDLERS_DIR . "loginhandler.php",
    "/signup" => FORM_HANDLERS_DIR . "signuphandler.php"
];

$protectedPostRoutes = [];


$requestMethod = $_SERVER["REQUEST_METHOD"];

$path = str_replace("taskhive/", "", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

if (str_contains($path, "usr")) {
    handleRoutes($requestMethod, $path, $protectedGetRoutes, $protectedPostRoutes, true);
} else {
    handleRoutes($requestMethod, $path, $publicGetRoutes, $publicPostRoutes, false);
}

function handleNotFound($isProtected)
{
    if ($isProtected) {
        require VIEWS_DIR . "u_404.php";
        return;
    } else {
        require VIEWS_DIR . "404.php";
    }
}

function handleRoutes($requestMethod, $path, $getRoutes, $postRoutes, $isProtected)
{
    $isAuthenticated = isset($_SESSION["uid"]);
    global $publicGetRoutes;

    if ($isProtected && !$isAuthenticated) {
        require $publicGetRoutes["/login"];
        return;
    }

    if ($requestMethod == "GET") {
        if (array_key_exists($path, $getRoutes)) {
            require $getRoutes[$path];
            return;
        } else {
            handleNotFound($isProtected);
            return;
        }
    } else if ($requestMethod == "POST") {
        if (array_key_exists($path, $postRoutes)) {
            require $postRoutes[$path];
            return;
        } else {
            handleNotFound($isProtected);
        }
    }
}
