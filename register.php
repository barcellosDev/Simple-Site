<?php
include 'Autoload.php';
require_once 'Config/Classes/Sql.php';
$Cad = new Cadastrar;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar</title>
</head>
<body>
    <div align="center">
        <h1>Cadastrar</h1>
        <img src="Imgs/user.png" width="100px"><br>
        <form method="post">
            <input type="text" name="usuario" placeholder="Usuário"><br>
            <input type="password" name="senha" placeholder="Senha"><br>
            <input type="submit" name="cadastra" value="Cadastrar">
            <a href="index.php">Já cadastrado?</a>
        </form>
    </div>
</body>
</html>
<?php
$Cad->Cad(['usuario', 'senha']);
?>