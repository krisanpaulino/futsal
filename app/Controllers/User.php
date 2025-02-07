<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $user = user();
        $data = [
            'user' => $user,
            'title' => 'MyProfil',
        ];
        return view('admin/user_index', $data);
    }

    public function edit()
    {
        $model = new UserModel();
        $user = $model->findUser(session('user')->username);
        $data = [
            'title' => 'Edit Profile',
            'user' => $user
        ];
        return view('user/edit', $data);
    }

    function save()
    {
        $user_id = $this->request->getPost('user_id');
        $data = $this->request->getPost();
        $model = new UserModel();
        $img = $this->request->getFile('image');

        if ($img != null) {
            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[userfile,100]',
                        'max_dims[userfile,1024,768]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                $err = ['errors' => $this->validator->getErrors()];

                return redirect()->back()->with('danger', 'Foto tidak valid')->withInput();
            }
            $path = './assets/img/profile';
            $filename = session('user')->user_id . '.' . $img->getExtension();
            if (!$img->move($path, $filename, true))
                return redirect()->back()->with('danger', 'Kesalahan saat mengupload gambar')->withInput();
            $data['user_image'] = $filename;
        }

        if ($model->update($user_id, $data))
            return redirect()->back()->with('success', 'Profile berhasil diupdate!');
        return redirect()->back()->with('danger', 'Gagal diupdate')->withInput()->with('errors', $model->errors());
    }

    function profil()
    {
        $user = user();
        $data = [
            'user' => $user,
            'title' => 'MyProfil',
        ];
        return view('user/gantipassword', $data);
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
            ->with('message', "Toastify({'text':'Password berhasil diubah!'}).showToast()");
    }
}
