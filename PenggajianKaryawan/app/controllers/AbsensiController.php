<?php
require_once '../config/database.php';
require_once '../models/Absensi.php';

class AbsensiController {
    private $absensiModel;

    public function __construct() {
        $this->absensiModel = new Absensi();
    }

    public function index() {
        $absensis = $this->absensiModel->getAll();
        include '../resources/views/absensi/index.php';
    }

    public function create() {
        if ($_POST) {
            $data = [
                'karyawan_id' => $_POST['karyawan_id'],
                'tanggal' => $_POST['tanggal'],
                'jam_masuk' => $_POST['jam_masuk'],
                'jam_keluar' => $_POST['jam_keluar'],
                'status' => $_POST['status']
            ];
            
            $result = $this->absensiModel->create($data);
            if ($result) {
                header('Location: ?page=absensi');
                exit();
            }
        }
        
        // Get all employees for the dropdown
        $karyawans = $this->absensiModel->getAllKaryawan();
        include '../resources/views/absensi/create.php';
    }

    public function edit($id) {
        if ($_POST) {
            $data = [
                'karyawan_id' => $_POST['karyawan_id'],
                'tanggal' => $_POST['tanggal'],
                'jam_masuk' => $_POST['jam_masuk'],
                'jam_keluar' => $_POST['jam_keluar'],
                'status' => $_POST['status']
            ];
            
            $result = $this->absensiModel->update($id, $data);
            if ($result) {
                header('Location: ?page=absensi');
                exit();
            }
        }
        
        $absensi = $this->absensiModel->getById($id);
        $karyawans = $this->absensiModel->getAllKaryawan();
        include '../resources/views/absensi/edit.php';
    }

    public function delete($id) {
        $result = $this->absensiModel->delete($id);
        if ($result) {
            header('Location: ?page=absensi');
            exit();
        }
    }
}