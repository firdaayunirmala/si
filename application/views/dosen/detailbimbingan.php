<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Mahasiswa Bimbingan</h1>
  
    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart(); ?>
            <input type="hidden" name="id" value="<?= $datata['id'] ?>">
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
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-7">
            <input type="hidden" name="jurusan" id="jurusan" value="<?= $datata['kode_jurusan'] ?>">
              <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $datata['kode_jurusan']; ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="judul" name="judul"><?= $datata['judul']; ?></textarea>
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
              <input type="hidden" name="id_detail1" id="id_detail1" value="<?= $datata['id_detail1'] ?>">
              <input type="text" class="form-control" id="id_detail1" name="id_detail1" value="<?= $datata['id_detail1']; ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="pembimbing2" class="col-sm-3 col-form-label">Pembimbing 2</label>
            <div class="col-sm-9">
              <input type="hidden" name="id_detail2" id="id_detail2" value="<?= $datata['id_detail2'] ?>">
              <input type="text" class="form-control" id="id_detail2" name="id_detail2" value="<?= $datata['id_detail2']; ?>" readonly>
            </div>
          </div>

            <div class="form-group row">
                <label for="aktif" class="col-sm-3 col-form-label">Status</label>
                <?php
                $aktif = $datata['status']; ?>
                <div class="form-check form-check-inline pl-3" for="aktifsts">
                    <input type="radio" name="aktifsts" <?php if ($aktif == '1') {
                                                            echo 'checked';
                                                        } ?> value="1">
                    <label class="form-check-label" for="aktifsts">Belum disetujui</label>
                </div>
                <div class="form-check form-check-inline pl-3">
                    <input type="radio" name="aktifsts" <?php if ($aktif == '2') {
                                                            echo 'checked';
                                                        } ?> value="2">
                    <label class="form-check-label" for="aktifsts">Di Setujui</label>
                </div>
                <div class="form-check form-check-inline pl-3">
                    <input type="radio" name="aktifsts" <?php if ($aktif == '0') {
                                                            echo 'checked';
                                                        } ?> value="0">
                <label class="form-check-label" for="aktifsts">Tidak di setujui</label>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="<?= base_url('dosen'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

               