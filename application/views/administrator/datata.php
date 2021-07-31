<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?php if ($this->session->flashdata('message')) : ?>
    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>


  <div class="row" id="formData" style="display: none;">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            Form Tambah Tugas Akhir</h6>
          <div class="float-rgiht">
            <button class="btn btn-sm btn-danger" type="button" onclick="$('#cancelData').click()"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

          <?= form_open_multipart(); ?>
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="aksi" id="aksi" value="tambah">
          <div class="form-group row" style="margin-top: 20px;">
            <label class="col-sm-3 col-form-label" for="tanggal">Tanggal </label>
            <div class="col-sm-6">
              <div class="input-group">
                <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="date" class="form-control" placeholder="Periode Tanggal">
              </div>
              <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" value="" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-6">
              <select name="id_user" id="id_user" class="form-control">
                <?php foreach ($mahasiswa as $k => $v) : ?>
                  <option value="<?= $v->id ?>" data-nim="<?= $v->nim ?>"><?= $v->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-6">
              <textarea class="form-control" id="judul" name="judul" placeholder="Masukan Judul Skripsi" value="<?= set_value('judul'); ?>"></textarea>
              <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-6">
              <div class="custom-file">
                <input type="file" id="sinopsis" name="sinopsis" class="custom-file-input" required>
                <?= form_error('filename', ' <small class="text-danger pl-3">', '</small>'); ?>
                <label class="custom-file-label" for="customFile">Choose File</label>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-6">
              <select name="jurusan" id="jurusan" class="form-control">
                <option value="0" selected>Pilih Jurusan</option>
                <?php foreach ($jurusan as $j) : ?>
                  <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="dosen" class="col-sm-3 col-form-label">Pembimbing 1</label>
            <div class="col-sm-6">
              <select name="pembimbing1" id="pembimbing1" class="form-control">
                <option value="0">Pilih Dosen Pembimbing 1</option>
                <?php foreach ($dosen as $pembimbing1) : ?>
                  <option value="<?= $pembimbing1['id'] ?>"><?= $pembimbing1['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="dosen" class="col-sm-3 col-form-label">Pembimbing 2</label>
            <div class="col-sm-6">
              <select name="pembimbing2" id="pembimbing2" class="form-control">
                <option value="0">Pilih Dosen Pembimbing 2</option>
                <?php foreach ($dosen as $pembimbing2) : ?>
                  <option value="<?= $pembimbing2['id'] ?>"><?= $pembimbing2['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row justify-content-end">
            <div class="col-sm-9">
              <small class="text-danger"> Harap semua data yang di isi dengan benar ! </small>
              <br>
              <button type="button" class="btn btn-primary" id="saveData">Tambah</button>
              <button type="button" id="cancelData" class="btn btn-danger">Kembali</button>
            </div>
          </div>

          </form>
        </div>

      </div>

    </div>
  </div>

  <div class="row" id="listData">
    <div class="col-lg">
      <div class="card shadow">
        <div class="card-body">
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?> </div>
          <?php endif; ?>

          <button type="button" class="btn btn-success mb-3" id="tambahData">Tambah data tugas akhir</button>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
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
                    <td><?= $d['tanggal']; ?></td>
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
                        <span class="badge badge-succes "> Setuju</span>
                      <?php elseif ($aktif == 0) : ?>
                        <span class="badge badge-warning "> Proses</span>
                      <?php else : ?>
                        <span class="badge badge-danger "> Tolak</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="dropdown ">
                        <button class="btn btn-primary btn-sm dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          opsi
                        </button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                          <a class="btn btn-warning btn-sm" href="<?= base_url('administrator/editdatata/') . $d['id']; ?>">edit</a>
                          <a class="btn btn-success btn-sm" href="<?= base_url('administrator/detaildata/') . $d['id']; ?>">detail</a>
                          <a class="btn btn-danger btn-sm hapusskripsi" href="javascript:void();" onclick="confirm('Apakah Anda yakin ingin menghapus data ini?') ? window.location = '<?= base_url('administrator/hapusdatata/') . $d['id']; ?>' : null">hapus</a>
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

<script>
  $("#tambahData").on('click', function() {
    resetForm()
    $("#id_user").trigger('change')
    $("#formData").slideDown(500)
    $("#listData").slideUp(500)
    $("#id_user").select2({
      width: 'element'
    })
  })

  $("#cancelData").on('click', function() {
    resetForm()
    $("#listData").slideDown(500)
    $("#formData").slideUp(500)
  })


  $("#id_user").select2()

  $("#id_user").change(function() {
    $('#nim').val($("#id_user").select2().find(":selected").data("nim"))
  })

  function resetForm() {

  }


  $(document).ready(function() {
    $("#saveData").click(function() {
      let error = 0;
      let pesanError = "";
      const elementError = []


      if ($("#judul").val() == "") {
        pesanError += "Judul tidak boleh kosong<br>"
        error++;
        elementError.push('#judul')
      }


      if ($("#pembimbing1").val() == "0") {
        pesanError += "Pilih Dosen Pembimbing 1 Dahulu<br>"
        error++;
        elementError.push('#pembimbing1')
      }


      if ($("#pembimbing2").val() == "0") {
        pesanError += "Pilih Dosen Pembimbing 2 Dahulu<br>"
        error++;
        elementError.push('#pembimbing2')
      }


      if ($("#jurusan").val() == "0") {
        pesanError += "Pilih Jurusan Dahulu<br>"
        error++;
        elementError.push('#jurusan')
      }


      if (error > 0) {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          html: pesanError,
        })

        return false;
      }
      $("#formData").find('form').submit()
    })
    $("#formData").find('form').submit(function(e) {
      e.preventDefault()
      console.log($(this).serialize());
      $.ajax({
        url: "<?= base_url() ?>datata/tambahdatata",
        type: 'post',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(res) {
          if (res.status == 201) {
            Swal.fire({
              type: 'success',
              title: 'Success',
              html: res.message,
              showConfirmButton: false,
              timer: 1500
            })
          }
        }
      })
    })
  })
</script>

</div>
<!-- End of Main Content -->