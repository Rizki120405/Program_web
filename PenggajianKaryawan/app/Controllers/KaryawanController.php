<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    private $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new Karyawan();
    }

    public function index()
    {
        \App\Core\Auth::check();
        
        $karyawans = $this->karyawanModel->findAll();
        $data = [
            'title' => 'Data Karyawan',
            'karyawans' => $karyawans
        ];
        
        $this->view('karyawan/index', $data);
    }

    public function create()
    {
        \App\Core\Auth::check();
        
        $data = [
            'title' => 'Tambah Karyawan'
        ];
        
        $this->view('karyawan/create', $data);
    }

    public function store()
    {
        \App\Core\Auth::check();
        
        $data = [
            'nama' => $_POST['nama'],
            'nip' => $_POST['nip'],
            'jabatan' => $_POST['jabatan'],
            'departemen' => $_POST['departemen'],
            'gaji_pokok' => $_POST['gaji_pokok']
        ];
        
        $this->karyawanModel->create($data);
        header('Location: /karyawan');
        exit();
    }

    public function edit($id)
    {
        \App\Core\Auth::check();
        
        $karyawan = $this->karyawanModel->findById($id);
        $data = [
            'title' => 'Edit Karyawan',
            'karyawan' => $karyawan
        ];
        
        $this->view('karyawan/edit', $data);
    }

    public function update($id)
    {
        \App\Core\Auth::check();
        
        $data = [
            'nama' => $_POST['nama'],
            'nip' => $_POST['nip'],
            'jabatan' => $_POST['jabatan'],
            'departemen' => $_POST['departemen'],
            'gaji_pokok' => $_POST['gaji_pokok']
        ];
        
        $this->karyawanModel->update($id, $data);
        header('Location: /karyawan');
        exit();
    }

    public function delete($id)
    {
        \App\Core\Auth::check();
        
        $this->karyawanModel->delete($id);
        header('Location: /karyawan');
        exit();
    }
}