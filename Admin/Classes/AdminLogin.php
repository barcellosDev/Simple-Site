<?php 
class AdminLogin extends Sql
{
    public function Login($array_campos)
    {
        $fields = $this->verificaVazio($array_campos);
        $valores = $this->capturaForm($fields);
        $valores['admin_pass'] = sha1($valores['admin_pass']);
        $valores = array_values($valores);
        
        $results = $this->Select("SELECT * FROM tb_admin WHERE usuario = ? and senha = ?", $valores);
        if (!empty($results[0]))
        {
            $_SESSION['admin_id'] = $results[0]['id'];
            header("Location: painel.php");
        } else 
        {
            echo '<script>alert("Nenhum usuário encontrado =( ")</script>';
        }
    }
}
?>