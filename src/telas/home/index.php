<?php
$user = $_SESSION["loggedUser"];
$users = Usuario::listarUsuarios();
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
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/error_message.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <section>
            <h1>Bem Vindo <?= $user['username'] ?></h1>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Fullname</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getUsername() ?></td>
                        <td><?= $value->getFullname() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=User&action=logout" method="post" required>
                <button type="submit">Sair</button>
            </form>
        </section>
    </div>
</body>

</html>