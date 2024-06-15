<?php

use App\Controllers\CategoryController;

if (isset($_SESSION["categoryFormValues"])) {
    unset($_SESSION["categoryFormValues"]);
}

if (isset($_POST["save-category"])) {
    if ($_GET["mode"] == "new") {
        $name = $_POST["name"];
        $category = new CategoryController($name);
        $category->createNewCategory();
        return;
    }

    if ($_GET["mode"] == "edit") {
        $name = $_POST["name"];
        $categoryId = $_GET["category_id"];
        $category = new CategoryController($name);
        $category->editCategory($categoryId);
        return;
    }
}
