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
                        <li class="breadcrumb-item"><a href="/obatmasuk">Data Obat Masuk</a></li>
                        <li class="breadcrumb-item active">Tambah Obat Masuk</li>
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
                            <form action="/obatmasuk" method="POST">
                                <?= csrf_field(); ?>
                                <div class="form-group row">
                                    <label for="id_obat" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <select class="form-control <?= ($validation->hasError('id_obat')) ? 'is-invalid' : ''; ?>" id="id_obat" name="id_obat">
                                            <option value="">== Pilih Obat ==</option>
                                            <?php foreach ($obat as $o) : ?>
                                                <option value="<?= $o['id_obat']; ?>" <?= (old('id_obat') == $o['id_obat']) ? 'selected' : ''; ?>><?= $o['no_batch']; ?> - <?= $o['nama_obat']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_obat'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control  <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" placeholder="Masukan jumlah..." value="<?= old('jumlah'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jumlah'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control  <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_masuk'); ?>
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
                                        <a href="/obatmasuk" class="btn btn-secondary">Kembali</a>
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
<?= $this->endSection(); ?>