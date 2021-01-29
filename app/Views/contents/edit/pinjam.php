<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h4>Form Ubah Peminjaman</h4>
    </div>
    <form method="POST" action="<?= route_to('ubah_pinjam'); ?>" class="needs-validation" novalidate="">
        <?= csrf_field(); ?>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-5">
                    <input type="hidden" name="id" value="<?= $dataset['id_pinjam']; ?>">
                    <label for="telp">Pilih Anggota</label>
                    <div class="input_group"></div>
                    <?php
                    $data = array();
                    foreach ($dataanggota as $i) {
                        $data[$i['id_anggota']] = $i['nama'];
                    }
                    echo form_dropdown('anggota', $data, (old('anggota')) ? old('anggota') : $dataset['id_anggota'], 'class="form-control selectric "');
                    ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="kodep_pengirim">Pilih Buku</label>
                    <div class="input_group"></div>
                    <?php
                    $data = array();
                    foreach ($databuku as $i) {
                        $data[$i['id_buku']] = $i['judul_buku'];
                    }
                    echo form_dropdown('buku', $data, (old('buku')) ? old('buku') : $dataset['id_buku'], 'class="form-control selectric "');
                    ?>
                </div>
                <div class="form-group col-md-3">
                    <label for="kodep_pengirim">Tanggal Pinjam</label>
                    <div class="input_group"></div>
                    <input type="text" class="form-control datepicker" name="tanggal" value="<?= (old('tanggal')) ? old('tanggal') : $dataset['tanggal']; ?>">
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
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jquery-selectric/selectric.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url() ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url() ?>/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>