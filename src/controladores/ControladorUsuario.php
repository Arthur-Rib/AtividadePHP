<?php

require_once "src/modelos/Usuario.php";

class ControladorUsuario
{
    public function cadastro()
    {
        $username = $_POST["username"];
        $nomecompleto = $_POST["nomecompleto"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($username) || !isset($nomecompleto) || !isset($email) || !isset($senha)) {
            require_once "src/telas/cadastro/index.php";
        } else {
            $usuario = new Usuario($email, $username, $nomecompleto, $senha);
            $result = $usuario->salvar();
            if (!is_bool($result)) {
                require_once "src/telas/login/index.php";
            } else {
                require_once "src/telas/cadastro/index.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($email) || !isset($senha)) {
            require_once "src/telas/cadastro/index.php";
        } else {
            $result = Usuario::logIn($email, $password);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "username" => $result->getUsername(), "email" => $result->getEmail());
                require_once "src/telas/home/index.php";
            } else {
                require_once "src/telas/login/index.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=login");
    }
}