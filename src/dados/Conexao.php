<?php
class Conexao
{
    public static function getConnection()
    {
        $database = "atividade";
        $username = "root";
        $senha = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $senha);
    }
}
