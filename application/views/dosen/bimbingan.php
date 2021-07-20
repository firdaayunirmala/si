<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php $nik = $_SESSION['nik'];?>

    <input type="hidden" id="nikDosen" value="<?php echo $nik ?>" ;>

    <div class="row">
        <div class="col-lg">
        
            <a href="<?= base_url('dosen/kirimfile') ?>" class="btn btn-success mb-3">Kirim Bimbingan</a>
            <a href="<?= base_url('dosen/pesan') ?>" class="btn btn-success mb-3">Kirim Pesan</a>
            <div class="table-responsive">
                <h3>Riwayat Bimbingan Tugas Akhir</h3>
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Catatan Bimbingan</th>
                            <th scope="col">Opsi</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        <?php foreach ($bimbingan_dsn as $bim) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $bim['tanggal']; ?></td>
                                <td><?= $bim['nim']; ?></td>
                                <td><?= $bim['name']; ?></td>
                                <td><?= $bim['catatan']; ?></td>

            </div>
            </td>
            <td> <a class=" btn btn-warning btn-sm " href="<?= base_url() ?>dosen/detailbimbingan/<?= $bim['id']; ?>">Detail</a>
            </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

        </tbody>
        </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->