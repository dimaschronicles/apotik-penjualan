<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login | Apotek Buaran',
            'validation' => \Config\Services::validation()
        ];

        return view('login/index', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('/')->withInput();
        }

        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $userModel->getLogin($username);

        if (!empty($dataUser)) {
            if ($dataUser['is_active'] == 1) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'id_user' => $dataUser['id_user'],
                        'username' => $dataUser['username'],
                        'nama' => $dataUser['nama'],
                        'role' => $dataUser['role']
                    ]);

                    if ($dataUser['role'] == 1) {
                        return redirect()->to('dashboard');
                    } elseif ($dataUser['role'] == 2) {
                        return redirect()->to('dashboard');
                    }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Cek <strong>username</strong> atau <strong>password</strong> anda!</div>');
                    return redirect()->to('/')->withInput();
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Akun anda belum aktif!</div>');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Cek <strong>username</strong> atau <strong>password</strong> anda!</div>');
            return redirect()->to('/')->withInput();
        }
    }

    public function logout()
    {
        $array_items = ['id_user', 'nama', 'username', 'role'];
        session()->remove($array_items);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');
        return redirect()->to('/')->withInput();
    }
}
