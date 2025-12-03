<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Penggajian;

class PenggajianController extends Controller
{
    private $penggajianModel;

    public function __construct()
    {
        $this->penggajianModel = new Penggajian();
    }

    public function index()
    {
        \App\Core\Auth::check();
        
        $penggajians = $this->penggajianModel->findAll();
        $data = [
            'title' => 'Data Penggajian',
            'penggajians' => $penggajians
        ];
        
        $this->view('penggajian/index', $data);
    }

    public function create()
    {
        \App\Core\Auth::check();
        
        $data = [
            'title' => 'Tambah Penggajian'
        ];
        
        $this->view('penggajian/create', $data);
    }

    public function store()
    {
        \App\Core\Auth::check();
        
        $data = [
            'karyawan_id' => $_POST['karyawan_id'],
            'bulan' => $_POST['bulan'],
            'tahun' => $_POST['tahun'],
            'gaji_pokok' => $_POST['gaji_pokok'],
            'tunjangan' => $_POST['tunjangan'],
            'potongan' => $_POST['potongan'],
            'total_gaji' => $_POST['total_gaji']
        ];
        
        $this->penggajianModel->create($data);
        header('Location: /penggajian');
        exit();
    }

    public function edit($id)
    {
        \App\Core\Auth::check();
        
        $penggajian = $this->penggajianModel->findById($id);
        $data = [
            'title' => 'Edit Penggajian',
            'penggajian' => $penggajian
        ];
        
        $this->view('penggajian/edit', $data);
    }

    public function update($id)
    {
        \App\Core\Auth::check();
        
        $data = [
            'karyawan_id' => $_POST['karyawan_id'],
            'bulan' => $_POST['bulan'],
            'tahun' => $_POST['tahun'],
            'gaji_pokok' => $_POST['gaji_pokok'],
            'tunjangan' => $_POST['tunjangan'],
            'potongan' => $_POST['potongan'],
            'total_gaji' => $_POST['total_gaji']
        ];
        
        $this->penggajianModel->update($id, $data);
        header('Location: /penggajian');
        exit();
    }

    public function delete($id)
    {
        \App\Core\Auth::check();
        
        $this->penggajianModel->delete($id);
        header('Location: /penggajian');
        exit();
    }
    
    public function generateSlipGaji($id)
    {
        \App\Core\Auth::check();
        
        $penggajian = $this->penggajianModel->findById($id);
        $data = [
            'title' => 'Slip Gaji',
            'penggajian' => $penggajian
        ];
        
        $this->view('penggajian/slip_gaji', $data);
    }
}