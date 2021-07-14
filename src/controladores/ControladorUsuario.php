<?php

require_once "src/dados/Conexão.php";

class ControladorUsuario
{
    public function signUp()
    {
        $username = $_POST["username"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($username) || !isset($fullname) || !isset($email) || !isset($password)) {
            require_once "app/views/signup/index.php";
        } else {
            $usuario = new Usuario($username, $password, $fullname, $email);
            if (!is_bool($result)) {
                require_once "app/views/login/index.php";
            } else {
                require_once "app/views/signup/index.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($email) || !isset($password)) {
            require_once "app/views/signup/index.php";
        } else {
            $result = $this->userService->logIn($email, $password);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "username" => $result->getUsername(), "email" => $result->getEmail());
                require_once "app/views/home/index.php";
            } else {
                require_once "app/views/login/index.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=login");
    }
}