<?php 
include 'Autoload.php';
require_once '../Config/Classes/Sql.php';
$loga_admin = new Adminlogin;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div align="center">
        <h1>Administrador</h1>
        <img src="../Imgs/admin.png" width="100px">
        <br>
        <form method="post">
            <input type="email" name="admin_email" placeholder="E-mail" value="<?php Sql::showFields('admin_email'); ?>"><br>
            <input type="password" name="admin_pass" placeholder="Senha" value="<?php Sql::showFields('admin_pass'); ?>"><br>
            <input type="submit" name="admin_loga" value="Logar">
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['admin_loga']))
{
    $loga_admin->Login(['admin_email', 'admin_pass']);
}
?>