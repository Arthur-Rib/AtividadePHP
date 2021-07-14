<?php
session_start();

if (isset($_GET["view"])) {
    require_once "src/telas/" . $_GET["view"] . "/index.php";
} else if (isset($_GET["action"]) && isset($_GET["class"])) {
    $controlador = "Controlador".$_GET["class"];
    $action = $_GET["action"];
    require_once "src/controladores/" . $controlador . ".php";
    $controlador = new $controlador();
    $controlador->$action();
} else if (isset($_SESSION["loggedUser"])) {
    require_once "src/telas/home/index.php";
} else {
    require_once "src/telas/login/index.php";
}
