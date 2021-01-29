<?= $this->extend('layouts/master'); ?>

<?= $this->section('header_button'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="col-12 col-md-12 col-lg-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Master Data</h4>
            <div class="card-header-action float-right">
                <a href="<?= route_to('add_buku'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15%">
                                ID Buku
                            </th>
                            <th class="text-center" style="width: 20%">Aksi</th>
                            <th>Judul Buku</th>
                            <th>Tahun Terbit</th>
                            <th>Penerbit</th>
                            <th>Stok Buku</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataset as $i) :
                            $arr = array_values($i);
                        ?>
                            <tr>
                                <td class="text-center"><?= $arr[0]; ?></td>
                                <td class="text-center">
                                    <a href="<?= route_to('edit_buku', $arr[0]); ?>" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Ubah">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a data-id="<?= $arr[0]; ?>" class="btn btn-danger btn-action ml-1 swal_confirm" data-toggle="tooltip" data-original-title="Hapus">
                                        <form action="<?= route_to('del_buku', $arr[0]); ?>" method="POST" id="hapus<?= $arr[0]; ?>" class="">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE" />
                                        </form>
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <?php for ($j = 1; $j < count($arr); $j++) : ?>
                                    <td><?= $arr[$j]; ?></td>
                                <?php endfor ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url(); ?>/assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/sweetalert/sweetalert.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>
<script src="<?= base_url(); ?>/assets/js/page/modules-datatables.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>
<script>
    $(document).on("click", ".swal_confirm", function(e) {
        var id = $(this).data('id');
        swal({
                title: 'Apakah kamu yakin?',
                text: 'Disaat kamu menghapus, data yang terhapus tidak dapat dikembalikan lagi!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#hapus'.concat(id)).submit();
                }
            });
    });

    <?php if (session()->getFlashData('pesan')) : ?>
        swal('Sukses', '<?= session()->getFlashData('pesan'); ?>', 'success', {
            buttons: false,
            timer: 1200,
        });
    <?php endif ?>
</script>
<?= $this->endSection(); ?>