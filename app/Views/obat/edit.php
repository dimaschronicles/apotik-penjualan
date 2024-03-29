<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/obat">Data Obat</a></li>
                        <li class="breadcrumb-item active">Ubah Data Obat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section>
        <div class="row">
            <div class="col mr-3 ml-3">
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="card card-primary">
                        <div class="card-header">
                            Form Edit Data Obat
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/obat/<?= $obat['id_obat']; ?>" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group row">
                                    <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat">
                                            <option value="">== Pilih Obat ==</option>
                                            <?php foreach ($barang as $b) : ?>
                                                <option value="<?= $b['nama_barang']; ?>" <?= ($obat['nama_obat'] == $b['nama_barang']) ? 'selected' : old('nama_obat'); ?>><?= $b['nama_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_obat'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_jenis" class="col-sm-2 col-form-label">Jenis</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  <?= ($validation->hasError('nama_jenis')) ? 'is-invalid' : ''; ?>" id="nama_jenis" name="nama_jenis">
                                            <option value="">== Pilih Jenis ==</option>
                                            <?php foreach ($jenis as $k) : ?>
                                                <option value="<?= $k['nama_jenis']; ?>" <?= ($obat['jenis'] == $k['nama_jenis']) ? 'selected' : old('nama_jenis'); ?>><?= $k['nama_jenis']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_jenis'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_kategori" class="col-sm-2 col-form-label">Ketegori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" name="nama_kategori">
                                            <option value="">== Pilih Ketegori ==</option>
                                            <?php foreach ($kategori as $k) : ?>
                                                <option value="<?= $k['nama_kategori']; ?>" <?= ($obat['kategori'] == $k['nama_kategori']) ? 'selected' : old('nama_kategori'); ?>><?= $k['nama_kategori']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_kategori'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control <?= ($validation->hasError('id_supplier')) ? 'is-invalid' : ''; ?>" id="id_supplier" name="id_supplier">
                                            <option value="">== Pilih Supplier ==</option>
                                            <?php foreach ($supplier as $o) : ?>
                                                <option value="<?= $o['id_supplier']; ?>" <?= ($obat['id_supplier'] == $o['id_supplier']) ? 'selected' : old('id_supplier'); ?>><?= $o['nama_supplier']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_supplier'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harga" class="col-sm-2 col-form-label">Harga (Rp)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control  <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" placeholder="Masukan harga..." value="<?= ($obat['harga']) ? $obat['harga'] : old('harga'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="keterangan" value="<?= old('keterangan'); ?>">
                                        <textarea id="summernote" name="keterangan" cols="3"><?= $obat['keterangan'] ?></textarea>
                                        <?php if ($validation->hasError('keterangan')) : ?>
                                            <p class="text-danger" style="font-size: 13px;"><?= $validation->getError('keterangan'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                        <a href="/obat" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    var tanpa_rupiah = document.getElementById('harga_jual');
    tanpa_rupiah.addEventListener('keyup', function(e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    var tanpa_rupiah_b = document.getElementById('harga_beli');
    tanpa_rupiah_b.addEventListener('keyup', function(e) {
        tanpa_rupiah_b.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?= $this->endSection(); ?>