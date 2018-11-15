<?php 
error_reporting(0);
require_once '../Config/Classes/Sql.php';
$Sql = new Sql;
Sql::Protect($_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar notícias</title>
</head>
<body>
    <h1 align="center">Notícias cadastradas</h1>
    <div align="center">
        <table border="1px" align="center" width="80%">
            <tr>
                <th>Título</th>
                <th>Imagem</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Ação</th>
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
                            <td align="center"><img src="../Noticias/'.$value['img'].'" width="100px"></td>
                            <td align="center">'.$value['descricao'].'</td>
                            <td align="center">'.$value['data_de_pub'].'</td>
                            <td align="center"><a href="inserir_noticias.php?id='.$value['id'].'&acao=editar">Editar</a> - <a href="view_noticias.php?id='.$value['id'].'&acao=excluir">Excluir</a></td>
                        </tr>
                        ';
                    }
                } else 
                {
                    echo '<tr>
                        <td colspan="5" align="center"><strong>Nenhuma notícia no momento!</strong></td>
                    </tr>';
                }
                
                if (isset($_GET['id']) and $_GET['acao'] == 'excluir')
                {
                    $delete = $Sql->sqlQuery("DELETE FROM tb_noticias WHERE id = :ID", [':ID' => $_GET['id']]);
                    if ($delete)
                    {
                        echo '<script>window.location.href = "view_noticias.php"</script>';
                    } else 
                    {
                        echo 'Ocorreu algo ao excluir!';
                    }
                }
            ?>
        </table>
    </div>
    <ul>
        <li><a href="Helpers/logout.php">Logout</a></li>
        <li><a href="inserir_noticias.php">Inserir notícias</a></li>
        <li><a href="view_noticias.php">Visualizar notícias</a></li>
        <li><a href="painel.php">Visualizar usuários</a></li>
        <br><br>
        <li><label><strong>Logado como </strong><?php echo $_SESSION['admin_usuario']; ?></label></li>
    </ul>
</body>
</html>