<?php

class UserController extends User
{

    private $email;
    private $password;
    private $password_confirmation;

    public function __construct($email, $password, $password_confirmation)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    public function registerUser()
    {
        $errors = $this->validateRegisterCreds();
        if (count($errors) > 0) {
            //handle validation error,
        } else {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            if ($this->saveNewUser($this->email, $hashedPassword)) {
                //handle registration success
            }else{
                //handle registration error,
            };
        }
    }

    public function loginUser()
    {
        $errors = $this->validateLoginCreds();
        if(count($errors)>0){
            //handle validation error
        }else{
            $user = $this->findUserByEmail($this->email);
            if(!$user){
                //handle no user found error
            }else{
                session_start();
                $_SESSION["uid"] = $user["id"];
                $_SESSION["email"] = $user["email"];
            }
        }
    }

    public function validateRegisterCreds()
    {
        $errors = [];

        if (empty($this->email)) {
            array_push($errors, "email is required");
        };

        if (empty($this->password)) {
            array_push($errors, "password is required");
        };

        if (empty($this->password_confirmation)) {
            array_push($errors, "confirm password is required");
        };

        if ($this->password != $this->password_confirmation) {
            array_push($errors, "Passwords do not match");
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
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

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email provided is not a valid email");
        }

        if (empty($this->password)) {
            array_push($errors, "password is required");
        };

        return $errors;
    }
}
