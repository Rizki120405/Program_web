<?php
require_once '../config/database.php';
require_once '../models/Karyawan.php';

class KaryawanController {
    private $karyawanModel;

    public function __construct() {
        $this->karyawanModel = new Karyawan();
    }

    public function index() {
        $karyawans = $this->karyawanModel->getAll();
        include '../resources/views/karyawan/index.php';
    }

    public function create() {
        if ($_POST) {
            $data = [
                'nama' => $_POST['nama'],
                'nip' => $_POST['nip'],
                'jabatan' => $_POST['jabatan'],
                'departemen' => $_POST['departemen'],
                'gaji_pokok' => $_POST['gaji_pokok'],
                'tanggal_masuk' => $_POST['tanggal_masuk']
            ];
            
            $result = $this->karyawanModel->create($data);
            if ($result) {
                header('Location: ?page=karyawan');
                exit();
            }
        }
        include '../resources/views/karyawan/create.php';
    }

    public function edit($id) {
        if ($_POST) {
            $data = [
                'nama' => $_POST['nama'],
                'nip' => $_POST['nip'],
                'jabatan' => $_POST['jabatan'],
                'departemen' => $_POST['departemen'],
                'gaji_pokok' => $_POST['gaji_pokok'],
                'tanggal_masuk' => $_POST['tanggal_masuk']
            ];
            
            $result = $this->karyawanModel->update($id, $data);
            if ($result) {
                header('Location: ?page=karyawan');
                exit();
            }
        }
        
        $karyawan = $this->karyawanModel->getById($id);
        include '../resources/views/karyawan/edit.php';
    }

    public function delete($id) {
        $result = $this->karyawanModel->delete($id);
        if ($result) {
            header('Location: ?page=karyawan');
            exit();
        }
    }
}