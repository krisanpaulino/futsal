<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            $data['title'] = 'LOGIN';
            return view('login', $data);
        } else {
            switch (session('user')->user_type) {
                case 'admin':
                    return redirect()->to('admin');
                    break;

                default:
                    return redirect()->to('/');
                    break;
            }
        }
    }
    public function signup()
    {
        $data['title'] = 'SIGN UP';
        return view('sign-up', $data);
    }

    function login()
    {
        $username = htmlspecialchars((string)$this->request->getPost('username'));
        $password = htmlspecialchars((string)$this->request->getPost('user_password'));
        $model = new UserModel();
        $user = $model->findUser($username);
        if (empty($user))
            return redirect()->back()->with('danger', 'User tidak ditemukan!');
        if (!password_verify($password, $user->user_password))
            return redirect()->back()->with('danger', 'Password Salah!');

        session()->set('user', $user);
        if ($user->user_type == 'pelanggan') {
            session()->set('is_pelanggan', 1);
            return redirect()->to('/');
        } else {
            session()->set('is_admin', 1);
            return redirect()->to('admin');
        }
    }

    function register()
    {
        $userinfo = [
            'username' => $this->request->getPost('username'),
            'user_type' => 'pelanggan',
            'password_confirmation' => $this->request->getPost('password_confirmation'),
            'user_password' => $this->request->getPost('user_password'),
        ];
        $model = new UserModel();

        if ($user_id = $model->insert($userinfo)) {
            $mPelanggan = new PelangganModel();
            $pelanggan = [
                'pelanggan_nama' => $this->request->getPost('pelanggan_nama'),
                'pelanggan_telepon' => $this->request->getPost('pelanggan_telepon'),
                'pelanggan_email' => $this->request->getPost('username'),
                'user_id' => $user_id,
            ];
            if ($mPelanggan->insert($pelanggan))
                return redirect()->to('auth')->with('message', "successToast('Gagal')");
            else
                dd($mPelanggan->errors());
        }
        // dd($model->errors());
        return redirect()->back()->with('message', "dangerToast('Gagal')")->withInput()->with('errors', $model->errors());
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('auth');
    }
}
