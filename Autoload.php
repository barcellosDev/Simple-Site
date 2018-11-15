<?php
spl_autoload_register(function($nomeClasse)
{
    if (!file_exists('Config/Classes/'.$nomeClasse.'.php'))
    {
        echo 'Classe chamada não encontrada!';
        exit();
    } else
    {
        require ('Config/Classes/'.$nomeClasse.'.php');
    }
});
?>