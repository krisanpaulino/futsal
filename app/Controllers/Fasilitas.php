<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasModel;
use App\Models\LogdataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Fasilitas extends BaseController
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
    function insert()
    {
        $model = new FasilitasModel();
        $data = $this->request->getPost();
        $data['status'] = 'Tersedia';
        if (!$model->insert($data)) {
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Data tidak lengkap.', style: {
            background: '#fd2e64',
          }}).showToast()")->withInput();
        }
        $log = [
            'user_id' => user()->user_id,
            'operation' => 'insert',
            'log_tablename' => 'fasilitas',
            'changed_at' => date('Y-m-d H:i:s'),
            'changed_data' => '-'
        ];
        $logModel = new LogdataModel();
        $logModel->insert($log);
        return redirect()->to('admin/fasilitas')
            ->with('message', "dangerToast('Fasilitas Disimpan!')");
    }
    function update()
    {
        $model = new FasilitasModel();
        $id = $this->request->getPost('fasilitas_id');
        $old_data = json_encode($model->find($id));
        $data = $this->request->getPost();
        if (!$model->update($id, $data)) {
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Data tidak lengkap atau tidak sesuai.', style: {
            background: '#fd2e64',
          }}).showToast()")->withInput();
        }
        $log = [
            'user_id' => user()->user_id,
            'operation' => 'update',
            'log_tablename' => 'fasilitas',
            'changed_at' => date('Y-m-d H:i:s'),
            'changed_data' => $old_data
        ];
        $logModel = new LogdataModel();
        $logModel->insert($log);
        return redirect()->to('admin/fasilitas')
            ->with('message', "dangerToast('Fasilitas Disimpan!')");
    }
    function delete()
    {
        $model = new FasilitasModel();
        $id = $this->request->getPost('fasilitas_id');
        $old_data = json_encode($model->find($id));
        $model->where('fasilitas_id', $id)->delete();
        $log = [
            'user_id' => user()->user_id,
            'operation' => 'delete',
            'log_tablename' => 'fasilitas',
            'changed_at' => date('Y-m-d H:i:s'),
            'changed_data' => $old_data
        ];
        $logModel = new LogdataModel();
        $logModel->insert($log);
        return redirect()->to('admin/fasilitas')
            ->with('message', "dangerToast('Fasilitas Terhapus!')");
    }
}
