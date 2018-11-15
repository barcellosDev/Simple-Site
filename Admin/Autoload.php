<?php 
spl_autoload_register(function($nomeClasse)
{
    if (!file_exists('Classes/'.$nomeClasse.'.php'))
    {
        echo 'Classe não encontrada!';
    } else 
    {
        require 'Classes/'.$nomeClasse.'.php';
    }
})
?>