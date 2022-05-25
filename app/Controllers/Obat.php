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
        $this->satuan = new SatuanModel();
        $this->kategori = new KategoriModel();
        $this->supplier = new SupplierModel();
        $this->barang = new BarangModel();
        $this->jenis = new JenisModel();
        $this->obat = new ObatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Obat',
            'obat' => $this->obat->findAll(),
        ];

        return view('obat/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Obat',
            'validation' => \Config\Services::validation(),
            'satuan' => $this->satuan->findAll(),
            'kategori' => $this->kategori->findAll(),
            'supplier' => $this->supplier->findAll(),
            'barang' => $this->barang->findAll(),
            'jenis' => $this->jenis->findAll(),
        ];

        return view('obat/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'no_batch' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Batch harus diisi!',
                ]
            ],
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
            'nama_satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi!',
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
            'no_batch' => $this->request->getVar('no_batch'),
            'nama_obat' => $this->request->getVar('nama_obat'),
            'jenis' => $this->request->getVar('nama_jenis'),
            'kategori' => $this->request->getVar('nama_kategori'),
            'satuan' => $this->request->getVar('nama_satuan'),
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
            'satuan' => $this->satuan->findAll(),
            'kategori' => $this->kategori->findAll(),
            'supplier' => $this->supplier->findAll(),
            'barang' => $this->barang->findAll(),
            'jenis' => $this->jenis->findAll(),
            'obat' => $this->obat->find($id),
        ];

        return view('obat/edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            'no_batch' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Batch harus diisi!',
                ]
            ],
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
            'nama_satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi!',
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
            'no_batch' => $this->request->getVar('no_batch'),
            'nama_obat' => $this->request->getVar('nama_obat'),
            'jenis' => $this->request->getVar('nama_jenis'),
            'kategori' => $this->request->getVar('nama_kategori'),
            'satuan' => $this->request->getVar('nama_satuan'),
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
            'obat' => $this->obat->find($id),
        ];

        return view('obat/show', $data);
    }
}
