<?php

namespace App\Models;

use App\Core\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (nama, nip, jabatan, departemen, gaji_pokok) VALUES (:nama, :nip, :jabatan, :departemen, :gaji_pokok)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        $stmt->bindParam(':departemen', $data['departemen']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET nama = :nama, nip = :nip, jabatan = :jabatan, departemen = :departemen, gaji_pokok = :gaji_pokok WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        $stmt->bindParam(':departemen', $data['departemen']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        
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