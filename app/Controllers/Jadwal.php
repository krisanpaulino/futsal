<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\LogdataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Jadwal extends BaseController
{
    public function index()
    {
        $model = new JadwalModel();
        $data = [
            'title' => 'Daftar Jadwal',
            'transaksi' => $model->tampilDepan()
        ];
        return view('admin/jadwal_index', $data);
    }
    function checkin()
    {
        $model = new JadwalModel();
        $jadwal_id = $this->request->getPost('jadwal_id');
        $old_data = json_encode($model->find($jadwal_id));
        $log = [
            'user_id' => user()->user_id,
            'operation' => 'update',
            'log_tablename' => 'fasilitas',
            'changed_at' => date('Y-m-d H:i:s'),
            'changed_data' => $old_data
        ];
        $logModel = new LogdataModel();
        $logModel->insert($log);
        $data['status'] = 'Aktif';
        $model->update($jadwal_id, $data);
        return redirect()->back()
            ->with('message', "Toastify({'text':'Berhasil checkin!'}).showToast()");
    }
    function today()
    {
        $model = new JadwalModel();
        $data = [
            'title' => 'Daftar Jadwal Hari Ini',
            'transaksi' => $model->getToday()
        ];
        return view('admin/jadwal_index', $data);
    }
    function done()
    {
        $model = new JadwalModel();
        $data = [
            'title' => 'Daftar Jadwal Selesai',
            'transaksi' => $model->getSelesai()
        ];
        return view('admin/jadwal_index', $data);
    }
    function selesai()
    {
        $model = new JadwalModel();
        $jadwal_id = $this->request->getPost('jadwal_id');
        $old_data = json_encode($model->find($jadwal_id));
        $log = [
            'user_id' => user()->user_id,
            'operation' => 'update',
            'log_tablename' => 'fasilitas',
            'changed_at' => date('Y-m-d H:i:s'),
            'changed_data' => $old_data
        ];
        $logModel = new LogdataModel();
        $logModel->insert($log);
        $data['status'] = 'Selesai';
        $model->update($jadwal_id, $data);
        return redirect()->back()
            ->with('message', "Toastify({'text':'Berhasil mengubah status jadwal ke selesai!'}).showToast()");
    }
}
