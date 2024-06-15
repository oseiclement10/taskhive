<?php

namespace App\Models;

use App\Models\DbConnection;
use PDOException;

class Category  extends DbConnection
{

    protected $user_id;
    protected $name;

    public function __construct($name)
    {
        if (isset($name)) {
            $this->name = $name;
        }
        $this->user_id = $_SESSION["uid"];
    }

    public function saveCategory()
    {
        $query = "INSERT into CATEGORIES (name,user_id) values (?,?)";
        $connector = parent::connect()->prepare($query);

        return $connector->execute([
            $this->name,
            $_SESSION["uid"],
        ]);
    }

    public static function deleteCategory($id)
    {
        $query = "DELETE FROM CATEGORIES WHERE id = ?";
        $connector = parent::connect()->prepare($query);
        return  $connector->execute([$id]);
    }

    public function updateCategory($categoryId)
    {
        $query = "UPDATE CATEGORIES SET name = ? where id = ?";
        $connector = parent::connect()->prepare($query);
        return $connector->execute([
            $this->name,
            $categoryId
        ]);
    }

    public static function fetchUserCategories()
    {
        $query = "SELECT * FROM categories where user_id = ?";

        $conn = self::connect()->prepare($query);

        if ($conn->execute([$_SESSION["uid"]])) {
            return $conn->fetchAll();
        } else {
            throw new PDOException("Error fetching categories");
        }
    }

    public static function fetchUserCategoryByCategoryId($categoryId)
    {
        $query = "SELECT * FROM categories where user_id = ? and id = ?";

        $conn = self::connect()->prepare($query);

        if ($conn->execute([$_SESSION["uid"], $categoryId])) {
            return $conn->fetch();
        } else {
            throw new PDOException("Error fetching categories");
        }
    }
}
