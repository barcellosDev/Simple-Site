<?php 
class Cadastrar extends Sql 
{
    public function Cad($array_campos)
    {
        if (isset($_POST['cadastra']))
        {
            $campos = $this->verificaVazio($array_campos);
            $fields = $this->capturaForm($campos);
            $data = new Datetime();

            $query = $this->sqlQuery("INSERT INTO tb_usuarios (usuario, senha, tempo) VALUES (:user, :pass, :tempo)", [
                ':user' => $fields['usuario'],
                ':pass' => sha1($fields['senha']),
                ':tempo' => $data->format("d/m/Y H:i:s")
            ]);
            if ($query)
            {
                echo '<script>alert("Cadastrado com sucesso!")</script>';
                echo '<script>window.location.href = "index.php"</script>';
            } else
            {
                echo 'Algo deu errado!';
            }
        }
    }
}
?>