<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  
    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('dosen/pesan') ?>" class="btn btn-success mb-3">Kirim Pesan</a>
            <div class="table-responsive">
                <h3>Riwayat Bimbingan Tugas Akhir</h3>
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Catatan Bimbingan</th>
                            <th scope="col">Opsi</th>

                        </tr>
                    </thead>
               
                    <tbody>                 
                    <?php $i = 1; ?>
                    <?php foreach ($bimbingan_dsn as $bim) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $bim['tanggal']; ?></td>
                            <td><?= $bim['name']; ?></td>
                            <td><?= $bim['catatan']; ?></td>
                            <td> <a class=" btn btn-warning btn-sm " href="<?= base_url() ?>dosen/detailbimbingan/<?= $bim['id']; ?>">Detail</a>
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
<!-- /.container-fluid -->
<br>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="col-lg-12">
      <div class="card shadow">
    <h1 class="h3 mb-4 text-gray-800">Kirim Riwayat Bimbingan</h1>
    <?= form_open_multipart('dosen/bimbingan'); ?>

    <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="tanggal">Tanggal Bimbingan</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="date" class="form-control" placeholder="Periode Tanggal">
                    </div>
                    <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                </div>
    </div>
    
    <div class="form-group row">
                <label for="konsultasi" class="col-sm-3 col-form-label">Catatan Bimbingan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="konsultasi" name="konsultasi" placeholder="Masukan konsultasi Bimbingan Skripsi" value="<?= set_value('konsultasi'); ?>"></textarea>
                    <?= form_error('konsultasi', ' <small class="text-danger pl-3">', '</small>'); ?>
                    <small class="text-danger"> Harap data yang di isi dengan benar ! </small>
                </div>
            </div>
    <div>

    <div class="form-group row">
                <label for="password2" class="col-sm-3 col-form-label">Pilih Mahasiswa </label>
                <div class="col-sm-9">
                    <select name="dosbing2" id="dosbing2" class="form-control col-sm-9">
                        <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['nik'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
    </div>

    <a href="<?= base_url('mahasiswa/bimbingan'); ?>" class="btn btn-success">Upload</a>
    </div>
           
</div>
    </div>
</div>