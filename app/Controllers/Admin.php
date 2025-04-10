<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use App\Models\JadwalModel;
use App\Models\LogdataModel;
use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {

        $mTransaksi = new TransaksiModel();
        $mJadwal = new JadwalModel();
        $data = [
            'title' => 'Dashboard',
            'total_booking' => $mTransaksi->countAllResults(),
            'jadwal_hariini' => $mJadwal->getToday(true)
        ];

        return view('admin/dashboard', $data);
    }

    public function user()
    {
        $model = new UserModel();
        $user = $model->findActive();
        $data = [
            'title' => 'User Management',
            'user' => $user,
        ];
        return view('admin/user_index', $data);
    }
    public function pelanggan()
    {
        $model = new PelangganModel();
        $pelanggan = $model->findPelanggan();
        $data = [
            'title' => 'Data Pelanggan',
            'pelanggan' => $pelanggan,
        ];
        return view('admin/pelanggan_index', $data);
    }

    public function storeuser()
    {
        $model = new UserModel();
        $data = $this->request->getPost();
        $data['role_id'] = 3;
        if (!$model->insert($data))
            // dd($model->errors());
            return redirect()->back()->with('danger', ' Gagal Menambahkan')->withInput()->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Berhasil menambah user');
    }
    function gantiPassword()
    {
        $user = user();
        $data = [
            'title' => 'Profil',
            'user' => $user
        ];
        return view('admin/ganti_password', $data);
    }
    function updatePassword()
    {
        // $user_id = user()->user_id;
        $current_password = $this->request->getPost('current_password');
        $model = new UserModel();
        $user = user();
        //cek validasi password 
        if (!password_verify($current_password, $user->user_password)) {
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Gagal! Pasword salah!', style: {
    background: '#fd2e64',
  }}).showToast()");
        }
        $data = [
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation')
        ];
        // dd($user);
        $model->where('user_id', session('user')->user_id);
        $model->set($data);
        if (!$model->update())
            // dd($model->errors());
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Gagal! Konfirmasi password tidak sama', style: {
    background: '#fd2e64',
  }}).showToast()");

        return redirect()->back()
            ->with('message', "Toastify({'text':'Password berhasil diubah!'}).showToast()")
            ->with('errors', $model->errors());
    }

    function feedback()
    {
        $model = new FeedbackModel();
        $feedback = $model->getFeedback();
        $data = [
            'title' => 'Data Feedback',
            'feedback' => $feedback
        ];
        return view('admin/feedback_index', $data);
    }

    public function log()
    {
        $model = new LogdataModel();
        $log = $model->getLog();

        $data = [
            'title' => 'Data log',
            'log' => $log
        ];
        return view('admin/log_index', $data);
    }
}
