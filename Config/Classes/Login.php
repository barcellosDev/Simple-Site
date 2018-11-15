<?php
class Login extends Sql
{
    public function Logar($campos)
    {
        $fields = $this->verificaVazio($campos);
        $valores = $this->capturaForm($fields);

        $results = $this->Select("SELECT * FROM tb_usuarios WHERE usuario = :user and senha = :pass", [
            ':user' => $valores['usuario'],
            ':pass' => sha1($valores['senha'])
        ]);

        if (count($results) > 0)
        {
            $_SESSION['id_usuario'] = $results[0]['id'];
            header("Location: conteudo.php");
        } else
        {
            echo '<script>alert("Usuário ou senha incorretos!")</script>';
            exit();
        }
    }
}
?>