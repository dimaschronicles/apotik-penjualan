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
                        <li class="breadcrumb-item active">Detail Data Obat</li>
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
                <div class="col-lg-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            Detail Data Obat
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Nama Obat :</b>
                                    <span><?= $obat['nama_obat']; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Jenis :</b>
                                    <span><?= $obat['jenis']; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Kategori :</b>
                                    <span><?= $obat['kategori']; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Stok :</b>
                                    <span><?= ($obat['stok'] == null) ? 0 : $obat['stok']; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Supplier :</b>
                                    <span><?= $obat['nama_supplier']; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Keterangan :</b>
                                    <span><?= $obat['keterangan']; ?></span>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-secondary mt-3" onclick="window.close()">Kembali</a>
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