<?php

$getRoutes = [
    "/" => "./src/views/home.php",
    "/login" => "./src/views/login.php",
    "/signup" => "./src/views/signup.php",
    "/usr/dashboard" => "./src/views/dashboard.php"
];

$postRoutes = [
    "/login" => "./src/formhandlers/loginhandler.php",
    "/signup" => "./src/formhandlers/signuphandler.php"
];

$requestMethod = $_SERVER["REQUEST_METHOD"];

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = str_replace("taskhive/", "", $path);

if ($requestMethod == "GET") {
    if (array_key_exists($path, $getRoutes)) {
        require($getRoutes[$path]);
    } else {
        echo "404 page not found";
    }
} else if ($requestMethod == "POST") {
    if (array_key_exists($path, $postRoutes)) {
        require($postRoutes[$path]);
    } else {
        echo "404 page not found";
    }
}
