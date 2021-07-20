<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $nim_create_mhs_bimbingan = $_SESSION['nim']; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Upload Form Bimbingan Tugas Akhir</h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('mahasiswa/kirimfile'); ?>

            <div class="form-group row" style="display: none;">
                <label for="nama" class="col-sm-3 col-form-label">NIM </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nim_create_mhs_bimbingan" name="nim" placeholder="masukan nim" value="<?php echo $nim_create_mhs_bimbingan; ?>">

                </div>
            </div>
            <div class="form-group row" style="display: none;">
                <label for="nama" class="col-sm-3 col-form-label">Nama Mahasiswa </label>
                <div class="col-sm-6">
                    <?php foreach ($user_data as $user_create_mhs_bimbingan) : ?>
                        <input type="text" class="form-control" id="nama_create_mhs_bimbingan" name="nama" placeholder="masukan nama" value="<?php echo $user_create_mhs_bimbingan['name'] ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group row" style="margin-top: 20px;">
                <label class="col-sm-3 col-form-label" for="tanggal">Tanggal Bimbingan</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="date" class="form-control" placeholder="Periode Tanggal">
                    </div>
                    <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="konsultasi" class="col-sm-3 col-form-label">Konsultasi Bimbingan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="konsultasi" name="konsultasi" placeholder="Masukan konsultasi Bimbingan Skripsi" value="<?= set_value('konsultasi'); ?>"></textarea>
                    <?= form_error('konsultasi', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Kirim Dosen Pembimbing 1</label>
                <div class="col-sm-9">
                    <select name="dosbing1" id="dosbing1" class="form-control col-sm-9">
                        <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['nik'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row" style="display: none;">
                <label for="password" class="col-sm-3 col-form-label">Kirim Dosen Pembimbing 1</label>
                <div class="col-sm-9">
                    <input type="text" id="dosbing1">
                </div>
            </div>

            <div class="form-group row" style="display: none;">
                <label for="password2" class="col-sm-3 col-form-label">Kirim Dosen Pembimbing 2</label>
                <div class="col-sm-9">
                    <input type="text" id="dosbing2">
                </div>
            </div>

            <div class="form-group row">
                <label for="password2" class="col-sm-3 col-form-label">Kirim Dosen Pembimbing 2</label>
                <div class="col-sm-9">
                    <select name="dosbing2" id="dosbing2" class="form-control col-sm-9">
                        <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['nik'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">Upload File Laporan</div>
                <div class="col-sm-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_create_mhs_bimbingan" name="file">
                        <label class="custom-file-label" for="file" id="label_file_create_mhs_bimbingan">Pilih Laporan</label>
                        <small class="text-danger"> Dalam Bentuk Word dan Pdf </small>
                        <input type="hidden" id="file_data_create_mhs_bimbingan">
                    </div>

                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Link Google Drive </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="link" name="link" placeholder="Jika Ada Masukan Link Google Drive" value="<?= set_value('link'); ?>"></textarea>

                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <small class="text-danger"> Harap semua data yang di isi dengan benar ! </small>
                    <br>
                    <button type="button" id="sendKegiatan" class="btn btn-primary">Kirim</button>
                    <a href="<?= base_url('mahasiswa/bimbingan'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->