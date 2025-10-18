<?php

class Database {
    private $host = 'localhost'; // nome do serviço no docker-compose
    private $db_name = 'crud_app';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
                
            );
           
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erro de conexão: " . $e->getMessage()]);
        }
        return $this->conn;
    }
}
?>
