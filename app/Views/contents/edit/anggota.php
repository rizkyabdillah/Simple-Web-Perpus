<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h4>Form Ubah Anggota</h4>
    </div>
    <form method="POST" action="<?= route_to('ubah_anggota'); ?>" class="needs-validation" novalidate="">
        <?= csrf_field(); ?>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="telp">Nama Anggota</label>
                    <div class="input_group"></div>
                    <input type="hidden" name="id" value="<?= $dataset['id_anggota']; ?>">
                    <input type="text" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" value="<?= (old('nama')) ? old('nama') : $dataset['nama']; ?>" placeholder="Nama Anggota">
                    <div class="invalid-feedback">
                        <?= $valid->getError('nama'); ?>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <label for="kodep_pengirim">Alamat</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control <?= ($valid->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $dataset['alamat']; ?>" placeholder="Alamat">
                    <div class="invalid-feedback">
                        <?= $valid->getError('alamat'); ?>
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