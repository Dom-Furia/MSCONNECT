<?php

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        // Recebe variáveis do ambiente Docker (docker-compose)
        $this->host = getenv('DB_HOST') ?: 'localhost';  // 'db' é o nome do serviço no docker-compose
        $this->db_name = getenv('MYSQL_DATABASE') ?: 'crud_app';
        $this->username = getenv('MYSQL_USER') ?: 'root';
        $this->password = getenv('MYSQL_PASSWORD') ?: 'root';
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erro de conexão: " . $e->getMessage()]);
        }

        return $this->conn;
    }
}
?>
