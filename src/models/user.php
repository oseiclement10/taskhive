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
            return false;
        }
    }

    public function saveNewUser($email, $password)
    {
        try {
            $query = "INSERT into users (email,password) values (?, ?)";
            $connector = $this->connect()->prepare($query);
            return $connector->execute([$email, $password]);
        } catch (PDOException $err) {
            throw new PDOException($err);
        }
    }
}
