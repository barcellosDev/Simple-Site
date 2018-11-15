<?php 
include 'Autoload.php';
require_once '../Config/Classes/Sql.php';
$Sql = new Sql;
$ins = new InserirNoticia;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserir notícias</title>
</head>
<body>
    <div align="center">
        <form method="post" action="" enctype="multipart/form-data">
            <label><strong>Título</strong></label><br>
            <input type="text" name="titulo" style="width: 50%; height: 25px;" value="<?php if (isset($_GET['id']) and $_GET['acao'] == 'editar') { echo forEdit('titulo'); } else {Sql::showFields('titulo');} ?>"><br>
            <label><strong>Imagem</strong></label><br>
            <input type="file" name="imagem[]" multiple=""><br>
            <label><strong>Conteúdo</strong></label><br>
            <textarea name="conteudo" style="margin: 0px; width: 1185px; height: 484px;"><?php if (isset($_GET['id']) and $_GET['acao'] == 'editar') { echo forEdit('descricao'); } else {Sql::showFields('conteudo');}  ?></textarea><br>
            <input type="submit" name="inserir" value="Inserir noticia">
        </form>
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
<?php
if (isset($_POST['inserir']))
{
    $ins->insertNoticia(['titulo', 'conteudo']);
}
function forEdit($campo_sql)
{
    global $Sql;
    $select = $Sql->Select("SELECT titulo, descricao FROM tb_noticias WHERE id = :ID", [
        ':ID' => $_GET['id']
    ]);
    return $select[0][$campo_sql];
}
?>