<?php
const br = "<br>";
date_default_timezone_set('America/Sao_Paulo');
session_start();

class Sql
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:dbname=site;host=localhost", 'root', '');
    }

    protected function verificaVazio($campos)
    {
        foreach ($campos as $key => $value)
        {
            if (empty($_POST[$value]) or !isset($_POST[$value]))
            {
                echo '<script>alert("O campo '.$value.' está vazio!")</script>';
                exit();
            }
        }
        return $campos;
    }

    protected function capturaForm($array_campos)
    {
        $params = [];
        foreach ($array_campos as $key => $value)
        {
            $params[$value] = $_POST[$value];
        }
        return $params;
    }

    public static function showFields($field)
    {
        echo (isset($_POST[$field])) ? $_POST[$field] : '';
    }

    public static function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    public static function Protect($id_sessao)
    {
        if (!isset($id_sessao))
        {
            echo '<h1>404</h1>';
            echo 'Forbidden';
            exit();
        }
    }

    private function Query($rawQuery, $params)
    {
        $q = $this->conn->prepare($rawQuery);
        $q->execute($params);
        return $q;
    }

    public function Select($sql_code, $parametros = null):array
    {
        $stmt = $this->Query($sql_code, $parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sqlQuery($sql_code, $parametros = null)
    {
        $stmt = $this->Query($sql_code, $parametros);
        return $stmt;
    }
}

?>