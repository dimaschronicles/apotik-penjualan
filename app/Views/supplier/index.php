<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Data <?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Supplier</li>
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

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSupplier"><i class="fas fa-plus mr-1"></i> Tambah Data Supplier</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Supplier</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($supplier as $s) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $s['nama_supplier'] ?></td>
                                            <td><?= $s['telp_supplier'] ?></td>
                                            <td><?= $s['alamat_supplier'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusSupplier<?= $s['id_supplier']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $s['id_supplier']; ?>">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusSupplier<?= $s['id_supplier']; ?>" tabindex="-1" aria-labelledby="hapusSupplierLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusSupplierLabel">Peringatan!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah data ini akan dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/supplier/<?= $s['id_supplier']; ?>" method="post" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger">Ya</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $s['id_supplier']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Supplier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_supplier">Nama Supplier</label>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><?= $s['nama_supplier']; ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telp_supplier">No HP</label>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><?= $s['telp_supplier']; ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telp_supplier">Telp. Supplier</label>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><?= $s['telp_supplier']; ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat_supplier">Alamat</label>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><?= $s['alamat_supplier']; ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan_supplier">Keterangan</label>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><?= $s['keterangan_supplier']; ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Supplier</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Modal Tambah Data -->
                            <div class="modal fade" id="tambahSupplier" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahSupplierLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahSupplierLabel">Tambah Data Supplier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/supplier" method="POST">
                                                <?= csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="nama_supplier">Nama</label>
                                                    <input type="text" class="form-control <?= ($validation->hasError('nama_supplier')) ? 'is-invalid' : ''; ?>" id="nama_supplier" name="nama_supplier" placeholder="Masukan nama supplier..." value="<?= old('nama_supplier'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('nama_supplier'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telp_supplier">Nomor HP</label>
                                                    <input type="number" class="form-control <?= ($validation->hasError('telp_supplier')) ? 'is-invalid' : ''; ?>" id="telp_supplier" name="telp_supplier" placeholder="Masukan nomor hp..." value="<?= old('telp_supplier'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('telp_supplier'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat_supplier">Alamat</label>
                                                    <textarea class="form-control <?= ($validation->hasError('alamat_supplier')) ? 'is-invalid' : ''; ?>" id="alamat_supplier" name="alamat_supplier" rows="3"><?= old('alamat_supplier'); ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('alamat_supplier'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan_supplier">Keterangan</label>
                                                    <textarea class="form-control <?= ($validation->hasError('keterangan_supplier')) ? 'is-invalid' : ''; ?>" id="keterangan_supplier" name="keterangan_supplier" rows="3"><?= old('keterangan_supplier'); ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('keterangan_supplier'); ?>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>