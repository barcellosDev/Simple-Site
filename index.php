<?php
include 'Autoload.php';
$Sql = new Sql;
$Login = new Login;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<body>
    <div align="center">
        <h1>Login</h1>
        <img src="Imgs/user.png" width="100px">
        <br>
        <form method="post">
            <input type="text" name="usuario" placeholder="Digite seu usuário" value="<?php Sql::showFields('usuario'); ?>"><br>
            <input type="password" name="senha" placeholder="Digite sua senha" value="<?php Sql::showFields('senha'); ?>"><br>
            <input type="submit" name="loga" value="Logar">
            <a href="register.php">Não cadastrado?</a>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['loga']))
{
    $Login->Logar(['usuario', 'senha']);
}
?>