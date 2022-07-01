<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserTokenModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->user_token = new UserTokenModel();
    }

    public function index()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
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
                        'email' => $dataUser['email'],
                        'no_hp' => $dataUser['no_hp'],
                        'role' => $dataUser['role'],
                        // 'foto' => $dataUser['foto']
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

    public function register()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
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
            return redirect()->to('/register')->withInput();
        }

        $email_user = $this->request->getVar('email');

        $this->user->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $email_user,
            'no_hp' => $this->request->getVar('no_hp'),
            'foto' => 'default.png',
            'role' => $this->request->getVar('role'),
            'is_active' => $this->request->getVar('is_active'),
        ]);

        // buat token
        $token = base64_encode(random_bytes(32));

        $this->user_token->save([
            'email' => $email_user,
            'token' => $token,
            'date_created' => time()
        ]);

        $this->_sendEmail($token, 'verify');

        session()->setFlashdata('message', '<div class="alert alert-success">Pendaftaran berhasil silahkan cek email anda aktivasi akun!</div>');

        return redirect()->to('/');
    }

    private function _sendEmail($token, $type)
    {
        $email_user = $this->request->getVar('email');
        $email = \Config\Services::email();
        $email->setTo($email_user); // target
        $email->setFrom('alfiafarmaapotik@gmail.com'); // pengirim

        if ($type == 'verify') {
            $email->setSubject('Aktivasi Akun');
            $email->setMessage('Klik link ini untuk aktivasi akun : <a href="' . base_url() . '/auth/verify?email=' . $email_user . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } elseif ($type == 'forgot') {
            $email->setSubject('Reset Password');
            $email->setMessage('Klik link ini untuk reset password : <a href="' . base_url() . '/auth/resetpassword?email=' . $email_user . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($email->send()) {
            return true;
        } else {
            print_r($email->printDebugger());
            die;
        }
    }

    public function verify()
    {
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $user = $this->db->table('user_token')->getWhere(['email' => $email])->getRowArray();

        if ($user) {
            $user_token = $this->db->table('user_token')->getWhere(['token' => $token])->getRowArray();

            if ($user_token) {
                $builder = $this->db->table('user');
                $data = [
                    'is_active' => 1,
                ];
                $builder->where('email', $email);
                $builder->update($data);

                $this->db->table('user_token')->delete(['email' => $email]);

                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Aktivasi berhasil! Silahkan login.</div>');
                return redirect()->to('/')->withInput();
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token tidak valid.</div>');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email tidak valid.</div>');
            return redirect()->to('/')->withInput();
        }
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Lupa Password',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/forgot_password', $data);
    }

    public function forgot()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ]
        ])) {
            return redirect()->to('/auth/forgot_password')->withInput();
        }

        $email = $this->request->getVar('email');
        $user = $this->db->table('user')->getWhere(['email' => $email, 'is_active' => 1])->getRowArray();

        // buat token
        $token = base64_encode(random_bytes(32));

        if ($user) {
            $this->user_token->save([
                'email' => $email,
                'token' => $token,
            ]);

            $this->_sendEmail($token, 'forgot');

            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Silahkan cek email anda!</div>');
            return redirect()->to('/auth/forgot_password')->withInput();
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar atau teraktivasi!</div>');
            return redirect()->to('/auth/forgot_password')->withInput();
        }
    }

    public function resetpassword()
    {
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $user = $this->db->table('user')->getWhere(['email' => $email])->getRowArray();

        if ($user) {
            $user_token = $this->db->table('user_token')->getWhere(['token' => $token])->getRowArray();

            if ($user_token) {
                session()->set(['reset_email', $email]);
                $this->change_password();
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email salah.</div>');
            return redirect()->to('/')->withInput();
        }
    }

    public function change_password()
    {
        $data = [
            'title' => 'Ganti Password',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/change_password', $data);
    }

    public function logout()
    {
        $array_items = ['id_user', 'nama', 'email', 'no_hp', 'username', 'role'];
        session()->remove($array_items);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');
        return redirect()->to('/')->withInput();
    }
}
