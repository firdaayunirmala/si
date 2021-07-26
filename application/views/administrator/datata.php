<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?= $this->session->flashdata('message'); ?>

  <div class="row">
    <div class="col-lg">
      <div class="card shadow">
        <div class="card-body">
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php endif; ?>

          <a href="<?= base_url('administrator/tambahdatata'); ?>" class="btn btn-success mb-3">Tambah pembagian dosbing</a>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nim</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Sinopsis</th>
                  <th scope="col">Jurusan</th>
                  <th scope="col">Pembimbing 1</th>
                  <th scope="col">Pembimbing 2</th>
                  <th scope="col">Status</th>
                  <th scope="col">Opsi</th>
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
                        <a class="btn btn-warning btn-sm" href="<?= base_url('administrator/editdatata/') . $d['id']; ?>">edit</a>
                        <a class="btn btn-danger btn-sm hapusskripsi" href="javascript:void();" onclick="confirm('Apakah Anda yakin ingin menghapus data ini?') ? window.location = '<?= base_url('administrator/hapusdatata/') . $d['id']; ?>' : null">hapus</a>
                      </div>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
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