<?php
include 'Autoload.php';
$Sql = new Sql;

$results = $Sql->Select("SELECT * FROM tb_noticias WHERE id = :ID", [':ID' => $_GET['id']]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $results[0]['titulo']; ?></title>
</head>
<body>
    <h1 align="center"><?php echo $results[0]['titulo']; ?></h1>
    <em><?php echo $results[0]['data_de_pub']; ?></em>
    <br>
    <div align="center">
        <img src="Noticias/<?php echo $results[0]['img']; ?>">
    </div>    
    <br>
    <br>
    <div align="center">
        <p><?php echo $results[0]['descricao']; ?></p>
    </div>
    <br>
    <ul>
        <li><a href="conteudo.php">Principal</a><br></li>
        <li><a href="Config/Helpers/logout.php">Logout</a></li>    
    </ul>
</body>
</html>