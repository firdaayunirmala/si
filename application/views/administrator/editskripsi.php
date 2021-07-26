<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Form Edit Data Tugas Akhir</h1>

  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow">
        <div class="card-body">

          <?= form_open_multipart(); ?>
          <input type="hidden" name="id" value="<?= $datata['id']; ?>">

          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nim" name="nim" value="<?= $datata['nim']; ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $datata['name']; ?>" readonly>
              <input type="hidden" id="id_user" name="id_user" value="<?= $datata['id_user']; ?>">
              <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-7">
              <select name="jurusan" id="jurusan" class="form-control col-sm-9">
                <?php foreach ($jurusan as $j) : ?>
                  <?php if ($j['id'] == $datata['kode_jurusan']) : ?>
                    <option value="<?= $j['id'] ?>" selected><?= $j['nama_jurusan'] ?></option>
                  <?php else : ?>
                    <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="judul" name="judul"><?= $datata['judul']; ?></textarea>
              <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="custom-file col-sm-9">
              <input type="file" id="sinopsis" name="sinopsis" class="custom-file-input"><?= $datata['sinopsis']; ?>
              <?= form_error('filename', ' <small class="text-danger pl-3">', '</small>'); ?>
              <label class="custom-file-label" for="customFile">Choose File</label>
            </div>
          </div>

          <div class="form-group row">
            <label for="pembimbing1" class="col-sm-3 col-form-label">Pembimbing 1</label>
            <div class="col-sm-9">
              <select name="pembimbing1" id="pembimbing1" class="form-control col-sm-9">
                <?php foreach ($dosen as $dsn) : ?>
                  <?php if ($dsn['id'] == $datata['id_dosen1']) : ?>
                    <option value="<?= $dsn['id'] ?>" selected><?= $dsn['name'] ?></option>
                  <?php else : ?>
                    <option value="<?= $dsn['id'] ?>"><?= $dsn['name'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
              <input type="hidden" name="id_detail1" id="id_detail1" value="<?= $datata['id_detail1'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="pembimbing2" class="col-sm-3 col-form-label">Pembimbing 2</label>
            <div class="col-sm-9">
              <select name="pembimbing2" id="pembimbing2" class="form-control col-sm-9">
                <?php foreach ($dosen as $dsn) : ?>
                  <?php if ($dsn['id'] == $datata['id_dosen2']) : ?>
                    <option value="<?= $dsn['id'] ?>" selected><?= $dsn['name'] ?></option>
                  <?php else : ?>
                    <option value="<?= $dsn['id'] ?>"><?= $dsn['name'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
              <input type="hidden" name="id_detail2" id="id_detail2" value="<?= $datata['id_detail2'] ?>">
            </div>
          </div>

          <div class="form-group row justify-content-end">
            <div class="col-sm-9">
              <small class="text-danger"> Perhatikan data yang di isi sudah benar ! </small>
              <br>
              <button type="submit" name="update" value="update" class="btn btn-primary">Perbarui</button>

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