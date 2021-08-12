<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Mahasiswa</h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('operation/tambahmahasiswa'); ?>

            <div class="form-group row">
                <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" value="<?= set_value('nim'); ?>">
                    <?= form_error('nim', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>

            </div>
            <div class="form-group row">
                <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                <div class="col-sm-9">
                    <select name="jurusan" id="jurusan" class="form-control col-sm-9">
                        <option selected>Pilih Jurusan</option>
                        <?php foreach ($jurusan as $j) : ?>
                            <option value="<?= $j['jurusan_id'] ?>"><?= $j['jurusan_nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="sms" class="col-sm-3 col-form-label">Semester</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="semester" name="semester" placeholder="Masukan Semster" value="<?= set_value('semester'); ?>">
                    <?= form_error('semester', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="totalsks" class="col-sm-3 col-form-label">Total Sks</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="totalsks" name="totalsks" placeholder="Masukan Total SKS" value="<?= set_value('totalsks'); ?>">
                    <?= form_error('totalsks', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="emailmhs" name="emailmhs" placeholder="Masukan email valid" value="<?= set_value('emailmhs'); ?>">
                    <?= form_error('emailmhs', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="hpmhs" name="hpmhs" placeholder="Masukan Nomer HP" value="<?= set_value('hpmhs'); ?>">
                    <?= form_error('hpmhs', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Aktif</label>
                <div class="form-check form-check-inline pl-3">
                    <input type="radio" name="aktif" value="1" <?php echo  set_radio('aktif', '1', TRUE); ?> />
                    <label class="form-check-label">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="aktif" value="0" <?php echo  set_radio('aktif', '0'); ?> />
                    <label class="form-check-label">Tidak</label>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Foto</div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/mahasiswa/default.jpg') ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagemhs" name="imagemhs">
                                <?= form_error('imagemhs', ' <small class="text-danger pl-3">', '</small>'); ?>
                                <label class="custom-file-label" for="imagemhs">Pilih foto</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="<?= base_url('operation/mahasiswa'); ?>" class="btn btn-danger">Kembali</a>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->