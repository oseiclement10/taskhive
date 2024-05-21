<?php

$getRoutes = [
    "/" => "./views/home.php",
    "/login" => "./views/login.php",
    "/signup" => "./views/signup.php",
];

$postRoutes = [
    "/login" => "./formhandlers/loginhandler.php",
    "/signup" => "./formhandlers/signuphandler.php"
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
