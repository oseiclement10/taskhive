<?php 

$routes = [
    "/" => "./views/home.php",
    "/login" => "./views/login.php",
    "/signup" => "./views/signup.php",
];


$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = str_replace("taskhive/", "", $path);

if (array_key_exists($path, $routes)) {
    require($routes[$path]);
} else {
    echo "404 page not found";
}

