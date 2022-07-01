<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profil',
            'user' => $this->user->find(session()->get('id_user'))
        ];

        return view('profile/index', $data);
    }

    public function editProfile()
    {
        $data = [
            'title' => 'Edit Profil',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->find(session()->get('id_user'))
        ];

        return view('profile/edit_profile', $data);
    }

    public function updateProfile()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
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
            return redirect()->to('/editprofile')->withInput();
        }

        $this->user->save([
            'id_user' => $this->request->getVar('id_user'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><b>Profile</b> anda berhasil diubah!</div>');

        return redirect()->to('/profile');
    }

    public function changePassword()
    {
        $data = [
            'title' => 'Ganti Password',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->find(session()->get('id_user'))
        ];

        return view('profile/change_password', $data);
    }

    public function updatePassword()
    {
        if (!$this->validate([
            'current_password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password Saat Ini harus diisi!',
                    'min_length' => 'Password Saat Ini minimal 6 karakter!',
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[6]|matches[new_password_conf]',
                'errors' => [
                    'required' => 'Password Baru harus diisi!',
                    'min_length' => 'Password Baru minimal 6 karakter!',
                    'matches' => 'Password Baru tidak sama dengan Konfirmasi Password!',
                ]
            ],
            'new_password_conf' => [
                'rules' => 'required|min_length[6]|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi!',
                    'min_length' => 'Konfirmasi Password minimal 6 karakter!',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password!',
                ]
            ]
        ])) {
            return redirect()->to('/changepassword')->withInput();
        }

        $user = $this->user->where('id_user', session()->get('id_user'))->first();
        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password');

        if (!password_verify($current_password, $user['password'])) {
            session()->setFlashdata('message', '<div class="alert alert-danger"><b>Password Saat Ini</b> salah!</div>');
            return redirect()->to('/changepassword');
        } else {
            if ($current_password == $new_password) {
                session()->setFlashdata('message', '<div class="alert alert-danger"><b>Password Baru</b> harus berbeda dengan <b>Password Saat Ini</b>!</div>');
                return redirect()->to('/changepassword');
            } else {
                $this->user->save([
                    'id_user' => $this->request->getVar('id_user'),
                    'password' => password_hash($new_password, PASSWORD_DEFAULT),
                ]);

                session()->setFlashdata('message', '<div class="alert alert-success"><b>Password</b> anda berhasil diubah!</div>');
                return redirect()->to('/profile');
            }
        }
    }
}
