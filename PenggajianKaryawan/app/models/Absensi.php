<?php
require_once '../config/database.php';

class Absensi {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    public function getAll() {
        $query = "SELECT a.*, k.nama as karyawan_nama FROM absensi a LEFT JOIN karyawan k ON a.karyawan_id = k.id ORDER BY a.tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT a.*, k.nama as karyawan_nama FROM absensi a LEFT JOIN karyawan k ON a.karyawan_id = k.id WHERE a.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO absensi (karyawan_id, tanggal, jam_masuk, jam_keluar, status) VALUES (:karyawan_id, :tanggal, :jam_masuk, :jam_keluar, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam_masuk', $data['jam_masuk']);
        $stmt->bindParam(':jam_keluar', $data['jam_keluar']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE absensi SET karyawan_id = :karyawan_id, tanggal = :tanggal, jam_masuk = :jam_masuk, jam_keluar = :jam_keluar, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam_masuk', $data['jam_masuk']);
        $stmt->bindParam(':jam_keluar', $data['jam_keluar']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM absensi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAllKaryawan() {
        $query = "SELECT id, nama FROM karyawan ORDER BY nama ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}