<?php

namespace App\Controllers;

use App\Models\Category;
use Exception;

const CATEGORYFORMPAGE = "/taskhive/usr/categories?status=openForm";
const CATEGORYPAGE = "/taskhive/usr/categories";

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
            header("Location: " . CATEGORYFORMPAGE . "&errors=category name is required");
        } else {
            try {
                $this->saveCategory();
                header("Location: " . CATEGORYPAGE . "?success=saved category successfully");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: " . CATEGORYFORMPAGE . "&errors=$errorMessage");
            }
        }
    }

    public function editCategory($categoryId)
    {
        if (!$this->validate()) {
            $_SESSION["categoryFormValues"] = [
                "name" => $this->name
            ];
            header("Location: " . CATEGORYFORMPAGE . "?mode=edit&id=$categoryId&errors=category name is required");
        } else {
            try {
                $this->updateCategory($categoryId);
                header("Location: " . CATEGORYPAGE . "?success=updated category");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: " . CATEGORYFORMPAGE . "?errors=$errorMessage");
            }
        }
    }

    public static function removeCategory($categoryId)
    {
        try {
            parent::deleteCategory($categoryId);
            header("Location: " . CATEGORYPAGE . "?success=deleted category");
        } catch (Exception $e) {
            $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
            header("Location: " . CATEGORYPAGE . "?errors=$errorMessage");
        }
    }
}
