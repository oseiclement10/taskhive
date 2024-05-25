<?php

namespace App\Models;

use PDOException;

class User extends DbConnection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function findUserByEmail($email)
    {
        try {
            $query = "SELECT * FROM users where email = ? ";
            $connector = $this->connect()->prepare($query);

            if ($connector->execute([$email])) {
                return $connector->fetch();
            } else {
                return false;
            }
        } catch (PDOException $er) {
            echo("Error fetching user". $er->getMessage());
            return false;
        }
    }

    public function saveNewUser($email, $password)
    {
        try {
            echo "saving new user";
            $query = "INSERT into users (email,password) values (?, ?)";
            $connector = $this->connect()->prepare($query);
            return $connector->execute([$email, $password]);
        } catch (PDOException $err) {
            echo("Error adding new user". $err->getMessage());
            return false;
        }
    }

    
}
