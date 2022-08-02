<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/css/mystyle.css">
</head>

<body>
    <div class="header">
        <p>
            <span style="font-size: 18px;"><b>APOTEK ALFIA FARMA</b></span><br>
            <span style="font-size: 11px;"><i>Jl. Bumiayu - Bantarkawung Raya, Buaran, Pangebatan, Kec. Bantarkawung, Kabupaten Brebes, Jawa Tengah 52274</i></span>
        </p>
        <hr style="line-height: 2;">
    </div>

    <div class="content">
        <div class="header">
            <h3>Laporan Transaksi</h3>
        </div>
        <div class="tanggal">
            <p style="font-size: 12px;">
                Nama Karyawan : <?= session('nama'); ?><br>
                Mulai Tanggal : <?= @$_GET['dari_tanggal']; ?><br>
                Sampai Tanggal : <?= @$_GET['sampai_tanggal']; ?>
            </p>
        </div>
        <div class="data-obat">
            <table style="width: 100%; text-align: center;">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
                <?php $i = 1;
                foreach ($obat as $o) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $o['nama_obat']; ?></td>
                        <td>Rp <?= number_format($o['harga'], 2, ',', '.') ?></td>
                        <td><?= $o['jumlah_keluar']; ?></td>
                        <td>Rp <?= number_format($o['sub_total'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="ttd">

        </div>
    </div>

    <script type="text/javascript">
        window.print();
        window.onafterprint = window.close;
    </script>
</body>

</html>