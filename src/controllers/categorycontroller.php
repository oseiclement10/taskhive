<?php

namespace App\Controllers;

use App\Models\Category;

const CATEGORYFORMPAGE = "/taskhive/usr/category?status=openForm";
const CATEGORYPAGE = "/taskhive/usr/category";

class CategoryController extends Category
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function validate()
    {
        return empty($name);
    }

    public function createNewCategory()
    {
        if (!$this->validate()) {
            $_SESSION["categoryFormValues"] = [
                "name" => $this->name
            ];
            header("Location :" . CATEGORYFORMPAGE . "?errors=category name is required");
        } else {
            $this->saveCategory();
            header("Location :" . CATEGORYPAGE . "?success=created new category");
        }
    }

    public function editCategory($categoryId)
    {
        if (!$this->validate()) {
            $_SESSION["categoryFormValues"] = [
                "name" => $this->name
            ];
            header("Location :" . CATEGORYFORMPAGE . "?mode=edit&id=$categoryId&errors=category name is required");
        } else {
            $this->updateCategory($categoryId);
            header("Location :" . CATEGORYPAGE . "?success=updated category");
        }
    }
}
