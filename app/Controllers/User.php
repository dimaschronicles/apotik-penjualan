<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class User extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'user' => $this->user->where('role', 2)->findAll(),
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Karyawan',
            'validation' => Services::validation(),
        ];

        return view('user/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                    'is_unique' => 'Email sudah terdaftar!',
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
            return redirect()->to('/user/add')->withInput();
        }

        $this->user->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
            'role' => 2,
            'date_created' => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>karyawan</strong> berhasil ditambahkan!</div>');
        return redirect()->to('/user');
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Ubah Data Karyawan',
            'validation' => Services::validation(),
            'user' => $this->user->find($id),
        ];

        return view('user/edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
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
        ])) {
            return redirect()->to('/user' . '/' . $this->request->getVar('id_user') . '/edit')->withInput();
        }

        $this->user->save([
            'id_user' => $this->request->getVar('id_user'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
            'role' => 2,
            'date_created' => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>karyawan</strong> berhasil ditambahkan!</div>');
        return redirect()->to('/user');
    }

    public function delete($id = null)
    {
        $this->user->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>karyawan</strong> berhasil dihapus!</div>');
        return redirect()->to('/user');
    }
}
