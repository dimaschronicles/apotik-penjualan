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
                        <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="message my-1">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="/updatepassword" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                                <div class="form-group">
                                    <label for="current_password">Password Saat Ini</label>
                                    <input type="password" class="form-control <?= ($validation->hasError('current_password')) ? 'is-invalid' : ''; ?>" name="current_password" id="current_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('current_password'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control <?= ($validation->hasError('new_password')) ? 'is-invalid' : ''; ?>" name="new_password" id="new_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('new_password'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password_conf">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control <?= ($validation->hasError('new_password_conf')) ? 'is-invalid' : ''; ?>" name="new_password_conf" id="new_password_conf">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('new_password_conf'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="show_pass" id="show_pass" onclick="showPass()">
                                    <label class="form-check-label" for="show_pass">Tampilkan Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                <a href="/profile" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    function showPass() {
        let pass = document.getElementById('current_password')
        let new_pass = document.getElementById('new_password')
        let new_pass_conf = document.getElementById('new_password_conf')

        if (pass.type && new_pass.type && new_pass_conf.type === "password") {
            pass.type = "text"
            new_pass.type = "text"
            new_pass_conf.type = "text"
        } else {
            pass.type = "password"
            new_pass.type = "password"
            new_pass_conf.type = "password"
        }
    }
</script>
<?= $this->endSection(); ?>