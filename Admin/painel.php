<?php 
error_reporting(0);
include 'Autoload.php';
require_once '../Config/Classes/Sql.php';
$Sql = new Sql;
Sql::Protect($_SESSION['admin_id']);

// Salvando email do admin em $_SESSION 
$s = $Sql->Select("SELECT usuario FROM tb_admin WHERE id = :ID", [':ID' => $_SESSION['admin_id']]);
$_SESSION['admin_usuario'] = $s[0]['usuario'];
//
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel</title>
</head>
<body>
    <div align="center">
        <h1>Usuários</h1>
        <table border="1px" width="80%">
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Senha</th>
                <th>Data de cadastro</th>
                <th>Ação</th>
            </tr>
            <?php 
                $results = $Sql->Select("SELECT * FROM tb_usuarios");
                $DE = new AdminDE;

                if (isset($_GET['id']) and $_GET['acao'] == 'excluir')
                {
                    $DE->Delete();
                    $data = new DateTime();
                    $data_format = $data->format("d/m/Y H:i:s");

                    $data_alt = $Sql->sqlQuery("UPDATE tb_admin SET tempo = :TEMPO WHERE id = :ADMIN_ID", [
                        ':TEMPO' => $data_format,
                        ':ADMIN_ID' => $_SESSION['admin_id']
                    ]);

                } elseif ($_GET['acao'] == 'editar')
                {
                    echo '
                    <form method="post">
                        <tr>                        
                            <td>'.$DE->showEdit('id').'</td>
                            <td><input type="text" name="edit_user" value="'.$DE->showEdit('usuario').'"></td>
                            <td><input type="password" name="edit_senha" value="'.$DE->showEdit('senha').'"></td>
                            <td>'.$DE->showEdit('tempo').'</td>
                            <td>
                            <input type="submit" name="atualizar" value="Editar">
                            <a href="painel.php">Voltar</a>
                            </td>
                        </tr>  
                    </form>                        
                        ';
                        if (isset($_POST['atualizar']))
                        {
                            $DE->Edit(['edit_user', 'edit_senha']);

                            $data = new DateTime();
                            $data_format = $data->format("d/m/Y H:i:s");

                            $data_alt = $Sql->sqlQuery("UPDATE tb_admin SET tempo = :TEMPO WHERE id = :ADMIN_ID", [
                                ':TEMPO' => $data_format,
                                ':ADMIN_ID' => $_SESSION['admin_id']
                            ]);
                        }                        
                } else 
                {
                    foreach ($results as $key => $value)
                    {
                        echo '
                        <tr>
                            <td>'.$value['id'].'</td>
                            <td>'.$value['usuario'].'</td>
                            <td>'.$value['senha'].'</td>
                            <td>'.$value['tempo'].'</td>
                            <td><a href="painel.php?id='.$value['id'].'&acao=excluir">Excluir</a> - <a href="painel.php?id='.$value['id'].'&acao=editar">Editar</a></td>
                        </tr>
                        ';
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