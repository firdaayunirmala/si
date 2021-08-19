<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg-8">

      <?= form_open_multipart(); ?>
      <input type="hidden" id="mhs_id" name="mhs_id" value="<?= $mahasiswa['mhs_id']; ?>">
      <div class="form-group row">
        <label for="nim" class="col-sm-3 col-form-label">NIM</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim']; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="name" name="name" value="<?= $mahasiswa['name']; ?>">
          <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>


      <div class="form-group row">
        <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $mahasiswa['jurusan_nama']; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="email" name="email" value="<?= $mahasiswa['email']; ?>">
          <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="sms" class="col-sm-3 col-form-label">Semester</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="semester" name="semester" value="<?= $mahasiswa['semester']; ?>">
          <?= form_error('semester', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="totalsks" class="col-sm-3 col-form-label">Total Sks</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="totalsks" name="totalsks" value="<?= $mahasiswa['totalsks']; ?>">
          <?= form_error('totalsks', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="hp" name="hp" value="<?= $mahasiswa['hp']; ?>">
          <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-3">Foto</div>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-sm-3">
              <img src="<?= base_url('assets/img/profile/mahasiswa/') . $mahasiswa['image']; ?>" class="img-thumbnail">
            </div>

          </div>
        </div>
        <div class="col-sm-3">Ganti Foto</div>
        <div class="col-sm-9">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Pilih foto</label>
          </div>
        </div>
      </div>
      <div class="form-group row justify-content-end">
        <div class="col-sm-9">
          <button type="submit" class="btn btn-primary">Perbarui</button>
          <button type="reset" class="btn btn-warning">Reset</button>
          <a href="<?= base_url('user'); ?>" class="btn btn-danger">Batal</a>
        </div>
      </div>

      </form>


    </div>

  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->