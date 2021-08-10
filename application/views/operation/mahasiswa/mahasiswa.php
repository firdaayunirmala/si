<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg">
      <div class="card shadow">
        <div class="card-body">
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('message')) : ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>

          <a href="<?= base_url('operation/tambahmahasiswa'); ?>" class="btn btn-success mb-3">Tambah Mahasiswa</a>

          <div class="table-responsive">
            <table class="table table-sm table-striped table-hover table-bordered" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center" width="5%">No</th>
                  <th class="text-center" width="10%">NIM</th>
                  <th class="text-center" width="25%">Nama</th>
                  <th class="text-center" width="20%">Jurusan</th>
                  <th class="text-center" width="15%">Email</th>
                  <th class="text-center" width="20%">Foto</th>
                  <th class="text-center" width="20%">Hp</th>
                  <th class="text-center" width="10%">Status</th>
                  <th class="text-center" width="15%">Aksi</th>
                </tr>
              </thead>

              <?php
              $query = "SELECT
                      m.mhs_id ,
                      m.nim ,
                      m.name ,
                      m.semester ,
                      m.totalsks ,
                      j.jurusan_nama ,
                      m.email ,
                      m.image,
                      m.hp ,
                      m.is_active 
                    FROM
                      mahasiswa m
                    Left JOIN jurusan j ON
                      m.jurusan_id = j.jurusan_id
                    ORDER BY
                      m.mhs_id ASC
                    ";
              $datamhs = $this->db->query($query)->result_array();
              ?>

              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($datamhs as $mhs) : ?>
                  <tr>
                    <th scope="row" class="text-center"><?= $i; ?></th>
                    <td class="text-center"><?= $mhs['nim']; ?></td>
                    <td><?= $mhs['name']; ?></td>
                    <td><?= $mhs['jurusan_nama']; ?></td>
                    <td><?= $mhs['email']; ?></td>
                    <td><?= $mhs['image']; ?></td>
                    <td><?= $mhs['hp']; ?></td>
                    <td class="text-center">
                      <?php $aktif = $mhs['is_active'];
                      if ($aktif == 1) { ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php } else { ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a class=" btn btn-success btn-sm" href="<?= base_url() ?>operation/detailmahasiswa/<?= $mhs['mhs_id']; ?>" title="detail"><i class="fa fa-eye"></i></a>
                      <a class="btn btn-warning btn-sm" href="<?= base_url() ?>operation/editmahasiswa/<?= $mhs['mhs_id']; ?>" title="edit"><i class="fa fa-pencil-alt"></i></a>
                      <a class=" btn btn-danger btn-sm" onclick="confirm('Apakah Anda yakin ingin menghapus data ini?') ? window.location = '<?= base_url() ?>operation/hapusmahasiswa/<?= $mhs['mhs_id']; ?>' : return" href="javascript:void(0);" title="hapus"><i class="fa fa-trash"></i></a>
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

<!-- script for this page -->
<script>

</script>
<!-- /script for this page -->

</div>
<!-- End of Main Content -->