<?php 
error_reporting(0);
include 'Autoload.php';
$Sql = new Sql;
Sql::Protect($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notícias</title>
</head>
<body>
    <h1 align="center">Bem vindo ao painel de notícias!</h1>
    <div align="center">
        <table border="1px" align="center" width="80%">
            <tr>
                <th>Título</th>
                <th>Imagem</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Visualizar notícias</th>
            </tr>
            <?php 
                $result = $Sql->Select("SELECT * FROM tb_noticias");

                if (count($result) > 0)
                {
                    foreach ($result as $key => $value)
                    {
                        echo '
                        <tr>
                            <td align="center">'.$value['titulo'].'</td>
                            <td align="center"><img src="Noticias/'.$value['img'].'" width="100px"></td>
                            <td align="center">'.$value['descricao'].'</td>
                            <td align="center">'.$value['data_de_pub'].'</td>
                            <td align="center"><a href="noticia_details.php?id='.$value['id'].'">Visualizar notícia</a></td>
                        </tr>
                        ';
                    }
                } else 
                {
                    echo '<tr>
                        <td colspan="5" align="center"><strong>Nenhuma notícia no momento!</strong></td>
                    </tr>';
                }
            ?>
        </table>
    </div>
    <br>
    <div align="left">
        <ul>
            <li><a href="conteudo.php">Principal</a><br></li>
            <li><a href="Config/Helpers/logout.php">Logout</a></li>
        </ul>
    </div>    
</body>
</html>