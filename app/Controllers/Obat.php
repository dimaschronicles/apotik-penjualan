<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\JenisModel;
use App\Models\KategoriModel;
use App\Models\ObatModel;
use App\Models\SatuanModel;
use App\Models\SupplierModel;

class Obat extends BaseController
{
    public function __construct()
    {
        $this->barang = new BarangModel();
        $this->kategori = new KategoriModel();
        $this->supplier = new SupplierModel();
        $this->jenis = new JenisModel();
        $this->obat = new ObatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Obat',
            'obat' => $this->obat->getObat(),
        ];

        return view('obat/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Obat',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barang->findAll(),
            'kategori' => $this->kategori->findAll(),
            'supplier' => $this->supplier->findAll(),
            'jenis' => $this->jenis->findAll(),
        ];

        return view('obat/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat harus diisi!',
                ]
            ],
            'nama_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis harus diisi!',
                ]
            ],
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi!',
                ]
            ],
            'id_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier harus diisi!',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/obat/add')->withInput();
        }

        $this->obat->save([
            'nama_obat' => $this->request->getVar('nama_obat'),
            'jenis' => $this->request->getVar('nama_jenis'),
            'kategori' => $this->request->getVar('nama_kategori'),
            'id_supplier' => $this->request->getVar('id_supplier'),
            'keterangan' => $this->request->getVar('keterangan'),
            'time_created' => time(),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>obat</b> berhasil ditambahkan!</div>');

        return redirect()->to('/obat');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Obat',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barang->findAll(),
            'kategori' => $this->kategori->findAll(),
            'supplier' => $this->supplier->findAll(),
            'jenis' => $this->jenis->findAll(),
            'obat' => $this->obat->getObat($id),
        ];

        return view('obat/edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat harus diisi!',
                ]
            ],
            'nama_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis harus diisi!',
                ]
            ],
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi!',
                ]
            ],
            'id_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier harus diisi!',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/obat/add')->withInput();
        }

        $this->obat->save([
            'id_obat' => $id,
            'nama_obat' => $this->request->getVar('nama_obat'),
            'jenis' => $this->request->getVar('nama_jenis'),
            'kategori' => $this->request->getVar('nama_kategori'),
            'id_supplier' => $this->request->getVar('id_supplier'),
            'keterangan' => $this->request->getVar('keterangan'),
            'time_created' => time(),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>obat</b> berhasil diubah!</div>');

        return redirect()->to('/obat');
    }

    public function delete($id)
    {
        $this->obat->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>obat</strong> berhasil dihapus!</div>');
        return redirect()->to('/obat');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Obat',
            'obat' => $this->obat->getObat($id),
        ];

        return view('obat/show', $data);
    }
}
