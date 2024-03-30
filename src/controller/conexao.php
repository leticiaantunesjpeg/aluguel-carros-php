<?php

class Conexao {

    private $host = 'localhost';
    private $dbname = 'aluguel-carros-php'; // Corrigido para o nome do banco de dados fornecido
    private $user = 'root';
    private $pass = '';

    public function conectar() {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"                
            );

            return $conexao;
        } catch (PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
            exit; // Adicionado para interromper a execução em caso de erro
        }
    }
}

?>
