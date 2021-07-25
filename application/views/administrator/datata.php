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

          <<<<<<< HEAD <a href="<?= base_url('administrator/tambahdatata'); ?>" class="btn btn-success mb-3">Tambah pembagian dosbing</a>
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Pembimbing 1</th>
                    <th scope="col">Pembimbing 2</th>
                    <th scope="col">Status</th>
                    <t scope="col">Opsi</t /h>
                  </tr>
                </thead>
                <?php
                // $query = "SELECT * 
                // FROM datata INNER JOIN jurusan
                // ON datata.kode_jurusan = jurusan.id  
                // ORDER BY datata.id ASC
                // ";
                // $datata = $this->db->query($query)->result_array();
                // // echo '<pre>';
                // // print_r($datata);
                // // echo '</pre>';
                // // die;
                ?>
                <?php
                $query = "SELECT * 
                    FROM datata INNER JOIN mahasiswa INNER JOIN jurusan INNER JOIN datata_detail
                    ON datata.id_user = mahasiswa.id = jurusan.id = datata_detail.pembimbing_ke
                    ORDER BY datata.id ASC
                    ";
                $datata = $this->db->query($query)->result_array();
                // echo '<pre>';
                // print_r($datata);
                // echo '</pre>';
                // die;
                ?>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($datata as $d) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $d['nim']; ?></td>
                      <td><?= $d['name']; ?></td>
                      <td><?= $d['judul']; ?></td>
                      <td><?= $d['nama_jurusan']; ?></td>
                      <td><?= $d['id_dosen']; ?></td>
                      <td><?= $d['id_dosen']; ?></td>
                      <td></td>
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