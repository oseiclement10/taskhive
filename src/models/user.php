<?php

namespace App\Models;

use PDOException;

class User extends DbConnection
{
    protected $username;
    protected $email;
    protected $password;
    protected $password_confirmation;


    public function __construct($username, $email, $password, $password_confirmation)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    public static function findUserByEmail($email)
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

    public function changeUserInfo()
    {
        $query = "UPDATE USERS set username = ?, email = ? where id = ?";
        $connector = parent::connect()->prepare($query);
        return $connector->execute([
            $this->username,
            $this->email,
            $_SESSION["uid"]
        ]);
    }

    public static function changeUserPassword($newPasswordHash){
        $query = "UPDATE USERS set password = ? where id = ? ";
        $connector = parent::connect()->prepare($query);

        return $connector->execute([
            $newPasswordHash,
            $_SESSION["uid"]
        ]);
    }

    public function saveNewUser($passwordHash)
    {
        try {
            $query = "INSERT into users (username,email,password) values (?,?, ?)";
            $connector = self::connect()->prepare($query);
            return $connector->execute([$this->username, $this->email, $passwordHash]);
        } catch (PDOException $err) {
            throw new PDOException($err);
        }
    }
}
