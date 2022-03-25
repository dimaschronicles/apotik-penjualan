<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Register | Apotek Buaran',
            'validation' => \Config\Services::validation()
        ];

        return view('register/index', $data);
    }

    public function register()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'is_unique' => 'Username sudah terdaftar!',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric|min_length[11]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor HP harus diisi!',
                    'numeric' => 'Nomor HP harus angka!',
                    'min_length' => 'Nomor HP kurang dari 11 digit!',
                    'max_length' => 'Nomor HP lebih dari 13 digit!',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|matches[password_conf]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Password minimal 6 karakter!',
                    'matches' => 'Password tidak sama dengan Konfirmasi Password!',
                ]
            ],
            'password_conf' => [
                'rules' => 'required|min_length[6]|matches[password_conf]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi!',
                    'min_length' => 'Konfirmasi Password minimal 6 karakter!',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password!',
                ]
            ]
        ])) {
            return redirect()->to('/register')->withInput();
        }

        $this->user->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
            'foto' => 'default.png',
            'role' => $this->request->getVar('role'),
            'is_active' => $this->request->getVar('is_active'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Pendaftaran berhasil silahkan cek email anda aktivasi akun!</div>');

        return redirect()->to('/');
    }
}
