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

            <a href="<?= base_url('mahasiswa/pesan') ?>" class="btn btn-success mb-3">Kirim Pesan</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Bimbingan</th>
                            <th scope="col">Catatan Bimbingan</th>
                            <th scope="col">Pengesahan Pembimbing</th>
                            <th scope="col">Layak Ujian Proposal</th>
                            <th scope="col">Batasan Waktu</th>
                            <th scope="col">Kirim Oleh</th>

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
                                    Firda Ayu Nirmala     
                               
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
</div>
<!-- /.container-fluid -->

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kirim Riwayat Bimbingan</h1>
    <div class="form-group row">
                <label for="konsultasi" class="col-sm-3 col-form-label">Catatan Bimbingan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="konsultasi" name="konsultasi" placeholder="Masukan konsultasi Bimbingan Skripsi" value="<?= set_value('konsultasi'); ?>"></textarea>
                    <?= form_error('konsultasi', ' <small class="text-danger pl-3">', '</small>'); ?>
                    <small class="text-danger"> Harap data yang di isi dengan benar ! </small>
                </div>
            </div>
    <div>
    <a href="<?= base_url('mahasiswa/bimbingan'); ?>" class="btn btn-success">Upload</a>
    </div>
           
</div>