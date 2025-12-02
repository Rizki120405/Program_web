<?php
require_once '../config/database.php';

class Penggajian {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    public function getAll() {
        $query = "SELECT p.*, k.nama as karyawan_nama FROM penggajian p LEFT JOIN karyawan k ON p.karyawan_id = k.id ORDER BY p.tahun DESC, p.bulan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT p.*, k.nama as karyawan_nama FROM penggajian p LEFT JOIN karyawan k ON p.karyawan_id = k.id WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO penggajian (karyawan_id, bulan, tahun, gaji_pokok, tunjangan, potongan, total_gaji, tanggal_pembayaran, status) VALUES (:karyawan_id, :bulan, :tahun, :gaji_pokok, :tunjangan, :potongan, :total_gaji, :tanggal_pembayaran, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':bulan', $data['bulan']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tunjangan', $data['tunjangan']);
        $stmt->bindParam(':potongan', $data['potongan']);
        $stmt->bindParam(':total_gaji', $data['total_gaji']);
        $stmt->bindParam(':tanggal_pembayaran', $data['tanggal_pembayaran']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE penggajian SET karyawan_id = :karyawan_id, bulan = :bulan, tahun = :tahun, gaji_pokok = :gaji_pokok, tunjangan = :tunjangan, potongan = :potongan, total_gaji = :total_gaji, tanggal_pembayaran = :tanggal_pembayaran, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':bulan', $data['bulan']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':gaji_pokok', $data['gaji_pokok']);
        $stmt->bindParam(':tunjangan', $data['tunjangan']);
        $stmt->bindParam(':potongan', $data['potongan']);
        $stmt->bindParam(':total_gaji', $data['total_gaji']);
        $stmt->bindParam(':tanggal_pembayaran', $data['tanggal_pembayaran']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM penggajian WHERE id = :id";
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

    public function getKaryawanById($id) {
        $query = "SELECT * FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}