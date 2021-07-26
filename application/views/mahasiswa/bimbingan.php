<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php $id = $_SESSION['id'];
            ?>

            <input type="hidden" id="nimCall" value="<?php echo $id ?>" ;>
            <a href="<?= base_url('mahasiswa/kirimfile') ?>" class="btn btn-success mb-3">Kirim Bimbingan</a>
            <a href="<?= base_url('mahasiswa/pesan') ?>" class="btn btn-success mb-3">Kirim Pesan</a>
            <div class="table-responsive">
                <h3>Riwayat Bimbingan Tugas Akhir</h3>
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Catatan Bimbingan</th>
                            <th scope="col">Status Dospem 1</th>
                            <th scope="col">Status Dospem 2</th>
                            <th scope="col">Batasan Waktu</th>
                            <th scope="col">Opsi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bimbingan_mhs as $b) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $b['tanggal']; ?></td>
                                <td><?= $b['catatan_mhs']; ?></td>
                                <td>
                                    <?php $aktif = $b['status_dosbing']; ?>
                                    <?php if ($aktif == 1) : ?>
                                    <a class="badge badge-succes "> Di Terima</a>
                                    <?php else : ?>
                                    <a class="badge badge-warning "> Di Tunggu</a>
                                    <?php endif; ?>
                                    </td>
                                <td>
                                    <?php $aktif = $b['status_dosbing']; ?>
                                    <?php if ($aktif == 1) : ?>
                                    <a class="badge badge-succes "> Di Terima</a>
                                    <?php else : ?>
                                    <a class="badge badge-warning "> Di Tunggu</a>
                                     <?php endif; ?>
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                <a class=" btn btn-success btn-sm" href="<?= base_url() ?>mahasiswa/detail/<?= $b['id']; ?>">detail</a>
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