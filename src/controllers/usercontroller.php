<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

class UserController extends User
{

    private $email;
    private $password;
    private $password_confirmation;

    public function __construct($email, $password, $password_confirmation)
    {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    public function registerUser()
    {
        $errors = $this->validateRegisterCreds();
        if (count($errors) > 0) {
            session_start();
            $_SESSION["regisFormValues"] = [
                "email" => $this->email,
                "password" => $this->password,
                "password_confirmation" => $this->password_confirmation,
            ];
            $errorStr = implode("_", $errors);
            header("Location: ./signup?errors=$errorStr");
        } else {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            try {
                $this->saveNewUser($this->email, $hashedPassword);
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
            $user = $this->findUserByEmail($this->email);
            if (!$user) {
                header("Location: ./login?errors=invalid credentials");
            } else {
                if (password_verify($this->password, $user["password"])) {
                    session_start();
                    $_SESSION["uid"] = $user["id"];
                    $_SESSION["email"] = $user["email"];
                    header("Location: ./usr/dashboard");
                } else {
                    header("Location: ./login?errors=invalid credentials");
                }
            }
        }
    }

    public function validateRegisterCreds()
    {
        $errors = [];



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
