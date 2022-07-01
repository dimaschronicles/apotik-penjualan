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
                        <li class="breadcrumb-item active">Tambah Data Obat</li>
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
                            Form Tambah Data Obat
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/obat" method="POST">
                                <?= csrf_field(); ?>
                                <!-- <div class="form-group row">
                                    <label for="no_batch" class="col-sm-2 col-form-label">No. Batch</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control  <?= ($validation->hasError('no_batch')) ? 'is-invalid' : ''; ?>" id="no_batch" name="no_batch" placeholder="Masukan no batch..." value="<?= old('no_batch'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('no_batch'); ?>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="nama_obat" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control  <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat" placeholder="Masukan nama obat..." value="<?= old('nama_obat'); ?>">
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
                                                <option value="<?= $k['nama_jenis']; ?>" <?= (old('nama_jenis') == $k['nama_jenis']) ? 'selected' : ''; ?>><?= $k['nama_jenis']; ?></option>
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
                                                <option value="<?= $k['nama_kategori']; ?>" <?= (old('nama_kategori') == $k['nama_kategori']) ? 'selected' : ''; ?>><?= $k['nama_kategori']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_kategori'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_satuan" class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control  <?= ($validation->hasError('nama_satuan')) ? 'is-invalid' : ''; ?>" id="nama_satuan" name="nama_satuan">
                                            <option value="">== Pilih Satuan ==</option>
                                            <?php foreach ($satuan as $s) : ?>
                                                <option value="<?= $s['nama_satuan']; ?>" <?= (old('nama_satuan') == $s['nama_satuan']) ? 'selected' : ''; ?>><?= $s['nama_satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_satuan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control <?= ($validation->hasError('id_supplier')) ? 'is-invalid' : ''; ?>" id="id_supplier" name="id_supplier">
                                            <option value="">== Pilih Supplier ==</option>
                                            <?php foreach ($supplier as $o) : ?>
                                                <option value="<?= $o['id_supplier']; ?>" <?= (old('id_supplier') == $o['id_supplier']) ? 'selected' : ''; ?>><?= $o['nama_supplier']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_supplier'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="keterangan" value="<?= old('keterangan'); ?>">
                                        <textarea id="summernote" name="keterangan" cols="3"><?= old('keterangan'); ?></textarea>
                                        <?php if ($validation->hasError('keterangan')) : ?>
                                            <p class="text-danger" style="font-size: 13px;"><?= $validation->getError('keterangan'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
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