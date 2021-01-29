<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h4>Form Ubah Petugas</h4>
    </div>
    <form method="POST" action="<?= route_to('ubah_petugas'); ?>" class="needs-validation" novalidate="">
        <?= csrf_field(); ?>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nama_pengirim">Nama Petugas</label>
                    <input type="text" class="form-control <?= ($valid->hasError('nama_petugas')) ? 'is-invalid' : ''; ?>" name="nama_petugas" value="<?= (old('nama_petugas')) ? old('nama_petugas') : $dataset['nama_petugas']; ?>" placeholder="Nama Petugas">
                    <input type="hidden" name="id" value="<?= $dataset['id_petugas']; ?>">
                    <div class="invalid-feedback">
                        <?= $valid->getError('nama_petugas'); ?>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="telp">Username</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= (old('username')) ? old('username') : $dataset['username']; ?>" placeholder="Username">
                    <div class="invalid-feedback">
                        <?= $valid->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <label for="kodep_pengirim">Password</label>
                    <div class="input_group"></div>
                    <input type="password" class="form-control <?= ($valid->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" value="<?= old('password'); ?>" placeholder="Password">
                    <div class="invalid-feedback">
                        <?= $valid->getError('password'); ?>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" id="sub" class="btn btn-primary btn-lg btn-round">
                    <i class="fas fa-save"></i> Ubah
                </button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>


<!-- Section CSS -->
<?= $this->section('page_css'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>