<?php 
class InserirNoticia extends Sql
{
    private $ext;

    public function insertNoticia($array_campos)
    {
        $fields = $this->verificaVazio($array_campos);
        $valores = $this->capturaForm($fields);
        $arquivos = $this->reOrder($_FILES['imagem']);
        $errors = $this->exceptions();

        foreach ($arquivos as $arquivo => $array_atributos)
        {
            if ($array_atributos['error'] != 0)
            {
                if (isset($_GET['id']) and $_GET['acao'] == 'editar')
                {
                    if ($array_atributos['error'] == 4)
                    {
                        $data = new DateTime();
                        $data_format = $data->format("d/m/Y H:i:s");

                        $editar = $this->sqlQuery("UPDATE tb_noticias SET titulo = :TITULO, descricao = :DESCRICAO, data_de_pub = :DATA_DE_PUB WHERE id = :ID", [
                            ':TITULO' => ucfirst($valores['titulo']),
                            ':DESCRICAO' => $valores['conteudo'],
                            ':ID' => $_GET['id'],
                            ':DATA_DE_PUB' => $data_format
                        ]);
                        echo '<h3>Notícia alterada com sucesso!</h3>';
                    }
                } else 
                {
                    echo $errors[$array_atributos['error']];
                }
            } else 
            {
                $ext_allowed = $this->allowExt($array_atributos['name']);

                if (!$ext_allowed)
                {
                    echo 'Extensão de arquivo não permitido!';
                    exit();
                } else 
                {
                    // $this->ext possui um array que na posição [0] é o nome do arquivo e na posição [1] é a extensão já permitida
                    $name_formated = str_replace(' ', '-', $this->ext[0]);
                    $final = $name_formated.'.'.$this->ext[1];
                    $data = new DateTime();
                    $data_format = $data->format("d/m/Y H:i:s");

                    if (move_uploaded_file($array_atributos['tmp_name'], '../Noticias/'.$final))
                    {
                        if (isset($_GET['id']) and $_GET['acao'] == 'editar')
                        {
                            $e = $this->sqlQuery("UPDATE tb_noticias SET img = :IMG, titulo = :TITULO, descricao = :DESCRICAO, data_de_pub = :DATA_DE_PUB WHERE id = :ID", [
                                ':IMG' => $final,
                                ':TITULO' => ucfirst($valores['titulo']),
                                ':DESCRICAO' => $valores['conteudo'],
                                ':DATA_DE_PUB' => $data_format,
                                ':ID' => $_GET['id']
                            ]);
                            echo '<h3>Notícia alterada com sucesso!</h3>';
                        } else 
                        {
                            
                            $insert = $this->sqlQuery("INSERT INTO tb_noticias (img, titulo, descricao, data_de_pub) VALUES (
                                '$final',
                                :TITULO,
                                :DESC,
                                '$data_format'
                            )", [
                                ':TITULO' => ucfirst($valores['titulo']),
                                ':DESC' => $valores['conteudo']
                            ]);

                            echo '<h3>Notícia enviada com sucesso!</h3>';
                        }
                    } else 
                    {
                        echo 'Algo deu errado!';
                    }
                }
            }
        }
    }

    private function allowExt($file_type)
    {
        $permitidos = ['png', 'jpg', 'jpeg', 'bmp', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF', 'BMP'];

        $this->ext = explode('.', $file_type);
        if (!in_array($this->ext[1], $permitidos))
        {
            return false;
        } else 
        {
            return true;
        }
    }

    private function exceptions()
    {
        $phpFileUploadErrors = [
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'Nenhum arquivo foi enviado',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        ];
        return $phpFileUploadErrors;
    }

    private function reOrder($vector)
    {
        $result = [];
        foreach ($vector as $key1 => $value1)
        {
            foreach ($value1 as $key2 => $value2)
            {
                $result[$key2][$key1] = $value2;
            }
        }
        return $result;
    }
}
?>