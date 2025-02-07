<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LapanganModel;
use App\Models\LogdataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Lapangan extends BaseController
{
    public function index() //langsung detail lapangan
    {
        $model = new LapanganModel();
        $lapangan = $model->first();

        $data = [
            'title' => 'Data Lapangan',
            'lapangan' => $lapangan
        ];
        return view('admin/lapangan_detail', $data);
    }
    public function form() //langsung detail lapangan
    {
        $model = new LapanganModel();
        $lapangan = $model->first();
        if (empty($lapangan))
            $lapangan = new LapanganModel();

        $data = [
            'title' => 'Data Lapangan',
            'lapangan' => $lapangan
        ];
        return view('admin/lapangan_form', $data);
    }

    function save()
    {

        // Proses Data lapangan
        $datalapangan = $this->request->getPost();
        // dd($this->request->getFile('file'));
        $model = new LapanganModel();
        if ($datalapangan['lapangan_id'] == null) {
            $log = [
                'user_id' => user()->user_id,
                'operation' => 'insert',
                'log_tablename' => 'fasilitas',
                'changed_at' => date('Y-m-d H:i:s'),
                'changed_data' => '-'
            ];
        } else {
            $old_data = json_encode($model->find($datalapangan['lapangan_id']));
            $log = [
                'user_id' => user()->user_id,
                'operation' => 'update',
                'log_tablename' => 'fasilitas',
                'changed_at' => date('Y-m-d H:i:s'),
                'changed_data' => $old_data
            ];
        }
        // Validasi Image
        $validationRule = [
            'file' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file,2048]',
                    // 'max_dims[file,1920,1080]',
                ],
            ],
        ];
        if (!$this->validateData([], $validationRule) && $datalapangan['lapangan_id'] == null) {
            $errors = ['errors' => $this->validator->getErrors()];
            return redirect()->back()->with('errors', $errors)
                ->with('message', "Toastify({'text':'Gagal 1 menambahkan lapangan! File tidak valid.', style: {
            background: '#fd2e64',
          }}).showToast()")->withInput();
        }
        $file = $this->request->getFile('file');
        if (!$file->isValid() && $datalapangan['lapangan_id'] == null) {
            return redirect()->back()->with('errors', ['image' => 'File tidak valid'])
                ->with('message', "Toastify({'text':'Gagal menambahkan lapangan File tidak valid!', style: {
                background: '#fd2e64',
              }}).showToast()")->withInput();
        }
        //File Upload 
        if ($file->isValid()) {
            $filename = $file->getRandomName();
            $file->move('assets/img/lapangan', $filename, true);

            //Updating data in lapangan
            $datalapangan['gambar'] = $filename;
        }
        $lapangan_id = $model->save($datalapangan, true);
        if ($lapangan_id == false) {
            // dd($model->errors());
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Gagal menambahkan lapangan! Data tidak lengkap', style: {
            background: '#fd2e64',
          }}).showToast()")->withInput();
        }
        $logModel = new LogdataModel();
        $logModel->insert($log);
        //done
        return redirect()->to('admin/lapangan')
            ->with('message', "Toastify({'text':'lapangan disimpan!'}).showToast()");
    }
}
