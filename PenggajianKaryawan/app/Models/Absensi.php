<?php

namespace App\Models;

use App\Core\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (karyawan_id, tanggal, jam_masuk, jam_keluar, status) VALUES (:karyawan_id, :tanggal, :jam_masuk, :jam_keluar, :status)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam_masuk', $data['jam_masuk']);
        $stmt->bindParam(':jam_keluar', $data['jam_keluar']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET karyawan_id = :karyawan_id, tanggal = :tanggal, jam_masuk = :jam_masuk, jam_keluar = :jam_keluar, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam_masuk', $data['jam_masuk']);
        $stmt->bindParam(':jam_keluar', $data['jam_keluar']);
        $stmt->bindParam(':status', $data['status']);
        
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