<!-- Begin Page Content -->
<div class="container-fluid">
   
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Upload Form Bimbingan Tugas Akhir</h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('mahasiswa/kirimfile'); ?>

            <div class="form-group row" style="display: none;">
                <label for="nama" class="col-sm-3 col-form-label">NIDN </label>
                <div class="col-sm-6">
            
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
                <label for="password" class="col-sm-3 col-form-label">Pilih Dosen Pembimbing </label>
                <div class="col-sm-9">
                    <select name="dosbing1" id="dosbing1" class="form-control col-sm-9">
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
                        <small class="text-danger"> Dalam Bentuk Word atau Pdf </small>
                        <input type="hidden" id="file_data_create_mhs_bimbingan">
                    </div>

                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <small class="text-danger"> Harap semua data yang di isi dengan benar ! </small>
                    <br>
                    <a a href="<?= base_url('dosen/bimbingan'); ?>" type="button" id="sendKegiatan" class="btn btn-primary">Kirim</a>
                    <a href="<?= base_url('dosen/bimbingan'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    $(document).ready(function() {
        var nimCall = $('#nim_create_mhs_bimbingan').val();
        $.ajax({
            type: "GET",
            url: '../API/data/dataDosenPembimbing.php?pembimbing1=' + nimCall,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                var StringData = JSON.stringify(data);
                var MahasiswaData = jQuery.parseJSON(StringData);
                var mahasiswaDataPush = MahasiswaData.data;
                var html = '';
                mahasiswaDataPush.forEach(function(item, index, array) {
                    $('#dosbing1').val(item.name);
                });
            }
        });

        $.ajax({
            type: "GET",
            url: '../API/data/dataDosenPembimbing.php?pembimbing2=' + nimCall,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                var StringData = JSON.stringify(data);
                var MahasiswaData = jQuery.parseJSON(StringData);
                var mahasiswaDataPush = MahasiswaData.data;
                var html = '';
                mahasiswaDataPush.forEach(function(item, index, array) {
                    $('#dosbing2').val(item.name);
                });
            }
        });
    });
</script>
</div>
<!-- End of Main Content -->