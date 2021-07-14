<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/auth.css">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/error_message.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form action="?class=Usuario&action=cadastro" method="post">
            <div class="form-control">
                <label for="username">Nome de usuário</label>
                <input placeholder="username *" type="text" name="username" id="username" required>
            </div>
            <div class="form-control">
                <label for="fullname">Nome Completo</label>
                <input placeholder="fullname *" type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form-control">
                <label for="email">E-mail</label>
                <input placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="password">Senha</label>
                <input placeholder="password *" type="password" name="password" id="password" required>
            </div>
            <button type="submit">Cadastrar!</button>
            <div class="vocative">
                <span>Já é cadastrado?</span>
                <a href="?view=login">Realize o login!</a>
            </div>
        </form>
    </div>
</body>

</html>
