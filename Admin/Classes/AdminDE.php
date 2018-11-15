<?php 
class AdminDE extends Sql
{
    public function Edit($array_campos)
    {
        $valores = $this->capturaForm($array_campos);

        $edit = $this->sqlQuery("UPDATE tb_usuarios SET usuario = :USER, senha = :SENHA WHERE id = :ID", [
            ':USER' => $valores['edit_user'],
            ':SENHA' => sha1($valores['edit_senha']),
            ':ID' => $_GET['id']
        ]);

        if (!$edit)
        {
            echo 'Algo deu errado ao editar usuário!';
        } else 
        {
            header("Location: painel.php");
        }
    }

    public function Delete()
    {
        $delete = $this->sqlQuery("DELETE FROM tb_usuarios WHERE id = :ID", [':ID' => $_GET['id']]);
        if (!$delete)
        {
            echo 'Ocorreu algum erro ao excluir usuário!';
        } else 
        {
            header("Location: painel.php");
        }
    }

    public function showEdit($campoforSelect)
    {
        $select = $this->Select("SELECT ".$campoforSelect." FROM tb_usuarios WHERE id = :ID", [':ID' => $_GET['id']]);

        if (count($select) > 0)
        {
            return $select[0][$campoforSelect];
        } else 
        {
            echo 'Erro!';
        }
    }
}
?>