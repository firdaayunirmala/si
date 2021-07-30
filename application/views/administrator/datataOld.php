<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <a href="<?= base_url('administrator/tambahdatata'); ?>" class="btn btn-success mb-3">Tambah pembagian dosbing</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tbl_TA">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Pembimbing 1</th>
                            <th scope="col">Pembimbing 2</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tbl_TA').DataTable({
            "searchable": false,
            "orderable": false,
            "targets": 0,
            "ajax": {
                "type": 'GET',
                "url": '<?= base_url(); ?>' + 'API/data/dataSkripsi.php',
                "mimeType": 'json',
            },
            "columns": [{
                    "data": null,
                    "width": "4%",
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "nim"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "judul"
                },
                {
                    "data": "kode_jurusan"
                },
                {
                    "data": "pembimbing1"
                },
                {
                    "data": "pembimbing2"
                },
                {
                    "data": "act"
                },
            ],
            "columnDefs": [{
                    "targets": 0,
                    "className": "text-left",
                },
                {
                    "targets": 1,
                    "className": "text-left",
                },
                {
                    "targets": 2,
                    "className": "text-center",
                },
            ]
        });
    });
</script>