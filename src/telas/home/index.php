<?php
require_once "src/modelos/Usuario.php";
$user = $_SESSION["loggedUser"];
if (isset($_GET["pesquisa"])) {
    $users = Usuario::buscar($_GET["pesquisa"]);
} else {
    $users = Usuario::listarUsuarios();
}
function logOut()
{
    session_destroy();
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Home</title>
</head>

<body>
    <div class="container">
        <section>
            <form action="?tela=home" method="GET">
                <label for="pesquisa">Pesquisar Usuario:</label>
                <input type="text" name="pesquisa" value="<?php echo isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : "" ?>">
                <button type="submit">Enviar</button>
            </form>
            <h1> Seja Bem Vindo <?= $user['username'] ?></h1>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Nome completo</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getUsername() ?></td>
                        <td><?= $value->getNomeCompleto() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=Usuario&action=logout" method="post" required>
                <button type="submit">Sair</button>
            </form>
        </section>
    </div>
</body>

</html>