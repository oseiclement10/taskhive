<?php

use App\Controllers\CategoryController;

if (isset($_SESSION["categoryFormValues"])) {
    unset($_SESSION["categoryFormValues"]);
}

if (isset($_GET["mode"])) {
    if ($_GET["mode"] == "new") {
        $name = $_POST["name"];
        $category = new CategoryController($name);
        $category->createNewCategory();
        return;
    } else if ($_GET["mode"] == "edit") {
        $name = $_POST["name"];
        $categoryId = $_GET["category_id"];
        $category = new CategoryController($name);
        $category->editCategory($categoryId);
        return;
    } else if ($_GET["mode"] == "delete") {
        $categoryId = $_GET["category_id"];
        CategoryController::removeCategory($categoryId);
        return;
    }
} else {
    header("Location: /taskhive/usr/categories");
}

