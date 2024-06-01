<?php

namespace App\Models;

use PDOException;

class User extends DbConnection
{
    protected $email;
    protected $password;
    protected $password_confirmation;

    public function __construct($email, $password, $password_confirmation)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    public function findUserByEmail($email)
    {
        try {
            $query = "SELECT * FROM users where email = ? ";
            $connector = self::connect()->prepare($query);

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
            $connector = self::connect()->prepare($query);
            return $connector->execute([$email, $password]);
        } catch (PDOException $err) {
            throw new PDOException($err);
        }
    }
}
