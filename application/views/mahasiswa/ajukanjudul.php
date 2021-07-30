<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Ajukan Judul Tugas Akhir</h1>
    <div class="row">
        <div class="col-lg-8">
        <?php $nim = $_SESSION['nim']; ?>
         <input type="hidden" id="nim" value="<?php echo $nim ?>" ;>
            <?= form_open_multipart('mahasiswa/judul'); ?>

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
                <label for="judul" class="col-sm-3 col-form-label">Judul Tugas Akhir</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="judul" name="judul" placeholder="Masukan Judul Bimbingan Skripsi" value="<?= set_value('judul'); ?>"></textarea>
                    <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Pilih DosPem 1 </label>
                <div class="col-sm-9">
                    <select name="dosbing" id="dosbing" class="form-control col-sm-9">
                        <option selected>Pilih Dosen Pembimbing</option>
                        <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Pilih DosPem 2 </label>
                <div class="col-sm-9">
                    <select name="dosbing" id="dosbing" class="form-control col-sm-9">
                        <option selected>Pilih Dosen Pembimbing</option>
                        <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">Upload Sinopsis</div>
                <div class="custom-file col-sm-9">
                    <input type="file" id="sinopsis" name="sinopsis" class="custom-file-input" required>
                    <?= form_error('filename', ' <small class="text-danger pl-3">', '</small>'); ?>
                    <label class="custom-file-label" for="customFile">Pilih File</label>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <small class="text-danger"> Harap semua data yang di isi dengan benar ! </small>
                    <br>
                    <a a href="<?= base_url('mahasiswa/bimbingan'); ?>" type="button" id="sendKegiatan" class="btn btn-primary">Kirim</a>
                    <a href="<?= base_url('mahasiswa/bimbingan'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>