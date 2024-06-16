<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

define("USERPROFILEPAGE", "/taskhive/usr/profile");

class UserController extends User
{

    public function __construct($username, $email, $password, $password_confirmation)
    {
        parent::__construct($username, $email, $password, $password_confirmation);
    }

    public function registerUser()
    {
        $errors = $this->validateRegisterCreds();
        if (count($errors) > 0) {
            session_start();
            $_SESSION["regisFormValues"] = [
                "username" => $this->username,
                "email" => $this->email,
                "password" => $this->password,
                "password_confirmation" => $this->password_confirmation,
            ];
            $errorStr = implode("_", $errors);
            header("Location: ./signup?errors=$errorStr");
        } else {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            try {
                $this->saveNewUser($hashedPassword);
                header("Location: ./login");
            } catch (Exception $err) {
                session_start();
                $_SESSION["regisFormValues"] = [
                    "email" => $this->email,
                    "password" => $this->password,
                    "password_confirmation" => $this->password_confirmation,
                ];
                $errorMessage = str_replace(["\r", "\n"], "", $err->getMessage());
                header("Location: ./signup?errors=$errorMessage");
            }
        }
    }

    public function loginUser()
    {
        $errors = $this->validateLoginCreds();
        if (count($errors) > 0) {
            session_start();
            $_SESSION["loginFormValues"] = [
                "email" => $this->email,
                "password" => $this->password,
            ];
            $errorStr = implode("_", $errors);
            header("Location: ./login?errors=$errorStr");
        } else {
            $user = parent::findUserByEmail($this->email);
            if (!$user) {
                header("Location: ./login?errors=invalid credentials");
            } else {
                if (password_verify($this->password, $user["password"])) {
                    session_start();
                    $_SESSION["uid"] = $user["id"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["username"] = $user["username"];
                    header("Location: ./usr/dashboard");
                } else {
                    header("Location: ./login?errors=invalid credentials");
                }
            }
        }
    }

    public function updateUserInfo()
    {
        $errors = $this->validateUserInfo();
        if (count($errors) > 0) {
            session_start();
            $_SESSION["userInfoForm"] = [
                "email" => $this->email,
                "username" => $this->username,
            ];
            $errorStr = implode("_", $errors);
            header("Location: /taskhive/usr/profile?errors=$errorStr");
        } else {
            try {
                $this->changeUserInfo();
                header("Location: /taskhive/usr/profile?success=info changed successfully");
            } catch (Exception $err) {
                $_SESSION["userInfoForm"] = [
                    "email" => $this->email,
                    "username" => $this->username,
                ];
                $errorMessage = str_replace(["\r", "\n"], "", $err->getMessage());
                header("Location: ./taskhive/usr/profile?errors=$errorMessage");
            }
        }
    }

    public static function updateUserPassword($oldPassword, $newPassword, $confirmPassword)
    {
        $errors = self::validatePasswordFields($oldPassword, $newPassword, $confirmPassword);
        if (count($errors) > 0) {
            $errorStr = implode("_", $errors);
            header("Location: " . USERPROFILEPAGE . "?errors=$errorStr");
        } else {
            $user = parent::findUserByEmail($_SESSION["email"]);
            if (password_verify($oldPassword, $user["password"])) {
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                try {
                    parent::changeUserPassword($passwordHash);
                    header("Location: " . USERPROFILEPAGE . "?success=changed password successfully");
                } catch (Exception $err) {
                    $errorMessage = str_replace(["\r", "\n"], "", $err->getMessage());
                    header("Location: " . USERPROFILEPAGE . "?errors=$errorMessage");
                }
            } else {
                header("Location: " . USERPROFILEPAGE . "?errors= incorrect current password");
            }
        }
    }

    public function validateUserInfo()
    {
        $errors = [];

        if (empty($this->username)) {
            array_push($errors, "username is required");
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email provided is not a valid email");
        }
        return $errors;
    }

    public function validateRegisterCreds()
    {
        $errors = [];

        if (empty($this->username)) {
            array_push($errors, "username is required");
        }

        if (empty($this->password)) {
            array_push($errors, "password is required");
        };

        if (empty($this->password_confirmation)) {
            array_push($errors, "confirm password is required");
        };

        if ($this->password != $this->password_confirmation) {
            array_push($errors, "Passwords do not match");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email provided is not a valid email");
        }

        if ($this->findUserByEmail($this->email)) {
            array_push($errors, "Email already taken");
        }

        return $errors;
    }

    public static function validatePasswordFields($oldPassword, $newPassword, $confirmPassword)
    {
        $errors = [];

        if (empty($oldPassword)) {
            array_push($errors, "current password is required");
        };


        if (empty($newPassword)) {
            array_push($errors, "new password is required");
        };

        if (empty($confirmPassword)) {
            array_push($errors, "confirm password is required");
        };


        if ($newPassword != $confirmPassword) {
            array_push($errors, "Passwords do not match");
        }
        return $errors;
    }

    public function validateLoginCreds()
    {
        $errors = [];

        if (empty($this->email)) {
            array_push($errors, "email is required");
        };

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email provided is not a valid email");
        }

        if (empty($this->password)) {
            array_push($errors, "password is required");
        };

        return $errors;
    }
}
