<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


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

            <div class="flashdataadmin" data-flashdataadmin="<?= $this->session->flashdata('message'); ?>"></div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>

          <button class="btn btn-success mb-3" onclick="$('#tambahAdminModal').modal('show')">Tambah admin</button>
          <div class="table-responsive">

            <table class="table table-bordered table-hover" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="text-center">No</th>
                  <th scope="col" class="text-center">Nama</th>
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">HP</th>
                  <th scope="col" class="text-center">Aktif</th>
                  <th scope="col" class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>

                <?php $i = 1; ?>
                <?php foreach ($admin as $adm) : ?>

                  <tr>
                    <th scope="row" class="text-center"><?= $i; ?></th>
                    <td><?= $adm['name']; ?></td>
                    <td><?= $adm['email']; ?></td>
                    <td><?= $adm['hp']; ?></td>
                    <td class="text-center">
                      <?php $aktif = $adm['is_active'];
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
                          <div class="row">
                            <div class="col-md-6">
                              <a class=" btn btn-success btn-sm" href="<?= base_url('admin/detailadmin/') . $adm['id']; ?>">detail</a>
                            </div>
                            <?php if ($adm['role_id'] != 2) : ?>
                              <div class="col-md-6">
                                <a class=" btn btn-danger btn-sm hapusadmin" href="<?= base_url('admin/hapusadmin') . '?data=' . $adm['id'] . rawurlencode("|") . $adm['role_id']; ?>">hapus</a>
                              </div>
                            <?php endif ?>
                          </div>
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
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Hapus Modal-->
<div class="modal fade" id="tambahAdminModal" tabindex="-1" role="dialog" aria-labelledby="tambahAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAdminModalLabel">Form Tambah Admin</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" action="" method="post">
          <input type="hidden" name="tambah" value="tambah">
          <div class="form-group row">
            <label class="control-label col-md-3">Pilih User</label>
            <div class="col-md-9">
              <select name="user_id" id="user_id" class="form-control">
                <?php foreach ($dosen as $v) : ?>
                  <option value="<?= $v['id'] . "|" . $v['role_id'] ?>"><?= $v['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Tambah</button>
        <button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>