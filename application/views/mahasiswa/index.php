<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $user_name =  $this->session->userdata('user_name');
    $query = "SELECT * 
    FROM mahasiswa INNER JOIN jurusan
    ON mahasiswa.kode_jurusan = jurusan.id
    WHERE mahasiswa.nim = $user_name  
    ORDER BY mahasiswa.nim ASC
    ";
    $datamhs = $this->db->query($query)->row_array();
    ?>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/mahasiswa/') . $datamhs['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Nim Mahasiswa =<?= $datamhs['nim']; ?></h5>
                    <p class="card-text">Nama Lengkap Mahasiswa =<?= $datamhs['name']; ?></p>
                    <p class="card-text">Semester = <?= $datamhs['semester']; ?></p>
                    <p class="card-text">Total Sks =<?= $datamhs['totalsks']; ?> sks</p>
                    <p class="card-text">Jurusan =<?= $datamhs['nama_jurusan']; ?></p>
                    <p class="card-text">Email = <?= $datamhs['email']; ?></p>
                    <p class="card-text">Whatsapp = <?= $datamhs['hp']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->