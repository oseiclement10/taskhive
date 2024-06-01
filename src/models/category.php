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
