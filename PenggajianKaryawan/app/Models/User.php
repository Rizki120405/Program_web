<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users';

    public function findByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (nama, email, password) VALUES (:nama, :email, :password)";
        $stmt = $this->conn->prepare($query);
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword);
        
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET nama = :nama, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}