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

            <?php if ($this->session->flashdata('message')) : ?>
                <div class="flashdatapimpinan" data-flashdatapimpinan="<?= $this->session->flashdata('message'); ?>"></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <a href="<?= base_url('operation/tambahpimpinan'); ?>" class="btn btn-success mb-3">Tambah Pimpinan</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIDN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Status Aktif</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        <?php foreach ($pimpinan as $pimp) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $pimp['nidn']; ?></td>
                                <td><?= $pimp['name']; ?></td>
                                <td><?= $pimp['email']; ?></td>
                                <td><?= $pimp['hp']; ?></td>
                                <td class="text-center">
                      <?php $aktif = $pimp['is_active'];
                      if ($aktif == 1) { ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php } else { ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php } ?>
                    </td>
                                <td>
                                    <div class="dropdown ">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            opsi
                                        </button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                            <a class="btn btn-success btn-sm" href="<?= base_url() ?>operation/detailpimpinan/<?= $pimp['pimp_id']; ?>">detail</a>
                                            <a class="btn btn-warning btn-sm" href="<?= base_url() ?>operation/editpimpinan/<?= $pimp['pimp_id']; ?>" class="badge badge-warning">edit</a>
                                            <a class=" btn btn-danger btn-sm tombol-hapuspimpinan" href="<?= base_url() ?>operation/hapuspimpinan/<?= $pimp['pimp_id']; ?>">hapus</a>
                                        </div>
                                    </div>
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

</div>
<!-- End of Main Content -->