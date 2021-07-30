<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Mahasiswa Bimbingan</h1>
    <a href="<?= base_url('dosen'); ?>" class="btn btn-danger">Kembali</a>
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="dataTable">
        <thead class="thead-dark">
            <tr>
                <td>No</td>
                <td>NIM</td>
                <td>Nama</td>
                <td>Judul</td>
                <td>Sinopsis</td>
                <td>Jurusan</td>
                <td>Opsi</td>
            </tr>
        </thead>

        <?php
      $query = "SELECT
      d.id ,
      d.id_user ,
      m.nim ,
      m.name ,
      d.judul ,
      d.sinopsis,
      j.nama_jurusan,
      d.status,
      dd.id_dosen,
      dd.id as id_detail
  FROM
      datata d
  inner join datata_detail dd on
      dd.id_datata = d.id
  inner join mahasiswa m on
      m.id = d.id_user
  inner join jurusan j on
  m.kode_jurusan = j.id
  where
      d.id = id_dosen";
    $datata = $this->db->query($query)->result_array();
      ?>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($datata as $d) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $d['nim']; ?></td>
                    <td><?= $d['name']; ?></td>
                    <td><?= $d['judul']; ?></td>
                    <td><?= $d['sinopsis']; ?></td>
                    <td><?= $d['nama_jurusan']; ?></td>
                    <td>
                    <div class="button ">
                    <?php
                    $aktif = $d['status']; ?>
                    <a class="btn btn-success btn-sm" for="aktif" 
                    name="aktifstatus" <?php if ($aktif == '1') {
                    } ?> value="1"> Di Setujui
                    <a class="btn btn-warning btn-sm" for="aktif" 
                    name="aktifstatus" <?php if ($aktif == '0') {
                    } ?> value="1"> Belum Di Setujui
                    <a class="btn btn-danger btn-sm" for="aktif" 
                    name="aktifstatus" <?php if ($aktif == '') {
                    } ?> value="1"> Tidak Di Setujui
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>