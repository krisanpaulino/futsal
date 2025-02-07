<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasModel;
use App\Models\LogdataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Log extends BaseController
{
    public function index()
    {
        $model = new FasilitasModel();
        $fasilitas = $model->findAll();

        $data = [
            'title' => 'Data Fasilitas',
            'fasilitas' => $fasilitas
        ];
        return view('admin/fasilitas_index', $data);
    }
}
