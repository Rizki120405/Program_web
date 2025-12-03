<?php

namespace App\Models;

use App\Core\Model;

class Penggajian extends Model
{
    protected $table = 'penggajian';

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (karyawan_id, bulan, tahun, gaji_pokok, tunjangan, potongan, total_gaji) VALUES (:karyawan_id, :bulan, :tahun, :gaji_pokok, :tunjangan, :potongan, :total_gaji)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':bulan', $data['bulan']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tunjangan', $data['tunjangan']);
        $stmt->bindParam(':potongan', $data['potongan']);
        $stmt->bindParam(':total_gaji', $data['total_gaji']);
        
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET karyawan_id = :karyawan_id, bulan = :bulan, tahun = :tahun, gaji_pokok = :gaji_pokok, tunjangan = :tunjangan, potongan = :potongan, total_gaji = :total_gaji WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':bulan', $data['bulan']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tunjangan', $data['tunjangan']);
        $stmt->bindParam(':potongan', $data['potongan']);
        $stmt->bindParam(':total_gaji', $data['total_gaji']);
        
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