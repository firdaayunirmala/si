    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <h5>Data Mahasiswa Bimbingan</h5>
        <?php $nik = $_SESSION['nik']; ?>

        <input type="hidden" id="nikDosen" value="<?php echo $nik ?>" ;>

        <body id="page-top">
            <table class="table table-bordered table-hover" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Judul</td>
                        <td>Sinopsis</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($datata as $d) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $d['nim']; ?></td>
                            <td><?= $d['name']; ?></td>
                            <td><?= $d['judul']; ?></td>
                            <td><?= $d['sinopsis']; ?></td>
                            <td><?= $d['nama_jurusan']; ?></td>
                            <td><?= $d['pembimbing1']; ?></td>
                            <td><?= $d['pembimbing2']; ?></td>
                            <td>
                                <?php $aktif = $d['status']; ?>
                                <?php if ($aktif == 1) : ?>
                                    <a class="badge badge-succes "> Di Terima</a>
                                <?php else : ?>
                                    <a class="badge badge-warning "> Di Tunggu</a>
                                <?php endif; ?>
                            </td>
                            <td>
                            <div class="button ">
                            <a class="btn btn-warning btn-sm" href="<?= base_url('dosen/detaildata/') . $d['id']; ?>">detail</a>
                            </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
    <!-- 
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
    </script> -->