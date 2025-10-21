<?php
class User
{
    private $conn;
    private $table = "users";

    public $id;
    public $name;
    public $email;
    public $fone;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (name, email, phone) VALUES (:name, :email, :fone)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":fone", $this->fone);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET name=:name, email=:email, phone=:fone WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":fone", $this->fone);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function existsByEmail($email, $excludeId = null)
    {
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($excludeId) $sql .= " AND id != :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        if ($excludeId) $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
