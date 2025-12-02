<?php
require_once '../config/database.php';
require_once '../models/Penggajian.php';

class PenggajianController {
    private $penggajianModel;

    public function __construct() {
        $this->penggajianModel = new Penggajian();
    }

    public function index() {
        $penggajians = $this->penggajianModel->getAll();
        include '../resources/views/penggajian/index.php';
    }

    public function create() {
        if ($_POST) {
            $data = [
                'karyawan_id' => $_POST['karyawan_id'],
                'bulan' => $_POST['bulan'],
                'tahun' => $_POST['tahun'],
                'gaji_pokok' => $_POST['gaji_pokok'],
                'tunjangan' => $_POST['tunjangan'],
                'potongan' => $_POST['potongan'],
                'total_gaji' => $_POST['total_gaji'],
                'tanggal_pembayaran' => $_POST['tanggal_pembayaran'],
                'status' => $_POST['status']
            ];
            
            $result = $this->penggajianModel->create($data);
            if ($result) {
                header('Location: ?page=penggajian');
                exit();
            }
        }
        
        // Get all employees for the dropdown
        $karyawans = $this->penggajianModel->getAllKaryawan();
        include '../resources/views/penggajian/create.php';
    }

    public function edit($id) {
        if ($_POST) {
            $data = [
                'karyawan_id' => $_POST['karyawan_id'],
                'bulan' => $_POST['bulan'],
                'tahun' => $_POST['tahun'],
                'gaji_pokok' => $_POST['gaji_pokok'],
                'tunjangan' => $_POST['tunjangan'],
                'potongan' => $_POST['potongan'],
                'total_gaji' => $_POST['total_gaji'],
                'tanggal_pembayaran' => $_POST['tanggal_pembayaran'],
                'status' => $_POST['status']
            ];
            
            $result = $this->penggajianModel->update($id, $data);
            if ($result) {
                header('Location: ?page=penggajian');
                exit();
            }
        }
        
        $penggajian = $this->penggajianModel->getById($id);
        $karyawans = $this->penggajianModel->getAllKaryawan();
        include '../resources/views/penggajian/edit.php';
    }

    public function delete($id) {
        $result = $this->penggajianModel->delete($id);
        if ($result) {
            header('Location: ?page=penggajian');
            exit();
        }
    }
    
    public function generateSlipGaji($id) {
        $penggajian = $this->penggajianModel->getById($id);
        $karyawan = $this->penggajianModel->getKaryawanById($penggajian['karyawan_id']);
        
        // Include PDF generation here (would require DomPDF library)
        include '../resources/templates/slip_gaji.php';
    }
}