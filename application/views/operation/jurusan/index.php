<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg">
      <?php if ($this->session->flashdata('message')) : ?>

        <div class="juru" data-juru="<?= $this->session->flashdata('message'); ?>"></div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <div class="card shadow">
        <div class="card-body">

          <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Jurusan</a>

          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Nama Jurusan</th>
                  <th class="text-center" scope="col">Jumlah Mahasiswa</th>
                  <th class="text-center" scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>

                <?php $i = 1; ?>

                <?php foreach ($jur_mhs as $j) : ?>
                  <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?= $j['jurusan_nama']; ?></td>
                    <td class="text-center">
                      <?= $j['total']; ?>
                    </td>
                    <td class="text-center">
                      <a class=" btn btn-warning btn-sm " href="<?= base_url() ?>operation/detailjurusan/<?= $j['jurusan_id']; ?>">Detail</a>

                      <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editJurModal<?= $j['jurusan_id']; ?>">Edit</a>
                      <div class="modal fade" id="editJurModal<?= $j['jurusan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editJurModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editMenuModal">Edit Jurusan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <form action="<?= base_url('operation/editjurusan'); ?>" method="post">
                              <input type="hidden" name="id" value="<?= $j['jurusan_id'] ?>">

                              <div class="modal-body">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="jurusanedit" name="jurusanedit" value="<?= $j['jurusan_nama']; ?>" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">ubah</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <a href="<?= base_url() ?>operation/hapusjurusan/<?= $j['jurusan_id']; ?>" class="btn btn-danger btn-sm tombol-hapusjur">Hapus</a>
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Form Tambah Jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('operation'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Nama Jurusan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" nama="tambah" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>