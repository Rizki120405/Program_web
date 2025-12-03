<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    private $absensiModel;

    public function __construct()
    {
        $this->absensiModel = new Absensi();
    }

    public function index()
    {
        \App\Core\Auth::check();
        
        $absensis = $this->absensiModel->findAll();
        $data = [
            'title' => 'Data Absensi',
            'absensis' => $absensis
        ];
        
        $this->view('absensi/index', $data);
    }

    public function create()
    {
        \App\Core\Auth::check();
        
        $data = [
            'title' => 'Tambah Absensi'
        ];
        
        $this->view('absensi/create', $data);
    }

    public function store()
    {
        \App\Core\Auth::check();
        
        $data = [
            'karyawan_id' => $_POST['karyawan_id'],
            'tanggal' => $_POST['tanggal'],
            'jam_masuk' => $_POST['jam_masuk'],
            'jam_keluar' => $_POST['jam_keluar'],
            'status' => $_POST['status']
        ];
        
        $this->absensiModel->create($data);
        header('Location: /absensi');
        exit();
    }

    public function edit($id)
    {
        \App\Core\Auth::check();
        
        $absensi = $this->absensiModel->findById($id);
        $data = [
            'title' => 'Edit Absensi',
            'absensi' => $absensi
        ];
        
        $this->view('absensi/edit', $data);
    }

    public function update($id)
    {
        \App\Core\Auth::check();
        
        $data = [
            'karyawan_id' => $_POST['karyawan_id'],
            'tanggal' => $_POST['tanggal'],
            'jam_masuk' => $_POST['jam_masuk'],
            'jam_keluar' => $_POST['jam_keluar'],
            'status' => $_POST['status']
        ];
        
        $this->absensiModel->update($id, $data);
        header('Location: /absensi');
        exit();
    }

    public function delete($id)
    {
        \App\Core\Auth::check();
        
        $this->absensiModel->delete($id);
        header('Location: /absensi');
        exit();
    }
}