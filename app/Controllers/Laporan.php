<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\ObatMasukModel;
use App\Models\ObatKeluarModel;
use App\Controllers\BaseController;
use App\Models\ObatTransaksiModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->obat = new ObatModel();
        $this->obatMasuk = new ObatMasukModel();
        $this->obatKeluar = new ObatKeluarModel();
        $this->obatTransaksi = new ObatTransaksiModel();
    }

    public function index()
    {
        $id_obat = $this->request->getGet('id_obat');
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');

        if (empty($id_obat) || empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatTransaksi->filterObat($id_obat, $dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'Laporan Stok Obat',
            'idObat' => $this->obat->findAll(),
            'obat' => $obat,
        ];

        return view('laporan/obat/index', $data);
    }

    public function getObatPdf()
    {
        $id_obat = $this->request->getGet('id_obat');
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');

        if (empty($id_obat) || empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatTransaksi->filterObat($id_obat, $dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'PDF Laporan Obat Masuk',
            'obat' => $obat,
        ];

        return view('laporan/obat/pdf', $data);
    }

    // obat masuk
    public function obatMasuk()
    {
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');

        if (empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatMasuk->filterObatMasuk($dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'Laporan Obat Masuk',
            'obat' => $obat,
        ];

        return view('laporan/obat_masuk/data_obat_masuk', $data);
    }

    public function obatMasukPdf()
    {
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');

        if (empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatMasuk->filterObatMasuk($dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'PDF Laporan Obat Masuk',
            'obat' => $obat,
        ];

        return view('laporan/obat_masuk/pdf', $data);
    }


    // obat keluar
    public function obatKeluar()
    {
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');
        $jenis = $this->request->getGet('jenis');

        if (empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatKeluar->filterObatKeluar($dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'Laporan Obat Keluar',
            'obat' => $obat,
            'jenis' => $jenis,
        ];

        return view('laporan/obat_keluar/data_obat_keluar', $data);
    }

    public function obatKeluarPdf()
    {
        $dari_tgl = $this->request->getGet('dari_tanggal');
        $sampai_tgl = $this->request->getGet('sampai_tanggal');

        if (empty($dari_tgl) || empty($sampai_tgl)) {
            $obat = '';
        } else {
            $obat = $this->obatKeluar->filterObatKeluar($dari_tgl, $sampai_tgl);
        }

        $data = [
            'title' => 'PDF Laporan Obat Keluar',
            'obat' => $obat,
        ];

        return view('laporan/obat_keluar/pdf', $data);
    }
}
