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
            <?= $this->session->flashdata('message'); ?>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>

          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Data Menu</a>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Title</th>
                  <th class="text-center" scope="col">Menu</th>
                  <th class="text-center" scope="col">Url</th>
                  <th class="text-center" scope="col">Icon</th>
                  <th class="text-center" scope="col">Active</th>
                  <th class="text-center" scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($subMenu as $sm) : ?>
                  <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?= $sm['title']; ?></td>
                    <td><?= $sm['menu']; ?></td>
                    <td><?= $sm['url']; ?></td>
                    <td><?= $sm['icon']; ?></td>
                    <td class="text-center">
                      <?php $aktif = $sm['is_active'];
                      if ($aktif == 1) { ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php } else { ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" onclick="set_val('<?= $sm['id'] . '|' . $sm['title'] . '|' . $sm['menu_id'] . '|' . $sm['url'] . '|' . $sm['icon'] . '|' . $sm['is_active'];  ?>')" class="btn btn-success btn-sm" title="edit"><i class="fa fa-pencil-alt"></i></a>

                      <a href="" data-toggle="modal" title="hapus" data-target="#hapusSubMenuModal<?= $sm['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                      <div class="modal fade" id="hapusSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusSubMenuModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="hapusSubMenuModalLabel">Hapus SubMenu</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?= base_url('menu/hapussubmenu'); ?>" method="post">
                              <input type="hidden" name="id" value="<?= $sm['id'] ?>">
                              <div class="modal-body">Apakah ingin menghapus sub menu <?= $sm['title'] ?>?</div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <button class="btn btn-primary">Hapus</button>
                              </div>
                            </form>
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

<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Form Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
        <input type="hidden" id="id" name="id">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
          </div>
          <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
              <option value="">Select Menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
          </div>
          <div class="form-group row">
            <div class="form-check form-check-inline pl-3">
              <input type="checkbox" name="is_active" id="is_active" value="1" checked />
              <label class="form-check-label" for="aktif">&nbsp;Aktif ?</label>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function set_val(data) {
    $("#newSubMenuModal").find('form').attr('action', '<?= base_url('menu/editsubmenu'); ?>')
    const isi = data.split('|')
    $("#id").val(isi[0])
    $("#title").val(isi[1])
    $("#menu_id").val(isi[2])
    $("#url").val(isi[3])
    $("#icon").val(isi[4])
    $("#is_active").prop('checked', (isi[5] == 1) ? true : false)
    $("#newSubMenuModal").modal('show')
  }


  function resetForm() {
    $("#newSubMenuModal").find('form').attr('action', '<?= base_url('menu/submenu'); ?>')
    $("#newSubMenuModal").find('form')[0].reset()
    $("#id").val('')
  }
</script>