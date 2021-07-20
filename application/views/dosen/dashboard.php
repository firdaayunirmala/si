    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <h5>Data Mahasiswa Bimbingan</h5>
        <?php $nik = $_SESSION['nik']; ?>

        <input type="hidden" id="nikDosen" value="<?php echo $nik ?>" ;>

        <body id="page-top">
            <table class="table table-bordered table-hover" id="usersData">
                <thead class="thead-dark">
                    <tr>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Judul</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var nik = $('#nikDosen').val();
            var table = $('#usersData').DataTable({
                "searchable": false,
                "orderable": false,
                "targets": 0,
                "ajax": {
                    "type": 'GET',
                    "url": '<?= base_url(); ?>' + 'API/data/dataDosenBimbingan.php?name=' + nik,
                    "mimeType": 'json',
                },
                "columns": [{
                        "data": "nim"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "judul"
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