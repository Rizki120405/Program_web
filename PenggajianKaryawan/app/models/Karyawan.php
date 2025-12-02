<?php
require_once '../config/database.php';

class Karyawan {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    public function getAll() {
        $query = "SELECT * FROM karyawan ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO karyawan (nama, nip, jabatan, departemen, gaji_pokok, tanggal_masuk) VALUES (:nama, :nip, :jabatan, :departemen, :gaji_pokok, :tanggal_masuk)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        $stmt->bindParam(':departemen', $data['departemen']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tanggal_masuk', $data['tanggal_masuk']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE karyawan SET nama = :nama, nip = :nip, jabatan = :jabatan, departemen = :departemen, gaji_pokok = :gaji_pokok, tanggal_masuk = :tanggal_masuk WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        $stmt->bindParam(':departemen', $data['departemen']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tanggal_masuk', $data['tanggal_masuk']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}