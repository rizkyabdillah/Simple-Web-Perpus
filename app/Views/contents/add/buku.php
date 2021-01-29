<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h4>Form Tambah Petugas</h4>
    </div>
    <form method="POST" action="<?= route_to('save_buku'); ?>" class="needs-validation" novalidate="">
        <?= csrf_field(); ?>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nama_pengirim">Judul Buku</label>
                    <input type="text" class="form-control <?= ($valid->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" value="<?= old('judul'); ?>" placeholder="Judul Buku">
                    <div class="invalid-feedback">
                        <?= $valid->getError('judul'); ?>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="telp">Tahun Terbit</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control <?= ($valid->hasError('tahun')) ? 'is-invalid' : ''; ?>" name="tahun" value="<?= old('tahun'); ?>" placeholder="Tahun Terbit">
                    <div class="invalid-feedback">
                        <?= $valid->getError('tahun'); ?>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="kodep_pengirim">Penerbit</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control <?= ($valid->hasError('penerbit')) ? 'is-invalid' : ''; ?>" name="penerbit" value="<?= old('penerbit'); ?>" placeholder="Penerbit">
                    <div class="invalid-feedback">
                        <?= $valid->getError('penerbit'); ?>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="telp">Stok Buku</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control <?= ($valid->hasError('stok')) ? 'is-invalid' : ''; ?>" name="stok" value="<?= old('stok'); ?>" placeholder="Stok Buku">
                    <div class="invalid-feedback">
                        <?= $valid->getError('stok'); ?>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" id="sub" class="btn btn-primary btn-lg btn-round">
                    <i class="fas fa-save"></i> Simpan
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