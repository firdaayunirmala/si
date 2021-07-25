<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tambah Data Tugas Akhir</h1>

  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow">
        <div class="card-body">

          <?= form_open_multipart('administrator/tambahdatata'); ?>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" value="" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
              <select name="id_user" id="id_user" class="form-control">
                <?php foreach ($mahasiswa as $k => $v) : ?>
                  <option value="<?= $v->id ?>" data-nim="<?= $v->nim ?>"><?= $v->name ?></option>
                <?php endforeach; ?>
              </select>
              <!-- <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value=""> -->
              <?= form_error('id_user', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="judul" name="judul" placeholder="Masukan Judul Skripsi" value="<?= set_value('judul'); ?>"></textarea>
              <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-9">
              <select name="jurusan" id="jurusan" class="form-control col-sm-9">
                <option value="0" selected>Pilih Jurusan</option>
                <?php foreach ($jurusan as $j) : ?>
                  <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="dosen" class="col-sm-3 col-form-label">Pembimbing 1</label>
            <div class="col-sm-9">
              <select name="pembimbing1" id="pembimbing1" class="form-control col-sm-9">
                <option value="0">Pilih Dosen Pembimbing 1</option>
                <?php foreach ($dosen as $pembimbing1) : ?>
                  <option value="<?= $pembimbing1['id'] ?>"><?= $pembimbing1['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="dosen" class="col-sm-3 col-form-label">Pembimbing 2</label>
            <div class="col-sm-9">
              <select name="pembimbing2" id="pembimbing2" class="form-control col-sm-9">
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
              <button type="submit" class="btn btn-primary">Tambah</button>
              <a href="<?= base_url('administrator/datata'); ?>" class="btn btn-danger">Kembali</a>

            </div>
          </div>

          </form>
        </div>

      </div>

    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  $(document).ready(function() {
    $("#id_user").trigger('change')
  })
  $("#id_user").select2({
    width: 'resolve'
  })
  $("#id_user").change(function() {
    $('#nim').val($("#id_user").select2().find(":selected").data("nim"))
  })
</script>