<?php

namespace App\Core;

use App\Config\Database;

abstract class Model
{
    protected $conn;
    protected $table;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    abstract public function create($data);
    abstract public function update($id, $data);
    abstract public function delete($id);
}