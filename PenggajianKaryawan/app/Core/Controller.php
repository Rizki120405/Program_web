<?php

namespace App\Core;

class Controller
{
    protected $model;

    public function model($model)
    {
        require_once '../app/Models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        $viewFile = '../resources/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            extract($data);
            require_once $viewFile;
        } else {
            die("View tidak ditemukan: " . $viewFile);
        }
    }
}